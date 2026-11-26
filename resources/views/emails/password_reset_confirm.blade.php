<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Atur Ulang Kata Sandi</title>
</head>
<body style="margin:0; padding:24px; background:#F1F5F9; font-family:'Segoe UI', Arial, sans-serif; color:#0F172A;">
    <div style="max-width:560px; margin:0 auto; background:#FFFFFF; border:1px solid #CBD5E1; border-radius:8px; overflow:hidden;">
        <div style="background:#092552; color:#FFFFFF; padding:18px 24px;">
            <div style="font-size:15px; font-weight:700;">SI-SAPRAS JTIK FT UNM</div>
            <div style="font-size:12px; color:#CBD5E1; margin-top:2px;">Konfirmasi Permintaan Atur Ulang Kata Sandi</div>
        </div>
        <div style="padding:24px; font-size:13.5px; line-height:1.65; color:#334155;">
            <p style="margin:0 0 12px 0;">Halo <strong>{{ $user->name }}</strong> ({{ $user->nomor_induk }}),</p>
            <p style="margin:0 0 16px 0;">
                Kami menerima permintaan atur ulang kata sandi untuk akun SI-SAPRAS Anda. Demi keamanan akun, perubahan kata sandi hanya dapat disetujui langsung oleh pemilik email ini.
            </p>
            <p style="margin:0 0 20px 0;">
                <a href="{{ $resetUrl }}" style="display:inline-block; background:#092552; color:#FFFFFF; text-decoration:none; font-weight:700; padding:11px 20px; border-radius:6px; font-size:13px;">
                    Konfirmasi &amp; Atur Ulang Kata Sandi
                </a>
            </p>
            <p style="margin:0 0 10px 0; font-size:12px; color:#64748B;">
                Tautan konfirmasi ini berlaku selama <strong>{{ $expireMinutes }} menit</strong> dan hanya dapat digunakan satu kali. Jika Anda tidak merasa mengajukan permintaan ini, abaikan email ini.
            </p>
            <div style="margin-top:16px; padding-top:12px; border-top:1px solid #E2E8F0; font-size:11.5px; color:#64748B; word-break:break-all;">
                Atau salin tautan berikut ke browser Anda:<br>
                <a href="{{ $resetUrl }}" style="color:#08296E;">{{ $resetUrl }}</a>
            </div>
        </div>
    </div>
</body>
</html>
