<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sarana Ruangan - SI-SAPRAS JTIK FT UNM</title>
  <!-- Google Fonts: Poppins & JetBrains Mono (Standar UI SI-SAPRAS UNM) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-navy: #08296E;
      --sidebar-dark: #16192E;
      --sidebar-card: #1E223D;
      --unm-yellow: #FBBF24;
      --bg-canvas: #0F172A;
      --bg-app: #F8FAFC;
      --border-color: #CBD5E1;
      --border-subtle: #E2E8F0;
      --text-dark: #0F172A;
      --text-muted: #64748B;
      --success-green: #15803D;
      --danger-red: #DC2626;
      --warning-amber: #B45309;
      --accent-blue: #0091FF;
      --accent-orange: #ED7411;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg-app);
      min-height: 100vh;
      width: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      color: var(--text-dark);
    }

    /* FULLSCREEN APP LAYOUT TANPA BINGKAI */
    .app-body {
      display: grid;
      grid-template-columns: 220px minmax(0, 1fr);
      width: 100%;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* SIDEBAR (KONSISTEN 220PX) */
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
      display: flex;
      align-items: center;
      gap: 10px;
      padding-bottom: 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 18px;
    }

    .brand-logo-img {
      height: 34px;
      width: auto;
      object-fit: contain;
    }

    .sidebar-nav {
      display: flex;
      flex-direction: column;
      gap: 4px;
      flex: 1;
    }

    .nav-header-label {
      font-size: 9px;
      font-weight: 700;
      color: #64748B;
      letter-spacing: 0.8px;
      padding: 6px 10px;
      text-transform: uppercase;
      margin-top: 4px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 9px 12px;
      color: #94A3B8;
      text-decoration: none;
      font-size: 11.5px;
      font-weight: 500;
      border-radius: 6px;
      transition: all 0.15s ease;
    }

    .nav-item:hover {
      background-color: rgba(255, 255, 255, 0.06);
      color: #FFFFFF;
    }

    .nav-item.active {
      background-color: var(--accent-orange);
      color: #FFFFFF;
      font-weight: 600;
    }

    .nav-left-part {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sidebar-footer {
      font-size: 10px;
      color: #475569;
      text-align: center;
      padding-top: 14px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    /* MAIN WORKSPACE */
    .main-workspace {
      flex: 1;
      padding: 18px 24px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    /* PAGE HEADER */
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--border-subtle);
      gap: 16px;
    }

    .header-left {
      display: flex;
      align-items: baseline;
      gap: 8px;
      flex: 1;
      min-width: 0;
      flex-wrap: wrap;
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

    .page-subtitle {
      font-size: 11px;
      color: var(--text-muted);
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }

    /* Admin Role Pill */
    .badge-admin-role {
      background: #EFF6FF;
      color: #1D4ED8;
      font-family: 'Poppins', sans-serif;
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
      white-space: nowrap;
    }

    .badge-admin-role:hover {
      background: #DBEAFE;
      border-color: #93C5FD;
    }

    /* Dropdown Profile Menu (Selaras Pengelola) */
    .btn-header-admin, .badge-admin-role {
      background: #EFF6FF;
      color: #1D4ED8;
      font-family: 'Poppins', sans-serif;
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
    .btn-header-admin:hover, .badge-admin-role:hover {
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
    .user-dropdown-email {
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
      font-family: 'Poppins', sans-serif;
      font-size: 10.5px;
      font-weight: 500;
      color: #334155;
      cursor: pointer;
      transition: all 0.15s ease;
      text-align: left;
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

    .user-dropdown-sep {
      height: 1px;
      background: #E2E8F0;
      margin: 4px 0;
    }

    .user-dropdown-btn.logout, .user-dropdown-logout-btn {
      color: var(--danger-red, #DC2626);
      font-weight: 600;
    }
    .user-dropdown-btn.logout:hover, .user-dropdown-logout-btn:hover {
      background: #FEF2F2;
      color: #B91C1C;
    }
    .user-dropdown-btn.logout svg, .user-dropdown-logout-btn svg {
      stroke: var(--danger-red, #DC2626);
    }
    .user-dropdown-btn.logout:hover svg, .user-dropdown-logout-btn:hover svg {
      stroke: #B91C1C;
    }

    /* Flash Message Banner */
    .alert-success-banner {
      background: #DCFCE7;
      border: 1px solid #86EFAC;
      color: var(--success-green);
      padding: 9px 14px;
      border-radius: 6px;
      font-size: 11.5px;
      font-weight: 600;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .alert-danger-banner {
      background: #FEE2E2;
      border: 1px solid #FCA5A5;
      color: #991B1B;
      padding: 10px 14px;
      border-radius: 6px;
      font-size: 11px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    /* Unified Toolbar (Filters, Search in 1 Clean Row) */
    .toolbar-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
    }

    .toolbar-left {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
      min-width: 0;
      flex-wrap: wrap;
    }

    .pill-select-wrap {
      position: relative;
      flex-shrink: 0;
    }

    .pill-filter-select {
      background: var(--sidebar-dark);
      color: #FFFFFF;
      font-family: 'Poppins', sans-serif;
      font-size: 10.5px;
      font-weight: 600;
      height: 34px;
      padding: 0 28px 0 14px;
      border-radius: 6px;
      border: 1px solid #232742;
      cursor: pointer;
      outline: none;
      transition: all 0.15s ease;
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 10px center;
      display: inline-flex;
      align-items: center;
    }

    .pill-filter-select:hover {
      background-color: #1E2342;
    }

    .toolbar-search-form {
      display: flex;
      flex: 1;
      margin: 0;
      min-width: 220px;
    }

    .search-input-box {
      flex: 1;
      position: relative;
      display: flex;
      align-items: center;
    }

    .search-input-box svg {
      position: absolute;
      left: 11px;
      pointer-events: none;
    }

    .search-input-box input {
      width: 100%;
      height: 34px;
      background: #FFFFFF;
      border: 1.2px solid var(--border-color);
      border-radius: 6px;
      padding: 0 12px 0 34px;
      font-family: 'Poppins', sans-serif;
      font-size: 10.5px;
      color: var(--text-dark);
      outline: none;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .search-input-box input:focus {
      border-color: var(--accent-orange);
      box-shadow: 0 0 0 2px rgba(237, 116, 17, 0.15);
    }

    /* Master Data Table Container Card */
    .table-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 11.5px;
    }

    .data-table th {
      background: #F1F5F9;
      color: #334155;
      font-weight: 700;
      font-size: 9.5px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 10px 12px;
      border-bottom: 1px solid var(--border-color);
      white-space: nowrap;
    }

    .data-table td {
      padding: 11px 12px;
      border-bottom: 1px solid var(--border-subtle);
      vertical-align: middle;
    }

    .data-table tbody tr:hover {
      background-color: #F8FAFC;
    }

    /* Room Code */
    .badge-asset-code {
      display: inline-block;
      font-family: 'Poppins', sans-serif;
      font-size: 12px;
      font-weight: 800;
      color: #08296E;
      letter-spacing: -0.2px;
      text-align: center;
    }

    .asset-name-title {
      font-size: 12px;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 2px;
    }

    .rack-label-tag {
      font-size: 7.5px;
      font-weight: 800;
      color: #64748B;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 1px;
    }

    .rack-location-title {
      font-size: 9.5px;
      font-weight: 600;
      color: #1E293B;
    }

    /* Stacked Stock Boxes */
    .stock-stack {
      display: flex;
      flex-direction: column;
      gap: 3px;
      width: 90px;
      margin: 0 auto;
    }

    .stock-box-total {
      background: #F1F5F9;
      border: 1px solid #CBD5E1;
      color: #334155;
      font-family: 'Poppins', sans-serif;
      font-size: 9.5px;
      font-weight: 600;
      padding: 2.5px 6px;
      border-radius: 4px;
      text-align: center;
      line-height: 1.2;
    }

    .stock-box-ready {
      background: #DCFCE7;
      border: 1px solid #86EFAC;
      color: var(--success-green);
      font-family: 'Poppins', sans-serif;
      font-size: 9.5px;
      font-weight: 700;
      padding: 2.5px 6px;
      border-radius: 4px;
      text-align: center;
      line-height: 1.2;
    }

    /* Condition Badge */
    .condition-badge {
      display: inline-block;
      font-family: 'Poppins', sans-serif;
      font-size: 10px;
      font-weight: 700;
      padding: 2.5px 8px;
      border-radius: 4px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      white-space: nowrap;
    }

    .condition-baik {
      background: #F0FDF4;
      border: 1.2px solid #22C55E;
      color: #16A34A;
    }

    .condition-perbaikan {
      background: #FFFBEB;
      border: 1.2px solid #FBBF24;
      color: #D97706;
    }

    /* 3-Dots Action Dropdown Menu (Konsep Asli SI-SAPRAS) */
    .action-dropdown-wrap {
      position: relative;
      display: inline-block;
    }

    .btn-action-dots {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #F1F5F9;
      border: 1px solid #E2E8F0;
      color: #475569;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.15s ease;
      outline: none;
      padding: 0;
    }

    .btn-action-dots:hover {
      background: #E2E8F0;
      color: #0F172A;
      border-color: #CBD5E1;
      transform: scale(1.05);
    }

    .action-dropdown-menu {
      position: absolute;
      right: 0;
      top: calc(100% + 5px);
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.14), 0 8px 10px -6px rgba(0, 0, 0, 0.06);
      padding: 6px;
      min-width: 145px;
      display: none;
      flex-direction: column;
      gap: 2px;
      z-index: 1000;
      text-align: left;
    }

    .action-dropdown-menu.show {
      display: flex;
    }

    .action-dropdown-menu.drop-up {
      top: auto;
      bottom: calc(100% + 5px);
    }

    .action-menu-item {
      display: flex;
      align-items: center;
      gap: 9px;
      width: 100%;
      padding: 7px 11px;
      border-radius: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 11px;
      font-weight: 500;
      color: #1E293B;
      background: transparent;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.12s ease, color 0.12s ease;
      white-space: nowrap;
    }

    .action-menu-item:hover {
      background: #F8FAFC;
      color: #0F172A;
    }

    .action-menu-item svg {
      flex-shrink: 0;
    }

    /* Table Footer Summary Card */
    .table-footer-card {
      background: #FFFFFF;
      border: 1px solid var(--border-subtle);
      border-radius: 8px;
      padding: 12px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .rekap-title {
      font-size: 12px;
      font-weight: 700;
      color: var(--primary-navy);
    }

    .rekap-desc {
      font-size: 10px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    .btn-print-rekap-orange {
      background: #ED7411;
      color: #FFFFFF;
      border: none;
      padding: 8px 18px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: background 0.15s ease, transform 0.1s ease;
      font-family: 'Poppins', sans-serif;
      box-shadow: 0 2px 4px rgba(237, 116, 17, 0.25);
    }

    .btn-print-rekap-orange:hover {
      background: #D96509;
      transform: translateY(-1px);
    }

    /* MODAL */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.55);
      backdrop-filter: blur(2px);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      padding: 16px;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal-card {
      background: #FFFFFF;
      border-radius: 10px;
      box-shadow: 0 16px 40px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 480px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .modal-header {
      padding: 14px 18px;
      border-bottom: 1px solid var(--border-subtle);
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #F8FAFC;
    }

    .modal-title-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .modal-title-icon {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: #E0F2FE;
      color: var(--accent-blue);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 12px;
    }

    .modal-title-text {
      font-size: 12px;
      font-weight: 800;
      color: #08296E;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .modal-close-btn {
      background: none;
      border: none;
      font-size: 18px;
      color: #94A3B8;
      cursor: pointer;
    }

    .modal-close-btn:hover {
      color: var(--danger-red);
    }

    .modal-body {
      padding: 16px 18px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .form-group-sm {
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .form-label-sm {
      font-size: 10px;
      font-weight: 700;
      color: #334155;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .form-input-sm, .form-select-sm, .form-textarea-sm {
      width: 100%;
      padding: 8px 10px;
      font-family: 'Poppins', sans-serif;
      font-size: 11px;
      border: 1.2px solid var(--border-color);
      border-radius: 6px;
      outline: none;
      color: #0F172A;
      background: #FFFFFF;
    }

    .form-input-sm:focus, .form-select-sm:focus, .form-textarea-sm:focus {
      border-color: #08296E;
    }

    .form-row-2col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .modal-footer {
      padding: 12px 18px;
      background: #F8FAFC;
      border-top: 1px solid var(--border-subtle);
      display: flex;
      justify-content: flex-end;
      gap: 8px;
    }

    .btn-modal-cancel {
      background: #F1F5F9;
      border: 1px solid var(--border-color);
      color: #475569;
      padding: 6px 14px;
      border-radius: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-modal-submit {
      background: #08296E;
      border: none;
      color: #FFFFFF;
      padding: 6px 16px;
      border-radius: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-modal-submit:hover {
      background: #061F54;
    }
  </style>
</head>
<body>

  <!-- APP BODY (FULLSCREEN VERSI TANPA BINGKAI) -->
  <div class="app-body">
    
    <!-- LEFT SIDEBAR -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('images/logo-unm-white.png') }}" alt="UNM SI-SAPRAS JTIK" class="brand-logo-img">
      </div>

      <!-- Navigation -->
      <nav class="sidebar-nav">
        <div class="nav-header-label">MENU ADMINISTRATOR</div>

        <!-- 1. Alat dan Bahan -->
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
              <path d="M22 12h-6l-2 3h-4l-2-3H2"/>
              <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
            </svg>
            <span>Alat dan Bahan</span>
          </div>
        </a>

        <!-- 2. Sarana Ruangan -->
        <a href="{{ route('admin.sarana-ruangan') }}" class="nav-item {{ request()->routeIs('admin.sarana-ruangan') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
              <path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"/>
              <path d="M3 16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z"/>
              <path d="M5 18v2"/>
              <path d="M19 18v2"/>
            </svg>
            <span>Sarana ruangan</span>
          </div>
        </a>

        <!-- 3. Data Ruang & Lokasi -->
        <a href="{{ route('admin.ruangan') }}" class="nav-item {{ request()->routeIs('admin.ruangan') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
              <rect x="4" y="2" width="16" height="20" rx="2" ry="2"/>
              <path d="M9 22v-4h6v4"/>
              <path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/>
              <path d="M8 10h.01"/><path d="M16 10h.01"/><path d="M12 10h.01"/>
              <path d="M8 14h.01"/><path d="M16 14h.01"/><path d="M12 14h.01"/>
            </svg>
            <span>Data Ruang &amp; Lokasi</span>
          </div>
        </a>

        <!-- 4. Manajemen Akun User -->
        <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <circle cx="19" cy="11" r="2"/>
              <path d="M19 8v1"/><path d="M19 13v1"/><path d="m21.6 9.5-.9.5"/><path d="m17.3 12-.9.5"/><path d="m21.6 12.5-.9-.5"/><path d="m17.3 10-.9-.5"/>
            </svg>
            <span>Manajemen Akun User</span>
          </div>
        </a>
      </nav>

      <!-- Sidebar Footer -->
      <div class="sidebar-footer">
        SI-SAPRAS JTIK FT UNM
      </div>
    </aside>

    <!-- MAIN WORKSPACE -->
    <main class="main-workspace">

      <!-- Page Header -->
      <div class="page-header">
        <div class="header-left">
          <h1 class="page-title">SARANA RUANGAN (MEBELAIR)</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">Katalog kapasitas bangku, meja, dan kuota relokasi ruang kuliah teori JTIK FT UNM</span>
        </div>
        <div class="header-right">
          <!-- Admin Profile Pill (Persis Pengelola) -->
          <div style="position: relative;">
            <button type="button" id="adminBtn" class="btn-header-admin" onclick="toggleUserDropdown(event)" title="Menu Akun Administrator">
              <span>Admin</span>
              <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>

            <!-- Dropdown Menu Profil & Keluar (Selaras Pengelola) -->
            <div id="userDropdown" class="user-dropdown-panel" style="display: none;">
              <!-- Header Profil (Klik untuk Buka Profil Saya) -->
              <div class="user-dropdown-header-card" onclick="openProfileModal()" title="Klik untuk lihat / ubah Profil">
                <div class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <div style="flex: 1; min-width: 0;">
                  <div class="user-dropdown-name">{{ Auth::user()->name ?? 'Administrator' }}</div>
                  <div class="user-dropdown-email">{{ Auth::user()->email ?? 'admin.sarpras@unm.ac.id' }}</div>
                  <div class="user-dropdown-tag">Administrator Sarpras</div>
                </div>
              </div>

              <!-- Menu Aksi Fungsional -->
              <div class="user-dropdown-links">
                <!-- 1. Profil Saya -->
                <button type="button" class="user-dropdown-btn" onclick="openProfileModal()">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                  <span>Profil Saya</span>
                </button>

                <!-- 2. Ganti Kata Sandi -->
                <button type="button" class="user-dropdown-btn" onclick="openChangePasswordModal()">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                  <span>Ganti Kata Sandi</span>
                </button>

                <div class="user-dropdown-sep"></div>

                <!-- 3. Keluar (Logout) -->
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
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

      <!-- Flash Success Alert -->
      @if(session('success'))
      <div class="alert-success-banner">
        <span>✓ {{ session('success') }}</span>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; color:var(--success-green); font-weight:700; cursor:pointer;">✕</button>
      </div>
      @endif

      <!-- Flash Error Alert -->
      @if(session('error'))
      <div class="alert-danger-banner">
        <span>✕ {{ session('error') }}</span>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; color:#DC2626; font-weight:700; cursor:pointer;">✕</button>
      </div>
      @endif

      <!-- Unified Toolbar (Filters & Search in 1 Clean Row) -->
      <div class="toolbar-row">
        <div class="toolbar-left">
          <!-- Filter Gedung -->
          <div class="pill-select-wrap">
            <select class="pill-filter-select" onchange="window.location.href='{{ route('admin.sarana-ruangan') }}?lokasi=' + encodeURIComponent(this.value) + '&kondisi={{ $kondisiFilter ?? 'all' }}'">
              <option value="all" {{ empty($lokasiFilter) || $lokasiFilter === 'all' ? 'selected' : '' }}>Semua Ruangan</option>
              <option value="Gedung AE" {{ ($lokasiFilter ?? '') === 'Gedung AE' ? 'selected' : '' }}>Gedung AE</option>
              <option value="Lab Komputer" {{ ($lokasiFilter ?? '') === 'Lab Komputer' ? 'selected' : '' }}>Gedung Lab Komputer</option>
            </select>
          </div>

          <!-- Filter Kondisi -->
          <div class="pill-select-wrap">
            <select class="pill-filter-select" onchange="window.location.href='{{ route('admin.sarana-ruangan') }}?lokasi={{ urlencode($lokasiFilter ?? 'all') }}&kondisi=' + this.value">
              <option value="all" {{ empty($kondisiFilter) || $kondisiFilter === 'all' ? 'selected' : '' }}>Semua Kondisi</option>
              <option value="tersedia" {{ ($kondisiFilter ?? '') === 'tersedia' ? 'selected' : '' }}>Kondisi: Tersedia</option>
              <option value="perbaikan" {{ ($kondisiFilter ?? '') === 'perbaikan' ? 'selected' : '' }}>Kondisi: Terkunci / Ujian</option>
            </select>
          </div>

          <!-- Search Input Form -->
          <form method="GET" action="{{ route('admin.sarana-ruangan') }}" class="toolbar-search-form">
            <input type="hidden" name="lokasi" value="{{ $lokasiFilter ?? 'all' }}">
            <input type="hidden" name="kondisi" value="{{ $kondisiFilter ?? 'all' }}">
            <div class="search-input-box">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kode ruang, nama kelas, atau penanggung jawab...">
            </div>
          </form>
        </div>
      </div>

      <!-- Master Data Table Container Card -->
      <div class="table-card">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 12%; text-align: center;">KODE RUANG</th>
              <th style="width: 24%;">RUANG KULIAH TEORI</th>
              <th style="width: 22%;">LOKASI GEDUNG</th>
              <th style="width: 16%; text-align: center;">KAPASITAS KURSI</th>
              <th style="width: 16%; text-align: center;">KAPASITAS MEJA</th>
              <th style="width: 6%; text-align: center;">KONDISI</th>
              <th style="width: 6%; text-align: center;">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @forelse($ruangans as $r)
            <tr>
              <td style="text-align: center;">
                <span class="badge-asset-code">{{ $r->kode_ruangan }}</span>
              </td>
              <td>
                <div class="asset-name-title">{{ $r->kode_ruangan === $r->nama_ruangan ? 'Ruang ' . $r->nama_ruangan : $r->nama_ruangan }}</div>
              </td>
              <td>
                <div class="rack-label-tag">LOKASI GEDUNG:</div>
                <div class="rack-location-title">{{ $r->lokasi_gedung ?: 'Gedung AE' }}</div>
                <div style="font-size: 8.5px; color: #0284C7; font-weight: 600; margin-top: 1px;">
                  PJ: {{ $r->pj_ruangan ?? 'Staf Lab JTIK' }}
                </div>
              </td>
              <td style="text-align: center;">
                <div class="stock-stack">
                  <span class="stock-box-total">Total: {{ $r->kapasitas_kursi }} Unit</span>
                  <span class="stock-box-ready">Kuota: {{ $r->kuota_maks_kursi }} Unit</span>
                </div>
              </td>
              <td style="text-align: center;">
                <div class="stock-stack">
                  <span class="stock-box-total">Total: {{ $r->kapasitas_meja }} Unit</span>
                  <span class="stock-box-ready">Kuota: {{ $r->kuota_maks_meja }} Unit</span>
                </div>
              </td>
              <td style="text-align: center;">
                @if($r->kondisi === 'tersedia')
                  <span class="condition-badge condition-baik">TERSEDIA</span>
                @else
                  <span class="condition-badge condition-perbaikan">TERKUNCI</span>
                @endif
              </td>
              <td style="text-align: center; position: relative;">
                <div class="action-dropdown-wrap">
                  <button type="button" class="btn-action-dots" onclick="toggleActionMenu(event, this)" title="Pilihan Aksi">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                      <circle cx="5" cy="12" r="2"/>
                      <circle cx="12" cy="12" r="2"/>
                      <circle cx="19" cy="12" r="2"/>
                    </svg>
                  </button>
                  <div class="action-dropdown-menu">
                    <button type="button" class="action-menu-item" onclick='closeAllActionMenus(); openEditModal({!! htmlspecialchars(json_encode($r), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      <span>Edit Kapasitas</span>
                    </button>
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align:center; padding: 28px; color:#64748B; font-size: 11px;">
                Belum ada data ruangan pada kriteria filter ini.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </main>
  </div>

  <!-- MODAL: EDIT KAPASITAS MEBELAIR -->
  <div id="editModal" class="modal-overlay" onclick="closeModalOnOverlay(event)">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon">✎</div>
          <div class="modal-title-text">EDIT KAPASITAS MEBELAIR RUANGAN</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeEditModal()">✕</button>
      </div>

      <form id="editKapasitasForm" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <div class="form-group-sm">
            <label class="form-label-sm">Ruang Kuliah Teori:</label>
            <input type="text" id="modalRuanganName" class="form-input-sm" style="background: #F1F5F9; font-weight: 700; color: #08296E;" readonly>
          </div>

          <div class="form-row-2col">
            <div class="form-group-sm">
              <label class="form-label-sm">Kapasitas Kursi (Unit): <span style="color:#DC2626;">*</span></label>
              <input type="number" name="kapasitas_kursi" id="modalKapasitasKursi" class="form-input-sm" min="0" required>
            </div>
            <div class="form-group-sm">
              <label class="form-label-sm">Kuota Maks Pinjam Kursi: <span style="color:#DC2626;">*</span></label>
              <input type="number" name="kuota_maks_kursi" id="modalKuotaKursi" class="form-input-sm" min="0" required>
            </div>
          </div>

          <div class="form-row-2col">
            <div class="form-group-sm">
              <label class="form-label-sm">Kapasitas Meja (Unit): <span style="color:#DC2626;">*</span></label>
              <input type="number" name="kapasitas_meja" id="modalKapasitasMeja" class="form-input-sm" min="0" required>
            </div>
            <div class="form-group-sm">
              <label class="form-label-sm">Kuota Maks Pinjam Meja: <span style="color:#DC2626;">*</span></label>
              <input type="number" name="kuota_maks_meja" id="modalKuotaMeja" class="form-input-sm" min="0" required>
            </div>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Status Kondisi / Operasional: <span style="color:#DC2626;">*</span></label>
            <select name="kondisi" id="modalKondisi" class="form-select-sm" required>
              <option value="tersedia">Kondisi: Tersedia (Dapat Dipinjam/Direlokasi)</option>
              <option value="perbaikan">Kondisi: Terkunci / Digunakan Ujian</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
          <button type="submit" class="btn-modal-submit">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL: PROFIL SAYA (ADMINISTRATOR)                                       -->
  <!-- ======================================================================= -->
  <div id="modalProfile" class="modal-overlay">
    <div class="modal-card" style="max-width: 500px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <div class="modal-title-text" style="color: #08296E;">PROFIL SAYA (ADMINISTRATOR)</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeProfileModal()">✕</button>
      </div>

      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 12px;">
          <!-- Kartu Identitas Singkat (Persis Pengelola) -->
          <div style="display: flex; align-items: center; gap: 14px; background: #F8FAFC; padding: 12px 14px; border-radius: 8px; border: 1px solid #E2E8F0;">
            <div class="user-avatar-initial" style="width: 44px; height: 44px; font-size: 16px; flex-shrink: 0;">
              {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
              <div style="font-size: 13px; font-weight: 700; color: #0F172A;">{{ Auth::user()->name ?? 'Administrator' }}</div>
              <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 6px; margin-top: 4px;">
                <span style="background: #08296E; color: #FFFFFF; font-size: 9px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">Administrator Sarpras</span>
              </div>
            </div>
          </div>

          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Nama Lengkap &amp; Gelar</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" required style="width: 100%; font-family: 'Poppins', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Alamat Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" required style="width: 100%; font-family: 'Poppins', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">NIP / Nomor Induk</label>
              <input type="text" name="nomor_induk" value="{{ Auth::user()->nomor_induk }}" style="width: 100%; font-family: 'Poppins', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
            </div>
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Jabatan</label>
              <input type="text" name="jabatan" value="{{ Auth::user()->jabatan ?? 'Administrator Jurusan JTIK' }}" style="width: 100%; font-family: 'Poppins', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
            </div>
          </div>
        </div>

        <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; background: #F8FAFC; border-top: 1px solid var(--border-color);">
          <button type="button" class="btn-modal-cancel" onclick="closeProfileModal()">Tutup</button>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-modal-cancel" onclick="closeProfileModal(); openChangePasswordModal();" style="color: #08296E; border-color: #08296E;">Ganti Sandi</button>
            <button type="submit" class="btn-modal-submit" style="background: #08296E;">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL: GANTI KATA SANDI (ADMINISTRATOR)                                 -->
  <!-- ======================================================================= -->
  <div id="modalChangePassword" class="modal-overlay">
    <div class="modal-card" style="max-width: 440px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ED7411" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <div class="modal-title-text" style="color: #ED7411;">GANTI KATA SANDI</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeChangePasswordModal()">✕</button>
      </div>

      <form action="{{ route('profile.password') }}" method="POST">
        @csrf
        <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 12px;">
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Kata Sandi Saat Ini</label>
            <input type="password" name="current_password" required placeholder="Masukkan kata sandi lama Anda" style="width: 100%; font-family: 'Poppins', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Kata Sandi Baru</label>
            <input type="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" style="width: 100%; font-family: 'Poppins', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="password_confirmation" required minlength="6" placeholder="Ketik ulang kata sandi baru" style="width: 100%; font-family: 'Poppins', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
        </div>

        <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 8px; padding: 12px 20px; background: #F8FAFC; border-top: 1px solid var(--border-color);">
          <button type="button" class="btn-modal-cancel" onclick="closeChangePasswordModal()">Batal</button>
          <button type="submit" class="btn-modal-submit" style="background: #ED7411; border-color: #ED7411;">Perbarui Kata Sandi</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function toggleUserDropdown(e) {
      if (e) e.stopPropagation();
      const dd = document.getElementById('userDropdown');
      if (dd) {
        dd.style.display = (dd.style.display === 'none' || dd.style.display === '') ? 'block' : 'none';
      }
    }

    document.addEventListener('click', function(e) {
      const dd = document.getElementById('userDropdown');
      const btn = document.getElementById('adminBtn') || document.querySelector('.btn-header-admin') || document.querySelector('.badge-admin-role');
      if (dd && btn && !btn.contains(e.target) && !dd.contains(e.target)) {
        dd.style.display = 'none';
        dd.classList.remove('active');
      }
    });

    // Modal Profil & Password (Administrator)
    function openProfileModal() {
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) {
        dropdown.style.display = 'none';
        dropdown.classList.remove('active');
      }
      document.getElementById('modalProfile').classList.add('active');
    }
    function closeProfileModal() {
      document.getElementById('modalProfile').classList.remove('active');
    }
    function openChangePasswordModal() {
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) {
        dropdown.style.display = 'none';
        dropdown.classList.remove('active');
      }
      document.getElementById('modalChangePassword').classList.add('active');
    }
    function closeChangePasswordModal() {
      document.getElementById('modalChangePassword').classList.remove('active');
    }

    // 3-Dots Action Menu Controller
    function toggleActionMenu(e, btn) {
      e.stopPropagation();
      const wrap = btn.closest('.action-dropdown-wrap');
      const menu = wrap.querySelector('.action-dropdown-menu');
      const isShown = menu.classList.contains('show');

      closeAllActionMenus();

      if (!isShown) {
        menu.classList.add('show');
        const rect = menu.getBoundingClientRect();
        if (rect.bottom > window.innerHeight - 10) {
          menu.classList.add('drop-up');
        } else {
          menu.classList.remove('drop-up');
        }
      }
    }

    function closeAllActionMenus() {
      document.querySelectorAll('.action-dropdown-menu').forEach(m => {
        m.classList.remove('show');
        m.classList.remove('drop-up');
      });
    }

    document.addEventListener('click', function(e) {
      if (!e.target.closest('.action-dropdown-wrap')) {
        closeAllActionMenus();
      }
    });

    function openEditModal(ruangan) {
      const displayName = ruangan.nama_ruangan || ruangan.kode_ruangan;
      document.getElementById('modalRuanganName').value = displayName;
      document.getElementById('modalKapasitasKursi').value = ruangan.kapasitas_kursi || 40;
      document.getElementById('modalKuotaKursi').value = ruangan.kuota_maks_kursi || 10;
      document.getElementById('modalKapasitasMeja').value = ruangan.kapasitas_meja || 20;
      document.getElementById('modalKuotaMeja').value = ruangan.kuota_maks_meja || 10;
      document.getElementById('modalKondisi').value = ruangan.kondisi || 'tersedia';

      const form = document.getElementById('editKapasitasForm');
      form.action = '/admin/sarana-ruangan/' + ruangan.id + '/kapasitas';

      document.getElementById('editModal').classList.add('active');
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.remove('active');
    }

    function closeModalOnOverlay(e) {
      if (e.target.id === 'editModal') {
        closeEditModal();
      }
    }
  </script>

</body>
</html>
