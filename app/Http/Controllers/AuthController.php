<?php

namespace App\Http\Controllers;

use App\Mail\LoginSecurityAlertMail;
use App\Mail\PasswordResetConfirmMail;
use App\Models\LoginHistory;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private const FIRST_LOCK_ATTEMPTS = 3;
    private const FIRST_LOCK_SECONDS = 3 * 60;
    private const SECOND_LOCK_ATTEMPTS = 5;
    private const SECOND_LOCK_SECONDS = 5 * 60;
    private const SECURITY_WINDOW_SECONDS = 60 * 60;
    private const RESET_EXPIRE_MINUTES = 60;

    // Halaman pembukaan dengan animasi (root / -> Slide 2 khusus Portal Mahasiswa)
    public function showOpening(Request $request)
    {
        return view('animasi_pembukaan', $this->resolveLoginThrottleState($request, 'mahasiswa'));
    }

    // Halaman Portal Login khusus Mahasiswa (Database Aplikasi)
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectSesuaiRole(Auth::user());
        }

        return view('auth.login', $this->resolveLoginThrottleState($request, 'mahasiswa'));
    }

    // Halaman Portal Login khusus Pengelola & Admin
    public function showStaffLogin(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectSesuaiRole(Auth::user());
        }

        return view('auth.staff_login', $this->resolveLoginThrottleState($request, 'petugas'));
    }

    // Halaman Pendaftaran Mandiri Khusus Pengelola (Menunggu ACC Admin)
    public function showPengelolaRegister()
    {
        if (Auth::check()) {
            return $this->redirectSesuaiRole(Auth::user());
        }

        $ruangans = Ruangan::where('jenis_ruangan', 'alat_bahan')
            ->orderBy('nama_ruangan')
            ->get();

        return view('auth.pengelola_register', compact('ruangans'));
    }

    // Memproses pendaftaran mandiri Pengelola (otomatis status menunggu_acc)
    public function registerPengelola(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'nomor_induk' => 'required|string|max:50|unique:users,nomor_induk',
            'email' => 'required|email|max:150|unique:users,email',
            'ruangan_id' => 'required|exists:ruangans,id',
            'jabatan' => 'nullable|string|max:120',
            'password' => 'required|string|min:6|max:32|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nomor_induk.required' => 'NIP / Nomor Induk Pengelola wajib diisi.',
            'nomor_induk.unique' => 'NIP / Nomor Induk tersebut sudah terdaftar.',
            'email.required' => 'Email aktif wajib diisi (digunakan untuk verifikasi lupa kata sandi).',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email tersebut sudah terdaftar.',
            'ruangan_id.required' => 'Unit / Ruangan penugasan wajib dipilih.',
            'ruangan_id.exists' => 'Unit / Ruangan yang dipilih tidak ditemukan.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.max' => 'Kata sandi maksimal 32 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::create([
            'name' => trim($validated['name']),
            'nomor_induk' => trim($validated['nomor_induk']),
            'email' => Str::lower(trim($validated['email'])),
            'ruangan_id' => $validated['ruangan_id'],
            'jabatan' => !empty($validated['jabatan']) ? trim($validated['jabatan']) : 'Pengelola Sarpras',
            'password' => Hash::make($validated['password']),
            'role' => 'pengelola',
            'status_akun' => 'menunggu_acc',
        ]);

        return redirect()->route('staff.login')
            ->with('status', 'Pendaftaran akun Pengelola berhasil dikirim. Mohon tunggu persetujuan (ACC) dari Admin Sarpras sebelum masuk ke sistem.');
    }

    // Memproses login khusus Mahasiswa langsung menggunakan data akun pada database
    public function loginMahasiswa(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required|string|max:100',
            'password' => 'required|string|min:6|max:32',
        ], [
            'nomor_induk.required' => 'NIM atau Email Mahasiswa wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.max' => 'Kata sandi maksimal 32 karakter.',
        ]);

        $identifier = trim((string) $request->nomor_induk);
        $normalizedIdent = Str::lower($identifier);
        $password = (string) $request->password;
        $remember = $request->filled('remember');
        $matchedByIdent = User::where('nomor_induk', $identifier)->orWhere('email', $identifier)->first();
        $throttleKey = $this->throttleKey('mahasiswa', $normalizedIdent, $request->ip());
        $secState = $this->getSecurityState('mahasiswa', $normalizedIdent, $request->ip(), $matchedByIdent);

        $request->session()->put('login_throttle_ident_mahasiswa', $normalizedIdent);

        if (($secState['lock_until'] ?? 0) > now()->timestamp) {
            $seconds = max(1, (int) $secState['lock_until'] - now()->timestamp);
            $stageMinutes = (int) ($secState['stage_minutes'] ?? 3);
            $attemptCount = (int) ($secState['attempts'] ?? self::FIRST_LOCK_ATTEMPTS);
            $emailSent = (bool) ($secState['email_alert_sent'] ?? false);

            $this->recordLoginHistory(
                $request,
                $matchedByIdent,
                $identifier,
                $matchedByIdent?->role ?? 'mahasiswa',
                'mahasiswa',
                'terkunci',
                "Akses masuk masih ditahan sementara ({$stageMinutes} menit)"
            );

            return back()->withErrors([
                'login_error' => $this->formatLockoutMessage($seconds, $stageMinutes, $attemptCount, $emailSent),
            ])->with('login_throttle_portal', 'mahasiswa')
              ->with('login_lockout_seconds', $seconds)
              ->with('login_lockout_stage_minutes', $stageMinutes)
              ->with('login_lockout_attempts', $attemptCount)
              ->with('login_email_alert_sent', $emailSent)
              ->with('login_locked_ident', $normalizedIdent)
              ->onlyInput('nomor_induk', 'remember');
        }

        // Pastikan akun Pengelola / Admin tidak masuk melalui portal Mahasiswa
        $existingStaff = ($matchedByIdent && in_array($matchedByIdent->role, ['pengelola', 'admin'], true))
            ? $matchedByIdent
            : null;

        if ($existingStaff) {
            $this->recordLoginHistory(
                $request,
                $existingStaff,
                $identifier,
                $existingStaff->role,
                'mahasiswa',
                'ditolak',
                'Akun staf mencoba masuk di portal mahasiswa'
            );

            return back()->withErrors([
                'login_error' => 'Akun Pengelola dan Admin wajib masuk melalui Portal Login Pengelola & Admin.',
            ])->with('redirect_staff_portal', true)
              ->onlyInput('nomor_induk');
        }

        // Autentikasi mahasiswa langsung dari tabel users di database (tidak membuat akun baru otomatis)
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'nomor_induk';
        $student = User::where('role', 'mahasiswa')
            ->where($field, $identifier)
            ->first();

        if (!$student || !Hash::check($password, $student->password)) {
            return $this->handleFailedLoginAttempt($request, $throttleKey, $normalizedIdent, 'mahasiswa', $student);
        }

        if ($student->status_akun !== 'aktif') {
            $this->clearSecurityState('mahasiswa', $normalizedIdent, $request->ip(), $student);
            $request->session()->forget('login_throttle_ident_mahasiswa');

            $this->recordLoginHistory(
                $request,
                $student,
                $identifier,
                'mahasiswa',
                'mahasiswa',
                'nonaktif',
                'Akun mahasiswa dinonaktifkan'
            );

            return back()->withErrors([
                'login_error' => 'Akun mahasiswa Anda sedang dinonaktifkan. Hubungi Admin Sarpras.',
            ])->onlyInput('nomor_induk');
        }

        $this->clearSecurityState('mahasiswa', $normalizedIdent, $request->ip(), $student);
        $request->session()->forget('login_throttle_ident_mahasiswa');
        Auth::login($student, $remember);
        $request->session()->regenerate();

        $this->recordLoginHistory(
            $request,
            $student,
            $identifier,
            'mahasiswa',
            'mahasiswa',
            'berhasil',
            'Login portal mahasiswa berhasil'
        );

        return $this->redirectSesuaiRole($student);
    }

    // Alias backward-compatible untuk rute atau pemanggil lama
    public function login(Request $request)
    {
        return $this->loginMahasiswa($request);
    }

    // Memproses login khusus Pengelola & Admin
    public function loginStaff(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required|string|max:100',
            'password' => 'required|string|min:6|max:32',
        ], [
            'nomor_induk.required' => 'NIP atau Email Pengelola/Admin wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.max' => 'Kata sandi maksimal 32 karakter.',
        ]);

        $identifier = trim((string) $request->nomor_induk);
        $normalizedIdent = Str::lower($identifier);
        $password = (string) $request->password;
        $remember = $request->filled('remember');
        $user = User::where('nomor_induk', $identifier)
            ->orWhere('email', $identifier)
            ->first();
        $throttleKey = $this->throttleKey('petugas', $normalizedIdent, $request->ip());
        $secState = $this->getSecurityState('petugas', $normalizedIdent, $request->ip(), $user);

        $request->session()->put('login_throttle_ident_petugas', $normalizedIdent);

        if (($secState['lock_until'] ?? 0) > now()->timestamp) {
            $seconds = max(1, (int) $secState['lock_until'] - now()->timestamp);
            $stageMinutes = (int) ($secState['stage_minutes'] ?? 3);
            $attemptCount = (int) ($secState['attempts'] ?? self::FIRST_LOCK_ATTEMPTS);
            $emailSent = (bool) ($secState['email_alert_sent'] ?? false);

            $this->recordLoginHistory(
                $request,
                $user,
                $identifier,
                $user?->role,
                'petugas',
                'terkunci',
                "Akses masuk masih ditahan sementara ({$stageMinutes} menit)"
            );

            return back()->withErrors([
                'login_error' => $this->formatLockoutMessage($seconds, $stageMinutes, $attemptCount, $emailSent),
            ])->with('login_throttle_portal', 'petugas')
              ->with('login_lockout_seconds', $seconds)
              ->with('login_lockout_stage_minutes', $stageMinutes)
              ->with('login_lockout_attempts', $attemptCount)
              ->with('login_email_alert_sent', $emailSent)
              ->with('login_locked_ident', $normalizedIdent)
              ->onlyInput('nomor_induk', 'remember');
        }

        // Tolak akun mahasiswa di portal petugas
        if ($user && $user->role === 'mahasiswa') {
            $this->recordLoginHistory(
                $request,
                $user,
                $identifier,
                'mahasiswa',
                'petugas',
                'ditolak',
                'Akun mahasiswa mencoba masuk di portal petugas'
            );

            return back()->withErrors([
                'login_error' => 'Akun Mahasiswa wajib masuk melalui Portal Login Mahasiswa.',
            ])->with('redirect_mahasiswa_portal', true)
              ->onlyInput('nomor_induk');
        }

        if (!$user || !in_array($user->role, ['pengelola', 'admin'], true) || !Hash::check($password, $user->password)) {
            return $this->handleFailedLoginAttempt($request, $throttleKey, $normalizedIdent, 'petugas', $user);
        }

        if ($user->status_akun === 'menunggu_acc') {
            $this->clearSecurityState('petugas', $normalizedIdent, $request->ip(), $user);
            $request->session()->forget('login_throttle_ident_petugas');

            $this->recordLoginHistory(
                $request,
                $user,
                $identifier,
                $user->role,
                'petugas',
                'menunggu_acc',
                'Pendaftaran pengelola belum di-ACC Admin'
            );

            return back()->withErrors([
                'login_error' => 'Pendaftaran akun Pengelola Anda masih menunggu persetujuan (ACC) dari Admin Sarpras.',
            ])->onlyInput('nomor_induk');
        }

        if ($user->status_akun === 'ditolak') {
            $this->clearSecurityState('petugas', $normalizedIdent, $request->ip(), $user);
            $request->session()->forget('login_throttle_ident_petugas');

            $this->recordLoginHistory(
                $request,
                $user,
                $identifier,
                $user->role,
                'petugas',
                'ditolak',
                'Pendaftaran pengelola ditolak Admin'
            );

            return back()->withErrors([
                'login_error' => 'Pendaftaran akun Pengelola Anda ditolak oleh Admin Sarpras.',
            ])->onlyInput('nomor_induk');
        }

        if ($user->status_akun !== 'aktif') {
            $this->clearSecurityState('petugas', $normalizedIdent, $request->ip(), $user);
            $request->session()->forget('login_throttle_ident_petugas');

            $this->recordLoginHistory(
                $request,
                $user,
                $identifier,
                $user->role,
                'petugas',
                'nonaktif',
                'Akun staf dinonaktifkan'
            );

            return back()->withErrors([
                'login_error' => 'Akun Anda sedang dinonaktifkan. Hubungi Admin Sarpras.',
            ])->onlyInput('nomor_induk');
        }

        $this->clearSecurityState('petugas', $normalizedIdent, $request->ip(), $user);
        $request->session()->forget('login_throttle_ident_petugas');
        Auth::login($user, $remember);
        $request->session()->regenerate();

        $this->recordLoginHistory(
            $request,
            $user,
            $identifier,
            $user->role,
            'petugas',
            'berhasil',
            'Login portal petugas berhasil'
        );

        return $this->redirectSesuaiRole($user);
    }

    // Mengirim tautan konfirmasi atur ulang kata sandi langsung ke email pemilik akun
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'identity' => 'required|string|max:150',
        ], [
            'identity.required' => 'Masukkan email atau NIM/NIP akun Anda terlebih dahulu.',
        ]);

        $identity = trim((string) $request->identity);
        $rateKey = 'forgot:' . sha1(Str::lower($identity) . '|' . ($request->ip() ?? '0.0.0.0'));

        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            $minutes = max(1, (int) ceil(RateLimiter::availableIn($rateKey) / 60));
            return back()->withErrors([
                'forgot_error' => "Terlalu banyak permintaan atur ulang kata sandi. Silakan coba lagi dalam {$minutes} menit.",
            ])->with('open_forgot_modal', true);
        }

        RateLimiter::hit($rateKey, 15 * 60);

        $user = User::where('email', $identity)
            ->orWhere('nomor_induk', $identity)
            ->first();

        if ($user && !empty($user->email) && filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $plainToken = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => Hash::make($plainToken),
                    'created_at' => now(),
                ]
            );

            $resetUrl = route('password.reset', [
                'token' => $plainToken,
                'email' => $user->email,
            ]);

            try {
                Mail::to($user->email)->send(new PasswordResetConfirmMail(
                    $user,
                    $resetUrl,
                    self::RESET_EXPIRE_MINUTES
                ));
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim email konfirmasi lupa kata sandi.', [
                    'email' => $user->email,
                    'error' => $e->getMessage(),
                ]);

                return back()->withErrors([
                    'forgot_error' => 'Gagal mengirim email konfirmasi saat ini. Pastikan konfigurasi email server sudah aktif atau coba beberapa saat lagi.',
                ])->with('open_forgot_modal', true);
            }
        }

        return back()->with(
            'status',
            'Jika akun terdaftar dengan email aktif, tautan konfirmasi atur ulang kata sandi telah dikirim langsung ke email pemilik akun. Silakan buka email Anda untuk menyetujui (ACC) perubahan kata sandi.'
        );
    }

    // Halaman konfirmasi kata sandi baru (dibuka dari tautan email pemilik akun)
    public function showResetPasswordForm(Request $request, string $token)
    {
        $email = Str::lower(trim((string) $request->query('email', '')));
        $tokenValid = $this->isValidResetToken($email, $token);

        return view('auth.reset_password', [
            'token' => $token,
            'email' => $email,
            'tokenValid' => $tokenValid,
        ]);
    }

    // Memproses penyimpanan kata sandi baru setelah pemilik akun mengonfirmasi lewat email
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email|max:150',
            'password' => 'required|string|min:6|max:32|confirmed',
        ], [
            'email.required' => 'Alamat email tidak ditemukan pada tautan konfirmasi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.max' => 'Kata sandi baru maksimal 32 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $email = Str::lower(trim((string) $request->email));
        $token = (string) $request->token;

        if (!$this->isValidResetToken($email, $token)) {
            return back()->withErrors([
                'reset_error' => 'Tautan konfirmasi atur ulang kata sandi tidak valid atau sudah kedaluwarsa. Silakan ajukan permintaan baru.',
            ])->withInput($request->only('email'));
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors([
                'reset_error' => 'Akun pemilik email tidak ditemukan.',
            ]);
        }

        $user->update([
            'password' => Hash::make((string) $request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Bersihkan kunci percobaan login sebelumnya agar pemilik akun dapat langsung masuk
        foreach (['mahasiswa', 'petugas'] as $portal) {
            $this->clearSecurityState($portal, $email, $request->ip(), $user);
            if (!empty($user->nomor_induk)) {
                $this->clearSecurityState($portal, Str::lower((string) $user->nomor_induk), $request->ip(), $user);
            }
        }

        $targetRoute = $user->role === 'mahasiswa' ? 'login' : 'staff.login';

        return redirect()->route($targetRoute)
            ->with('status', 'Kata sandi akun Anda berhasil diperbarui melalui konfirmasi email. Silakan masuk menggunakan kata sandi baru.');
    }

    private function isValidResetToken(string $email, string $plainToken): bool
    {
        if ($email === '' || $plainToken === '') {
            return false;
        }

        $record = DB::table('password_reset_tokens')->where('email', $email)->first();
        if (!$record || empty($record->token) || empty($record->created_at)) {
            return false;
        }

        if (Carbon::parse($record->created_at)->addMinutes(self::RESET_EXPIRE_MINUTES)->isPast()) {
            return false;
        }

        return Hash::check($plainToken, $record->token);
    }

    private function resolveLoginThrottleState(Request $request, string $portal): array
    {
        $isSamePortal = session('login_throttle_portal') === $portal;
        $lockoutSeconds = $isSamePortal ? (int) session('login_lockout_seconds', 0) : 0;
        $lockoutStageMinutes = $isSamePortal ? (int) session('login_lockout_stage_minutes', 3) : 3;
        $lockoutAttempts = $isSamePortal ? (int) session('login_lockout_attempts', self::FIRST_LOCK_ATTEMPTS) : self::FIRST_LOCK_ATTEMPTS;
        $emailAlertSent = $isSamePortal ? (bool) session('login_email_alert_sent', false) : false;
        $lockedIdent = $isSamePortal ? session('login_locked_ident') : null;
        $remainingAttempts = $isSamePortal ? session('login_remaining_attempts') : null;
        $nextLockMinutes = $isSamePortal ? (int) session('login_next_lock_minutes', 3) : 3;

        $lastIdent = $request->old('nomor_induk')
            ? Str::lower(trim((string) $request->old('nomor_induk')))
            : session("login_throttle_ident_{$portal}");

        if ($lastIdent) {
            $matchedUser = User::where('nomor_induk', $lastIdent)->orWhere('email', $lastIdent)->first();
            $state = $this->getSecurityState($portal, $lastIdent, $request->ip(), $matchedUser);
            $attempts = (int) ($state['attempts'] ?? 0);
            $lockUntil = (int) ($state['lock_until'] ?? 0);

            if ($lockUntil > now()->timestamp) {
                $lockoutSeconds = max($lockoutSeconds, $lockUntil - now()->timestamp);
                $lockoutStageMinutes = (int) ($state['stage_minutes'] ?? ($attempts >= self::SECOND_LOCK_ATTEMPTS ? 5 : 3));
                $lockoutAttempts = max(self::FIRST_LOCK_ATTEMPTS, $attempts);
                $emailAlertSent = $emailAlertSent || (bool) ($state['email_alert_sent'] ?? false);
                $lockedIdent = $lastIdent;
                $remainingAttempts = 0;
            } elseif ($remainingAttempts === null && $attempts > 0) {
                if ($attempts < self::FIRST_LOCK_ATTEMPTS) {
                    $remainingAttempts = max(0, self::FIRST_LOCK_ATTEMPTS - $attempts);
                    $nextLockMinutes = 3;
                } elseif ($attempts < self::SECOND_LOCK_ATTEMPTS) {
                    $remainingAttempts = max(0, self::SECOND_LOCK_ATTEMPTS - $attempts);
                    $nextLockMinutes = 5;
                } else {
                    $remainingAttempts = 1;
                    $nextLockMinutes = 5;
                }
            }
        }

        return compact(
            'lockoutSeconds',
            'lockoutStageMinutes',
            'lockoutAttempts',
            'emailAlertSent',
            'lockedIdent',
            'remainingAttempts',
            'nextLockMinutes'
        );
    }

    private function throttleKey(string $portal, string $ident, ?string $ip): string
    {
        return "login:{$portal}:" . sha1(Str::lower($ident) . '|' . ($ip ?? '0.0.0.0'));
    }

    private function securityCacheKeys(string $portal, string $ident, ?string $ip, ?User $user = null): array
    {
        $ipPart = $ip ?? '0.0.0.0';
        $keys = ["login_sec:{$portal}:" . sha1(Str::lower($ident) . '|' . $ipPart)];

        if ($user) {
            $keys[] = "login_sec:{$portal}:uid:" . sha1($user->id . '|' . $ipPart);
            if (!empty($user->email)) {
                $keys[] = "login_sec:{$portal}:" . sha1(Str::lower($user->email) . '|' . $ipPart);
            }
            if (!empty($user->nomor_induk)) {
                $keys[] = "login_sec:{$portal}:" . sha1(Str::lower((string) $user->nomor_induk) . '|' . $ipPart);
            }
        }

        return array_values(array_unique($keys));
    }

    private function getSecurityState(string $portal, string $ident, ?string $ip, ?User $user = null): array
    {
        $best = [
            'attempts' => 0,
            'lock_until' => 0,
            'stage_minutes' => 3,
            'email_alert_sent' => false,
        ];

        foreach ($this->securityCacheKeys($portal, $ident, $ip, $user) as $key) {
            $item = Cache::get($key);
            if (!is_array($item)) {
                continue;
            }
            if ((int) ($item['attempts'] ?? 0) >= (int) $best['attempts']) {
                $best['attempts'] = (int) ($item['attempts'] ?? 0);
                $best['stage_minutes'] = (int) ($item['stage_minutes'] ?? $best['stage_minutes']);
            }
            if ((int) ($item['lock_until'] ?? 0) > (int) $best['lock_until']) {
                $best['lock_until'] = (int) ($item['lock_until'] ?? 0);
            }
            $best['email_alert_sent'] = $best['email_alert_sent'] || (bool) ($item['email_alert_sent'] ?? false);
        }

        return $best;
    }

    private function putSecurityState(string $portal, string $ident, ?string $ip, array $state, ?User $user = null): void
    {
        foreach ($this->securityCacheKeys($portal, $ident, $ip, $user) as $key) {
            Cache::put($key, $state, now()->addSeconds(self::SECURITY_WINDOW_SECONDS));
        }
    }

    private function clearSecurityState(string $portal, string $ident, ?string $ip, ?User $user = null): void
    {
        RateLimiter::clear($this->throttleKey($portal, $ident, $ip));
        foreach ($this->securityCacheKeys($portal, $ident, $ip, $user) as $key) {
            Cache::forget($key);
        }
    }

    private function formatLockoutMessage(int $seconds, int $stageMinutes = 3, int $attemptCount = 3, bool $emailSent = false): string
    {
        $minutes = max(1, (int) ceil($seconds / 60));
        $base = "Percobaan login gagal mencapai {$attemptCount} kali. Akses masuk ditahan {$stageMinutes} menit (tunggu sekitar {$minutes} menit lagi).";
        if ($emailSent) {
            $base .= ' Pemberitahuan keamanan telah dikirim otomatis ke email pemilik akun.';
        }

        return $base;
    }

    private function handleFailedLoginAttempt(
        Request $request,
        string $throttleKey,
        string $normalizedIdent,
        string $portal,
        ?User $matchedUser = null
    ) {
        $ip = $request->ip();
        $state = $this->getSecurityState($portal, $normalizedIdent, $ip, $matchedUser);
        $attempts = (int) ($state['attempts'] ?? 0) + 1;
        $identLabel = $portal === 'mahasiswa' ? 'NIM / Email Mahasiswa' : 'NIP / Email Petugas';
        $portalLabel = $portal === 'mahasiswa' ? 'Portal Login Mahasiswa' : 'Portal Login Pengelola & Admin';

        if ($attempts === self::FIRST_LOCK_ATTEMPTS) {
            $seconds = self::FIRST_LOCK_SECONDS;
            $newState = [
                'attempts' => $attempts,
                'lock_until' => now()->timestamp + $seconds,
                'stage_minutes' => 3,
                'email_alert_sent' => false,
            ];
            $this->putSecurityState($portal, $normalizedIdent, $ip, $newState, $matchedUser);

            $this->recordLoginHistory(
                $request,
                $matchedUser,
                trim((string) $request->nomor_induk),
                $matchedUser?->role ?? ($portal === 'mahasiswa' ? 'mahasiswa' : null),
                $portal,
                'terkunci',
                'Gagal 3 kali pertama, akses masuk ditahan 3 menit'
            );

            return back()->withErrors([
                'login_error' => $this->formatLockoutMessage($seconds, 3, $attempts, false),
            ])->with('login_throttle_portal', $portal)
              ->with('login_lockout_seconds', $seconds)
              ->with('login_lockout_stage_minutes', 3)
              ->with('login_lockout_attempts', $attempts)
              ->with('login_email_alert_sent', false)
              ->with('login_locked_ident', $normalizedIdent)
              ->onlyInput('nomor_induk', 'remember');
        }

        if ($attempts >= self::SECOND_LOCK_ATTEMPTS) {
            $seconds = self::SECOND_LOCK_SECONDS;
            $emailSent = false;

            if ($matchedUser && !empty($matchedUser->email) && filter_var($matchedUser->email, FILTER_VALIDATE_EMAIL)) {
                try {
                    $ua = (string) $request->userAgent();
                    $portalUrl = $portal === 'mahasiswa' ? route('login') : route('staff.login');
                    Mail::to($matchedUser->email)->send(new LoginSecurityAlertMail(
                        $matchedUser,
                        $portalLabel,
                        $attempts,
                        5,
                        (string) ($ip ?? '-'),
                        LoginHistory::parseDeviceLabel($ua),
                        now()->timezone('Asia/Makassar')->format('d M Y, H:i'),
                        $portalUrl,
                    ));
                    $emailSent = true;
                } catch (\Throwable $e) {
                    Log::warning('Gagal mengirim email peringatan percobaan login.', [
                        'email' => $matchedUser->email,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            $newState = [
                'attempts' => $attempts,
                'lock_until' => now()->timestamp + $seconds,
                'stage_minutes' => 5,
                'email_alert_sent' => $emailSent || (bool) ($state['email_alert_sent'] ?? false),
            ];
            $this->putSecurityState($portal, $normalizedIdent, $ip, $newState, $matchedUser);

            $historyNote = "Gagal {$attempts} kali, akses masuk ditahan 5 menit";
            if ($emailSent) {
                $historyNote .= ' dan peringatan keamanan dikirim ke email';
            }

            $this->recordLoginHistory(
                $request,
                $matchedUser,
                trim((string) $request->nomor_induk),
                $matchedUser?->role ?? ($portal === 'mahasiswa' ? 'mahasiswa' : null),
                $portal,
                'terkunci',
                $historyNote
            );

            return back()->withErrors([
                'login_error' => $this->formatLockoutMessage($seconds, 5, $attempts, $emailSent),
            ])->with('login_throttle_portal', $portal)
              ->with('login_lockout_seconds', $seconds)
              ->with('login_lockout_stage_minutes', 5)
              ->with('login_lockout_attempts', $attempts)
              ->with('login_email_alert_sent', $emailSent)
              ->with('login_locked_ident', $normalizedIdent)
              ->onlyInput('nomor_induk', 'remember');
        }

        $nextTarget = $attempts < self::FIRST_LOCK_ATTEMPTS ? self::FIRST_LOCK_ATTEMPTS : self::SECOND_LOCK_ATTEMPTS;
        $nextLockMinutes = $attempts < self::FIRST_LOCK_ATTEMPTS ? 3 : 5;
        $remaining = max(1, $nextTarget - $attempts);

        $newState = [
            'attempts' => $attempts,
            'lock_until' => 0,
            'stage_minutes' => $nextLockMinutes,
            'email_alert_sent' => (bool) ($state['email_alert_sent'] ?? false),
        ];
        $this->putSecurityState($portal, $normalizedIdent, $ip, $newState, $matchedUser);

        $this->recordLoginHistory(
            $request,
            $matchedUser,
            trim((string) $request->nomor_induk),
            $matchedUser?->role ?? ($portal === 'mahasiswa' ? 'mahasiswa' : null),
            $portal,
            'gagal',
            "Kredensial tidak sesuai (gagal ke-{$attempts}; sisa {$remaining} percobaan sebelum jeda {$nextLockMinutes} menit)"
        );

        $warningText = $nextLockMinutes === 3
            ? "{$identLabel} atau Kata Sandi tidak sesuai. Sisa {$remaining} percobaan lagi sebelum akses ditahan sementara 3 menit."
            : "{$identLabel} atau Kata Sandi masih tidak sesuai. Peringatan: sisa {$remaining} percobaan lagi sebelum akses ditahan 5 menit dan kejadian dikirim ke email.";

        return back()->withErrors([
            'login_error' => $warningText,
        ])->with('login_throttle_portal', $portal)
          ->with('login_remaining_attempts', $remaining)
          ->with('login_next_lock_minutes', $nextLockMinutes)
          ->onlyInput('nomor_induk', 'remember');
    }

    private function recordLoginHistory(
        Request $request,
        ?User $user,
        string $identifier,
        ?string $role,
        string $portal,
        string $status,
        ?string $notes = null
    ): void {
        try {
            $ua = (string) $request->userAgent();
            LoginHistory::create([
                'user_id' => $user?->id,
                'identifier' => Str::limit($identifier, 120, ''),
                'role' => $role,
                'portal' => $portal,
                'status' => $status,
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit($ua, 500, ''),
                'device_label' => LoginHistory::parseDeviceLabel($ua),
                'notes' => $notes ? Str::limit($notes, 255, '') : null,
                'logged_in_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::warning('Gagal mencatat riwayat login.', ['error' => $e->getMessage()]);
        }
    }

    // Pengalihan cerdas sesuai peran pengguna (RBAC Gateway)
    public function redirectSesuaiRole($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'pengelola') {
            return redirect()->route('pengelola.dashboard');
        } else {
            return redirect()->route('mahasiswa.dashboard');
        }
    }

    // Logout sesuai portal peran pengguna
    public function logout(Request $request)
    {
        $role = Auth::user()?->role;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (in_array($role, ['pengelola', 'admin'], true)) {
            return redirect()->route('staff.login');
        }

        return redirect()->route('login');
    }
}
