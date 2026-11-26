<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Pastikan pengguna hanya dapat mengakses rute yang sesuai dengan rolenya (RBAC).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            if ($request->is('admin', 'admin/*', 'pengelola', 'pengelola/*')) {
                return redirect()->route('staff.login');
            }
            return redirect()->route('login');
        }

        if ($user->status_akun !== 'aktif') {
            \Illuminate\Support\Facades\Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $targetRoute = in_array(strtolower((string) $user->role), ['admin', 'pengelola'], true)
                ? 'staff.login'
                : 'login';

            return redirect()->route($targetRoute)
                ->withErrors(['login_error' => 'Status akun Anda tidak aktif. Hubungi Admin Sarpras jika diperlukan.']);
        }

        $userRole = strtolower((string) $user->role);
        $allowedRoles = array_map(fn ($r) => strtolower($r), $roles);

        if (!in_array($userRole, $allowedRoles, true)) {
            // Untuk aksi tulis (POST/PUT/PATCH/DELETE) atau AJAX/JSON, tolak keras dengan 403 Forbidden
            if (!$request->isMethod('get') || $request->expectsJson()) {
                abort(403, 'Akses ditolak. Akun Anda tidak memiliki hak akses untuk tindakan ini.');
            }

            $roleLabels = [
                'admin' => 'Administrator',
                'pengelola' => 'Pengelola',
                'mahasiswa' => 'Mahasiswa',
            ];
            $label = $roleLabels[$userRole] ?? ucfirst($userRole);

            return redirect()->route('dashboard')
                ->with('error', "Sesi akun Anda sedang aktif sebagai {$label} ({$user->name}). Anda dialihkan ke portal sesuai hak akses.");
        }

        return $next($request);
    }
}
