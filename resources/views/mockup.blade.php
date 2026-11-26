<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Mockup Web — SI-SAPRAS JTIK FT UNM</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: #E9EDF2;
      color: #1E293B;
      height: 100vh;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      -webkit-font-smoothing: antialiased;
    }

    /* BAR NAVIGASI MINIMALIS (SATU BARIS, BERSIH) */
    .top-bar {
      height: 46px;
      background: #FFFFFF;
      border-bottom: 1px solid #D8DEE6;
      padding: 0 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-shrink: 0;
    }

    .brand-name {
      font-size: 13px;
      font-weight: 700;
      color: #08296E;
      letter-spacing: -0.1px;
      white-space: nowrap;
    }

    .nav-links {
      display: flex;
      align-items: center;
      height: 100%;
      gap: 4px;
    }

    .nav-btn {
      height: 100%;
      background: none;
      border: none;
      border-bottom: 2px solid transparent;
      padding: 0 12px;
      font-family: inherit;
      font-size: 12.5px;
      font-weight: 500;
      color: #64748B;
      cursor: pointer;
      transition: color 0.15s ease, border-color 0.15s ease;
      white-space: nowrap;
    }

    .nav-btn:hover {
      color: #0F172A;
    }

    .nav-btn.active {
      color: #08296E;
      font-weight: 700;
      border-bottom-color: #08296E;
    }

    .right-controls {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }

    .page-select {
      font-family: inherit;
      font-size: 12px;
      font-weight: 500;
      color: #1E293B;
      background: #F8FAFC;
      border: 1px solid #CBD5E1;
      border-radius: 5px;
      padding: 5px 10px;
      outline: none;
      cursor: pointer;
      min-width: 185px;
    }

    .page-select:focus {
      border-color: #08296E;
    }

    .link-plain {
      font-size: 12px;
      font-weight: 500;
      color: #475569;
      text-decoration: none;
      padding: 5px 8px;
      border-radius: 5px;
      white-space: nowrap;
    }

    .link-plain:hover {
      color: #08296E;
      background: #F1F5F9;
    }

    /* AREA PRESENTASI LAPTOP */
    .stage {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 22px 28px 26px 28px;
      overflow: hidden;
    }

    /* PERANGKAT LAPTOP REALISTIS */
    .laptop-unit {
      display: flex;
      flex-direction: column;
      align-items: center;
      user-select: none;
    }

    /* TUTUP LAYAR / LID */
    .laptop-lid {
      background: #14161A;
      border-radius: 16px 16px 4px 4px;
      padding: 13px 13px 16px 13px;
      border: 1.5px solid #2D3139;
      box-shadow:
        inset 0 0 0 1px rgba(255, 255, 255, 0.06),
        0 18px 40px -16px rgba(15, 23, 42, 0.35);
      position: relative;
    }

    /* KAMERA TIPIS DI TENGAH BEZEL ATAS */
    .laptop-camera {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: #2A2E37;
      box-shadow: inset 0 0 1px #000000;
      position: absolute;
      top: 4px;
      left: 50%;
      transform: translateX(-50%);
    }

    /* LAYAR AKTIF (1280x800 SKALA OTOMATIS) */
    .laptop-screen {
      background: #FFFFFF;
      border-radius: 3px;
      overflow: hidden;
      position: relative;
      border: 1px solid #0B0D10;
    }

    .laptop-iframe {
      width: 1280px;
      height: 800px;
      border: none;
      display: block;
      transform-origin: top left;
      background: #FFFFFF;
    }

    /* LOADING HALUS */
    .screen-loader {
      position: absolute;
      inset: 0;
      background: rgba(255, 255, 255, 0.88);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 5;
      font-size: 12px;
      font-weight: 500;
      color: #475569;
    }

    .screen-loader.show {
      display: flex;
    }

    /* BODI BAWAH / BASE ALUMINIUM LAPTOP */
    .laptop-base {
      height: 15px;
      background: linear-gradient(180deg, #D5DAE0 0%, #C3C9D1 55%, #A6AEB8 100%);
      border-radius: 2px 2px 12px 12px;
      position: relative;
      box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.7),
        0 14px 28px -8px rgba(15, 23, 42, 0.32),
        0 3px 6px -2px rgba(15, 23, 42, 0.18);
    }

    /* LEKUKAN BUKA LAYAR DI TENGAH BASE */
    .laptop-notch {
      width: 84px;
      height: 4px;
      background: #9BA3AE;
      border-radius: 0 0 5px 5px;
      margin: 0 auto;
      box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.25);
    }

    /* BAYANGAN MEJA REALISTIS */
    .desk-shadow {
      height: 10px;
      margin-top: -3px;
      border-radius: 50%;
      background: radial-gradient(ellipse at center, rgba(15, 23, 42, 0.22) 0%, rgba(15, 23, 42, 0) 72%);
      pointer-events: none;
    }

    @media (max-width: 820px) {
      .top-bar {
        padding: 0 12px;
        gap: 8px;
      }
      .brand-name {
        display: none;
      }
      .page-select {
        min-width: 140px;
      }
    }
  </style>
</head>
<body>

  <!-- NAVIGASI RINGKAS -->
  <header class="top-bar">
    <div class="brand-name">SI-SAPRAS JTIK FT UNM</div>

    <nav class="nav-links" aria-label="Pilih Tampilan">
      <button type="button" class="nav-btn active" data-role="guest" onclick="selectRole('guest')">Pembuka &amp; Login</button>
      <button type="button" class="nav-btn" data-role="mahasiswa" onclick="selectRole('mahasiswa')">Mahasiswa</button>
      <button type="button" class="nav-btn" data-role="pengelola" onclick="selectRole('pengelola')">Pengelola</button>
      <button type="button" class="nav-btn" data-role="admin" onclick="selectRole('admin')">Admin</button>
    </nav>

    <div class="right-controls">
      <select id="pageSelect" class="page-select" aria-label="Pilih Halaman" onchange="onSelectPage(this.value)"></select>
      <a id="openFullLink" href="{{ url('/') }}" target="_blank" class="link-plain">Tab Baru ↗</a>
    </div>
  </header>

  <!-- MOCKUP LAPTOP WEB -->
  <main id="stage" class="stage">
    <div class="laptop-unit">
      <div class="laptop-lid">
        <div class="laptop-camera" aria-hidden="true"></div>
        <div id="laptopScreen" class="laptop-screen">
          <div id="screenLoader" class="screen-loader">Memuat halaman...</div>
          <iframe id="mockupFrame" class="laptop-iframe" src="{{ url('/') }}" title="SI-SAPRAS JTIK Web Preview"></iframe>
        </div>
      </div>
      <div id="laptopBase" class="laptop-base">
        <div class="laptop-notch" aria-hidden="true"></div>
      </div>
      <div id="deskShadow" class="desk-shadow" aria-hidden="true"></div>
    </div>
  </main>

  <script>
    const SCREENS = {
      guest: [
        { title: 'Animasi Pembukaan (Mahasiswa)', path: '/' },
        { title: 'Login Mahasiswa', path: '/login' },
        { title: 'Login Pengelola & Admin', path: '/petugas/login' },
        { title: 'Daftar Pengelola Baru', path: '/petugas/register' }
      ],
      mahasiswa: [
        { title: 'Dashboard Mahasiswa', path: '/mahasiswa/dashboard' },
        { title: 'Katalog Alat & Bahan', path: '/mahasiswa/peminjaman/alat' },
        { title: 'Pengembalian Fisik', path: '/mahasiswa/pengembalian' },
        { title: 'Status & Riwayat', path: '/mahasiswa/status-pinjam' },
        { title: 'Bebas Sarpras', path: '/mahasiswa/bebas-sarpras' }
      ],
      pengelola: [
        { title: 'Dashboard Pengajuan', path: '/pengelola/dashboard' },
        { title: 'Verifikasi Pengembalian', path: '/pengelola/pengembalian' },
        { title: 'Riwayat Keputusan', path: '/pengelola/riwayat' },
        { title: 'Bebas Pinjam', path: '/pengelola/bebas-pinjam' }
      ],
      admin: [
        { title: 'Master Sarpras', path: '/admin/dashboard' },
        { title: 'Data Ruangan', path: '/admin/ruangan' },
        { title: 'Akun & Monitoring', path: '/admin/users' }
      ]
    };

    const NATIVE_W = 1280;
    const NATIVE_H = 800;

    let currentRole = 'guest';
    let currentPath = '/';
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const stage = document.getElementById('stage');
    const laptopScreen = document.getElementById('laptopScreen');
    const laptopBase = document.getElementById('laptopBase');
    const deskShadow = document.getElementById('deskShadow');
    const frame = document.getElementById('mockupFrame');
    const loader = document.getElementById('screenLoader');
    const pageSelect = document.getElementById('pageSelect');
    const openFullLink = document.getElementById('openFullLink');

    frame.addEventListener('load', () => {
      loader.classList.remove('show');
    });

    function fitLaptop() {
      const availW = stage.clientWidth - 90;
      const availH = stage.clientHeight - 66;
      const scale = Math.max(0.35, Math.min(availW / NATIVE_W, availH / NATIVE_H, 0.96));

      const screenW = Math.round(NATIVE_W * scale);
      const screenH = Math.round(NATIVE_H * scale);

      laptopScreen.style.width = screenW + 'px';
      laptopScreen.style.height = screenH + 'px';
      frame.style.transform = 'scale(' + scale + ')';

      const lidOuterW = screenW + 29;
      laptopBase.style.width = Math.round(lidOuterW * 1.13) + 'px';
      deskShadow.style.width = Math.round(lidOuterW * 1.18) + 'px';
    }

    function populateSelect(role, activePath) {
      pageSelect.innerHTML = '';
      SCREENS[role].forEach((item) => {
        const opt = document.createElement('option');
        opt.value = item.path;
        opt.textContent = item.title;
        if (item.path === activePath) opt.selected = true;
        pageSelect.appendChild(opt);
      });
    }

    function selectRole(role) {
      document.querySelectorAll('.nav-btn').forEach((btn) => {
        btn.classList.toggle('active', btn.dataset.role === role);
      });
      const firstPath = SCREENS[role][0].path;
      navigateTo(role, firstPath);
    }

    function onSelectPage(path) {
      navigateTo(currentRole, path);
    }

    async function navigateTo(role, path) {
      const needSwitchRole = (role !== currentRole) || (role === 'guest' && path === '/login');
      currentRole = role;
      currentPath = path;

      populateSelect(role, path);
      openFullLink.href = "{{ url('') }}" + path;
      loader.classList.add('show');

      if (needSwitchRole) {
        try {
          const res = await fetch("{{ route('mockup.switch-role') }}", {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ role: role, target: path })
          });

          if (res.ok) {
            const data = await res.json();
            if (data.csrf_token) csrfToken = data.csrf_token;
          }
        } catch (err) {
          console.error('Gagal berpindah peran:', err);
        }
      }

      frame.src = "{{ url('') }}" + path;
    }

    window.addEventListener('resize', fitLaptop);
    populateSelect('guest', '/');
    fitLaptop();
  </script>
</body>
</html>
