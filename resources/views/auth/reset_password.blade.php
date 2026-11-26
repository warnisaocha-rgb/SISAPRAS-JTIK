<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - SI-SAPRAS JTIK Universitas Negeri Makassar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-navy: #092552;
            --brand-navy-dark: #061836;
            --brand-orange: #ea580c;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #07152b;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            min-width: 0;
        }

        .nav-logo-unm { height: 48px; width: auto; object-fit: contain; flex-shrink: 0; }
        .nav-logo-blu { height: 44px; width: auto; object-fit: contain; flex-shrink: 0; }

        .brand-text-col {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
            min-width: 0;
        }

        .brand-title-row {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .brand-main-navy { font-size: 24px; font-weight: 800; color: var(--brand-navy); letter-spacing: -0.5px; }
        .brand-main-orange { font-size: 24px; font-weight: 800; color: var(--brand-orange); letter-spacing: -0.5px; }
        .brand-sub-name { font-size: 13.5px; color: #64748b; font-weight: 600; margin-top: 2px; }

        .hero-section {
            flex: 1;
            background: linear-gradient(135deg, #071936 0%, #0d2855 50%, #133a78 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 20px;
        }

        .hero-photo-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 70%;
            height: 100%;
            background-image: url('{{ asset("images/bg-ruang-kelas.png") }}');
            background-size: cover;
            background-position: center left;
            opacity: 0.18;
            pointer-events: none;
            z-index: 1;
            -webkit-mask-image: linear-gradient(to right, rgba(0,0,0,1) 0%, rgba(0,0,0,0.85) 40%, rgba(0,0,0,0.2) 75%, rgba(0,0,0,0) 100%);
            mask-image: linear-gradient(to right, rgba(0,0,0,1) 0%, rgba(0,0,0,0.85) 40%, rgba(0,0,0,0.2) 75%, rgba(0,0,0,0) 100%);
        }

        .reset-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 40px -10px rgba(0, 0, 0, 0.35);
            padding: 34px 30px;
        }

        .status-tag {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .status-tag.valid {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .status-tag.invalid {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .reset-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--brand-navy);
            margin-bottom: 6px;
        }

        .reset-sub {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 18px;
        }

        .email-pill {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 16px;
            word-break: break-all;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 11px 13px;
            font-size: 13.5px;
            font-family: inherit;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            color: #0f172a;
        }

        .form-input:focus {
            border-color: var(--brand-navy);
            box-shadow: 0 0 0 3px rgba(9, 37, 82, 0.12);
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            line-height: 1.45;
            margin-bottom: 16px;
        }

        .btn-submit {
            width: 100%;
            background: var(--brand-navy);
            color: #ffffff;
            padding: 13px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(9, 37, 82, 0.2);
        }

        .btn-submit:hover {
            background: var(--brand-navy-dark);
        }

        .back-links {
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            font-size: 12.5px;
        }

        .back-links a {
            color: var(--brand-navy);
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        @media (max-width: 768px) {
            .top-navbar { padding: 10px 14px; }
            .nav-brand { gap: 8px; }
            .nav-logo-unm { height: 32px; }
            .nav-logo-blu { height: 28px; }
            .brand-main-navy, .brand-main-orange { font-size: 16.5px; }
            .brand-sub-name { font-size: 10.5px; }
            .reset-card { padding: 24px 18px; border-radius: 14px; }
        }

        @media (max-width: 480px) {
            .form-input { font-size: 16px; min-height: 44px; }
            .btn-submit { min-height: 44px; }
        }
    </style>
</head>
<body>

    <header class="top-navbar">
        <a href="{{ route('login') }}" class="nav-brand">
            <img src="{{ asset('images/logo-unm-resmi-siakad.png') }}" alt="Logo UNM Resmi" class="nav-logo-unm">
            <img src="{{ asset('images/logo-blu-speed.png') }}" alt="Logo BLU Speed" class="nav-logo-blu">
            <div class="brand-text-col">
                <div class="brand-title-row">
                    <span class="brand-main-navy">SI-SAPRAS</span>
                    <span class="brand-main-orange">JTIK</span>
                </div>
                <span class="brand-sub-name">Universitas Negeri Makassar</span>
            </div>
        </a>
    </header>

    <main class="hero-section">
        <div class="hero-photo-layer"></div>

        <div class="reset-card">
            @if($tokenValid)
                <span class="status-tag valid">Konfirmasi Email Terverifikasi</span>
                <h1 class="reset-title">Buat Kata Sandi Baru</h1>
                <p class="reset-sub">
                    Permintaan atur ulang kata sandi telah dikonfirmasi melalui email pemilik akun berikut:
                </p>
                <div class="email-pill">{{ $email }}</div>

                @if($errors->any())
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="form-group">
                        <label class="form-label" for="password">
                            <span>Kata Sandi Baru</span>
                            <span style="color:#94a3b8; font-weight:500;">6–32 karakter</span>
                        </label>
                        <input type="password" id="password" name="password" class="form-input" minlength="6" maxlength="32" placeholder="Masukkan kata sandi baru..." required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">
                            <span>Konfirmasi Kata Sandi Baru</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" minlength="6" maxlength="32" placeholder="Ulangi kata sandi baru..." required>
                    </div>

                    <button type="submit" class="btn-submit">Simpan Kata Sandi Baru</button>
                </form>
            @else
                <span class="status-tag invalid">Tautan Tidak Valid / Kedaluwarsa</span>
                <h1 class="reset-title">Tautan Konfirmasi Tidak Berlaku</h1>
                <p class="reset-sub">
                    Tautan konfirmasi atur ulang kata sandi sudah pernah digunakan, tidak cocok, atau telah melewati masa berlaku 60 menit. Silakan ajukan permintaan baru melalui menu <strong>Lupa sandi?</strong> pada halaman login.
                </p>
            @endif

            <div class="back-links">
                <a href="{{ route('login') }}">Portal Mahasiswa</a>
                <a href="{{ route('staff.login') }}">Portal Pengelola &amp; Admin</a>
            </div>
        </div>
    </main>

</body>
</html>
