<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetConfirmMail;
use App\Models\LoginHistory;
use App\Models\Ruangan;
use App\Models\User;
use App\Services\CampusStudentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private const MAX_LOGIN_ATTEMPTS = 3;
    private const LOCKOUT_SECONDS = 15 * 60;
    private const RESET_EXPIRE_MINUTES = 60;

    public function __construct(
        private readonly CampusStudentService $campusStudents,
    ) {}

    // Halaman pembukaan dengan animasi (root / -> Slide 2 khusus Portal Mahasiswa)
    public function showOpening(Request $request)
    {
        return view('animasi_pembukaan', $this->resolveLoginThrottleState($request, 'mahasiswa'));
    }

    // Halaman Portal Login khusus Mahasiswa (Data IP Kampus)
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

    // Memproses login khusus Mahasiswa melalui layanan IP Kampus (+ fallback data tersinkron)
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
        $throttleKey = $this->throttleKey('mahasiswa', $normalizedIdent, $request->ip());

        $request->session()->put('login_throttle_ident_mahasiswa', $normalizedIdent);

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_LOGIN_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $matchedUser = User::where('nomor_induk', $identifier)->orWhere('email', $identifier)->first();

            $this->recordLoginHistory(
                $request,
                $matchedUser,
                $identifier,
                $matchedUser?->role ?? 'mahasiswa',
                'mahasiswa',
                'terkunci',
                'Batas percobaan login habis (terkunci sementara)'
            );

            return back()->withErrors([
                'login_error' => $this->formatLockoutMessage($seconds),
            ])->with('login_throttle_portal', 'mahasiswa')
              ->with('login_lockout_seconds', $seconds)
              ->with('login_locked_ident', $normalizedIdent)
              ->onlyInput('nomor_induk', 'remember');
        }

        // Pastikan akun Pengelola / Admin tidak masuk melalui portal Mahasiswa
        $existingStaff = User::whereIn('role', ['pengelola', 'admin'])
            ->where(function ($q) use ($identifier) {
                $q->where('nomor_induk', $identifier)
                  ->orWhere('email', $identifier);
            })
            ->first();

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

        // Autentikasi ke layanan IP Kampus (atau data mahasiswa lokal yang sudah tersinkron; tidak membuat akun baru sembarangan)
        $result = $this->campusStudents->authenticate($identifier, $password);

        if ($result['ok'] && isset($result['user'])) {
            /** @var User $student */
            $student = $result['user'];

            RateLimiter::clear($throttleKey);
            $request->session()->forget('login_throttle_ident_mahasiswa');
            Auth::login($student, $remember);
            $request->session()->regenerate();

            $sourceLabel = ($result['source'] ?? '') === 'campus_api'
                ? 'Autentikasi via IP Kampus'
                : 'Autentikasi data mahasiswa terdaftar';

            $this->recordLoginHistory(
                $request,
                $student,
                $identifier,
                'mahasiswa',
                'mahasiswa',
                'berhasil',
                $sourceLabel
            );

            return $this->redirectSesuaiRole($student);
        }

        $reason = $result['reason'] ?? 'invalid_credentials';
        $student = $result['user'] ?? null;

        if ($reason === 'inactive') {
            RateLimiter::clear($throttleKey);
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

        if ($reason === 'campus_unreachable') {
            $this->recordLoginHistory(
                $request,
                $student,
                $identifier,
                'mahasiswa',
                'mahasiswa',
                'gagal',
                'Server IP Kampus tidak dapat dijangkau'
            );

            return back()->withErrors([
                'login_error' => 'Server data mahasiswa kampus sedang tidak dapat dijangkau. Silakan coba beberapa saat lagi.',
            ])->onlyInput('nomor_induk');
        }

        return $this->handleFailedLoginAttempt($request, $throttleKey, $normalizedIdent, 'mahasiswa', $student);
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
        $throttleKey = $this->throttleKey('petugas', $normalizedIdent, $request->ip());

        $request->session()->put('login_throttle_ident_petugas', $normalizedIdent);

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_LOGIN_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $matchedUser = User::where('nomor_induk', $identifier)->orWhere('email', $identifier)->first();

            $this->recordLoginHistory(
                $request,
                $matchedUser,
                $identifier,
                $matchedUser?->role,
                'petugas',
                'terkunci',
                'Batas percobaan login habis (terkunci sementara)'
            );

            return back()->withErrors([
                'login_error' => $this->formatLockoutMessage($seconds),
            ])->with('login_throttle_portal', 'petugas')
              ->with('login_lockout_seconds', $seconds)
              ->with('login_locked_ident', $normalizedIdent)
              ->onlyInput('nomor_induk', 'remember');
        }

        $user = User::where('nomor_induk', $identifier)
            ->orWhere('email', $identifier)
            ->first();

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
            RateLimiter::clear($throttleKey);
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
            RateLimiter::clear($throttleKey);
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
            RateLimiter::clear($throttleKey);
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

        RateLimiter::clear($throttleKey);
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
            RateLimiter::clear($this->throttleKey($portal, $email, $request->ip()));
            if (!empty($user->nomor_induk)) {
                RateLimiter::clear($this->throttleKey($portal, Str::lower((string) $user->nomor_induk), $request->ip()));
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
        $lockedIdent = $isSamePortal ? session('login_locked_ident') : null;
        $remainingAttempts = $isSamePortal ? session('login_remaining_attempts') : null;

        $lastIdent = $request->old('nomor_induk')
            ? Str::lower(trim((string) $request->old('nomor_induk')))
            : session("login_throttle_ident_{$portal}");

        if ($lastIdent) {
            $key = $this->throttleKey($portal, $lastIdent, $request->ip());
            if (RateLimiter::tooManyAttempts($key, self::MAX_LOGIN_ATTEMPTS)) {
                $lockoutSeconds = max($lockoutSeconds, RateLimiter::availableIn($key));
                $lockedIdent = $lastIdent;
                $remainingAttempts = 0;
            } elseif ($remainingAttempts === null && RateLimiter::attempts($key) > 0) {
                $remainingAttempts = max(0, self::MAX_LOGIN_ATTEMPTS - RateLimiter::attempts($key));
            }
        }

        return compact('lockoutSeconds', 'lockedIdent', 'remainingAttempts');
    }

    private function throttleKey(string $portal, string $ident, ?string $ip): string
    {
        return "login:{$portal}:" . sha1(Str::lower($ident) . '|' . ($ip ?? '0.0.0.0'));
    }

    private function formatLockoutMessage(int $seconds): string
    {
        $minutes = max(1, (int) ceil($seconds / 60));
        return "Percobaan login gagal mencapai batas maksimal 3 kali. Silakan tunggu {$minutes} menit lagi sebelum mencoba masuk kembali.";
    }

    private function handleFailedLoginAttempt(
        Request $request,
        string $throttleKey,
        string $normalizedIdent,
        string $portal,
        ?User $matchedUser = null
    ) {
        $attempts = RateLimiter::hit($throttleKey, self::LOCKOUT_SECONDS);
        $identLabel = $portal === 'mahasiswa' ? 'NIM / Email Mahasiswa' : 'NIP / Email Petugas';

        if ($attempts >= self::MAX_LOGIN_ATTEMPTS) {
            RateLimiter::clear($throttleKey);
            RateLimiter::increment($throttleKey, self::LOCKOUT_SECONDS, self::MAX_LOGIN_ATTEMPTS);
            $seconds = RateLimiter::availableIn($throttleKey);

            $this->recordLoginHistory(
                $request,
                $matchedUser,
                trim((string) $request->nomor_induk),
                $matchedUser?->role ?? ($portal === 'mahasiswa' ? 'mahasiswa' : null),
                $portal,
                'terkunci',
                'Gagal 3 kali berturut-turut, akun dikunci 15 menit'
            );

            return back()->withErrors([
                'login_error' => $this->formatLockoutMessage($seconds),
            ])->with('login_throttle_portal', $portal)
              ->with('login_lockout_seconds', $seconds)
              ->with('login_locked_ident', $normalizedIdent)
              ->onlyInput('nomor_induk', 'remember');
        }

        $remaining = max(1, self::MAX_LOGIN_ATTEMPTS - $attempts);

        $this->recordLoginHistory(
            $request,
            $matchedUser,
            trim((string) $request->nomor_induk),
            $matchedUser?->role ?? ($portal === 'mahasiswa' ? 'mahasiswa' : null),
            $portal,
            'gagal',
            "Kredensial tidak sesuai (sisa {$remaining} percobaan)"
        );

        $warningText = $remaining === 1
            ? "{$identLabel} atau Kata Sandi tidak sesuai. Peringatan: sisa 1 percobaan terakhir dari batas maksimal 3 kali."
            : "{$identLabel} atau Kata Sandi tidak sesuai. Anda hanya dapat mencoba maksimal 3 kali (sisa {$remaining} percobaan lagi).";

        return back()->withErrors([
            'login_error' => $warningText,
        ])->with('login_throttle_portal', $portal)
          ->with('login_remaining_attempts', $remaining)
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
