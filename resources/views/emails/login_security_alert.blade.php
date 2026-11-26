<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peringatan Keamanan Akun SI-SAPRAS</title>
</head>
<body style="margin:0; padding:24px; background:#F1F5F9; font-family:'Segoe UI', Arial, sans-serif; color:#0F172A;">
    <div style="max-width:560px; margin:0 auto; background:#FFFFFF; border:1px solid #CBD5E1; border-radius:8px; overflow:hidden;">
        <div style="background:#092552; color:#FFFFFF; padding:18px 24px;">
            <div style="font-size:15px; font-weight:700;">SI-SAPRAS JTIK FT UNM</div>
            <div style="font-size:12px; color:#FCD34D; margin-top:2px;">Peringatan Keamanan Akun — Percobaan Masuk Gagal</div>
        </div>
        <div style="padding:24px; font-size:13.5px; line-height:1.65; color:#334155;">
            <p style="margin:0 0 12px 0;">Halo <strong>{{ $user->name }}</strong> ({{ $user->nomor_induk }}),</p>
            <p style="margin:0 0 14px 0;">
                Sistem mendeteksi <strong>{{ $attemptCount }} kali kesalahan kata sandi beruntun</strong> pada akun SI-SAPRAS Anda melalui <strong>{{ $portalLabel }}</strong>.
            </p>
            <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:6px; padding:12px 14px; margin:0 0 16px 0; color:#991B1B; font-size:13px;">
                Demi keamanan akun, akses masuk ditahan sementara selama <strong>{{ $lockMinutes }} menit</strong>.
            </div>
            <table style="width:100%; border-collapse:collapse; margin:0 0 18px 0; font-size:12.5px; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:6px;">
                <tr>
                    <td style="padding:8px 12px; color:#64748B; width:140px; border-bottom:1px solid #E2E8F0;">Waktu Kejadian</td>
                    <td style="padding:8px 12px; color:#0F172A; font-weight:600; border-bottom:1px solid #E2E8F0;">{{ $occurredAt }} WITA</td>
                </tr>
                <tr>
                    <td style="padding:8px 12px; color:#64748B; border-bottom:1px solid #E2E8F0;">Portal Akses</td>
                    <td style="padding:8px 12px; color:#0F172A; font-weight:600; border-bottom:1px solid #E2E8F0;">{{ $portalLabel }}</td>
                </tr>
                <tr>
                    <td style="padding:8px 12px; color:#64748B; border-bottom:1px solid #E2E8F0;">Perangkat</td>
                    <td style="padding:8px 12px; color:#0F172A; font-weight:600; border-bottom:1px solid #E2E8F0;">{{ $deviceLabel }}</td>
                </tr>
                <tr>
                    <td style="padding:8px 12px; color:#64748B;">Alamat IP</td>
                    <td style="padding:8px 12px; color:#0F172A; font-weight:600;">{{ $ipAddress }}</td>
                </tr>
            </table>
            <p style="margin:0 0 16px 0; font-size:13px;">
                Jika ini bukan aktivitas Anda, atau jika Anda lupa kata sandi, segera ubah kata sandi Anda melalui menu <strong>Lupa sandi?</strong> di halaman portal login:
            </p>
            <p style="margin:0 0 18px 0;">
                <a href="{{ $portalUrl }}" style="display:inline-block; background:#092552; color:#FFFFFF; text-decoration:none; font-weight:700; padding:11px 20px; border-radius:6px; font-size:13px;">
                    Buka Portal Masuk &amp; Pulihkan Sandi
                </a>
            </p>
            <p style="margin:0; font-size:12px; color:#64748B;">
                Jika percobaan masuk tersebut memang Anda lakukan karena salah mengetik sandi, tunggu hingga jeda {{ $lockMinutes }} menit berakhir lalu coba kembali dengan kata sandi yang benar.
            </p>
        </div>
    </div>
</body>
</html>
