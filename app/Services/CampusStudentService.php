<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CampusStudentService
{
    /**
     * Autentikasi akun mahasiswa melalui IP / API kampus.
     * Tidak membuat akun mahasiswa secara manual di luar sinkronisasi data kampus.
     *
     * @return array{ok: bool, user?: User, reason?: string, source: string}
     */
    public function authenticate(string $identifier, string $password): array
    {
        $identifier = trim($identifier);
        $apiEnabled = (bool) config('campus.enabled', false);
        $baseUrl = (string) config('campus.base_url', '');

        if ($apiEnabled && $baseUrl !== '') {
            try {
                $endpoint = $baseUrl . '/' . ltrim((string) config('campus.login_endpoint', '/mahasiswa/login'), '/');
                $req = Http::acceptJson()->timeout((int) config('campus.timeout', 6));

                $token = (string) config('campus.api_token', '');
                if ($token !== '') {
                    $req = $req->withToken($token);
                }

                $response = $req->post($endpoint, [
                    'nim' => $identifier,
                    'nomor_induk' => $identifier,
                    'password' => $password,
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $payload = is_array($json) ? ($json['data'] ?? $json['mahasiswa'] ?? $json) : null;

                    if (is_array($payload) && (!empty($payload['nim']) || !empty($payload['nomor_induk']))) {
                        $student = $this->syncCampusStudent($payload, $password);

                        if ($student->status_akun !== 'aktif') {
                            return [
                                'ok' => false,
                                'reason' => 'inactive',
                                'user' => $student,
                                'source' => 'campus_api',
                            ];
                        }

                        return [
                            'ok' => true,
                            'user' => $student,
                            'source' => 'campus_api',
                        ];
                    }
                }

                if (in_array($response->status(), [400, 401, 403, 404, 422], true)) {
                    return [
                        'ok' => false,
                        'reason' => 'invalid_credentials',
                        'source' => 'campus_api',
                    ];
                }

                Log::warning('Campus API returned non-auth error during student login.', [
                    'status' => $response->status(),
                    'endpoint' => $endpoint,
                ]);
            } catch (ConnectionException $e) {
                Log::warning('Campus API unreachable; checking fallback setting.', [
                    'message' => $e->getMessage(),
                ]);
            } catch (\Throwable $e) {
                Log::error('Unexpected Campus API error.', [
                    'message' => $e->getMessage(),
                ]);
            }

            if (!config('campus.fallback_local', true)) {
                return [
                    'ok' => false,
                    'reason' => 'campus_unreachable',
                    'source' => 'campus_api',
                ];
            }
        }

        return $this->authenticateSyncedLocalStudent($identifier, $password);
    }

    /**
     * Ambil profil mahasiswa berdasarkan NIM langsung dari endpoint IP kampus (read-only).
     */
    public function fetchStudentByNim(string $nim): ?array
    {
        if (!config('campus.enabled', false) || config('campus.base_url', '') === '') {
            return null;
        }

        try {
            $endpoint = config('campus.base_url') . '/' . ltrim((string) config('campus.student_endpoint', '/mahasiswa'), '/') . '/' . urlencode(trim($nim));
            $req = Http::acceptJson()->timeout((int) config('campus.timeout', 6));
            if (config('campus.api_token', '') !== '') {
                $req = $req->withToken((string) config('campus.api_token'));
            }

            $res = $req->get($endpoint);
            if ($res->successful()) {
                $json = $res->json();
                $payload = is_array($json) ? ($json['data'] ?? $json) : null;
                return is_array($payload) ? $payload : null;
            }
        } catch (\Throwable $e) {
            Log::warning('Failed fetching student profile from Campus API.', ['nim' => $nim, 'error' => $e->getMessage()]);
        }

        return null;
    }

    /**
     * Verifikasi terhadap data akun mahasiswa yang sudah tersinkron di database lokal.
     * Menolak keras pembuatan akun mahasiswa baru secara liar jika NIM belum terdaftar.
     */
    private function authenticateSyncedLocalStudent(string $identifier, string $password): array
    {
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'nomor_induk';

        $student = User::where('role', 'mahasiswa')
            ->where($field, $identifier)
            ->first();

        if (!$student) {
            return [
                'ok' => false,
                'reason' => 'invalid_credentials',
                'source' => 'local_synced',
            ];
        }

        if ($student->status_akun !== 'aktif') {
            return [
                'ok' => false,
                'reason' => 'inactive',
                'user' => $student,
                'source' => 'local_synced',
            ];
        }

        if (Hash::check($password, $student->password)) {
            return [
                'ok' => true,
                'user' => $student,
                'source' => 'local_synced',
            ];
        }

        return [
            'ok' => false,
            'reason' => 'invalid_credentials',
            'user' => $student,
            'source' => 'local_synced',
        ];
    }

    /**
     * Sinkronkan data mahasiswa yang dikembalikan langsung oleh IP / server kampus.
     */
    private function syncCampusStudent(array $payload, string $plainPassword): User
    {
        $nim = trim((string) ($payload['nim'] ?? $payload['nomor_induk']));
        $name = trim((string) ($payload['nama'] ?? $payload['name'] ?? ('Mahasiswa FT UNM (' . $nim . ')')));
        $email = trim((string) ($payload['email'] ?? ($nim . '@mhs.unm.ac.id')));
        $kelasInput = $payload['kelas'] ?? $payload['jurusan'] ?? $payload['prodi'] ?? null;

        $kelasId = null;
        if (!empty($kelasInput)) {
            $resolved = Kelas::resolveFromInput((string) $kelasInput);
            if ($resolved) {
                $kelasId = $resolved->id;
            }
        }

        $student = User::where('nomor_induk', $nim)->where('role', 'mahasiswa')->first();

        if ($student) {
            $updates = [
                'name' => $name,
                'email' => $email ?: $student->email,
                'password' => Hash::make($plainPassword),
            ];
            if ($kelasId) {
                $updates['kelas_id'] = $kelasId;
            }
            $student->update($updates);

            return $student->fresh();
        }

        // Hindari bentrok dengan akun staf (pengelola/admin) yang sudah ada
        if (User::where('nomor_induk', $nim)->exists() || User::where('email', $email)->exists()) {
            throw new \RuntimeException('Nomor induk atau email bentrok dengan akun non-mahasiswa.');
        }

        return User::create([
            'nomor_induk' => $nim,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($plainPassword),
            'role' => 'mahasiswa',
            'kelas_id' => $kelasId,
            'status_akun' => 'aktif',
        ]);
    }
}
