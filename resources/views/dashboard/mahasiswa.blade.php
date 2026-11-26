<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM — Dashboard Mahasiswa</title>
  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono (Seragam dengan Halaman Login) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* RESET & DASAR */
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --primary-navy: #08296E;
      --sidebar-navy: #16192E;
      --sidebar-card: #1E2342;
      --unm-orange: #ED7411;
      --unm-yellow: #FBBF24;
      --text-dark: #0F172A;
      --text-body: #334155;
      --text-muted: #64748B;
      --border-color: #CBD5E1;
      --border-subtle: #E2E8F0;
      --bg-workspace: #F8FAFC;
      --status-amber-bg: #FEF3C7;
      --status-amber-text: #B45309;
      --status-amber-border: #FDE68A;
      --status-green-bg: #DCFCE7;
      --status-green-text: #15803D;
      --danger-red: #DC2626;
      --accent-blue: #0091FF;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: var(--bg-workspace);
      color: var(--text-dark);
      margin: 0;
      padding: 0;
      line-height: 1.5;
      display: flex;
      min-height: 100vh;
      width: 100%;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-rendering: optimizeLegibility;
    }

    /* FULLPAGE PORTAL LAYOUT (KONSISTEN 220PX GRID SEPERTI PENGELOLA & ADMIN) */
    .portal-layout {
      display: grid;
      grid-template-columns: 220px 1fr;
      width: 100%;
      min-height: 100vh;
    }

    /* SIDEBAR (KONSISTEN 220PX PERSIS PENGELOLA & ADMIN) */
    .sidebar {
      width: 220px;
      min-width: 220px;
      background: #16192E;
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
      color: #FFFFFF;
      min-height: 100vh;
      border-right: 1px solid rgba(255, 255, 255, 0.07);
      padding: 18px 14px 14px 14px;
      user-select: none;
    }

    .sidebar-brand {
      padding: 6px 8px 16px 8px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      margin-bottom: 12px;
    }

    .brand-logo-img {
      height: 36px;
      width: auto;
      max-width: 175px;
      object-fit: contain;
      display: block;
    }

    /* NAV ITEMS */
    .sidebar-nav {
      display: flex;
      flex-direction: column;
      gap: 4px;
      flex: 1;
    }

    .nav-header-label {
      font-size: 8.5px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: #64748B;
      font-weight: 700;
      padding: 8px 10px 4px 10px;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .nav-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 8.5px 12px;
      color: #94A3B8;
      text-decoration: none;
      font-size: 11px;
      font-weight: 500;
      border-radius: 6px;
      transition: all 0.15s ease;
      cursor: pointer;
    }

    .nav-item:hover {
      background: rgba(255, 255, 255, 0.06);
      color: #FFFFFF;
    }

    /* WARNA ACTIVE SIDEBAR KONSISTEN ORANGE SEPERTI ADMIN & PENGELOLA */
    .nav-item.active {
      background: #ED7411 !important;
      color: #FFFFFF !important;
      font-weight: 700;
    }

    .nav-left-part {
      display: flex;
      align-items: center;
      gap: 9px;
    }

    .nav-badge-count {
      font-size: 9px;
      font-weight: 800;
      background: #ED7411;
      color: #FFFFFF;
      padding: 1.5px 7px;
      border-radius: 999px;
      line-height: 1.3;
    }

    .nav-item.active .nav-badge-count {
      background: #FFFFFF !important;
      color: #ED7411 !important;
    }

    /* SUB-MENU PEMINJAMAN TERBAGI (FIGMA MOCKUP) */
    .nav-parent-group {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .nav-parent-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 8.5px 12px;
      color: #FFFFFF;
      font-size: 11px;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      background: rgba(255, 255, 255, 0.04);
      transition: background 0.15s ease;
    }

    .nav-parent-header:hover {
      background: rgba(255, 255, 255, 0.08);
    }

    .nav-sub-list {
      display: none;
      flex-direction: column;
      gap: 2px;
      padding-left: 10px;
      margin-top: 2px;
      margin-bottom: 4px;
    }

    .nav-sub-list.show {
      display: flex;
    }

    .nav-sub-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 7px 12px 7px 16px;
      color: #94A3B8;
      text-decoration: none;
      font-size: 10.5px;
      font-weight: 500;
      border-radius: 6px;
      transition: all 0.15s ease;
    }

    .nav-sub-item:hover {
      background: rgba(255, 255, 255, 0.06);
      color: #FFFFFF;
    }

    .nav-sub-item.active {
      background: #ED7411 !important;
      color: #FFFFFF !important;
      font-weight: 700;
    }

    .sidebar-footer {
      margin-top: auto;
      padding-top: 14px;
      border-top: 1px dashed rgba(255, 255, 255, 0.08);
      font-size: 10px;
      color: rgba(255, 255, 255, 0.4);
      letter-spacing: 0.5px;
      text-align: center;
      font-family: 'JetBrains Mono', monospace;
    }

    /* MAIN WORKSPACE */
    .workspace {
      background: var(--bg-workspace);
      padding: 22px 30px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      overflow-y: auto;
    }

    /* PAGE HEADER (PERSIS GAYA ADMIN & PENGELOLA) */
    .page-header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--border-subtle);
      gap: 16px;
    }

    .page-title {
      font-size: 15px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.2px;
      margin: 0;
      white-space: nowrap;
    }

    .header-divider {
      color: var(--primary-navy, #08296E);
      font-weight: 400;
      font-size: 14px;
      margin: 0 4px;
      line-height: 1;
    }

    @media (max-width: 1100px) {
      .header-divider {
        display: none;
      }
    }

    @media (max-width: 1100px) {
      .header-divider {
        display: none;
      }
    }

    .page-subtitle {
      font-size: 11px;
      color: var(--text-muted);
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }

    /* TOMBOL KERANJANG DI HEADER */
    .cart-btn-header {
      background: #FFFFFF;
      border: 1.5px solid #08296E;
      color: #08296E;
      padding: 0 10px;
      height: 34px;
      box-sizing: border-box;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      transition: all 0.15s ease;
      position: relative;
      white-space: nowrap;
    }

    .cart-btn-header:hover {
      background: #EFF6FF;
      border-color: #08296E;
    }

    .cart-badge-count {
      background: #ED7411;
      color: #FFFFFF;
      font-size: 10px;
      font-weight: 800;
      padding: 1px 6px;
      border-radius: 999px;
      line-height: 1.2;
      min-width: 16px;
      text-align: center;
    }

    /* ROLE BADGE PILL PERSIS GAYA ADMIN & PENGELOLA */
    .badge-role-pill {
      background: #EFF6FF;
      color: #1D4ED8;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      font-weight: 600;
      padding: 0 14px;
      height: 34px;
      box-sizing: border-box;
      border-radius: 6px;
      border: 1px solid #BFDBFE;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: all 0.15s ease;
      text-decoration: none;
      white-space: nowrap;
    }

    .badge-role-pill:hover {
      background: #DBEAFE;
      border-color: #93C5FD;
    }

    .badge-role-pill:hover {
      background: #DBEAFE;
      border-color: #93C5FD;
    }

    /* USER DROPDOWN MENU (PERSIS GAYA PENGELOLA) */
    .btn-header-mahasiswa, .badge-role-pill {
      background: #EFF6FF;
      color: #1D4ED8;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      padding: 5px 14px;
      border-radius: 6px;
      border: 1px solid #BFDBFE;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: all 0.15s ease;
      user-select: none;
    }
    .btn-header-mahasiswa:hover, .badge-role-pill:hover {
      background: #DBEAFE;
      border-color: #93C5FD;
    }

    .user-dropdown-panel, .user-dropdown-menu {
      position: absolute;
      top: calc(100% + 6px);
      right: 0;
      background: #FFFFFF;
      border: 1px solid var(--border-color, #E2E8F0);
      border-radius: 8px;
      box-shadow: 0 10px 20px -3px rgba(15, 23, 42, 0.12), 0 4px 6px -2px rgba(15, 23, 42, 0.05);
      width: 240px;
      padding: 6px;
      z-index: 1000;
      text-align: left;
      animation: dropdownFadeIn 0.15s ease-out;
    }
    @keyframes dropdownFadeIn {
      from { opacity: 0; transform: translateY(-4px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .user-dropdown-header-card {
      padding: 8px 10px;
      border-radius: 6px;
      background: #F8FAFC;
      border: 1px solid #EDF2F7;
      display: flex;
      align-items: center;
      gap: 9px;
      cursor: pointer;
      transition: all 0.15s ease;
      margin-bottom: 5px;
    }
    .user-dropdown-header-card:hover {
      background: #F1F5F9;
      border-color: #CBD5E1;
    }

    .user-avatar-initial {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: linear-gradient(135deg, #08296E, #ED7411);
      color: #FFFFFF;
      font-weight: 800;
      font-size: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .user-dropdown-name {
      font-size: 11px;
      font-weight: 700;
      color: #0F172A;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 1.25;
    }
    .user-dropdown-email, .user-dropdown-meta {
      font-size: 8.5px;
      color: #64748B;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-top: 1px;
    }
    .user-dropdown-tag {
      font-size: 8.5px;
      color: #ED7411;
      font-weight: 700;
      margin-top: 2px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .user-dropdown-links {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .user-dropdown-btn, .user-dropdown-link-btn {
      width: 100%;
      background: none;
      border: none;
      padding: 7px 10px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      gap: 8px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10.5px;
      font-weight: 500;
      color: #334155;
      cursor: pointer;
      transition: all 0.15s ease;
      text-align: left;
      text-decoration: none;
    }
    .user-dropdown-btn:hover, .user-dropdown-link-btn:hover {
      background: #F1F5F9;
      color: #08296E;
    }
    .user-dropdown-btn svg, .user-dropdown-link-btn svg {
      flex-shrink: 0;
      stroke: #64748B;
      transition: stroke 0.15s ease;
    }
    .user-dropdown-btn:hover svg, .user-dropdown-link-btn:hover svg {
      stroke: #08296E;
    }

    .user-dropdown-sep, .user-dropdown-divider {
      height: 1px;
      background: #E2E8F0;
      margin: 4px 0;
    }

    .user-dropdown-btn.logout, .user-dropdown-link-btn.logout {
      color: var(--danger-red, #DC2626);
      font-weight: 600;
    }
    .user-dropdown-btn.logout:hover, .user-dropdown-link-btn.logout:hover {
      background: #FEF2F2;
      color: #B91C1C;
    }
    .user-dropdown-btn.logout svg, .user-dropdown-link-btn.logout svg {
      stroke: var(--danger-red, #DC2626);
    }
    .user-dropdown-btn.logout:hover svg, .user-dropdown-link-btn.logout:hover svg {
      stroke: #B91C1C;
    }

    /* NOTIFIKASI ALERT */
    .alert-banner {
      padding: 10px 16px;
      border-radius: 8px;
      font-size: 11.5px;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: space-between;
      animation: fadeInAlert 0.2s ease-out;
    }

    @keyframes fadeInAlert {
      from { opacity: 0; transform: translateY(-6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .alert-banner.success {
      background: #DCFCE7;
      border: 1px solid #86EFAC;
      color: #166534;
    }

    .alert-banner.error {
      background: #FEE2E2;
      border: 1px solid #FCA5A5;
      color: #991B1B;
    }

    .alert-close-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 16px;
      line-height: 1;
      padding: 0 4px;
    }

    /* WELCOME ALERT BANNER */
    .welcome-banner {
      background: #FFFDF0;
      border: 1.2px solid #FDE68A;
      border-radius: 8px;
      padding: 13px 18px;
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .welcome-icon {
      width: 26px;
      height: 26px;
      border-radius: 6px;
      background: #FEF3C7;
      color: #D97706;
      font-weight: 800;
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .welcome-text h4 {
      font-size: 11.5px;
      font-weight: 800;
      color: #0F172A;
      letter-spacing: 0.2px;
    }

    .welcome-text p {
      font-size: 10px;
      color: #475569;
      margin-top: 2px;
    }

    /* 4 METRIC CARDS (PERSIS FIGMA TERBARU: DARK NAVY, ANGKA PUTIH) */
    .metrics-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
    }

    .metric-card {
      background: #08296E;
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 10px;
      padding: 20px 16px 18px 16px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      transition: transform 0.15s ease, box-shadow 0.15s ease;
      cursor: pointer;
    }

    .metric-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 15px -3px rgba(8, 41, 110, 0.2);
    }

    .m-title {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.6px;
      text-transform: uppercase;
      color: #CBD5E1;
      margin-bottom: 6px;
    }

    .m-num {
      font-size: 36px;
      font-weight: 800;
      line-height: 1;
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* 4 MENU AKSES CEPAT LAYANAN */
    .quick-section-title {
      font-size: 11px;
      font-weight: 800;
      color: #0F172A;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      margin-top: 4px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .quick-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
    }

    .quick-card {
      background: #FFFFFF;
      border: 1.2px solid #E2E8F0;
      border-radius: 8px;
      padding: 14px 16px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 85px;
      transition: all 0.15s ease;
      cursor: pointer;
      text-decoration: none;
    }

    .quick-card:hover {
      border-color: #0091FF;
      box-shadow: 0 4px 12px rgba(0, 145, 255, 0.08);
      transform: translateY(-2px);
    }

    .qc-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 8px;
    }

    .qc-title {
      font-size: 11px;
      font-weight: 700;
      color: #0F172A;
    }

    .btn-arrow-blue {
      width: 24px;
      height: 24px;
      background: #0091FF;
      border: none;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #FFFFFF;
      transition: background 0.15s ease;
      flex-shrink: 0;
      text-decoration: none;
    }

    .btn-arrow-blue:hover {
      background: #0077D6;
    }

    .qc-desc {
      font-size: 9.5px;
      color: #64748B;
      line-height: 1.35;
      margin-top: 6px;
    }

    /* TABLE SECTION */
    .table-section {
      background: #FFFFFF;
      border: 1.2px solid #E2E8F0;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .table-header-bar {
      padding: 12px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1.2px solid #E2E8F0;
      background: #FFFFFF;
      flex-wrap: wrap;
      gap: 10px;
    }

    .th-title {
      font-size: 11.5px;
      font-weight: 800;
      color: #0F172A;
      letter-spacing: 0.3px;
      text-transform: uppercase;
    }

    /* FILTER TABS PADA TABEL */
    .table-filter-group {
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .tbl-filter-btn {
      padding: 3px 9px;
      border-radius: 4px;
      border: 1px solid var(--border-color);
      background: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 9.5px;
      font-weight: 600;
      color: #475569;
      cursor: pointer;
      transition: all 0.15s ease;
    }

    .tbl-filter-btn:hover {
      background: #F1F5F9;
      color: var(--primary-navy);
    }

    .tbl-filter-btn.active {
      background: #0F172A;
      color: #FFFFFF;
      border-color: #0F172A;
    }

    .custom-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 11px;
    }

    .custom-table th {
      background: #08296E;
      color: #FFFFFF;
      font-size: 10px;
      font-weight: 700;
      padding: 9px 14px;
      text-align: left;
    }

    .custom-table td {
      padding: 11px 14px;
      border-bottom: 1px solid #E2E8F0;
      vertical-align: middle;
    }

    .custom-table tbody tr:hover {
      background-color: #F8FAFC;
    }

    .trx-tag {
      font-family: 'JetBrains Mono', monospace;
      font-weight: 700;
      color: #08296E;
      font-size: 10.5px;
      display: inline-block;
      white-space: nowrap;
      letter-spacing: 0.5px;
    }

    /* BADGE STATUS */
    .pill-status {
      padding: 4px 10px;
      border-radius: 5px;
      font-size: 11px;
      font-weight: 600;
      display: inline-block;
      text-align: center;
      white-space: nowrap;
      line-height: 1.25;
    }

    .status-breakdown-note {
      font-size: 10px;
      font-weight: 500;
      color: #64748B;
      margin-top: 4px;
      line-height: 1.3;
    }

    .pill-orange { background: #FFF3E8; color: #F06A09; border: 1px solid #FED7AA; }
    .pill-yellow { background: #FEF3C7; color: #D97706; border: 1px solid #FDE68A; }
    .pill-green  { background: #DCFCE7; color: #15803D; border: 1px solid #BBF7D0; }
    .pill-red    { background: #FEE2E2; color: #DC2626; border: 1px solid #FCA5A5; }
    .pill-blue   { background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; }
    .pill-partial { background: #FFF7ED; color: #C2410C; border: 1px solid #FDBA74; }
    .pill-indigo  { background: #EEF2FF; color: #4338CA; border: 1px solid #C7D2FE; }

    .btn-detail {
      background: #FFFFFF;
      border: 1px solid #08296E;
      color: #08296E;
      padding: 4px 11px;
      border-radius: 4px;
      font-size: 9.5px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.15s ease;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .btn-detail:hover {
      background: #08296E;
      color: #FFFFFF;
    }

    /* MODAL STYLES (KONSISTEN 100% DENGAN ADMIN & PENGELOLA) */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(2px);
      z-index: 9999;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-overlay.active {
      display: flex;
      animation: fadeInModal 0.15s ease-out;
    }

    @keyframes fadeInModal {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-dialog {
      background: #FFFFFF;
      border-radius: 12px;
      width: 100%;
      max-width: 580px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
      border: 1px solid #E2E8F0;
      max-height: 90vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .modal-dialog.modal-lg {
      max-width: 720px;
    }

    .modal-header {
      padding: 14px 20px;
      border-bottom: 1px solid var(--border-subtle);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .modal-title-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .modal-title {
      font-size: 13.5px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.2px;
    }

    .btn-close-modal {
      background: none;
      border: none;
      color: var(--text-muted);
      cursor: pointer;
      font-size: 20px;
      line-height: 1;
      padding: 2px 6px;
      border-radius: 4px;
      transition: all 0.15s ease;
    }

    .btn-close-modal:hover {
      background: #F1F5F9;
      color: var(--text-dark);
    }

    .modal-body {
      padding: 18px 20px;
      overflow-y: auto;
    }

    .modal-footer {
      padding: 12px 20px;
      border-top: 1px solid var(--border-subtle);
      background: #F8FAFC;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
    }

    /* FORM STYLES */
    .form-group {
      margin-bottom: 14px;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .form-label {
      display: block;
      font-size: 10.5px;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 5px;
    }

    .form-label .req {
      color: var(--danger-red);
    }

    .form-input, .form-select, .form-textarea {
      width: 100%;
      padding: 8px 12px;
      border-radius: 6px;
      border: 1.2px solid var(--border-color);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      color: var(--text-dark);
      background: #FFFFFF;
      transition: border-color 0.15s ease;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
      outline: none;
      border-color: #08296E;
      box-shadow: 0 0 0 2px rgba(8, 41, 110, 0.08);
    }

    .form-hint {
      font-size: 9.5px;
      color: var(--text-muted);
      margin-top: 4px;
    }

    .btn-primary {
      background: #08296E;
      color: #FFFFFF;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: background 0.15s ease;
    }

    .btn-primary:hover {
      background: #061d4f;
    }

    .btn-secondary {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      color: #475569;
      padding: 8px 14px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.15s ease;
    }

    .btn-secondary:hover {
      background: #F1F5F9;
      color: var(--text-dark);
    }

    .btn-danger {
      background: #DC2626;
      color: #FFFFFF;
      border: none;
      padding: 8px 14px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.15s ease;
    }

    .btn-danger:hover {
      background: #B91C1C;
    }

    /* DETAIL CARD INFO */
    .detail-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-bottom: 14px;
    }

    .detail-card {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 6px;
      padding: 10px 12px;
    }

    .detail-card-label {
      font-size: 9px;
      font-weight: 700;
      color: #64748B;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      margin-bottom: 3px;
    }

    .detail-card-value {
      font-size: 11px;
      font-weight: 700;
      color: #0F172A;
    }

    /* LAB CHECKLIST BOX FOR BEBAS PINJAM */
    .lab-check-box {
      background: #FFFFFF;
      border: 1.2px solid #E2E8F0;
      border-radius: 8px;
      padding: 12px 14px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .lab-check-info {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .lab-check-title {
      font-size: 11.5px;
      font-weight: 700;
      color: #08296E;
    }

    .lab-check-sub {
      font-size: 9.5px;
      color: #64748B;
    }

    /* KERANJANG ITEM LIST */
    .cart-item-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 12px;
      border-bottom: 1px solid #E2E8F0;
      background: #FFFFFF;
    }

    .cart-item-row:last-child {
      border-bottom: none;
    }

    .cart-item-info {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .cart-item-name {
      font-size: 11.5px;
      font-weight: 700;
      color: #0F172A;
    }

    .cart-item-meta {
      font-size: 9.5px;
      color: #64748B;
    }

    .cart-qty-badge {
      font-family: 'JetBrains Mono', monospace;
      font-size: 10px;
      font-weight: 800;
      background: #EFF6FF;
      color: #1D4ED8;
      padding: 2px 8px;
      border-radius: 4px;
      border: 1px solid #BFDBFE;
    }

    @media print {
      body * {
        visibility: hidden !important;
      }
      #modalCetakBebasPinjam,
      #modalCetakBebasPinjam * {
        visibility: visible !important;
      }
      #modalCetakBebasPinjam {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
        background: #FFFFFF !important;
        display: block !important;
        padding: 0 !important;
      }
      #modalCetakBebasPinjam .modal-dialog {
        box-shadow: none !important;
        border: none !important;
        max-width: 100% !important;
        width: 100% !important;
      }
      #modalCetakBebasPinjam .modal-header,
      #modalCetakBebasPinjam .modal-footer,
      #modalCetakBebasPinjam .no-print {
        display: none !important;
      }
    }

    /* FIGMA MODAL: FORMULIR PENGAJUAN PINJAM */
    .modal-dialog.modal-figma {
      max-width: 660px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);
      border: 1px solid #CBD5E1;
    }
    .cart-figma-box {
      background: #FFFFFF;
      border: 1.5px solid #E2E8F0;
      border-radius: 8px;
      padding: 12px 14px;
      margin-bottom: 14px;
    }
    .cart-figma-box-title {
      font-size: 11px;
      font-weight: 800;
      color: #08296E;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      margin-bottom: 10px;
    }
    .cart-figma-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 6px;
      padding: 8px 12px;
      margin-bottom: 6px;
    }
    .cart-figma-item-name {
      font-size: 11.5px;
      font-weight: 800;
      color: #08296E;
      margin-bottom: 2px;
    }
    .cart-figma-item-room {
      font-size: 10px;
      color: #64748B;
      font-weight: 500;
    }
    .cart-figma-stepper {
      display: flex;
      align-items: center;
      border: 1px solid #CBD5E1;
      border-radius: 6px;
      background: #FFFFFF;
      overflow: hidden;
    }
    .btn-stepper {
      width: 26px;
      height: 26px;
      border: none;
      background: #F8FAFC;
      color: #1E293B;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.15s;
    }
    .btn-stepper:hover {
      background: #E2E8F0;
    }
    .stepper-val {
      min-width: 26px;
      text-align: center;
      font-size: 11.5px;
      font-weight: 800;
      color: #08296E;
      padding: 0 4px;
    }
    .btn-del-item {
      margin-left: 8px;
      background: none;
      border: none;
      color: #EF4444;
      font-size: 16px;
      cursor: pointer;
      padding: 2px 6px;
      line-height: 1;
    }
    .btn-del-item:hover {
      color: #B91C1C;
    }
    .btn-submit-figma-orange {
      background: #ED7411;
      color: #FFFFFF;
      border: none;
      border-radius: 6px;
      padding: 10px 22px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11.5px;
      font-weight: 800;
      letter-spacing: 0.3px;
      cursor: pointer;
      transition: background 0.15s ease;
      box-shadow: 0 2px 4px rgba(237, 116, 17, 0.2);
    }
    .btn-submit-figma-orange:hover {
      background: #D96005;
    }
    .btn-batal-figma {
      background: #FFFFFF;
      color: #334155;
      border: 1.5px solid #CBD5E1;
      border-radius: 6px;
      padding: 10px 20px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11.5px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.15s;
    }
    .btn-batal-figma:hover {
      background: #F1F5F9;
      border-color: #94A3B8;
    }
    .btn-hapus-sarana {
      background: #FFFFFF;
      border: 1px solid #EF4444;
      color: #EF4444;
      font-size: 10px;
      font-weight: 700;
      border-radius: 4px;
      padding: 3px 8px;
      cursor: pointer;
      transition: all 0.15s;
    }
    .btn-hapus-sarana:hover {
      background: #FEE2E2;
    }
    select.auto-prodi-input {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: right 10px center !important;
      background-size: 14px !important;
      padding-right: 32px !important;
      text-overflow: ellipsis;
    }

    /* PERBAIKAN SKALA TIPOGRAFI, FONT PLUS JAKARTA SANS, BORDER HALUS & CAMPUS BANNER */
    body, button, input, select, textarea,
    .nav-header-label, .cart-btn-header, .badge-role-pill, .btn-header-mahasiswa,
    .user-dropdown-btn, .m-num, .tbl-filter-btn, .form-input, .form-select,
    .form-textarea, .btn-primary, .btn-secondary, .btn-danger,
    .btn-submit-figma-orange, .btn-batal-figma {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .portal-layout { grid-template-columns: 240px 1fr; }
    .sidebar { width: 240px; min-width: 240px; padding: 20px 15px 16px 15px; }
    .nav-header-label { font-size: 10px; padding: 12px 10px 5px 10px; }
    .nav-item { font-size: 13px; padding: 10px 12px; }
    .nav-badge-count { font-size: 10.5px; padding: 2px 7px; }
    .sidebar-footer { font-size: 11px; }

    .workspace { padding: 24px 32px; gap: 18px; }
    .page-title { font-size: 18px; letter-spacing: -0.3px; }
    .page-subtitle { font-size: 12.5px; }
    .cart-btn-header, .btn-header-mahasiswa, .badge-role-pill { font-size: 12.5px; height: 38px; padding: 0 14px; }
    .cart-badge-count { font-size: 11px; }
    .user-dropdown-panel, .user-dropdown-menu { width: 255px; border-color: #E2E8F0; }
    .user-dropdown-name { font-size: 12.5px; }
    .user-dropdown-email, .user-dropdown-meta, .user-dropdown-tag { font-size: 10.5px; }
    .user-dropdown-btn, .user-dropdown-link-btn { font-size: 12.5px; padding: 8.5px 10px; }

    .alert-banner { font-size: 13px; padding: 12px 18px; }

    /* CAMPUS HERO BANNER JTIK FT UNM (MENGGANTIKAN KOTAK PERINGATAN KUNING) */
    .welcome-banner {
      position: relative;
      overflow: hidden;
      background: linear-gradient(115deg, #071E4F 0%, #0B2D73 55%, #123D91 100%);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 12px;
      padding: 22px 26px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      box-shadow: 0 8px 22px -8px rgba(8, 41, 110, 0.28);
      flex-wrap: wrap;
    }
    .welcome-banner-photo {
      position: absolute;
      top: 0;
      right: 0;
      width: 52%;
      height: 100%;
      background-image: url('{{ asset("images/bg-ruang-kelas.png") }}');
      background-size: cover;
      background-position: center;
      opacity: 0.24;
      pointer-events: none;
      -webkit-mask-image: linear-gradient(to left, rgba(0,0,0,1) 20%, rgba(0,0,0,0) 100%);
      mask-image: linear-gradient(to left, rgba(0,0,0,1) 20%, rgba(0,0,0,0) 100%);
    }
    .welcome-content {
      position: relative;
      z-index: 2;
      max-width: 650px;
    }
    .welcome-meta-text {
      font-size: 11.5px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.72);
      margin-bottom: 4px;
      letter-spacing: 0.2px;
    }
    .welcome-text h4 {
      font-size: 18px;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: -0.3px;
    }
    .welcome-text p {
      font-size: 12.5px;
      color: #CBD5E1;
      line-height: 1.55;
      margin-top: 4px;
    }
    .btn-welcome-cta {
      position: relative;
      z-index: 2;
      background: #ED7411;
      color: #FFFFFF;
      text-decoration: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 12.5px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: background 0.15s ease, transform 0.15s ease;
      white-space: nowrap;
      box-shadow: 0 4px 12px rgba(237, 116, 17, 0.28);
    }
    .btn-welcome-cta:hover {
      background: #D96005;
      transform: translateY(-1px);
    }

    /* 4 METRIC CARDS: PUTIH BERSIH DENGAN AKSEN SEMANTIK (TIDAK TUMPUK BLOK BIRU TUA) */
    .metric-card {
      background: #08296E;
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 10px;
      padding: 20px 16px 18px 16px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0;
      box-shadow: 0 4px 8px -2px rgba(8, 41, 110, 0.14);
    }
    .metric-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px -4px rgba(8, 41, 110, 0.24);
      border-color: rgba(255, 255, 255, 0.16);
    }
    .m-title { font-size: 12px; text-transform: none; letter-spacing: 0.2px; font-weight: 600; color: #CBD5E1; margin-bottom: 6px; }
    .m-num { font-size: 36px; color: #FFFFFF; font-weight: 800; line-height: 1.05; letter-spacing: -0.6px; font-family: 'Plus Jakarta Sans', sans-serif; }

    .quick-section-title { font-size: 13.5px; text-transform: none; letter-spacing: -0.1px; }
    .quick-card {
      padding: 16px 18px;
      min-height: 102px;
      border: 1px solid #E5E7EB;
      border-radius: 10px;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }
    .quick-card:hover {
      border-color: #08296E;
      box-shadow: 0 6px 16px -4px rgba(8, 41, 110, 0.12);
    }
    .qc-title { font-size: 13.5px; }
    .qc-desc { font-size: 12px; line-height: 1.48; margin-top: 8px; }
    .btn-arrow-blue {
      width: 28px;
      height: 28px;
      border-radius: 7px;
      background: #08296E;
      color: #FFFFFF;
      border: 1px solid #08296E;
      transition: background 0.15s ease, border-color 0.15s ease;
    }
    .btn-arrow-blue svg { stroke: #FFFFFF; }
    .quick-card:hover .btn-arrow-blue {
      background: #061E52;
      border-color: #061E52;
      color: #FFFFFF;
    }
    .quick-card:hover .btn-arrow-blue svg { stroke: #FFFFFF; }

    .table-section {
      border: 1px solid #E5E7EB;
      border-radius: 10px;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }
    .table-header-bar { padding: 14px 20px; border-bottom: 1px solid #E5E7EB; }
    .th-title { font-size: 14px; text-transform: none; letter-spacing: -0.1px; }
    .tbl-filter-btn { font-size: 11.5px; padding: 5px 11px; border-color: #E2E8F0; border-radius: 6px; }
    .custom-table { font-size: 12.5px; }
    .custom-table th {
      background: #F8FAFC;
      color: #475569;
      font-size: 11.5px;
      font-weight: 700;
      padding: 12px 16px;
      letter-spacing: 0.1px;
      border-bottom: 1.5px solid #E2E8F0;
    }
    .custom-table td { padding: 13px 16px; border-bottom: 1px solid #F1F5F9; }
    .trx-tag { font-size: 12px; }
    .pill-status { font-size: 11px; padding: 4px 10px; border-radius: 5px; font-weight: 600; }
    .btn-detail { font-size: 11.5px; padding: 5px 13px; border-radius: 6px; }

    .modal-title { font-size: 15px; }
    .form-label { font-size: 12px; }
    .form-input, .form-select, .form-textarea { font-size: 12.5px; padding: 9px 12px; border-color: #D8DEE9; }
    .form-hint { font-size: 11px; }
    .btn-primary, .btn-secondary, .btn-danger { font-size: 12.5px; padding: 9px 16px; }
    .detail-card-label { font-size: 10.5px; }
    .detail-card-value { font-size: 12.5px; }

    /* PEMBERSIHAN ALL-CAPS, PENINGKATAN UKURAN TEKS MINI & TOMBOL TABEL TENANG */
    .nav-header-label,
    .page-title,
    .table-header-title,
    .section-title,
    .modal-title,
    .modal-header h2,
    .modal-header h3,
    .form-label,
    .modal-body label,
    .rack-label-tag,
    .condition-badge,
    .status-badge,
    .badge-status,
    .unit-tag,
    .role-badge,
    .kpi-label,
    .stat-label,
    table th {
      text-transform: none !important;
      letter-spacing: -0.1px !important;
    }

    /* Ukuran teks minimum yang nyaman dibaca (tidak ada lagi 7.5px - 10px) */
    .rack-label-tag { font-size: 11px !important; font-weight: 600 !important; color: #64748B !important; }
    .rack-location-title { font-size: 12px !important; font-weight: 600 !important; color: #1E293B !important; }
    .asset-name-title, .student-name, .user-name { font-size: 13px !important; }
    .asset-spec-text, .student-nim, .student-prodi, .trx-date, .trx-time, .sub-meta { font-size: 11.5px !important; }
    .trx-id, .badge-asset-code, .room-code-badge { font-size: 12px !important; }
    .condition-badge, .status-badge, .badge-status, .role-badge {
      font-size: 11.5px !important;
      padding: 4px 10px !important;
      border-radius: 6px !important;
      font-weight: 600 !important;
    }

    /* Tombol Aksi Baris Tabel yang Lebih Tenang (Soft-Tinted / Outline) */
    .btn-verify-action,
    .btn-action-navy,
    .btn-detail-pill {
      background: #F8FAFC !important;
      color: #08296E !important;
      border: 1.2px solid #CBD5E1 !important;
      font-size: 12px !important;
      font-weight: 600 !important;
      padding: 7px 14px !important;
      border-radius: 7px !important;
      box-shadow: none !important;
      text-transform: none !important;
    }
    .btn-verify-action:hover,
    .btn-action-navy:hover,
    .btn-detail-pill:hover {
      background: #08296E !important;
      color: #FFFFFF !important;
      border-color: #08296E !important;
      transform: none !important;
    }
    .btn-action-green {
      background: #F0FDF4 !important;
      color: #15803D !important;
      border: 1.2px solid #86EFAC !important;
      font-size: 12px !important;
      font-weight: 600 !important;
      padding: 7px 14px !important;
      border-radius: 7px !important;
      box-shadow: none !important;
      text-transform: none !important;
    }
    .btn-action-green:hover {
      background: #15803D !important;
      color: #FFFFFF !important;
      border-color: #15803D !important;
      transform: none !important;
    }
    .btn-action-outline {
      font-size: 12px !important;
      font-weight: 600 !important;
      padding: 7px 14px !important;
      border-radius: 7px !important;
      text-transform: none !important;
    }
    .btn-action-dots {
      width: 34px !important;
      height: 34px !important;
      border-radius: 8px !important;
      background: #F8FAFC !important;
      border: 1px solid #E2E8F0 !important;
    }
    .btn-action-dots:hover {
      background: #EFF6FF !important;
      color: #08296E !important;
      border-color: #BFDBFE !important;
      transform: none !important;
    }
    .action-menu-item {
      font-family: 'Plus Jakarta Sans', sans-serif !important;
      font-size: 12.5px !important;
      padding: 8px 12px !important;
      text-transform: none !important;
    }

    /* Penyeragaman Dropdown Profil Header Admin dengan Mahasiswa & Pengelola */
    .btn-header-admin, .badge-admin-role {
      font-family: 'Plus Jakarta Sans', sans-serif !important;
      font-size: 12.5px !important;
      font-weight: 600 !important;
      height: 38px !important;
      padding: 0 14px !important;
      border-radius: 8px !important;
    }
    .user-dropdown-panel, .user-dropdown-menu {
      width: 255px !important;
      border-color: #E2E8F0 !important;
      border-radius: 10px !important;
      padding: 8px !important;
    }
    .user-dropdown-name { font-size: 12.5px !important; }
    .user-dropdown-email, .user-dropdown-tag { font-size: 11px !important; }
    .user-dropdown-btn {
      font-family: 'Plus Jakarta Sans', sans-serif !important;
      font-size: 12.5px !important;
      padding: 8.5px 10px !important;
    }
  </style>
</head>
<body>

  <!-- FULLPAGE PORTAL LAYOUT -->
  <div class="portal-layout">
    
    <!-- SIDEBAR (PERSISTEN & KONSISTEN PERSIS PENGELOLA & ADMIN) -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('images/logo-unm-white.png') }}" alt="UNM SI-SAPRAS JTIK" class="brand-logo-img">
      </div>

      <!-- MENU NAVIGASI MAHASISWA -->
      <nav class="sidebar-nav">
        <!-- 1. Dashboard -->
        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}" title="Dashboard Utama Mahasiswa">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <rect x="3" y="3" width="7" height="7"></rect>
              <rect x="14" y="3" width="7" height="7"></rect>
              <rect x="14" y="14" width="7" height="7"></rect>
              <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            <span>Dashboard</span>
          </div>
        </a>

        <!-- MENU PEMINJAMAN (FIGMA MOCKUP) -->
        <div class="nav-header-label">Menu Peminjaman</div>

        <!-- 2. Peminjaman -->
        <a href="{{ route('mahasiswa.peminjaman.alat') }}" class="nav-item {{ request()->routeIs('mahasiswa.peminjaman*') ? 'active' : '' }}" title="Katalog Alat & Bahan Laboratorium">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
            </svg>
            <span>Peminjaman</span>
          </div>
        </a>

        <!-- LAYANAN MAHASISWA (FIGMA MOCKUP) -->
        <div class="nav-header-label">Layanan Mahasiswa</div>

        <!-- 3. Pengembalian -->
        <a href="{{ route('mahasiswa.pengembalian') }}" class="nav-item {{ request()->routeIs('mahasiswa.pengembalian*') ? 'active' : '' }}" title="Layanan Pengembalian Fisik & Bukti Serah Terima">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <polyline points="9 14 4 9 9 4"></polyline>
              <path d="M20 20v-7a4 4 0 0 0-4-4H4"></path>
            </svg>
            <span>Pengembalian</span>
          </div>
        </a>

        <!-- 4. Status Pinjam -->
        <a href="{{ route('mahasiswa.status-pinjam') }}" class="nav-item {{ request()->routeIs('mahasiswa.status-pinjam*') ? 'active' : '' }}" title="Lihat Status & Riwayat Peminjaman">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
            </svg>
            <span>Status Pinjam</span>
          </div>
        </a>

        <!-- 5. Bebas Sarpras -->
        <a href="{{ route('mahasiswa.bebas-sarpras') }}" class="nav-item {{ request()->routeIs('mahasiswa.bebas-sarpras*') ? 'active' : '' }}" title="Pemeriksaan & Pengajuan Bebas Sarpras">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
            <span>Bebas Sarpras</span>
          </div>
          @if(isset($bebasPinjam) && $bebasPinjam->status_final === 'bebas')
            <span class="nav-badge-count" style="background:#15803D !important; color:#FFFFFF !important;">Bebas</span>
          @endif
        </a>
      </nav>

      <!-- SIDEBAR FOOTER PERSIS PENGELOLA & ADMIN -->
      <div class="sidebar-footer">
        SI-SAPRAS JTIK FT UNM
      </div>
    </aside>

    <!-- MAIN WORKSPACE -->
    <main class="workspace">

      <!-- PAGE HEADER -->
      <div class="page-header-row">
        <div style="display: flex; align-items: baseline; gap: 8px; flex: 1; min-width: 0; flex-wrap: wrap;">
          <h1 class="page-title">Dashboard Mahasiswa</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">Sistem Informasi Sarana Prasarana JTIK FT UNM | <strong>{{ Auth::user()->name ?? 'Mahasiswa' }}</strong> ({{ Auth::user()->nomor_induk ?? '-' }})</span>
        </div>
        <div class="header-actions">
          <!-- Tombol Keranjang Peminjaman -->
          <button class="cart-btn-header" type="button" onclick="openCartModal()" title="Keranjang Peminjaman">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="cart-badge-count" id="cartCountBadge">0</span>
          </button>

          <!-- User Role Pill Badge Mahasiswa -->
          <div style="position: relative;">
            <button type="button" id="userPillBtn" class="btn-header-mahasiswa" onclick="toggleUserDropdown(event)" title="Menu Akun Mahasiswa">
              <span>Mahasiswa</span>
              <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>

            <!-- Dropdown Profil & Menu Fungsional -->
            <div id="userDropdown" class="user-dropdown-panel" style="display: none;">
              <div class="user-dropdown-header-card" onclick="openProfileModal()" title="Klik untuk lihat / ubah Profil">
                <div class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}</div>
                <div style="flex: 1; min-width: 0;">
                  <div class="user-dropdown-name">{{ Auth::user()->name ?? 'Mahasiswa' }}</div>
                  <div class="user-dropdown-email">{{ Auth::user()->email ?? '-' }}</div>
                  <div class="user-dropdown-tag">{{ Auth::user()->nama_kelas }} | {{ Auth::user()->kode_prodi }}</div>
                </div>
              </div>

              <div class="user-dropdown-links">
                <button type="button" class="user-dropdown-btn" onclick="openProfileModal()">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                  <span>Profil Saya</span>
                </button>

                <button type="button" class="user-dropdown-btn" onclick="openChangePasswordModal()">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                  <span>Ganti Kata Sandi</span>
                </button>

                <div class="user-dropdown-sep"></div>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                  @csrf
                  <button type="submit" class="user-dropdown-btn logout">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    <span>Keluar (Logout)</span>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- NOTIFIKASI SUKSES / ERROR -->
      @if(session('success'))
      <div class="alert-banner success">
        <div style="display: flex; align-items: center; gap: 8px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <span>{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="alert-close-btn" style="color:#166534;">×</button>
      </div>
      @endif

      @if(session('error'))
      <div class="alert-banner error">
        <div style="display: flex; align-items: center; gap: 8px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <span>{{ session('error') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="alert-close-btn" style="color:#991B1B;">×</button>
      </div>
      @endif

      <!-- CAMPUS HERO BANNER JTIK FT UNM (VISUAL KAMPUS SELARAS HALAMAN LOGIN) -->
      <div class="welcome-banner">
        <div class="welcome-banner-photo"></div>
        <div class="welcome-content">
          <div class="welcome-text">
            <h4>Selamat datang, {{ Auth::user()->name ?? 'Mahasiswa' }}</h4>
            <p>Portal layanan peminjaman, pengembalian, dan bebas sarpras Jurusan Teknik Informatika dan Komputer FT UNM.</p>
          </div>
        </div>
      </div>

      <!-- 4 METRIC CARDS -->
      <div class="metrics-grid">
        <!-- Card 1: Total Barang -->
        <div class="metric-card" onclick="openModalPinjamAlat()" title="Klik untuk lihat katalog sarpras">
          <span class="m-title">Total Barang</span>
          <span class="m-num">{{ $totalBarang ?? 245 }}</span>
        </div>

        <!-- Card 2: Tersedia -->
        <div class="metric-card" onclick="openModalPinjamAlat()" title="Klik untuk pinjam sarpras tersedia">
          <span class="m-title">Tersedia</span>
          <span class="m-num">{{ $tersedia ?? 180 }}</span>
        </div>

        <!-- Card 3: Dipinjam -->
        <div class="metric-card" onclick="scrollToTabel()" title="Klik untuk lihat daftar barang dipinjam">
          <span class="m-title">Dipinjam</span>
          <span class="m-num">{{ $dipinjam ?? 52 }}</span>
        </div>

        <!-- Card 4: Perbaikan -->
        <div class="metric-card" onclick="scrollToTabel()" title="Total sarpras dalam perbaikan / rusak">
          <span class="m-title">Perbaikan</span>
          <span class="m-num">{{ $rusak ?? 13 }}</span>
        </div>
      </div>

      <!-- 4 MENU AKSES CEPAT LAYANAN -->
      <div class="quick-section-title">
        <span>Akses Cepat Layanan</span>
      </div>
      <div class="quick-grid">
        <!-- Quick Card 1: Pinjam Alat & Bahan -->
        <a href="{{ route('mahasiswa.peminjaman.alat') }}" class="quick-card" style="text-decoration:none;">
          <div class="qc-top">
            <span class="qc-title">1. Pinjam Alat &amp; Bahan</span>
            <div class="btn-arrow-blue" title="Katalog Alat &amp; Bahan">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </div>
          </div>
          <div class="qc-desc">Lihat daftar alat dan bahan yang tersedia di JTIK.</div>
        </a>

        <!-- Quick Card 2: Pengembalian Fisik -->
        <a href="{{ route('mahasiswa.pengembalian') }}" class="quick-card" style="text-decoration:none;">
          <div class="qc-top">
            <span class="qc-title">2. Pengembalian Fisik</span>
            <div class="btn-arrow-blue" title="Buka Layanan Pengembalian Fisik">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </div>
          </div>
          <div class="qc-desc">Kembalikan barang pinjaman dan unggah bukti foto.</div>
        </a>

        <!-- Quick Card 3: Status & Riwayat -->
        <a href="{{ route('mahasiswa.status-pinjam') }}" class="quick-card" style="text-decoration:none;">
          <div class="qc-top">
            <span class="qc-title">3. Status &amp; Riwayat</span>
            <div class="btn-arrow-blue" title="Pantau Status &amp; Tiket Peminjaman">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </div>
          </div>
          <div class="qc-desc">Lihat status pengajuan dan riwayat peminjaman Anda.</div>
        </a>

        <!-- Quick Card 4: Bebas Sarpras -->
        <a href="{{ route('mahasiswa.bebas-sarpras') }}" class="quick-card" style="text-decoration:none;">
          <div class="qc-top">
            <span class="qc-title">4. Bebas Sarpras</span>
            <div class="btn-arrow-blue" title="Pengajuan &amp; Cetak Surat Bebas Sarpras">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </div>
          </div>
          <div class="qc-desc">Khusus mahasiswa yang akan menyelesaikan studi / butuh surat bebas tanggungan.</div>
        </a>
      </div>

      <!-- TABEL AKTIVITAS & TRANSAKSI -->
      <div class="table-section" id="tabelTransaksi">
        <div class="table-header-bar">
          <span class="th-title">Aktivitas &amp; Transaksi Terakhir</span>
          
          <a href="{{ route('mahasiswa.status-pinjam') }}" style="font-size:12px; font-weight:700; color:#08296E; text-decoration:none; margin-left:auto; margin-right:12px;">Lihat Seluruh Riwayat Pinjam →</a>

          <div class="table-filter-group">
            <button type="button" class="tbl-filter-btn active" onclick="filterTable('semua', this)">Semua ({{ $peminjamans->count() }})</button>
            <button type="button" class="tbl-filter-btn" onclick="filterTable('aktif', this)">Berjalan</button>
            <button type="button" class="tbl-filter-btn" onclick="filterTable('menunggu', this)">Menunggu ACC</button>
            <button type="button" class="tbl-filter-btn" onclick="filterTable('selesai', this)">Selesai</button>
          </div>
        </div>

        <div style="overflow-x: auto;">
          <table class="custom-table" id="aktivitasTable">
            <thead>
              <tr>
                <th style="width: 140px;">No. Tiket</th>
                <th>Fasilitas / Barang</th>
                <th>Unit / Lokasi</th>
                <th>Waktu Pinjam</th>
                <th style="text-align:center; width: 210px;">Status</th>
                <th style="text-align:center; width: 95px;">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              @forelse($peminjamans as $item)
                @php
                  $isAktif = in_array($item->status, ['sedang_dipinjam', 'disetujui', 'disetujui_sebagian']);
                  $isMenunggu = in_array($item->status, ['menunggu_verifikasi', 'diproses_sebagian']);
                  $isSelesai = $item->status === 'selesai';
                  $rowFilterCategory = $isAktif ? 'aktif' : ($isMenunggu ? 'menunggu' : ($isSelesai ? 'selesai' : 'lainnya'));
                  $itemCount = $item->total_items_count ?? 1;
                @endphp
                <tr data-category="{{ $rowFilterCategory }}">
                  <td>
                    <span class="trx-tag">{{ $item->kode_peminjaman }}</span>
                  </td>
                  <td>
                    <strong>{{ $item->sarpras->nama_sarpras ?? 'Sarpras Terdaftar' }} ({{ $item->jumlah }} Unit)</strong><br>
                    @if($itemCount > 1)
                      <small style="color:#64748B; font-weight:600;">
                        +{{ $itemCount - 1 }} barang lainnya ({{ $itemCount }} barang)
                      </small>
                    @else
                      <small style="color:#64748B;">
                        {{ $item->sarpras->kode_sarpras ?? 'Inventaris Jurusan' }}
                      </small>
                    @endif
                  </td>
                  <td>
                    {{ $item->rooms_summary ?? ($item->sarpras->ruangan->nama_ruangan ?? 'Laboratorium JTIK') }}
                  </td>
                  <td>
                    {{ $item->jadwal_lengkap }}
                  </td>
                  <td style="text-align:center;">
                    @if($item->status === 'sedang_dipinjam')
                      <span class="pill-status pill-orange">Sedang Dipinjam</span>
                    @elseif($item->status === 'disetujui_sebagian')
                      <span class="pill-status pill-partial">Sebagian Disetujui</span>
                    @elseif($item->status === 'diproses_sebagian')
                      <span class="pill-status pill-indigo">Diproses Sebagian</span>
                    @elseif($item->status === 'menunggu_verifikasi')
                      <span class="pill-status pill-yellow">Menunggu ACC</span>
                    @elseif($item->status === 'disetujui')
                      <span class="pill-status pill-blue">Disetujui</span>
                    @elseif($item->status === 'selesai')
                      <span class="pill-status pill-green">Selesai</span>
                    @elseif($item->status === 'ditolak')
                      <span class="pill-status pill-red">Ditolak</span>
                    @else
                      <span class="pill-status pill-yellow">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                    @endif
                    @if(!empty($item->status_breakdown))
                      <div class="status-breakdown-note">
                        {{ $item->status_breakdown }}
                      </div>
                    @endif
                  </td>
                  <td style="text-align:center;">
                    <button class="btn-detail" type="button" onclick="openDetailModal({{ json_encode($item) }})" title="Lihat rincian lengkap transaksi">
                      <span>Detail</span>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" style="text-align: center; padding: 24px; color: #64748B;">
                    Belum ada riwayat transaksi peminjaman. Silakan gunakan menu <strong>Pinjam Alat &amp; Bahan</strong> di atas.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL 1: FORM PINJAM ALAT & BAHAN                              -->
  <!-- ============================================================== -->
  <div id="modalPinjamAlat" class="modal-overlay">
    <div class="modal-dialog modal-lg">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
          <span class="modal-title">Formulir Permohonan Pinjam Alat &amp; Bahan</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalPinjamAlat')">×</button>
      </div>
      <form action="{{ route('mahasiswa.peminjaman.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label">Pilih Alat / Komponen / Instrumen Lab <span class="req">*</span></label>
            <select name="sarpras_id" id="pinjamSarprasSelect" class="form-select" onchange="updatePinjamInfo()" required>
              <option value="" disabled selected>-- Pilih Sarpras yang Tersedia --</option>
              @foreach($sarprasAlatBahan as $alat)
                <option value="{{ $alat->id }}" 
                        data-tersedia="{{ $alat->jumlah_tersedia }}" 
                        data-maks="{{ $alat->maks_pinjam ?? 2 }}"
                        data-ruangan="{{ $alat->ruangan->nama_ruangan ?? 'Laboratorium' }}"
                        data-nama="{{ $alat->nama_sarpras }}">
                  {{ $alat->nama_sarpras }} (Tersedia: {{ $alat->jumlah_tersedia }} Unit | {{ $alat->ruangan->nama_ruangan ?? 'Lab' }})
                </option>
              @endforeach
            </select>
            <div id="sarprasStockNote" class="form-hint" style="display:none; color: #08296E; font-weight: 600; margin-top: 5px;"></div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Jumlah Unit Pinjam <span class="req">*</span></label>
              <input type="number" name="jumlah" id="pinjamJumlahInput" class="form-input" min="1" max="2" value="1" required>
              <div class="form-hint" id="pinjamMaksHint">Maksimal peminjaman per mahasiswa: 2 Unit.</div>
            </div>
            <div class="form-group">
              <label class="form-label">Waktu Pelaksanaan / Sesi Jam</label>
              <input type="text" name="waktu_keterangan" class="form-input" placeholder="Contoh: 08:00 - 12:00 WITA" value="08:00 - 12:00 WITA">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Tanggal Peminjaman <span class="req">*</span></label>
              <input type="date" id="mhsTglPinjam" name="tgl_pinjam" class="form-input" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" onchange="(function(el){const k=document.getElementById('mhsTglKembali');if(!k||!el.value)return;const d=new Date(el.value+'T00:00:00');const m=new Date(d);m.setDate(m.getDate()+3);const pad=n=>String(n).padStart(2,'0');const maxStr=m.getFullYear()+'-'+pad(m.getMonth()+1)+'-'+pad(m.getDate());k.min=el.value;k.max=maxStr;if(k.value<el.value)k.value=el.value;if(k.value>maxStr){k.value=maxStr;if(window.showSystemToast)showSystemToast('Durasi peminjaman maksimal 3 hari dari tanggal pinjam.','warning');}})(this)" required>
            </div>
            <div class="form-group">
              <label class="form-label">Rencana Tanggal Pengembalian (Maks. 3 Hari) <span class="req">*</span></label>
              <input type="date" id="mhsTglKembali" name="tgl_kembali_rencana" class="form-input" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 days')) }}" onchange="(function(el){if(el.max&&el.value>el.max){el.value=el.max;if(window.showSystemToast)showSystemToast('Durasi peminjaman maksimal 3 hari dari tanggal pinjam.','warning');}})(this)" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Dosen Penanggung Jawab Mata Kuliah / Praktikum <span class="req">*</span></label>
            <input type="text" name="dosen_penanggung_jawab" class="form-input" placeholder="Contoh: Dr. Ir. H. Ramly, M.Pd." required>
          </div>

          <div class="form-group">
            <label class="form-label">Keperluan Praktikum / Kegiatan Riset <span class="req">*</span></label>
            <textarea name="keperluan" class="form-textarea" rows="2" placeholder="Uraikan keperluan peminjaman secara jelas, modul praktikum, atau tugas akhir..." required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="addToCartFromModal()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>Tambah ke Keranjang</span>
          </button>
          <button type="submit" class="btn-primary">
            <span>Ajukan Peminjaman Langsung</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL 3: FORM KONFIRMASI PENGEMBALIAN FISIK                    -->
  <!-- ============================================================== -->
  <div id="modalPengembalian" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.5"><polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/></svg>
          <span class="modal-title">Form Konfirmasi Pengembalian Fisik</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalPengembalian')">×</button>
      </div>
      @if($pinjamanAktif->count() > 0)
        <form action="{{ route('mahasiswa.pengembalian.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label class="form-label">Pilih Tiket Peminjaman yang Sedang Berjalan <span class="req">*</span></label>
              <select name="peminjaman_id" id="pengembalianPeminjamanId" class="form-select" required>
                @foreach($pinjamanAktif as $pa)
                  <option value="{{ $pa->id }}">
                    {{ $pa->kode_peminjaman }} | {{ $pa->sarpras->nama_sarpras ?? 'Sarpras' }} ({{ $pa->jumlah }} Unit)
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Catatan Kondisi Fisik Saat Dikembalikan <span class="req">*</span></label>
              <textarea name="catatan_kondisi_kembali" class="form-textarea" rows="3" placeholder="Contoh: Barang dalam kondisi bersih, berfungsi normal, dan kabel power/konektor lengkap." required>Barang dalam kondisi bersih, berfungsi normal, dan kabel/kelengkapan lengkap.</textarea>
            </div>

            <div class="form-group">
              <label class="form-label">Unggah Foto Bukti Fisik Barang (Opsional)</label>
              <input type="file" name="foto_sesudah" class="form-input" accept="image/*">
              <div class="form-hint">Maksimal 3MB. Format JPG, PNG, atau WEBP.</div>
            </div>

            <div style="background: #F1F5F9; border-radius: 6px; padding: 10px 12px; font-size: 12px; color: #475569; line-height: 1.4;">
              <strong>Instruksi:</strong> Setelah mengirimkan formulir ini, silakan serahkan barang fisik ke Laboran / Pengelola Ruangan di meja verifikasi untuk pemeriksaan akhir.
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal('modalPengembalian')">Tutup</button>
            <button type="submit" class="btn-primary">
              <span>Kirim Konfirmasi Pengembalian</span>
            </button>
          </div>
        </form>
      @else
        <div class="modal-body" style="text-align: center; padding: 30px 20px;">
          <div style="width: 48px; height: 48px; border-radius: 50%; background: #EFF6FF; color: #1D4ED8; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <h4 style="font-size: 13px; font-weight: 800; color: #08296E; margin-bottom: 6px;">Tidak Ada Pinjaman Aktif</h4>
          <p style="font-size: 11px; color: #64748B; margin-bottom: 16px;">Saat ini Anda tidak memiliki barang atau alat praktikum yang sedang dalam status dipinjam.</p>
          <button type="button" class="btn-primary" onclick="closeModal('modalPengembalian'); openModalPinjamAlat();">
            <span>Ajukan Peminjaman Baru</span>
          </button>
        </div>
      @endif
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL 4: BEBAS SARPRAS (3 LABORATORIUM & CETAK SURAT)          -->
  <!-- ============================================================== -->
  <div id="modalBebasPinjam" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <span class="modal-title">Status Bebas Sarana Prasarana JTIK</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalBebasPinjam')">×</button>
      </div>
      <div class="modal-body">
        <div style="margin-bottom: 14px; font-size: 11px; color: #475569;">
          Surat Bebas Sarpras membuktikan mahasiswa tidak memiliki tanggungan peminjaman alat, komponen, maupun kunci laboratorium di lingkungan Jurusan Teknik Informatika dan Komputer FT UNM.
        </div>

        @if($bebasPinjam)
          <!-- Kotak 1: Laboratorium -->
          <div class="lab-check-box">
            <div class="lab-check-info">
              <span class="lab-check-title">1. Laboratorium</span>
              <span class="lab-check-sub">
                @if($bebasPinjam->petugas_lab_komputer)
                  Disahkan oleh: {{ $bebasPinjam->petugas_lab_komputer }}
                @else
                  Menunggu verifikasi laboran
                @endif
              </span>
            </div>
            <div>
              @if($bebasPinjam->status_lab_komputer === 'bebas')
                <span class="pill-status pill-green">Bebas</span>
              @elseif($bebasPinjam->status_lab_komputer === 'tertahan')
                <span class="pill-status pill-red">Tertahan</span>
              @else
                <span class="pill-status pill-yellow">Proses Cek</span>
              @endif
            </div>
          </div>

          <!-- Kotak 2: Administrasi -->
          <div class="lab-check-box">
            <div class="lab-check-info">
              <span class="lab-check-title">2. Administrasi</span>
              <span class="lab-check-sub">
                @if($bebasPinjam->petugas_lab_jaringan)
                  Disahkan oleh: {{ $bebasPinjam->petugas_lab_jaringan }}
                @else
                  Menunggu verifikasi Administrasi
                @endif
              </span>
            </div>
            <div>
              @if($bebasPinjam->status_lab_jaringan === 'bebas')
                <span class="pill-status pill-green">Bebas</span>
              @elseif($bebasPinjam->status_lab_jaringan === 'tertahan')
                <span class="pill-status pill-red">Tertahan</span>
              @else
                <span class="pill-status pill-yellow">Proses Cek</span>
              @endif
            </div>
          </div>

          <!-- Kotak 3: Bengkel IT -->
          <div class="lab-check-box">
            <div class="lab-check-info">
              <span class="lab-check-title">3. Bengkel IT</span>
              <span class="lab-check-sub">
                @if($bebasPinjam->petugas_ruang_inventaris)
                  Disahkan oleh: {{ $bebasPinjam->petugas_ruang_inventaris }}
                @else
                  Menunggu verifikasi pengelola Bengkel IT
                @endif
              </span>
            </div>
            <div>
              @if($bebasPinjam->status_ruang_inventaris === 'bebas')
                <span class="pill-status pill-green">Bebas</span>
              @elseif($bebasPinjam->status_ruang_inventaris === 'tertahan')
                <span class="pill-status pill-red">Tertahan</span>
              @else
                <span class="pill-status pill-yellow">Proses Cek</span>
              @endif
            </div>
          </div>

          <!-- KESIMPULAN STATUS FINAL -->
          <div style="background: #F8FAFC; border: 1.2px solid #CBD5E1; border-radius: 8px; padding: 12px 14px; margin-top: 14px; text-align: center;">
            <div style="font-size: 12px; font-weight: 700; color: #64748B; ">Status Pengesahan Akhir:</div>
            <div style="margin: 6px 0;">
              @if($bebasPinjam->status_final === 'bebas')
                <span class="pill-status pill-green" style="font-size: 11px; padding: 5px 14px;">Terverifikasi Bebas Pinjam Resmi</span>
              @elseif($bebasPinjam->status_final === 'tertahan')
                <span class="pill-status pill-red" style="font-size: 11px; padding: 5px 14px;">Ditahan / Selesaikan Tanggungan</span>
              @else
                <span class="pill-status pill-yellow" style="font-size: 11px; padding: 5px 14px;">Sedang dalam Tahap Verifikasi Pengelola</span>
              @endif
            </div>
            <div style="font-size: 11.5px; color: #64748B;">Kode Pengajuan: <strong>{{ $bebasPinjam->kode_pengajuan }}</strong></div>
            <div style="font-size: 11px; color: #334155; margin-top: 4px;">Keperluan: <strong>{{ $bebasPinjam->keperluan }}</strong></div>
          </div>
        @else
          <!-- FORM PENGAJUAN PERTAMA KALI -->
          <p style="font-size: 11.5px; color: #64748B; margin-bottom: 12px; line-height: 1.45;">
            Layanan ini hanya perlu diajukan apabila Anda memerlukan surat keterangan bebas tanggungan (yudisium, wisuda, ujian akhir, cuti, atau pindah studi).
          </p>
          <form action="{{ route('mahasiswa.bebas-pinjam.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="dashKeperluanInput" class="form-label">Keperluan Surat <span class="req">*</span></label>
              <input type="text" id="dashKeperluanInput" name="keperluan" class="form-input" maxlength="255" value="Pemberkasan Yudisium &amp; Wisuda Sarjana FT UNM" placeholder="Ketik keperluan pengajuan surat..." required>
              <div style="font-size: 10.5px; color: #64748B; margin-top: 6px; display: flex; flex-wrap: wrap; gap: 6px 10px; align-items: center;">
                <span>Isi cepat:</span>
                @foreach(['Yudisium & Wisuda' => 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM', 'Ujian Tutup' => 'Persyaratan Ujian Tutup / Tugas Akhir (Skripsi)', 'Cuti' => 'Pengurusan Cuti Akademik', 'Pindah Prodi' => 'Pindah Program Studi / Perguruan Tinggi'] as $shortLabel => $fullText)
                  <button type="button" onclick="setDashKeperluanText({{ json_encode($fullText) }})" style="background:none; border:none; padding:0; color:#08296E; font-size:10.5px; font-weight:600; cursor:pointer; text-decoration:underline; font-family:inherit;">{{ $shortLabel }}</button>
                @endforeach
              </div>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
              <span>Ajukan Bebas Sarpras</span>
            </button>
          </form>
        @endif
      </div>
      <div class="modal-footer">
        @if(isset($bebasPinjam))
          <a href="{{ route('mahasiswa.bebas-sarpras') }}" class="btn-secondary" style="text-decoration:none; display:inline-flex; align-items:center;">Atur / Kelola Pengajuan</a>
        @endif
        @if(isset($bebasPinjam) && $bebasPinjam->status_final === 'bebas')
          <button type="button" class="btn-primary" onclick="openPrintBebasModal()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            <span>Cetak Surat Bebas Sarpras</span>
          </button>
        @endif
        <button type="button" class="btn-secondary" onclick="closeModal('modalBebasPinjam')">Tutup</button>
      </div>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL: KARTU BEBAS PEMINJAMAN SARPRAS (PREVIEW & CETAK)        -->
  <!-- ============================================================== -->
  <div id="modalCetakBebasPinjam" class="modal-overlay">
    <div class="modal-dialog modal-lg">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <span class="modal-title">Surat Keterangan Bebas Sarana Prasarana</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalCetakBebasPinjam')">×</button>
      </div>
      <div class="modal-body" id="suratPrintArea">
        @php
          $dashStLabKomputer = $bebasPinjam->status_lab_komputer ?? 'belum_cek';
          $dashStLabJaringan = $bebasPinjam->status_lab_jaringan ?? 'belum_cek';
          $dashStRuangInv = $bebasPinjam->status_ruang_inventaris ?? 'belum_cek';
          $dashIsAllBebas = ($dashStLabKomputer === 'bebas' && $dashStLabJaringan === 'bebas' && $dashStRuangInv === 'bebas');
        @endphp
        @include('partials.surat_bebas_sarpras', ['bebasPinjam' => $bebasPinjam ?? null])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary" onclick="closeModal('modalCetakBebasPinjam')">Tutup</button>
        @if($dashIsAllBebas)
          <button type="button" class="btn-primary" onclick="window.print()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            <span>Cetak Dokumen (Print / PDF)</span>
          </button>
        @else
          <button type="button" class="btn-primary" style="background: #94A3B8; cursor: not-allowed;" disabled title="Surat resmi baru dapat dicetak setelah seluruh unit menyatakan BEBAS.">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
            <span>Belum Dapat Dicetak (Menunggu Verifikasi)</span>
          </button>
        @endif
      </div>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL 5: DETAIL TRANSAKSI                                      -->
  <!-- ============================================================== -->
  <div id="modalDetailTransaksi" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
          <span class="modal-title">Rincian Tiket Peminjaman</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalDetailTransaksi')">×</button>
      </div>
      <div class="modal-body">
        <div class="detail-grid">
          <div class="detail-card">
            <div class="detail-card-label">Nomor Tiket</div>
            <div class="detail-card-value" id="dKode">-</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Status Tiket</div>
            <div class="detail-card-value" id="dStatus">-</div>
          </div>
        </div>

        <div class="detail-grid">
          <div class="detail-card" style="grid-column: 1 / -1;">
            <div class="detail-card-label">Rincian Sarpras / Fasilitas</div>
            <div class="detail-card-value" id="dSarpras">-</div>
          </div>
        </div>

        <div class="detail-grid">
          <div class="detail-card">
            <div class="detail-card-label">Jumlah Unit</div>
            <div class="detail-card-value" id="dJumlah">-</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Lokasi / Ruangan</div>
            <div class="detail-card-value" id="dRuangan">-</div>
          </div>
        </div>

        <div class="detail-grid">
          <div class="detail-card">
            <div class="detail-card-label">Waktu Peminjaman</div>
            <div class="detail-card-value" id="dWaktuPinjam">-</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Rencana Pengembalian</div>
            <div class="detail-card-value" id="dWaktuKembali">-</div>
          </div>
        </div>

        <div class="detail-card" style="margin-bottom: 12px;">
          <div class="detail-card-label">Dosen Penanggung Jawab</div>
          <div class="detail-card-value" id="dDosen">-</div>
        </div>

        <div class="detail-card" style="margin-bottom: 12px;">
          <div class="detail-card-label">Keperluan Peminjaman</div>
          <div class="detail-card-value" id="dKeperluan" style="font-weight: 500; font-size: 11px;">-</div>
        </div>

        <div class="detail-card" id="dRejectedWrap" style="display:none; background:#FEF2F2; border-color:#FECACA; margin-bottom: 10px;">
          <div class="detail-card-label" id="dRejectedLabel" style="color:#B91C1C;">Alasan Penolakan Pengelola</div>
          <div class="detail-card-value" id="dRejected" style="font-weight: 500; color:#7F1D1D; font-size: 10.5px; line-height: 1.5;">-</div>
        </div>

        <div class="detail-card" id="dCatatanWrap" style="display:none; background:#FFFBEB; border-color:#FDE68A;">
          <div class="detail-card-label" id="dCatatanLabel" style="color:#B45309;">Informasi Pengambilan &amp; Catatan Pengelola</div>
          <div class="detail-card-value" id="dCatatan" style="font-weight: 500; color:#92400E; font-size: 10.5px; line-height: 1.5;">-</div>
        </div>
      </div>
      <div class="modal-footer" id="dActionFooter">
        <!-- Dynamic Action Buttons will be injected here via JS -->
        <button type="button" class="btn-secondary" onclick="closeModal('modalDetailTransaksi')">Tutup</button>
      </div>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL: FORMULIR PENGAJUAN PINJAM (FIGMA DESIGN BATCH CHECKOUT) -->
  <!-- ============================================================== -->
  <div id="modalKeranjang" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalKeranjang')">
    <div class="modal-dialog modal-figma">
      <div class="modal-header">
        <div style="display: flex; align-items: center; gap: 8px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.5">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
          <h3 style="font-size: 13.5px; font-weight: 800; color: #08296E; margin: 0; letter-spacing: 0.3px;">Formulir Pengajuan Pinjam</h3>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalKeranjang')">×</button>
      </div>

      <form method="POST" action="{{ route('mahasiswa.peminjaman.batch') }}" id="formBatchCheckout" onsubmit="return handleBatchSubmit(event)">
        @csrf
        <input type="hidden" name="cart_items" id="batchCartItems">

        <div class="modal-body" style="padding: 16px 20px; max-height: calc(88vh - 120px); overflow-y: auto;">
          
          <!-- SECTION 1: DATA PENGAJU (MAHASISWA) -->
          <div class="cart-figma-box">
            <div class="cart-figma-box-title">Data Pengaju (Mahasiswa)</div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 10px;">
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Nomor Induk Mahasiswa (NIM) <span style="color: #DC2626;">*</span></label>
                <input type="text" name="nomor_induk" value="{{ Auth::user()->nomor_induk }}" readonly style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #F8FAFC; color: #334155; font-weight: 700;">
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Nama Lengkap Pengaju <span style="color: #DC2626;">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ Auth::user()->name }}" readonly style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #F8FAFC; color: #334155; font-weight: 700;">
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Program Studi / Jurusan <span style="color: #DC2626;">*</span></label>
                <select name="jurusan" class="auto-prodi-input" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #FFFFFF; color: #334155; font-weight: 600; outline: none; font-family: inherit; cursor: pointer;">
                  <option value="Pendidikan Teknik Informatika dan Komputer" {{ Auth::user()->program_studi === 'Pendidikan Teknik Informatika dan Komputer' ? 'selected' : '' }}>Pendidikan Teknik Informatika dan Komputer</option>
                  <option value="Teknik Komputer" {{ Auth::user()->program_studi === 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                </select>
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Kelas (Ketik untuk Mencari) <span style="color: #DC2626;">*</span></label>
                <div class="searchable-combobox" id="cartDashKelasComboboxWrapper" style="position: relative;">
                  <input type="hidden" name="kelas_id" class="auto-kelas-id-input" value="{{ Auth::user()->kelas_id }}">
                  <div style="position: relative; display: flex; align-items: center;">
                    <svg style="position: absolute; left: 10px; width: 13px; height: 13px; color: #94A3B8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" 
                           id="cartDashInputKelas" 
                           name="kelas" 
                           autocomplete="off" 
                           placeholder="Ketik untuk mencari kelas (contoh: PTIK A 24)..." 
                           value="{{ Auth::user()->nama_kelas }}"
                           required
                           style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 28px 7px 28px; font-size: 11px; background: #FFFFFF; color: #334155; font-weight: 600; outline: none; font-family: inherit;">
                    <button type="button" class="combobox-toggle-btn" style="position: absolute; right: 4px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 4px; cursor: pointer; color: #64748B;">
                      <svg class="combobox-chevron" style="width: 13px; height: 13px; transition: transform 0.2s;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </button>
                  </div>
                  <div id="cartDashDropdownListKelas" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; max-height: 180px; overflow-y: auto; background: #FFFFFF; border: 1.5px solid #0091FF; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12); z-index: 99999;"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- SECTION 2: 1. PEMINJAMAN ALAT & BAHAN PRAKTIKUM -->
          <div id="sectionAlatBahanFigma" style="margin-bottom: 14px;">
            <div style="font-size: 11px; font-weight: 800; color: #08296E; margin-bottom: 8px;">1. Peminjaman Alat &amp; Bahan Praktikum</div>
            
            <div id="figmaCartItemsContainer">
              <!-- Rendered via JS -->
            </div>

            <div id="figmaCartMetaFields" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 10px;">
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Jadwal Penggunaan (Maks 3 Hari) <span style="color: #DC2626;">*</span></label>
                <input type="text" name="jadwal_penggunaan" id="batchJadwal" value="{{ date('d/m/Y') }} (08:00 - 15:00 WITA)" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #FFFFFF; color: #334155;">
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Alasan / Keperluan Pinjam <span style="color: #DC2626;">*</span></label>
                <input type="text" name="keperluan" id="batchKeperluan" placeholder="Praktikum persiapan UTS..." oninput="this.style.borderColor='#CBD5E1'; const err=document.getElementById('errorBatchKeperluan'); if(err) err.style.display='none';" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #FFFFFF; color: #334155;">
                <div id="errorBatchKeperluan" style="display:none; color: #DC2626; font-size: 12px; margin-top: 3px; font-weight: 600;">* Alasan / keperluan pinjam wajib diisi</div>
              </div>
            </div>
            <div style="margin-top: 10px;">
              <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Dosen Penanggung Jawab <span style="color: #DC2626;">*</span></label>
              <input type="text" name="dosen_penanggung_jawab" id="batchDosen" required placeholder="Contoh: Dr. Ir. H. Ramly, M.Pd." oninput="this.style.borderColor='#CBD5E1'; const err=document.getElementById('errorBatchDosen'); if(err) err.style.display='none';" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #FFFFFF; color: #334155;">
              <div id="errorBatchDosen" style="display:none; color: #DC2626; font-size: 12px; margin-top: 3px; font-weight: 600;">* Dosen penanggung jawab wajib diisi</div>
            </div>
          </div>

          <div id="errorBatchEmpty" style="display:none; color: #DC2626; font-size: 11px; font-weight: 600; padding: 0 4px 10px 4px; text-align: right;">* Pilih alat atau bahan praktikum terlebih dahulu</div>
        </div>

        <div class="modal-footer" style="padding: 12px 20px; background: #FFFFFF; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" class="btn-batal-figma" onclick="closeModal('modalKeranjang')">Batal</button>
          <button type="submit" class="btn-submit-figma-orange">Kirim Pengajuan Pinjam</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL 7: PROFIL SAYA (PERSIS GAYA ADMIN & PENGELOLA)           -->
  <!-- ============================================================== -->
  <div id="modalProfile" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <span class="modal-title">Profil Saya</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalProfile')">×</button>
      </div>
      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="modal-body">
          <!-- Kartu Identitas Singkat (Persis Pengelola) -->
          <div style="display: flex; align-items: center; gap: 14px; background: #F8FAFC; padding: 12px 14px; border-radius: 8px; border: 1px solid #E2E8F0; margin-bottom: 12px;">
            <div class="user-avatar-initial" style="width: 44px; height: 44px; font-size: 16px; flex-shrink: 0;">
              {{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}
            </div>
            <div>
              <div style="font-size: 13px; font-weight: 700; color: #0F172A;">{{ Auth::user()->name ?? 'Mahasiswa' }}</div>
              <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 6px; margin-top: 4px;">
                <span style="background: #08296E; color: #FFFFFF; font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">{{ Auth::user()->nama_kelas }}</span>
                <span style="background: #DCFCE7; color: #15803D; font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">Akun Mahasiswa</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Nama Lengkap Akun <span class="req">*</span></label>
            <input type="text" name="name" class="form-input" value="{{ Auth::user()->name ?? '' }}" required>
          </div>
          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div class="form-group">
              <label class="form-label">Alamat Email <span class="req">*</span></label>
              <input type="email" name="email" class="form-input" value="{{ Auth::user()->email ?? '' }}" required>
            </div>
            <div class="form-group">
              <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
              <input type="text" name="nomor_induk" class="form-input" value="{{ Auth::user()->nomor_induk ?? '' }}">
            </div>
          </div>
          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Program Studi / Jurusan</label>
              <select name="jurusan" class="form-input auto-prodi-input" style="background: #FFFFFF; color: #334155; font-weight: 600; cursor: pointer;">
                <option value="Pendidikan Teknik Informatika dan Komputer" {{ Auth::user()->program_studi === 'Pendidikan Teknik Informatika dan Komputer' ? 'selected' : '' }}>Pendidikan Teknik Informatika dan Komputer</option>
                <option value="Teknik Komputer" {{ Auth::user()->program_studi === 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Kelas (Ketik untuk Mencari) <span class="req">*</span></label>
              <div class="searchable-combobox" id="profileKelasComboboxWrapper" style="position: relative;">
                <input type="hidden" name="kelas_id" class="auto-kelas-id-input" value="{{ Auth::user()->kelas_id }}">
                <div style="position: relative; display: flex; align-items: center;">
                  <svg style="position: absolute; left: 10px; width: 14px; height: 14px; color: #94A3B8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                  </svg>
                  <input type="text" 
                         id="profileInputKelas" 
                         name="kelas" 
                         autocomplete="off" 
                         class="form-input" 
                         placeholder="Ketik untuk mencari kelas (contoh: PTIK A 24)..." 
                         value="{{ Auth::user()->nama_kelas }}"
                         required
                         style="padding-left: 32px; padding-right: 32px; font-weight: 600;">
                  <button type="button" class="combobox-toggle-btn" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 4px; cursor: pointer; color: #64748B;">
                    <svg class="combobox-chevron" style="width: 14px; height: 14px; transition: transform 0.2s;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                  </button>
                </div>
                <div id="profileDropdownListKelas" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; max-height: 180px; overflow-y: auto; background: #FFFFFF; border: 1.5px solid #0091FF; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12); z-index: 99999;"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('modalProfile')">Batal</button>
          <button type="submit" class="btn-primary">
            <span>Simpan Perubahan</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL 8: GANTI KATA SANDI (PERSIS GAYA ADMIN & PENGELOLA)      -->
  <!-- ============================================================== -->
  <div id="modalChangePassword" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ED7411" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <span class="modal-title" style="color: #ED7411;">Ganti Kata Sandi</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalChangePassword')">×</button>
      </div>
      <form action="{{ route('profile.password') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label">Kata Sandi Saat Ini <span class="req">*</span></label>
            <input type="password" name="current_password" class="form-input" placeholder="Masukkan kata sandi lama Anda" maxlength="32" required>
          </div>
          <div class="form-group">
            <label class="form-label">Kata Sandi Baru <span class="req">*</span></label>
            <input type="password" name="password" class="form-input" placeholder="Minimal 8, maksimal 32 karakter" minlength="8" maxlength="32" required>
          </div>
          <div class="form-group">
            <label class="form-label">Konfirmasi Kata Sandi Baru <span class="req">*</span></label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru (8–32 karakter)" minlength="8" maxlength="32" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('modalChangePassword')">Batal</button>
          <button type="submit" class="btn-primary">
            <span>Perbarui Kata Sandi</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- JAVASCRIPT LOGIC INTERAKTIF LENGKAP                            -->
  <!-- ============================================================== -->
  <script>
    // --- 1. USER DROPDOWN TOGGLE (PERSIS PENGELOLA) ---
    function toggleUserDropdown(event) {
      if (event) event.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) {
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
      }
    }

    function toggleSubmenu(listId, chevronId) {
      const list = document.getElementById(listId);
      const chevron = document.getElementById(chevronId);
      if (list) {
        const isShown = list.classList.toggle('show');
        if (chevron) {
          chevron.style.transform = isShown ? 'rotate(180deg)' : 'rotate(0deg)';
        }
      }
    }

    document.addEventListener('click', function(e) {
      const dropdown = document.getElementById('userDropdown');
      const btn = document.getElementById('userPillBtn');
      if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
        dropdown.classList.remove('active');
      }
    });

    // --- 2. MODAL CONTROLS ---
    function openModal(modalId) {
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) {
        dropdown.style.display = 'none';
        dropdown.classList.remove('active');
      }
      const modal = document.getElementById(modalId);
      if (modal) modal.classList.add('active');
    }

    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) modal.classList.remove('active');
    }

    function openProfileModal() {
      openModal('modalProfile');
    }

    function openChangePasswordModal() {
      openModal('modalChangePassword');
    }

    function openModalPinjamAlat() {
      openModal('modalPinjamAlat');
    }

    function openModalPengembalian() {
      openModal('modalPengembalian');
    }

    function openModalBebasPinjam() {
      openModal('modalBebasPinjam');
    }

    function addToCartFromModal() {
      const select = document.getElementById('pinjamSarprasSelect');
      if (!select) return;
      const selected = select.options[select.selectedIndex];
      if (!selected || !selected.value) {
        showSystemToast('Silakan pilih alat atau sarpras terlebih dahulu.', 'warning');
        return;
      }

      const id = selected.value;
      const nama = selected.getAttribute('data-nama');
      const ruangan = selected.getAttribute('data-ruangan');
      const jumlah = parseInt(document.getElementById('pinjamJumlahInput').value) || 1;

      const cart = getCart();
      const existing = cart.find(item => item.id == id);
      if (existing) {
        existing.jumlah += jumlah;
      } else {
        cart.push({ id, nama, ruangan, jumlah });
      }

      saveCart(cart);
      closeModal('modalPinjamAlat');
      showSystemToast(`${nama} (${jumlah} Unit) berhasil ditambahkan ke Keranjang Peminjaman.`, 'success');
    }

    // Close modals on Escape key or backdrop click
    window.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.active').forEach(function(m) {
          m.classList.remove('active');
        });
        const dropdown = document.getElementById('userDropdown');
        if (dropdown) dropdown.classList.remove('active');
      }
    });

    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
      overlay.addEventListener('click', function(e) {
        if (e.target === this) {
          this.classList.remove('active');
        }
      });
    });

    // --- 3. SCROLL SMOOTH TO TABEL AKTIVITAS ---
    function scrollToTabel() {
      const el = document.getElementById('tabelTransaksi');
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        el.style.transition = 'box-shadow 0.3s ease';
        el.style.boxShadow = '0 0 0 3px rgba(8, 41, 110, 0.2)';
        setTimeout(() => {
          el.style.boxShadow = '0 1px 3px rgba(0,0,0,0.02)';
        }, 1500);
      }
    }

    // --- 4. FILTER TABEL AKTIVITAS ---
    function filterTable(category, btn) {
      document.querySelectorAll('.tbl-filter-btn').forEach(b => b.classList.remove('active'));
      if (btn) btn.classList.add('active');

      const rows = document.querySelectorAll('#aktivitasTable tbody tr');
      rows.forEach(row => {
        const cat = row.getAttribute('data-category');
        if (category === 'semua' || cat === category) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    // --- 5. PINJAM MODAL LIVE STOCK CALCULATION ---
    function updatePinjamInfo() {
      const select = document.getElementById('pinjamSarprasSelect');
      const selected = select.options[select.selectedIndex];
      if (!selected || !selected.value) return;

      const tersedia = parseInt(selected.getAttribute('data-tersedia')) || 0;
      const maks = parseInt(selected.getAttribute('data-maks')) || 2;
      const ruangan = selected.getAttribute('data-ruangan') || 'Lab';

      const inputJumlah = document.getElementById('pinjamJumlahInput');
      const maxAllowed = Math.min(tersedia, maks);
      inputJumlah.max = maxAllowed;
      if (parseInt(inputJumlah.value) > maxAllowed) {
        inputJumlah.value = maxAllowed;
      }

      const note = document.getElementById('sarprasStockNote');
      note.style.display = 'block';
      note.innerHTML = `Stok Tersedia: <strong>${tersedia} Unit</strong> (${ruangan})`;

      const hint = document.getElementById('pinjamMaksHint');
      hint.textContent = `Maksimal peminjaman: ${maxAllowed} Unit per transaksi.`;
    }

    // --- 6. DETAIL MODAL POPULATE ---
    function escapeDetailHtml(str) {
      const div = document.createElement('div');
      div.textContent = str ?? '';
      return div.innerHTML;
    }

    function cleanDetailNote(raw) {
      const text = String(raw || '').trim();
      if (!text) return '';
      if (text.includes('|')) {
        return text.split('|').map(part => {
          const p = part.trim();
          if (!p) return '';
          const idx = p.indexOf(':');
          if (idx > -1) {
            const val = p.slice(idx + 1).trim();
            if (!val.replace(/[\s,.\-]/g, '')) return '';
            return p.slice(0, idx).trim() + ': ' + val;
          }
          return valClean(p);
        }).filter(Boolean).join(' | ');
      }
      if (/^Catatan:/i.test(text)) {
        const val = text.slice(8).trim();
        return val.replace(/[\s,.\-]/g, '') ? 'Catatan: ' + val : '';
      }
      return valClean(text);

      function valClean(s) {
        return String(s || '').replace(/[\s,.\-]/g, '') ? String(s || '').trim() : '';
      }
    }

    function parseStructuredNote(raw) {
      const cleaned = cleanDetailNote(raw);
      const res = { lokasi: '', jaminan: '', catatan: '', extras: [] };
      if (!cleaned) return res;

      const parts = cleaned.includes('|') ? cleaned.split('|') : [cleaned];
      parts.forEach(part => {
        const p = part.trim();
        if (!p) return;
        const m = p.match(/^([^:]+):(.*)$/);
        if (m) {
          const key = m[1].trim().toLowerCase();
          const val = m[2].trim();
          if (!val) return;
          if (key === 'lokasi' || key === 'lokasi pengambilan') {
            res.lokasi = val;
          } else if (key === 'jaminan' || key === 'syarat jaminan') {
            res.jaminan = val;
          } else if (key === 'catatan') {
            res.catatan = val;
          } else {
            res.extras.push(p);
          }
        } else {
          res.extras.push(p);
        }
      });
      return res;
    }

    function renderItemNoteHtml(it, roomNm, parsed) {
      if (it.status === 'ditolak') {
        const reason = cleanDetailNote(it.clean_catatan || it.catatan_pengelola) || 'Permohonan ditolak oleh pengelola ruangan terkait.';
        return `
          <div style="display:flex; flex-wrap:wrap; gap:4px 14px; margin-top:5px; font-size:10px; line-height:1.45;">
            <div><span style="color:#64748B; font-weight:600;">Ruangan:</span> <span style="color:#0F172A; font-weight:600;">${escapeDetailHtml(roomNm)}</span></div>
            <div style="color:#B91C1C; font-weight:600;">Alasan ditolak: ${escapeDetailHtml(reason)}</div>
          </div>
        `;
      }

      const chips = [];
      if (parsed.lokasi && parsed.lokasi.toLowerCase() !== roomNm.toLowerCase()) {
        chips.push(`<div><span style="color:#64748B; font-weight:600;">Ruangan:</span> <span style="color:#0F172A; font-weight:600;">${escapeDetailHtml(roomNm)}</span></div>`);
        chips.push(`<div><span style="color:#64748B; font-weight:600;">Lokasi ambil:</span> <span style="color:#0F172A; font-weight:600;">${escapeDetailHtml(parsed.lokasi)}</span></div>`);
      } else {
        const locLabel = it.status === 'menunggu_verifikasi' ? 'Ruangan:' : 'Lokasi ambil:';
        chips.push(`<div><span style="color:#64748B; font-weight:600;">${locLabel}</span> <span style="color:#0F172A; font-weight:600;">${escapeDetailHtml(parsed.lokasi || roomNm)}</span></div>`);
      }

      if (parsed.jaminan) {
        chips.push(`<div><span style="color:#64748B; font-weight:600;">Jaminan:</span> <span style="color:#0F172A; font-weight:600;">${escapeDetailHtml(parsed.jaminan)}</span></div>`);
      }
      if (parsed.catatan) {
        chips.push(`<div><span style="color:#B45309; font-weight:600;">Catatan:</span> <span style="color:#0F172A; font-weight:600;">${escapeDetailHtml(parsed.catatan)}</span></div>`);
      }
      parsed.extras.forEach(ex => {
        chips.push(`<div><span style="color:#64748B; font-weight:600;">Info:</span> <span style="color:#0F172A; font-weight:600;">${escapeDetailHtml(ex)}</span></div>`);
      });

      if (it.status_pengembalian === 'menunggu_cek_fisik') {
        chips.push(`<div style="color:#B45309; font-weight:600;">Pengembalian fisik sedang menunggu pemeriksaan pengelola.</div>`);
      } else if (it.status === 'menunggu_verifikasi' && !parsed.catatan && !parsed.extras.length) {
        chips.push(`<div style="color:#92400E; font-weight:500;">Menunggu persetujuan pengelola ruangan.</div>`);
      }

      return `<div style="display:flex; flex-wrap:wrap; gap:4px 14px; margin-top:5px; font-size:10px; line-height:1.45;">${chips.join('')}</div>`;
    }

    function getItemBadgeHtml(it) {
      if (it.status_pengembalian === 'menunggu_cek_fisik') {
        return '<span class="pill-status pill-yellow">Menunggu Cek Kembali</span>';
      }
      if (it.status === 'sedang_dipinjam') {
        return '<span class="pill-status pill-orange">Sedang Dipinjam</span>';
      }
      if (it.status === 'disetujui') {
        return '<span class="pill-status pill-blue">Disetujui</span>';
      }
      if (it.status === 'selesai') {
        return '<span class="pill-status pill-green">Selesai</span>';
      }
      if (it.status === 'ditolak') {
        return '<span class="pill-status pill-red">Ditolak</span>';
      }
      return '<span class="pill-status pill-yellow">Menunggu ACC</span>';
    }

    function openDetailModal(item) {
      document.getElementById('dKode').textContent = item.kode_peminjaman || '-';

      const ticketItems = (item.ticket_items && item.ticket_items.length > 0) ? item.ticket_items : [item];
      const totalItems = ticketItems.length;
      const approvedItems = ticketItems.filter(it => ['disetujui', 'sedang_dipinjam', 'selesai'].includes(it.status));
      const activeItems = ticketItems.filter(it => ['disetujui', 'sedang_dipinjam'].includes(it.status));
      const rejectedItems = ticketItems.filter(it => it.status === 'ditolak');
      const pendingItems = ticketItems.filter(it => it.status === 'menunggu_verifikasi');
      const finishedItems = ticketItems.filter(it => it.status === 'selesai');

      const totalUnits = ticketItems.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);
      const approvedUnits = approvedItems.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);
      const rejectedUnits = rejectedItems.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);
      const pendingUnits = pendingItems.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);

      document.getElementById('dSarpras').innerHTML = ticketItems.map(it => {
        const nm = (it.sarpras && it.sarpras.nama_sarpras) ? it.sarpras.nama_sarpras : 'Sarpras Terdaftar';
        const qt = parseInt(it.jumlah, 10) || 1;
        const roomNm = it.room_name || ((it.sarpras && it.sarpras.ruangan) ? it.sarpras.ruangan.nama_ruangan : 'Laboratorium JTIK');
        const parsed = parseStructuredNote(it.clean_catatan || it.catatan_pengelola);
        const isRej = it.status === 'ditolak';
        const cardBg = isRej ? '#FEF2F2' : (it.status === 'menunggu_verifikasi' ? '#FFFBEB' : '#FFFFFF');
        const cardBorder = isRej ? '#FECACA' : (it.status === 'menunggu_verifikasi' ? '#FDE68A' : '#E2E8F0');

        return `
          <div style="background:${cardBg}; border:1px solid ${cardBorder}; border-radius:6px; padding:8px 10px; margin-bottom:6px;">
            <div style="display:flex; justify-content:space-between; align-items:center; gap:8px;">
              <div style="font-size:11px; font-weight:700; color:#0F172A; line-height:1.35;">
                ${escapeDetailHtml(nm)}
                <span style="color:#64748B; font-weight:600;">(${qt} Unit)</span>
              </div>
              <div style="flex-shrink:0;">${getItemBadgeHtml(it)}</div>
            </div>
            ${renderItemNoteHtml(it, roomNm, parsed)}
          </div>
        `;
      }).join('');

      if (totalItems > 1 && (rejectedItems.length > 0 || pendingItems.length > 0)) {
        const subParts = [`Dari total ${totalUnits} unit diminta`];
        if (rejectedUnits > 0) subParts.push(`${rejectedUnits} ditolak`);
        if (pendingUnits > 0) subParts.push(`${pendingUnits} menunggu ACC`);
        document.getElementById('dJumlah').innerHTML = `
          <div>${approvedUnits} Unit Disetujui</div>
          <div style="font-size:9.5px; color:#64748B; font-weight:600; margin-top:2px;">${escapeDetailHtml(subParts.join(', '))}</div>
        `;
      } else if (totalItems > 1) {
        document.getElementById('dJumlah').textContent = `${totalUnits} Unit (${totalItems} Barang)`;
      } else {
        document.getElementById('dJumlah').textContent = (item.jumlah || 1) + ' Unit';
      }

      const approvedRooms = [...new Set(approvedItems.map(it => it.room_name || ((it.sarpras && it.sarpras.ruangan) ? it.sarpras.ruangan.nama_ruangan : 'Laboratorium JTIK')))];
      const rejectedRooms = [...new Set(rejectedItems.map(it => it.room_name || ((it.sarpras && it.sarpras.ruangan) ? it.sarpras.ruangan.nama_ruangan : 'Laboratorium JTIK')))];
      const ruanganName = item.rooms_summary || ((item.sarpras && item.sarpras.ruangan) ? item.sarpras.ruangan.nama_ruangan : 'Laboratorium JTIK');

      if (approvedRooms.length > 0 && rejectedRooms.length > 0) {
        document.getElementById('dRuangan').innerHTML = `
          <div>Disetujui: ${escapeDetailHtml(approvedRooms.join(', '))}</div>
          <div style="font-size:9.5px; color:#B91C1C; font-weight:600; margin-top:2px;">Ditolak: ${escapeDetailHtml(rejectedRooms.join(', '))}</div>
        `;
      } else {
        document.getElementById('dRuangan').textContent = ruanganName;
      }

      document.getElementById('dWaktuPinjam').textContent = item.jadwal_lengkap || ((item.tgl_pinjam ? item.tgl_pinjam.substring(0, 10) : '-') + ', ' + (item.waktu_formatted || item.waktu_keterangan || ''));
      document.getElementById('dWaktuKembali').textContent = item.tgl_kembali_rencana ? item.tgl_kembali_rencana.substring(0, 10) : '-';
      document.getElementById('dDosen').textContent = item.dosen_penanggung_jawab || 'Dosen Pengampu / Laboran';
      document.getElementById('dKeperluan').textContent = item.keperluan || '-';

      let statusHtml = '';
      let statusDesc = '';
      if (item.status === 'sedang_dipinjam') {
        statusHtml = '<span class="pill-status pill-orange">Sedang Dipinjam</span>';
        statusDesc = totalItems > 1
          ? `${activeItems.length} barang sedang berjalan${finishedItems.length > 0 ? ', ' + finishedItems.length + ' sudah dikembalikan' : ''}.`
          : 'Barang sedang dalam masa peminjaman aktif.';
      } else if (item.status === 'disetujui_sebagian') {
        statusHtml = '<span class="pill-status pill-partial">Sebagian Disetujui</span>';
        statusDesc = `${approvedItems.length} dari ${totalItems} barang disetujui (${approvedUnits} unit), ${rejectedItems.length} barang ditolak.`;
      } else if (item.status === 'diproses_sebagian') {
        statusHtml = '<span class="pill-status pill-indigo">Diproses Sebagian</span>';
        const decidedParts = [];
        if (approvedItems.length > 0) decidedParts.push(`${approvedItems.length} disetujui`);
        if (rejectedItems.length > 0) decidedParts.push(`${rejectedItems.length} ditolak`);
        statusDesc = `${decidedParts.join(', ')}${decidedParts.length > 0 ? ', ' : ''}${pendingItems.length} menunggu ACC ruangan.`;
      } else if (item.status === 'menunggu_verifikasi') {
        statusHtml = '<span class="pill-status pill-yellow">Menunggu ACC</span>';
        statusDesc = 'Menunggu persetujuan pengelola ruangan terkait.';
      } else if (item.status === 'disetujui') {
        statusHtml = '<span class="pill-status pill-blue">Disetujui</span>';
        statusDesc = totalItems > 1
          ? `Semua ${totalItems} barang disetujui (${approvedUnits} unit). Silakan ambil di ruangan masing-masing.`
          : 'Permohonan disetujui. Silakan ambil barang sesuai informasi di bawah.';
      } else if (item.status === 'selesai') {
        statusHtml = '<span class="pill-status pill-green">Selesai</span>';
        statusDesc = rejectedItems.length > 0
          ? `${finishedItems.length} barang selesai dikembalikan, ${rejectedItems.length} barang ditolak saat pengajuan.`
          : 'Seluruh barang pada tiket ini telah selesai dikembalikan.';
      } else if (item.status === 'ditolak') {
        statusHtml = '<span class="pill-status pill-red">Ditolak</span>';
        statusDesc = totalItems > 1
          ? 'Seluruh barang pada tiket ini ditolak oleh pengelola.'
          : 'Permohonan ditolak oleh pengelola ruangan.';
      } else {
        statusHtml = `<span class="pill-status pill-yellow">${escapeDetailHtml(item.status)}</span>`;
      }

      document.getElementById('dStatus').innerHTML = statusHtml + (statusDesc
        ? `<div style="font-size:9.5px; color:#475569; font-weight:600; margin-top:4px; line-height:1.35;">${escapeDetailHtml(statusDesc)}</div>`
        : '');

      // Detail penolakan & info pengambilan sudah ditampilkan terstruktur di setiap kartu barang di atas
      const rejWrap = document.getElementById('dRejectedWrap');
      if (rejWrap) rejWrap.style.display = 'none';
      const cWrap = document.getElementById('dCatatanWrap');
      if (cWrap) cWrap.style.display = 'none';

      // Dynamic Action Footer Buttons (target HANYA item yang disetujui / aktif, bukan yang ditolak)
      const footer = document.getElementById('dActionFooter');
      let buttonsHtml = '<button type="button" class="btn-secondary" onclick="closeModal(\'modalDetailTransaksi\')">Tutup</button>';

      const returnableItem = ticketItems.find(it =>
        ['disetujui', 'sedang_dipinjam'].includes(it.status) &&
        !['menunggu_cek_fisik', 'selesai_diterima'].includes(it.status_pengembalian)
      );
      const returnableId = item.returnable_peminjaman_id || (returnableItem ? returnableItem.id : null);
      const cancelableItem = ticketItems.find(it => it.status === 'menunggu_verifikasi');
      const cancelableId = item.cancelable_peminjaman_id || (cancelableItem ? cancelableItem.id : null);

      if (returnableId) {
        buttonsHtml = `
          <button type="button" class="btn-primary" onclick="proceedReturnFromDetail(${returnableId})">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/></svg>
            <span>Ajukan Pengembalian Fisik</span>
          </button>
        ` + buttonsHtml;
      }

      if (cancelableId) {
        const cancelLabel = item.status === 'diproses_sebagian' ? 'Batalkan Item Menunggu ACC' : 'Batalkan Permohonan';
        buttonsHtml = `
          <form action="/mahasiswa/peminjaman/${cancelableId}/batal" method="POST" onsubmit="return confirmFormSubmit(event, this, 'Batalkan Permohonan', 'Apakah Anda yakin ingin membatalkan item permohonan yang masih menunggu verifikasi ini?', 'Ya, Batalkan', true)" style="margin:0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              <span>${cancelLabel}</span>
            </button>
          </form>
        ` + buttonsHtml;
      }

      footer.innerHTML = buttonsHtml;
      openModal('modalDetailTransaksi');
    }

    function proceedReturnFromDetail(id) {
      closeModal('modalDetailTransaksi');
      const select = document.getElementById('pengembalianPeminjamanId');
      if (select) {
        select.value = id;
      }
      openModalPengembalian();
    }

    // --- 7. CART (LOCALSTORAGE QUICK LOAN SYSTEM) ---
    function getCart() {
      try {
        return JSON.parse(localStorage.getItem('sisapras_cart') || '[]');
      } catch(e) {
        return [];
      }
    }

    function saveCart(cart) {
      localStorage.setItem('sisapras_cart', JSON.stringify(cart));
      updateCartBadge();
    }

    function updateCartBadge() {
      const cart = getCart();
      const count = cart.length;
      const badge = document.getElementById('cartCountBadge');
      if (badge) {
        badge.textContent = count;
      }
    }

    function openCartModal() {
      renderCartUI();
      openModal('modalKeranjang');
    }

    function renderCartUI() {
      const cart = getCart();
      const container = document.getElementById('figmaCartItemsContainer');
      const metaFields = document.getElementById('figmaCartMetaFields');

      // Render Alat & Bahan Praktikum
      if (cart.length === 0) {
        if (container) {
          container.innerHTML = `
            <div style="background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 6px; padding: 14px; text-align: center; color: #64748B; font-size: 11px;">
              Belum ada alat/bahan praktikum yang dimasukkan ke keranjang.
            </div>
          `;
        }
        if (metaFields) metaFields.style.display = 'none';
      } else {
        if (metaFields) metaFields.style.display = 'grid';
        let html = '';
        cart.forEach((item, index) => {
          html += `
            <div class="cart-figma-item">
              <div>
                <div class="cart-figma-item-name">${item.nama}</div>
                <div class="cart-figma-item-room">${item.ruangan || 'Laboratorium'}</div>
              </div>
              <div style="display: flex; align-items: center;">
                <div class="cart-figma-stepper">
                  <button type="button" class="btn-stepper" onclick="updateCartItemQty(${index}, -1)">-</button>
                  <span class="stepper-val">${item.jumlah}</span>
                  <button type="button" class="btn-stepper" onclick="updateCartItemQty(${index}, 1)">+</button>
                </div>
                <button type="button" class="btn-del-item" onclick="removeFromCart(${index})" title="Hapus dari keranjang">×</button>
              </div>
            </div>
          `;
        });
        if (container) container.innerHTML = html;
      }
    }

    function updateCartItemQty(index, delta) {
      const cart = getCart();
      if (!cart[index]) return;
      const nextVal = (parseInt(cart[index].jumlah) || 1) + delta;
      if (nextVal < 1) {
        cart.splice(index, 1);
      } else {
        cart[index].jumlah = nextVal;
      }
      saveCart(cart);
      renderCartUI();
    }

    function removeFromCart(index) {
      const cart = getCart();
      if (!cart[index]) return;
      cart.splice(index, 1);
      saveCart(cart);
      renderCartUI();
    }

    function handleBatchSubmit(event) {
      const cart = getCart();
      const errEmpty = document.getElementById('errorBatchEmpty');
      const errKep = document.getElementById('errorBatchKeperluan');
      const errDosen = document.getElementById('errorBatchDosen');

      if (errEmpty) errEmpty.style.display = 'none';
      if (errKep) errKep.style.display = 'none';
      if (errDosen) errDosen.style.display = 'none';

      if (cart.length === 0) {
        if (errEmpty) errEmpty.style.display = 'block';
        event.preventDefault();
        return false;
      }

      document.getElementById('batchCartItems').value = JSON.stringify(cart);

      const inpKep = document.getElementById('batchKeperluan');
      if (!inpKep.value.trim()) {
        inpKep.style.borderColor = '#DC2626';
        if (errKep) errKep.style.display = 'block';
        inpKep.focus();
        event.preventDefault();
        return false;
      }

      const inpDosen = document.getElementById('batchDosen');
      if (inpDosen && !inpDosen.value.trim()) {
        inpDosen.style.borderColor = '#DC2626';
        if (errDosen) errDosen.style.display = 'block';
        inpDosen.focus();
        event.preventDefault();
        return false;
      }

      // Hapus data keranjang seketika agar saat redirect keranjang sudah kosong
      localStorage.removeItem('sisapras_cart');
      updateCartBadge();

      return true;
    }

    // --- 8. CETAK BUKTI BEBAS PINJAM ---
    function openPrintBebasModal() {
      closeModal('modalBebasPinjam');
      openModal('modalCetakBebasPinjam');
    }

    // SEARCHABLE COMBOBOX UNTUK KELAS BIODATA MAHASISWA (TERHUBUNG TABEL KELAS & PROGRAM STUDI)
    const MASTER_KELAS_DB = @json(\App\Models\Kelas::getForDropdownJs());

    function initSearchableClassDropdown(inputId, listId, wrapperId) {
      const input = document.getElementById(inputId);
      const list = document.getElementById(listId);
      const wrapper = document.getElementById(wrapperId);
      if (!input || !list || !wrapper) return;

      const DAFTAR_KELAS = Array.isArray(MASTER_KELAS_DB) && MASTER_KELAS_DB.length > 0
        ? MASTER_KELAS_DB
        : [];

      const formEl = wrapper.closest('form') || wrapper.closest('.modal-dialog') || document;
      const prodiInputs = formEl.querySelectorAll('select[name="jurusan"], input[name="jurusan"], .auto-prodi-input');
      const kelasIdInputs = formEl.querySelectorAll('input[name="kelas_id"], .auto-kelas-id-input');

      let lastValidItem = DAFTAR_KELAS.find(k => k.nama_kelas.toLowerCase() === (input.value || '').trim().toLowerCase())
        || DAFTAR_KELAS.find(k => k.nama_kelas === 'PTIK A 24')
        || DAFTAR_KELAS[0]
        || { id: '', nama_kelas: 'PTIK A 24', angkatan: 2024, kode_prodi: 'PTIK', program_studi: 'Pendidikan Teknik Informatika dan Komputer' };

      function getSelectedProdi() {
        if (prodiInputs.length > 0 && prodiInputs[0].value) {
          return prodiInputs[0].value;
        }
        return lastValidItem ? lastValidItem.program_studi : 'Pendidikan Teknik Informatika dan Komputer';
      }

      function getClassesByProdi(prodiName) {
        const isTekom = (prodiName || '').toLowerCase().includes('teknik komputer') && !(prodiName || '').toLowerCase().includes('pendidikan');
        return DAFTAR_KELAS.filter(item =>
          isTekom ? item.kode_prodi === 'TEKOM' : item.kode_prodi === 'PTIK'
        );
      }

      function syncProdiField(itemObj) {
        if (!itemObj) return;
        prodiInputs.forEach(pInput => {
          pInput.value = itemObj.program_studi;
        });
        kelasIdInputs.forEach(kInput => {
          kInput.value = itemObj.id;
        });
        input.placeholder = itemObj.kode_prodi === 'TEKOM'
          ? 'Ketik untuk mencari kelas (contoh: TEKOM A 25)...'
          : 'Ketik untuk mencari kelas (contoh: PTIK A 24)...';
      }

      input.value = lastValidItem.nama_kelas;
      input.dataset.selected = lastValidItem.nama_kelas;
      syncProdiField(lastValidItem);

      prodiInputs.forEach(pInput => {
        pInput.addEventListener('change', (e) => {
          const selectedProdi = e.target.value;
          const allowedClasses = getClassesByProdi(selectedProdi);
          if (allowedClasses.length > 0) {
            const currentMatchesProdi = allowedClasses.some(k => k.nama_kelas.toLowerCase() === input.value.trim().toLowerCase());
            if (!currentMatchesProdi) {
              const defaultClass = allowedClasses.find(k => k.nama_kelas === (selectedProdi === 'Teknik Komputer' ? 'TEKOM A 25' : 'PTIK A 24')) || allowedClasses[0];
              lastValidItem = defaultClass;
              input.value = defaultClass.nama_kelas;
              input.dataset.selected = defaultClass.nama_kelas;
              syncProdiField(defaultClass);
            }
          }
          if (list.style.display === 'block') {
            renderList('');
            updateDropdownPosition();
          }
        });
      });

      function renderList(query = '') {
        const q = query.toLowerCase().trim();
        const allowedClasses = getClassesByProdi(getSelectedProdi());
        const filtered = allowedClasses.filter(item =>
          item.nama_kelas.toLowerCase().includes(q) ||
          String(item.angkatan).includes(q)
        );

        list.innerHTML = '';
        if (filtered.length === 0) {
          const emptyDiv = document.createElement('div');
          emptyDiv.style.padding = '10px 12px';
          emptyDiv.style.fontSize = '10.5px';
          emptyDiv.style.color = '#94A3B8';
          emptyDiv.style.textAlign = 'center';
          emptyDiv.style.fontStyle = 'italic';
          emptyDiv.textContent = 'Kelas tidak ditemukan pada program studi ini.';
          list.appendChild(emptyDiv);
        } else {
          filtered.forEach(item => {
            const option = document.createElement('div');
            option.style.padding = '8px 12px';
            option.style.fontSize = '11px';
            option.style.fontWeight = '600';
            option.style.color = '#1E293B';
            option.style.cursor = 'pointer';
            option.style.borderBottom = '1px solid #F1F5F9';
            option.style.display = 'flex';
            option.style.alignItems = 'center';
            option.style.justifyContent = 'space-between';
            option.style.transition = 'background 0.1s';

            const isCurrent = (item.nama_kelas.toLowerCase() === input.value.toLowerCase().trim());
            if (isCurrent) {
              option.style.background = '#EFF6FF';
              option.style.color = '#0091FF';
            }

            option.innerHTML = `
              <span>${item.nama_kelas}</span>
              <span style="font-size: 11.5px; color: ${isCurrent ? '#0091FF' : '#64748B'}; font-weight: 700; background: ${isCurrent ? '#DBEAFE' : '#F1F5F9'}; padding: 2px 6px; border-radius: 4px;">PILIH</span>
            `;

            option.addEventListener('mouseenter', () => {
              option.style.background = '#F1F5F9';
            });
            option.addEventListener('mouseleave', () => {
              option.style.background = (item.nama_kelas.toLowerCase() === input.value.toLowerCase().trim()) ? '#EFF6FF' : '#FFFFFF';
            });

            option.addEventListener('mousedown', (e) => {
              e.preventDefault();
              selectOption(item);
            });

            list.appendChild(option);
          });
        }
      }

      function selectOption(itemObj) {
        input.value = itemObj.nama_kelas;
        input.dataset.selected = itemObj.nama_kelas;
        lastValidItem = itemObj;
        syncProdiField(itemObj);
        closeDropdown();
      }

      // Pindahkan elemen dropdown ke document.body agar berada di luar card/modal dan tidak terhalang overflow card
      if (list.parentElement !== document.body) {
        document.body.appendChild(list);
      }

      function updateDropdownPosition() {
        if (list.style.display !== 'block') return;
        const rect = input.getBoundingClientRect();
        if (rect.width === 0 && rect.height === 0) {
          closeDropdown();
          return;
        }
        list.style.position = 'fixed';
        list.style.top = (rect.bottom + 4) + 'px';
        list.style.left = rect.left + 'px';
        list.style.width = rect.width + 'px';
        list.style.right = 'auto';
        list.style.zIndex = '999999';
      }

      function openDropdown(filterByInput = false) {
        renderList(filterByInput ? input.value : '');
        list.style.display = 'block';
        updateDropdownPosition();
        const chevron = wrapper.querySelector('.combobox-chevron');
        if (chevron) chevron.style.transform = 'rotate(180deg)';
      }

      function closeDropdown() {
        if (list.style.display === 'none') return;
        list.style.display = 'none';
        const chevron = wrapper.querySelector('.combobox-chevron');
        if (chevron) chevron.style.transform = 'rotate(0deg)';

        const currentVal = input.value.trim();
        const allowedClasses = getClassesByProdi(getSelectedProdi());
        const exactMatch = allowedClasses.find(k => k.nama_kelas.toLowerCase() === currentVal.toLowerCase());
        if (exactMatch) {
          input.value = exactMatch.nama_kelas;
          input.dataset.selected = exactMatch.nama_kelas;
          lastValidItem = exactMatch;
          syncProdiField(exactMatch);
        } else {
          input.value = lastValidItem.nama_kelas;
          syncProdiField(lastValidItem);
        }
      }

      input.addEventListener('focus', () => openDropdown(false));
      input.addEventListener('click', () => openDropdown(false));
      input.addEventListener('input', () => {
        openDropdown(true);
      });

      const toggleBtn = wrapper.querySelector('.combobox-toggle-btn');
      if (toggleBtn) {
        toggleBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          if (list.style.display === 'block') {
            closeDropdown();
          } else {
            input.focus();
            openDropdown(false);
          }
        });
      }

      window.addEventListener('scroll', (e) => {
        if (e.target === list) return;
        updateDropdownPosition();
      }, true);
      window.addEventListener('resize', updateDropdownPosition);

      document.addEventListener('click', (e) => {
        if (!wrapper.contains(e.target) && !list.contains(e.target)) {
          closeDropdown();
        }
      });
    }

    function setDashKeperluanText(text) {
      const inp = document.getElementById('dashKeperluanInput');
      if (!inp) return;
      inp.value = text;
      inp.focus();
    }

    // Initialize cart badge on page load
    document.addEventListener('DOMContentLoaded', function() {
      @if(session('clear_cart'))
        localStorage.removeItem('sisapras_cart');
        localStorage.removeItem('sisapras_relokasi');
      @endif
      updateCartBadge();
      initSearchableClassDropdown('cartDashInputKelas', 'cartDashDropdownListKelas', 'cartDashKelasComboboxWrapper');
      initSearchableClassDropdown('profileInputKelas', 'profileDropdownListKelas', 'profileKelasComboboxWrapper');
    });
  </script>


  @include('partials.ui_feedback')
</body>
</html>
