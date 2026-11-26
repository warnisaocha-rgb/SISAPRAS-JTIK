<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-SAPRAS JTIK - Universitas Negeri Makassar</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-navy: #092552;       /* Warna Navy judul persis gambar */
            --brand-orange: #ea580c;     /* Warna Oranye sub-judul & badge BLU */
            --brand-navy-dark: #061836;
            --brand-blue-sub: #0284c7;   /* Warna Biru Universitas Negeri Makassar */
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

        /* 1. TOP NAVBAR PERSIS GAMBAR REFERENSI PENGGUNA */
        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-portal-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1.5px solid #cbd5e1;
            background: #f8fafc;
            color: var(--brand-navy);
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.15s ease;
        }

        .nav-portal-link:hover {
            background: #eff6ff;
            border-color: var(--brand-navy);
        }

        .portal-role-tag {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 5px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: var(--brand-navy);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            line-height: 1.45;
            margin-bottom: 16px;
            text-align: left;
        }

        .portal-switch-box {
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .portal-switch-box a {
            color: var(--brand-navy);
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
        }

        .nav-logo-unm {
            height: 48px;
            width: auto;
            object-fit: contain;
        }

        .nav-logo-blu {
            height: 44px;
            width: auto;
            object-fit: contain;
        }

        .brand-text-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.15;
        }

        .brand-title-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .brand-main-navy {
            font-size: 24px;
            font-weight: 800;
            color: var(--brand-navy);
            letter-spacing: -0.5px;
        }

        .brand-main-orange {
            font-size: 24px;
            font-weight: 800;
            color: var(--brand-orange);
            letter-spacing: -0.5px;
        }

        .brand-sub-name {
            font-size: 13.5px;
            color: #64748b;
            font-weight: 600;
            margin-top: 2px;
            letter-spacing: 0.1px;
        }

        /* 2. HERO SECTION PERSIS SIAKAD UNM TEMA NAVY */
        .hero-section {
            flex: 1;
            background: linear-gradient(135deg, #071936 0%, #0d2855 50%, #133a78 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 40px 48px;
        }

        /* Lapisan Foto Asli Ruang Lab/Kelas JTIK (Semi transparan, dominan di kiri & pudar ke kanan) */
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

        /* Lingkaran abstrak dekoratif khas SIAKAD UNM */
        .hero-section::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -5%;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14, 116, 144, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -15%;
            right: 25%;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(234, 88, 12, 0.08) 0%, transparent 65%);
            pointer-events: none;
        }

        .hero-container {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.15fr 0.9fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        /* SISI KIRI: Banner SIAKAD UNM */
        .hero-left {
            color: #ffffff;
            max-width: 620px;
        }

        .welcome-pill {
            display: inline-block;
            background: #ffffff;
            color: var(--brand-navy);
            padding: 7px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .hero-headline {
            font-size: 46px;
            font-weight: 800;
            line-height: 1.18;
            letter-spacing: -1px;
            margin-bottom: 18px;
            color: #ffffff;
        }

        .hero-description {
            font-size: 15.5px;
            line-height: 1.65;
            color: #cbd5e1;
            margin-bottom: 32px;
        }

        .benefit-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .benefit-badge {
            background: #ffffff;
            color: var(--brand-navy);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 12.5px;
            font-weight: 700;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .check-circle {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--brand-orange);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 900;
        }

        /* SISI KANAN: KARTU FORM LOGIN BERSIH */
        .hero-right {
            display: flex;
            justify-content: flex-end;
        }

        .siakad-card {
            background: #ffffff;
            width: 100%;
            max-width: 430px;
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 25px 40px -10px rgba(0, 0, 0, 0.35);
            text-align: center;
        }

        /* Header Kartu dengan Warna Persis Gambar Pengguna */
        .card-brand-header {
            margin-bottom: 24px;
        }

        .card-title-navy {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.4px;
            color: var(--brand-navy);
            margin-bottom: 6px;
        }

        .card-subtitle-muted {
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .label-main {
            font-weight: 700;
            color: #1e293b;
        }

        .label-hint {
            font-size: 11px;
            color: #94a3b8;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px;
            font-size: 13.5px;
            font-family: inherit;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.15s ease;
            color: #0f172a;
            background: #ffffff;
        }

        .form-input:focus {
            border-color: var(--brand-navy);
            box-shadow: 0 0 0 3px rgba(9, 37, 82, 0.12);
        }

        /* Sembunyikan ikon mata bawaan browser Edge / IE agar tidak bertumpuk */
        input::-ms-reveal,
        input::-ms-clear {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        .password-wrap {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .password-wrap .form-input {
            padding-right: 44px;
        }

        .toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748B;
            transition: color 0.15s ease;
            z-index: 2;
        }

        .toggle-btn:hover {
            color: var(--brand-navy);
        }

        .toggle-btn svg {
            stroke: currentColor;
            display: block;
        }

        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            margin: 12px 0 20px 0;
        }

        .options-row label {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #475569;
            cursor: pointer;
        }

        .options-row a {
            color: var(--brand-navy);
            text-decoration: underline;
            text-underline-offset: 3px;
            font-weight: 700;
        }

        .btn-submit-main {
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
            transition: all 0.15s ease;
            box-shadow: 0 4px 6px -1px rgba(9, 37, 82, 0.2);
        }

        .btn-submit-main:hover {
            background: var(--brand-navy-dark);
            transform: translateY(-1px);
        }

        .btn-submit-main:disabled {
            background: #64748b;
            opacity: 0.72;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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
            text-align: left;
        }

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            line-height: 1.45;
            margin-bottom: 16px;
            text-align: left;
        }

        /* Modal Bantuan Sandi */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 16px;
        }

        .modal-box {
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            padding: 24px;
            text-align: left;
        }

        .modal-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .modal-title-text {
            font-size: 14px;
            font-weight: 800;
            color: var(--brand-navy);
        }

        .modal-close-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #64748b;
            cursor: pointer;
            line-height: 1;
        }

        .maba-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin: 12px 0 16px 0;
        }

        .maba-btn {
            border: 1px solid #fed7aa;
            border-radius: 8px;
            padding: 9px;
            background: #fff7ed;
            color: var(--brand-orange);
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            text-align: center;
            transition: all 0.15s ease;
        }

        .maba-btn:hover {
            background: #ffedd5;
        }

        @media (max-width: 1000px) {
            .top-navbar {
                padding: 12px 20px;
            }
            .hero-section {
                padding: 40px 20px;
            }
            .hero-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .hero-left {
                text-align: center;
                max-width: 100%;
            }
            .hero-headline {
                font-size: 34px;
            }
            .benefit-badges {
                justify-content: center;
            }
            .hero-right {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .top-navbar {
                padding: 10px 14px;
            }
            .nav-portal-link {
                padding: 6px 10px;
                font-size: 11px;
            }
            .nav-brand {
                gap: 8px;
            }
            .nav-logo-unm {
                height: 32px;
            }
            .nav-logo-blu {
                height: 28px;
            }
            .brand-main-navy,
            .brand-main-orange {
                font-size: 16.5px;
            }
            .brand-sub-name {
                font-size: 10.5px;
            }
            .hero-section {
                padding: 22px 14px 32px 14px;
                align-items: flex-start;
            }
            .hero-container {
                gap: 20px;
            }
            .hero-right {
                width: 100%;
            }
            .siakad-card {
                max-width: 100%;
                padding: 24px 18px;
                border-radius: 14px;
            }
            .card-title-navy {
                font-size: 20px;
            }
            .hero-headline {
                font-size: 24px;
                line-height: 1.2;
                margin-bottom: 10px;
            }
            .hero-description {
                font-size: 12.5px;
                line-height: 1.55;
                margin-bottom: 14px;
            }
            .welcome-pill {
                margin-bottom: 10px;
                font-size: 11px;
                padding: 5px 12px;
            }
        }

        @media (max-width: 480px) {
            .label-row,
            .options-row {
                flex-wrap: wrap;
                gap: 6px 10px;
            }
            .form-input {
                font-size: 16px;
                min-height: 44px;
                padding: 10px 12px;
            }
            .password-wrap .form-input {
                padding-right: 44px;
            }
            .toggle-btn {
                min-width: 40px;
                min-height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            .btn-submit-main,
            .maba-btn {
                min-height: 44px;
            }
            .benefit-badges {
                gap: 8px;
            }
            .benefit-badge {
                font-size: 11.5px;
                padding: 6px 12px;
            }
            .maba-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- 1. TOP NAVBAR PERSIS GAMBAR REFERENSI PENGGUNA -->
    <header class="top-navbar">
        <a href="/" class="nav-brand">
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
        <a href="{{ route('staff.login') }}" class="nav-portal-link">Portal Petugas</a>
    </header>

    <!-- 2. HERO SECTION PERSIS SIAKAD UNM TEMA NAVY -->
    <main class="hero-section">
        <!-- Foto Asli Ruang Lab/Kelas JTIK Semi-Transparan (Dominan Kiri, Pudar ke Kanan) -->
        <div class="hero-photo-layer"></div>

        <div class="hero-container">
            
            <!-- SISI KIRI: Banner SIAKAD UNM -->
            <div class="hero-left">
                <div class="welcome-pill">
                    Selamat Datang di SI-SAPRAS JTIK
                </div>

                <h1 class="hero-headline">
                    Semua urusan sarpras,<br>dalam satu pintu.
                </h1>

                <p class="hero-description">
                    Peminjaman alat laboratorium dan bengkel, pemantauan ketersediaan inventaris praktikum, hingga pengurusan surat bebas sarpras — terhubung dalam Sistem Informasi Sarana & Prasarana Terintegrasi Jurusan Teknik Informatika dan Komputer FT UNM.
                </p>

                <div class="benefit-badges">
                    <div class="benefit-badge">
                        <span class="check-circle">✓</span>
                        <span>Inventaris Lab & Ruangan</span>
                    </div>
                    <div class="benefit-badge">
                        <span class="check-circle">✓</span>
                        <span>Monitoring Real-time</span>
                    </div>
                    <div class="benefit-badge">
                        <span class="check-circle">✓</span>
                        <span>Bebas Sarpras Digital</span>
                    </div>
                </div>
            </div>

            <!-- SISI KANAN: Form Bersih Sesuai Desain Figma Kita -->
            <div class="hero-right">
                <div class="siakad-card">
                    
                    <!-- Header Kartu: Masuk Akun Mahasiswa -->
                    <div class="card-brand-header">
                        <h2 class="card-title-navy">Masuk Akun Mahasiswa</h2>
                        <p class="card-subtitle-muted">Gunakan NIM dan kata sandi akun kampus Anda</p>
                    </div>

                    @php
                        $lockSec = (int) ($lockoutSeconds ?? 0);
                        $remAtt = isset($remainingAttempts) ? (int) $remainingAttempts : null;
                        $lockedUserIdent = $lockedIdent ?? null;
                        $prefillIdent = old('nomor_induk', $lockSec > 0 ? ($lockedUserIdent ?? '') : '');
                    @endphp

                    @if(session('status'))
                        <div class="alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($lockSec > 0)
                        <div class="alert-error" id="loginLockoutAlert">
                            Percobaan masuk gagal sudah mencapai batas maksimal <strong>3 kali</strong>. Silakan tunggu <strong id="lockoutCountdown">15:00</strong> lagi sebelum mencoba kembali.
                        </div>
                    @elseif($errors->has('login_error'))
                        <div class="alert-error">
                            {{ $errors->first('login_error') }}
                            @if(session('redirect_staff_portal'))
                                <div style="margin-top: 8px;">
                                    <a href="{{ route('staff.login') }}" style="color:#092552; font-weight:700; text-decoration:underline;">Buka Portal Pengelola &amp; Admin &rarr;</a>
                                </div>
                            @endif
                        </div>
                    @elseif($remAtt !== null && $remAtt > 0 && $remAtt < 3)
                        <div class="alert-warning">
                            Peringatan: Anda hanya dapat mencoba masuk maksimal <strong>3 kali</strong> (sisa <strong>{{ $remAtt }}</strong> percobaan lagi).
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                        @csrf

                        <!-- NIM Mahasiswa -->
                        <div class="form-group">
                            <div class="label-row">
                                <span class="label-main">NIM Mahasiswa:</span>
                                <span class="label-hint">Terhubung data kampus</span>
                            </div>
                            <input 
                                type="text" 
                                name="nomor_induk" 
                                id="nomor_induk" 
                                class="form-input" 
                                placeholder="Contoh: 250210500034" 
                                value="{{ $prefillIdent }}" 
                                required 
                                autofocus
                            >
                        </div>

                        <!-- Kata Sandi -->
                        <div class="form-group">
                            <div class="label-row">
                                <span class="label-main">Kata Sandi:</span>
                                <span class="label-hint">6–32 karakter</span>
                            </div>
                            <div class="password-wrap">
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-input" 
                                    minlength="6" 
                                    maxlength="32" 
                                    placeholder="Masukkan kata sandi..." 
                                    required
                                >
                                <button type="button" class="toggle-btn" onclick="togglePass()" title="Tampilkan / Sembunyikan Kata Sandi">
                                    <svg id="eyeOpenIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <svg id="eyeClosedIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                        <line x1="1" y1="1" x2="23" y2="23"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Pilihan Ingat & Lupa Sandi -->
                        <div class="options-row">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Ingat saya di perangkat ini
                            </label>
                            <a href="javascript:void(0)" onclick="openModal()">Lupa sandi?</a>
                        </div>

                        <!-- Tombol Masuk Utama -->
                        <button type="submit" id="btnLoginSubmit" class="btn-submit-main" style="margin-bottom: 4px;" {{ $lockSec > 0 ? 'disabled' : '' }}>
                            {{ $lockSec > 0 ? 'Coba lagi dalam ' . sprintf('%02d:%02d', intdiv($lockSec, 60), $lockSec % 60) : 'Masuk Portal Mahasiswa' }}
                        </button>
                        <p style="margin-top: 10px; font-size: 11px; color: #64748b; line-height: 1.45;">
                            Peringatan: percobaan masuk dibatasi maksimal 3 kali.
                        </p>
                    </form>

                </div>
            </div>

        </div>
    </main>

    <!-- MODAL LUPA KATA SANDI (KONFIRMASI LANGSUNG KE EMAIL PEMILIK AKUN) -->
    <div id="modalLupa" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header-row">
                <span class="modal-title-text">Pemulihan Kata Sandi via Email</span>
                <button type="button" class="modal-close-btn" onclick="closeModal()">&times;</button>
            </div>
            <p style="font-size: 12.5px; color: #334155; line-height: 1.55; margin-bottom: 12px;">
                Masukkan <strong>NIM</strong> atau <strong>Email akun mahasiswa</strong> Anda. Sistem akan mengirim tautan persetujuan (ACC) atur ulang kata sandi langsung ke email pemilik akun.
            </p>
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:10px 12px; font-size:11.5px; color:#475569; line-height:1.5; margin-bottom:14px;">
                Demi privasi keamanan akun, Admin tidak dapat mengakses maupun mengatur ulang kata sandi pengguna.
            </div>

            @if($errors->has('forgot_error'))
                <div class="alert-error" style="margin-bottom:12px;">
                    {{ $errors->first('forgot_error') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <input type="text" name="identity" class="form-input" placeholder="Masukkan NIM atau Email akun..." value="{{ old('identity') }}" required style="margin-bottom: 12px;">
                <button type="submit" class="btn-submit-main" style="padding: 11px;">
                    Kirim Konfirmasi ke Email Saya
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePass() {
            const pass = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpenIcon');
            const eyeClosed = document.getElementById('eyeClosedIcon');

            if (pass.type === 'password') {
                pass.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                pass.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }

        function openModal() {
            document.getElementById('modalLupa').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modalLupa').style.display = 'none';
        }

        @if(session('open_forgot_modal') || $errors->has('forgot_error'))
            document.addEventListener('DOMContentLoaded', function() {
                openModal();
            });
        @endif

        (function initLoginLockoutCountdown() {
            let remainingSeconds = {{ (int) ($lockoutSeconds ?? 0) }};
            const lockedIdent = (@json($lockedIdent ?? '') || '').toLowerCase();
            const submitBtn = document.getElementById('btnLoginSubmit');
            const identInput = document.getElementById('nomor_induk');
            const countdownEl = document.getElementById('lockoutCountdown');
            const alertEl = document.getElementById('loginLockoutAlert');

            if (!submitBtn || remainingSeconds <= 0) return;

            function fmt(sec) {
                const m = Math.floor(sec / 60);
                const s = sec % 60;
                return String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
            }

            function syncLockUi() {
                const currentIdent = (identInput ? identInput.value : '').trim().toLowerCase();
                const isSameLockedAccount = !lockedIdent || currentIdent === lockedIdent;

                if (remainingSeconds <= 0) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Masuk Portal Mahasiswa';
                    if (alertEl) {
                        alertEl.style.background = '#eff6ff';
                        alertEl.style.color = '#1e3a8a';
                        alertEl.style.borderColor = '#bfdbfe';
                        alertEl.textContent = 'Waktu tunggu 15 menit selesai. Silakan coba masuk kembali.';
                    }
                    return;
                }

                if (countdownEl) {
                    countdownEl.textContent = fmt(remainingSeconds);
                }

                if (isSameLockedAccount) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Coba lagi dalam ' + fmt(remainingSeconds);
                } else {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Masuk Portal Mahasiswa';
                }
            }

            if (identInput) {
                identInput.addEventListener('input', syncLockUi);
            }

            syncLockUi();
            const timer = setInterval(function() {
                remainingSeconds = Math.max(0, remainingSeconds - 1);
                syncLockUi();
                if (remainingSeconds <= 0) {
                    clearInterval(timer);
                }
            }, 1000);
        })();
    </script>


  @include('partials.ui_feedback')
</body>
</html>
