<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pengelola - SI-SAPRAS JTIK Universitas Negeri Makassar</title>
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
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            min-width: 0;
        }

        .nav-logo-unm {
            height: 48px;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
        }

        .nav-logo-blu {
            height: 44px;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-text-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.15;
            min-width: 0;
        }

        .brand-title-row {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
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
            flex-shrink: 0;
            transition: all 0.15s ease;
        }

        .nav-portal-link:hover {
            background: #eff6ff;
            border-color: var(--brand-navy);
        }

        .hero-section {
            flex: 1;
            background: linear-gradient(135deg, #071936 0%, #0d2855 50%, #133a78 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 24px;
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

        .reg-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 580px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 40px -10px rgba(0, 0, 0, 0.35);
            padding: 34px 34px;
        }

        .reg-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .reg-tag {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 5px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #c2410c;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.2px;
            margin-bottom: 10px;
        }

        .reg-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--brand-navy);
            letter-spacing: -0.4px;
            margin-bottom: 6px;
        }

        .reg-subtitle {
            font-size: 13px;
            color: #64748b;
            line-height: 1.45;
        }

        .acc-notice {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-left: 4px solid var(--brand-orange);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 12px;
            color: #334155;
            line-height: 1.5;
            margin-bottom: 18px;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 18px;
        }

        .alert-error ul {
            margin-left: 16px;
            margin-top: 4px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-grid .form-group {
            margin-bottom: 0;
        }

        .form-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .form-hint {
            font-size: 11px;
            font-weight: 500;
            color: #94a3b8;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 10px 13px;
            font-size: 13.5px;
            font-family: inherit;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            color: #0f172a;
            background: #ffffff;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: var(--brand-navy);
            box-shadow: 0 0 0 3px rgba(9, 37, 82, 0.12);
        }

        .field-error {
            color: #b91c1c;
            font-size: 11.5px;
            margin-top: 4px;
            font-weight: 600;
        }

        .btn-submit {
            width: 100%;
            margin-top: 18px;
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
            transition: all 0.15s ease;
        }

        .btn-submit:hover {
            background: var(--brand-navy-dark);
            transform: translateY(-1px);
        }

        .reg-footer {
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 12.5px;
            color: #64748b;
        }

        .reg-footer a {
            color: var(--brand-navy);
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        @media (max-width: 768px) {
            .top-navbar {
                padding: 10px 14px;
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
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .nav-portal-link {
                padding: 6px 10px;
                font-size: 11px;
            }
            .hero-section {
                padding: 20px 14px 28px;
                align-items: flex-start;
            }
            .reg-card {
                padding: 24px 18px;
                border-radius: 14px;
            }
            .reg-title {
                font-size: 20px;
            }
            .form-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }
        }

        @media (max-width: 480px) {
            .nav-brand { gap: 6px; }
            .nav-logo-unm { height: 28px; }
            .nav-logo-blu { height: 24px; }
            .brand-title-row { gap: 4px; }
            .brand-main-navy, .brand-main-orange { font-size: 15px; }
            .brand-sub-name { font-size: 10px; }
            .nav-portal-link { padding: 5px 9px; font-size: 10.5px; }
            .form-input,
            .form-select {
                font-size: 16px;
                min-height: 44px;
            }
            .btn-submit {
                min-height: 44px;
            }
        }
    </style>
</head>
<body>

    <header class="top-navbar">
        <a href="{{ route('staff.login') }}" class="nav-brand">
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
        <a href="{{ route('staff.login') }}" class="nav-portal-link">Login Petugas</a>
    </header>

    <main class="hero-section">
        <div class="hero-photo-layer"></div>

        <div class="reg-card">
            <div class="reg-header">
                <h1 class="reg-title">Daftar Akun Pengelola</h1>
                <p class="reg-subtitle">
                    Lengkapi data berikut untuk mendaftarkan akun Pengelola Laboratorium atau Bengkel JTIK FT UNM.
                </p>
            </div>

            <div class="acc-notice">
                <strong>Persetujuan (ACC Admin):</strong> Pemberitahuan pendaftaran Anda akan diterima oleh Admin Sarpras. Akun dapat digunakan untuk masuk setelah disetujui (ACC) oleh Admin.
            </div>

            @if($errors->any())
                <div class="alert-error">
                    <strong>Mohon periksa kembali isian formulir:</strong>
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengelola.register.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">
                        <span>Nama Lengkap &amp; Gelar *</span>
                    </label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" placeholder="Contoh: Ahmad Hidayat, S.Pd., M.T." required>
                    @error('name') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid" style="margin-bottom: 15px;">
                    <div class="form-group">
                        <label class="form-label" for="nomor_induk">
                            <span>NIP / Nomor Induk *</span>
                        </label>
                        <input type="text" id="nomor_induk" name="nomor_induk" class="form-input" value="{{ old('nomor_induk') }}" placeholder="Contoh: 199005122020121001" required>
                        @error('nomor_induk') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">
                            <span>Email Aktif *</span>
                            <span class="form-hint">Untuk lupa sandi</span>
                        </label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="nama@unm.ac.id" required>
                        @error('email') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-grid" style="margin-bottom: 15px;">
                    <div class="form-group">
                        <label class="form-label" for="ruangan_id">
                            <span>Unit / Ruangan Penugasan *</span>
                        </label>
                        <select id="ruangan_id" name="ruangan_id" class="form-select" required>
                            <option value="">-- Pilih Unit / Ruangan --</option>
                            @foreach($ruangans as $ruang)
                                <option value="{{ $ruang->id }}" {{ old('ruangan_id') == $ruang->id ? 'selected' : '' }}>
                                    {{ $ruang->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                        @error('ruangan_id') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="jabatan">
                            <span>Jabatan</span>
                            <span class="form-hint">Opsional</span>
                        </label>
                        <input type="text" id="jabatan" name="jabatan" class="form-input" value="{{ old('jabatan') }}" placeholder="Contoh: Laboran / Teknisi Lab">
                        @error('jabatan') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="password">
                            <span>Kata Sandi *</span>
                            <span class="form-hint">6–32 karakter</span>
                        </label>
                        <input type="password" id="password" name="password" class="form-input" minlength="6" maxlength="32" placeholder="Buat kata sandi..." required>
                        @error('password') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">
                            <span>Konfirmasi Kata Sandi *</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" minlength="6" maxlength="32" placeholder="Ulangi kata sandi..." required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Ajukan Pendaftaran Pengelola</button>
            </form>

            <div class="reg-footer">
                Sudah terdaftar dan disetujui Admin? <a href="{{ route('staff.login') }}">Masuk Portal Petugas</a>
            </div>
        </div>
    </main>

    @include('partials.ui_feedback')
</body>
</html>
