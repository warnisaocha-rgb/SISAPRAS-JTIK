<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'SI-SAPRAS JTIK FT UNM')</title>
  
  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            mono: ['"JetBrains Mono"', 'monospace'],
          },
          colors: {
            brand: {
              navy: '#07162c',
              sidebar: '#0b1b36',
              card: '#0f274a',
              blue: '#0284c7',
              accent: '#2563eb',
              light: '#f1f5f9',
            }
          }
        }
      }
    }
  </script>

  <!-- Font Awesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .mono { font-family: 'JetBrains Mono', monospace; }
  </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col">

  <!-- MAIN APP WRAPPER: SIDEBAR + CONTENT -->
  <div class="flex flex-1 min-h-screen">

    <!-- SIDEBAR KIRI (PERSIS GAMBAR REFERENSI) -->
    <aside class="w-64 bg-[#0b1b36] text-slate-200 flex flex-col justify-between flex-shrink-0 shadow-xl border-r border-slate-800 select-none">
      <div>
        <!-- BRANDING LOGO UNM SI-SAPRAS JTIK -->
        <div class="p-5 border-b border-white/10 flex flex-col items-start gap-2">
          <img src="{{ asset('images/logo-unm-white.png') }}" alt="Logo UNM" class="h-8 w-auto object-contain">
          <div class="leading-tight">
            <div class="text-sm font-extrabold text-white tracking-tight">SI-SAPRAS JTIK</div>
            <div class="text-[9px] text-slate-400 font-medium">Fakultas Teknik</div>
          </div>
        </div>

        <!-- NAVIGATION MENU SESUAI DENGAN ROLE YANG LOGIN -->
        <nav class="p-3 space-y-1.5 text-xs font-semibold">
          @php $role = Auth::user()->role ?? 'mahasiswa'; @endphp

          {{-- ========== MENU MAHASISWA (REFERENSI 1) ========== --}}
          @if($role === 'mahasiswa')
            <div class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">
              Layanan Mahasiswa
            </div>
            
            <a href="{{ route('mahasiswa.dashboard') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition bg-blue-600 text-white shadow-md shadow-blue-600/30 font-bold">
              <i class="fa-solid fa-table-cells-large w-4 text-center"></i>
              <span>Dashboard</span>
            </a>

            <!-- Peminjaman Dropdown -->
            <div class="flex items-center justify-between px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <div class="flex items-center space-x-3">
                <i class="fa-solid fa-boxes-stacked w-4 text-center"></i>
                <span>Peminjaman</span>
              </div>
              <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
            </div>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-box-archive w-4 text-center"></i>
              <span>Pengembalian</span>
            </div>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-clock-rotate-left w-4 text-center"></i>
              <span>Status Pinjam</span>
            </div>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-certificate w-4 text-center"></i>
              <span>Bebas Sarpras</span>
            </div>

          {{-- ========== MENU PENGELOLA (REFERENSI 2) ========== --}}
          @elseif($role === 'pengelola')
            <div class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">
              Meja Verifikasi
            </div>

            <a href="{{ route('pengelola.dashboard') }}" 
               class="flex items-center justify-between px-3 py-2.5 rounded-lg transition bg-blue-600 text-white shadow-md shadow-blue-600/30 font-bold">
              <div class="flex items-center space-x-3">
                <i class="fa-solid fa-clipboard-check w-4 text-center"></i>
                <span>Persetujuan Pinjam</span>
              </div>
            </a>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-history w-4 text-center"></i>
              <span>Riwayat Keputusan</span>
            </div>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-box-open w-4 text-center"></i>
              <span>Verifikasi Pengembalian</span>
            </div>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-file-circle-check w-4 text-center"></i>
              <span>Verifikasi Bebas Pinjam</span>
            </div>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-wrench w-4 text-center"></i>
              <span>Cek Alat</span>
            </div>

          {{-- ========== MENU ADMIN (REFERENSI 3) ========== --}}
          @elseif($role === 'admin')
            <div class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">
              Administrasi Master
            </div>

            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition bg-blue-600 text-white shadow-md shadow-blue-600/30 font-bold">
              <i class="fa-solid fa-layer-group w-4 text-center"></i>
              <span>Kelola Master Sarpras</span>
            </a>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-door-open w-4 text-center"></i>
              <span>Data Ruang & Lokasi</span>
            </div>

            <div class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/5 hover:text-white transition cursor-pointer">
              <i class="fa-solid fa-users-gear w-4 text-center"></i>
              <span>Manajemen Akun User</span>
            </div>
          @endif
        </nav>
      </div>

      <!-- SIDEBAR FOOTER DENGAN TOMBOL LOGOUT -->
      <div class="p-4 border-t border-white/10 text-[11px] text-slate-400 flex items-center justify-between">
        <div>
          <div class="font-bold text-slate-300">SI-SAPRAS JTIK</div>
          <div class="text-[9px] text-slate-300">FT Universitas Negeri Makassar</div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" title="Logout" class="px-2.5 py-1.5 rounded-lg bg-white/5 hover:bg-red-600 hover:text-white text-slate-400 flex items-center space-x-1.5 transition text-[10px] font-bold">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Keluar</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- KONTEN UTAMA SISI KANAN -->
    <div class="flex-1 flex flex-col bg-slate-50 min-w-0">

      <!-- TOP NAVBAR PERSIS GAMBAR REFERENSI -->
      <header class="bg-white border-b border-slate-200 px-6 py-3.5 flex items-center justify-between sticky top-0 z-40 shadow-xs">
        <!-- Title & Breadcrumb -->
        <div>
          <div class="flex items-center space-x-2 text-slate-800">
            <h1 class="text-sm md:text-base font-black tracking-tight text-slate-900 uppercase">
              @yield('header_title', 'SI-SAPRAS JTIK')
            </h1>
            <span class="text-slate-300">|</span>
            <span class="text-xs font-semibold text-slate-500">
              @yield('header_subtitle', 'Sistem Informasi Sarana Prasarana')
            </span>
          </div>
        </div>

        <!-- Top Right Actions Sesuai Gambar Referensi -->
        <div class="flex items-center space-x-3">
          @yield('header_actions')

          <!-- Cart icon for mahasiswa -->
          @if((Auth::user()->role ?? '') === 'mahasiswa')
            <div class="relative w-9 h-9 rounded-lg border border-slate-200 bg-slate-50 text-slate-600 flex items-center justify-center">
              <i class="fa-solid fa-cart-shopping text-sm"></i>
              <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-blue-600 text-white font-bold text-[9px] flex items-center justify-center">1</span>
            </div>
          @endif

          <!-- User / Role Pill Badge -->
          <div class="flex items-center space-x-2 pl-2 border-l border-slate-200">
            <div class="w-8 h-8 rounded-full bg-slate-900 text-amber-400 font-extrabold text-xs flex items-center justify-center">
              {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <div class="text-left hidden sm:block">
              <div class="text-xs font-black text-slate-800 leading-none">
                {{ Auth::user()->name ?? 'Guest' }}
              </div>
              <div class="text-[10px] font-semibold text-slate-500 mt-0.5">
                {{ Auth::user()->nomor_induk ?? '-' }}
              </div>
            </div>
            <!-- Role Badge Pill -->
            <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider border {{ (Auth::user()->role ?? '') === 'admin' ? 'bg-purple-100 text-purple-800 border-purple-200' : ((Auth::user()->role ?? '') === 'pengelola' ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-blue-100 text-blue-800 border-blue-200') }}">
              {{ Auth::user()->role ?? 'user' }}
            </span>
          </div>
        </div>
      </header>

      <!-- MAIN PAGE CONTENT -->
      <main class="flex-1 p-6">
        @yield('content')
      </main>

    </div>
  </div>

  @yield('scripts')
</body>
</html>
