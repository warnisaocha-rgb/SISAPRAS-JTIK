<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Master Sarpras &amp; Inventaris Jurusan - SI-SAPRAS JTIK FT UNM</title>
  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono (Standar UI SI-SAPRAS UNM) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg-app);
      min-height: 100vh;
      width: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      color: var(--text-dark);
    }

    /* FULLSCREEN APP LAYOUT TANPA BINGKAI (RESPONSIF KONSISTEN) */
    .app-body {
      display: grid;
      grid-template-columns: 220px minmax(0, 1fr);
      width: 100%;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* SIDEBAR (KONSISTEN 220PX PERSIS PENGELOLA) */
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

    /* WARNA ACTIVE SIDEBAR KONSISTEN ORANGE SEPERTI PENGELOLA */
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

    .sidebar-footer {
      margin-top: auto;
      padding-top: 14px;
      border-top: 1px dashed rgba(255, 255, 255, 0.08);
      font-size: 9px;
      color: #515F7C;
      letter-spacing: 0.5px;
      text-align: center;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Main Workspace */
    .main-workspace {
      flex: 1;
      min-width: 0;
      width: 100%;
      display: flex;
      flex-direction: column;
      padding: 18px 24px;
      overflow-y: auto;
      overflow-x: hidden;
      background: var(--bg-app);
      box-sizing: border-box;
    }

    /* Top Page Header */
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 14px;
      border-bottom: 1px solid var(--border-subtle);
      padding-bottom: 12px;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .page-title {
      font-size: 15px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.2px;
      margin: 0;
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

    .page-subtitle {
      font-size: 11px;
      color: var(--text-muted);
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .badge-admin-role {
      background: #EFF6FF;
      color: #1D4ED8;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      padding: 5px 14px;
      border-radius: 6px;
      border: 1px solid #BFDBFE;
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: all 0.15s ease;
      text-decoration: none;
    }

    .badge-admin-role:hover {
      background: #DBEAFE;
      border-color: #93C5FD;
    }

    .btn-logout {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      color: #64748B;
      padding: 5px 12px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: all 0.15s ease;
    }

    .btn-logout:hover {
      background: #FEF2F2;
      color: var(--danger-red);
      border-color: #FECACA;
    }

    /* Dropdown Profile Menu (Selaras Pengelola) */
    .btn-header-admin, .badge-admin-role {
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
      font-family: 'Plus Jakarta Sans', sans-serif;
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
      font-size: 11px;
      font-weight: 600;
      margin-bottom: 12px;
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
      margin-bottom: 12px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      position: relative;
    }

    /* Unified Toolbar (Filters, Search & Add Action in 1 Clean Row) */
    .toolbar-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 14px;
    }

    .toolbar-left {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
      min-width: 0;
    }

    .pill-select-wrap {
      position: relative;
      flex-shrink: 0;
    }

    .pill-filter-select {
      background: var(--sidebar-dark);
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
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
      min-width: 180px;
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
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10.5px;
      color: var(--text-dark);
      outline: none;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .search-input-box input:focus {
      border-color: #ED7411;
      box-shadow: 0 0 0 2px rgba(237, 116, 17, 0.15);
    }

    .toolbar-right {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-shrink: 0;
    }

    /* Orange Primary Button (Samakan 100% dengan Warna Sidebar Orange #ED7411) */
    .btn-add-primary {
      background: #ED7411;
      color: #FFFFFF;
      border: 1px solid #D9650A;
      border-radius: 6px;
      height: 34px;
      padding: 0 16px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
      flex-shrink: 0;
      transition: all 0.15s ease;
      box-shadow: 0 1px 2px rgba(237, 116, 17, 0.2);
    }

    .btn-add-primary:hover {
      background: #D9650A;
      border-color: #BF5306;
      transform: translateY(-1px);
      box-shadow: 0 3px 6px rgba(237, 116, 17, 0.25);
    }

    .btn-add-primary:active {
      transform: translateY(0);
      box-shadow: 0 1px 2px rgba(237, 116, 17, 0.2);
    }

    /* Table Container Card */
    .table-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      overflow-x: auto;
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .table-card-header {
      padding: 8px 14px;
      background: #F8FAFC;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .table-caption {
      font-size: 9.5px;
      font-weight: 700;
      color: #334155;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .table-counter {
      font-family: 'JetBrains Mono', monospace;
      font-size: 8.5px;
      color: var(--text-muted);
      font-weight: 600;
    }

    /* Table Styling */
    .data-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    .data-table th {
      background: #F1F5F9;
      color: #334155;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10.5px;
      font-weight: 800;
      letter-spacing: 0.5px;
      padding: 10px 12px;
      border-bottom: 1.5px solid var(--border-color);
      white-space: nowrap;
    }

    .data-table td {
      padding: 11px 12px;
      border-bottom: 1px solid var(--border-subtle);
      vertical-align: middle;
      font-size: 11px;
    }

    .data-table tbody tr:hover {
      background-color: #F8FAFC;
    }

    /* Code Asset (Clean bold Navy Blue font sesuai desain referensi) */
    .badge-asset-code {
      display: inline-block;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      font-weight: 800;
      color: #08296E;
      letter-spacing: -0.2px;
      text-align: center;
    }

    /* Sarpras Name & Category */
    .asset-name-title {
      font-size: 12px;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 2px;
    }

    .asset-spec-text {
      font-size: 11px;
      color: var(--text-muted);
      line-height: 1.35;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    /* Unit & Ruangan Text (Langsung Tulisan Rapi Tanpa Fill Badge) */
    .room-badge {
      display: inline-block;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11.5px;
      font-weight: 600;
      white-space: nowrap;
      background: transparent !important;
      border: none !important;
      padding: 0 !important;
      line-height: 1.4;
      letter-spacing: -0.1px;
    }
    .room-badge-lab { color: #0284C7 !important; font-weight: 700; }
    .room-badge-bkl { color: #334155 !important; font-weight: 700; }
    .room-badge-adm { color: #D97706 !important; font-weight: 700; }

    /* Rack Location */
    .rack-label-tag {
      font-size: 7.5px;
      font-weight: 800;
      color: #64748B;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 1px;
    }
    .rack-location-title {
      font-size: 9px;
      font-weight: 600;
      color: #1E293B;
    }

    /* Stacked Stock Boxes */
    .stock-stack {
      display: flex;
      flex-direction: column;
      gap: 3px;
      width: 82px;
      margin: 0 auto;
    }

    .stock-box-total {
      background: #F1F5F9;
      border: 1px solid #CBD5E1;
      color: #334155;
      font-family: 'Plus Jakarta Sans', sans-serif;
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
      font-family: 'Plus Jakarta Sans', sans-serif;
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
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 700;
      padding: 2.5px 8px;
      border-radius: 4px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }
    .condition-baik {
      background: #F0FDF4;
      border: 1.2px solid #22C55E;
      color: #16A34A;
    }
    .condition-rusak {
      background: #FEF2F2;
      border: 1.2px solid #F87171;
      color: #DC2626;
    }
    .condition-perbaikan {
      background: #FFFBEB;
      border: 1.2px solid #FBBF24;
      color: #D97706;
    }

    /* 3-Dots Action Dropdown Menu (Konsep YouTube Style) */
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

    .btn-action-dots:active,
    .btn-action-dots.active {
      background: #CBD5E1;
      color: #0F172A;
    }

    .action-dropdown-menu {
      position: absolute;
      right: 0;
      top: calc(100% + 5px);
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 10px;
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
      animation: fadeInMenu 0.12s ease-out;
    }

    .action-dropdown-menu.drop-up {
      top: auto;
      bottom: calc(100% + 5px);
    }

    @keyframes fadeInMenu {
      from { opacity: 0; transform: translateY(-4px) scale(0.97); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .action-menu-item {
      display: flex;
      align-items: center;
      gap: 9px;
      width: 100%;
      padding: 7px 11px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
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
      color: #64748B;
      transition: color 0.12s;
    }

    .action-menu-item:hover svg {
      color: #0F172A;
    }

    .action-menu-item.action-menu-danger {
      color: #DC2626;
    }

    .action-menu-item.action-menu-danger svg {
      color: #DC2626;
    }

    .action-menu-item.action-menu-danger:hover {
      background: #FEF2F2;
      color: #B91C1C;
    }

    .action-menu-item.action-menu-danger:hover svg {
      color: #B91C1C;
    }

    .action-menu-divider {
      height: 1px;
      background: #F1F5F9;
      margin: 3px 0;
    }

    /* Table Footer Bar */
    .table-footer-bar {
      padding: 10px 16px;
      background: #FFFFFF;
      border-top: 1px solid var(--border-subtle);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .footer-summary-title {
      font-size: 9.5px;
      font-weight: 700;
      color: var(--primary-navy);
    }

    .footer-summary-desc {
      font-family: 'JetBrains Mono', monospace;
      font-size: 8px;
      color: var(--text-muted);
      margin-top: 1px;
    }

    .btn-print-rekap {
      background: #ED7411;
      color: #FFFFFF;
      border: 1px solid #D9650A;
      border-radius: 6px;
      padding: 6px 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
      box-shadow: 0 1px 2px rgba(237, 116, 17, 0.2);
    }
    .btn-print-rekap:hover {
      background: #D9650A;
      transform: translateY(-1px);
      box-shadow: 0 3px 6px rgba(237, 116, 17, 0.25);
    }

    /* ========================================================================= */
    /* MODAL WINDOW SYSTEM (Clean, Modern, Frameless)                             */
    /* ========================================================================= */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(15, 23, 42, 0.65);
      backdrop-filter: blur(2px);
      z-index: 9999;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal-card {
      background: #FFFFFF;
      border-radius: 10px;
      width: 100%;
      max-width: 760px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.25), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
      border: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      animation: modalFadeIn 0.15s ease-out;
    }

    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(8px) scale(0.98); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .modal-header {
      padding: 14px 20px;
      border-bottom: 1px solid var(--border-subtle);
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #FFFFFF;
      border-radius: 10px 10px 0 0;
    }

    .modal-title-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .modal-title-icon {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #E0F2FE;
      color: var(--accent-blue);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 13px;
    }

    .modal-title-text {
      font-size: 12.5px;
      font-weight: 800;
      color: var(--text-dark);
      letter-spacing: 0.3px;
      text-transform: uppercase;
    }

    .modal-close-btn {
      background: none;
      border: none;
      font-size: 18px;
      color: #94A3B8;
      cursor: pointer;
      line-height: 1;
      padding: 4px;
      border-radius: 4px;
      transition: color 0.15s;
    }
    .modal-close-btn:hover {
      color: var(--danger-red);
    }

    .modal-body {
      padding: 18px 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .modal-grid-top {
      display: grid;
      grid-template-columns: 190px 1fr;
      gap: 16px;
    }

    /* Photo Upload Dropzone */
    .photo-dropzone-box {
      border: 1.5px dashed var(--border-color);
      border-radius: 8px;
      background: #F8FAFC;
      padding: 16px 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      cursor: pointer;
      transition: all 0.15s ease;
      min-height: 135px;
      position: relative;
    }
    .photo-dropzone-box:hover {
      border-color: var(--accent-blue);
      background: #F0F9FF;
    }

    .photo-preview-img {
      max-width: 100%;
      max-height: 110px;
      object-fit: contain;
      border-radius: 4px;
      display: none;
    }

    .btn-choose-file {
      background: var(--accent-blue);
      color: #FFFFFF;
      font-size: 8px;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 4px;
      margin-top: 6px;
      display: inline-block;
      cursor: pointer;
    }

    /* Form Fields */
    .form-group-sm {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .form-label-sm {
      font-size: 9.5px;
      font-weight: 700;
      color: #334155;
    }

    .form-label-sm span.req {
      color: var(--danger-red);
    }

    .form-input-sm, .form-select-sm {
      width: 100%;
      height: 30px;
      padding: 0 10px;
      border: 1.2px solid var(--border-color);
      border-radius: 5px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      color: var(--text-dark);
      outline: none;
      transition: border-color 0.15s;
      background: #FFFFFF;
    }

    .form-input-sm:focus, .form-select-sm:focus, .form-textarea-sm:focus {
      border-color: var(--accent-blue);
    }

    .form-textarea-sm {
      width: 100%;
      padding: 8px 10px;
      border: 1.2px solid var(--border-color);
      border-radius: 5px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      color: var(--text-dark);
      outline: none;
      resize: vertical;
      min-height: 60px;
    }

    .form-row-2col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .modal-footer {
      padding: 12px 20px;
      border-top: 1px solid var(--border-subtle);
      background: #F8FAFC;
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      border-radius: 0 0 10px 10px;
    }

    .btn-modal-cancel {
      background: #FFFFFF;
      border: 1.2px solid var(--border-color);
      color: #475569;
      padding: 6px 16px;
      border-radius: 5px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 700;
      cursor: pointer;
    }

    .btn-modal-submit {
      background: var(--sidebar-dark);
      border: none;
      color: #FFFFFF;
      padding: 6px 18px;
      border-radius: 5px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.15s ease;
    }
    .btn-modal-submit:hover {
      background: #1E2342;
    }

    /* Detail Modal Specifics */
    .detail-info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .detail-card-box {
      background: #F8FAFC;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      padding: 10px 12px;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .detail-card-title {
      font-size: 8.5px;
      font-weight: 800;
      color: #64748B;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .detail-card-val {
      font-size: 10px;
      font-weight: 700;
      color: #0F172A;
    }

    .detail-card-sub {
      font-size: 8.5px;
      color: var(--text-muted);
    }

    /* Table Footer Summary Card (Sesuai Desain Figma) */
    .table-footer-card {
      background: #FFFFFF;
      border: 1px solid var(--border-subtle);
      border-radius: 8px;
      padding: 12px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 1px 3px rgba(0,0,0,0.02);
      margin-top: 14px;
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
      font-family: 'Plus Jakarta Sans', sans-serif;
      box-shadow: 0 2px 4px rgba(237, 116, 17, 0.25);
    }

    .btn-print-rekap-orange:hover {
      background: #D9640A;
      transform: translateY(-1px);
    }

    /* Modal Button Danger & Alert Boxes */
    .btn-modal-danger {
      background: var(--danger-red);
      border: none;
      color: #FFFFFF;
      padding: 6px 18px;
      border-radius: 5px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.15s ease;
    }
    .btn-modal-danger:hover {
      background: #B91C1C;
    }

    .modal-alert-box {
      background: #FEF2F2;
      border: 1px dashed #FCA5A5;
      border-radius: 8px;
      padding: 10px 14px;
    }

    .modal-alert-list {
      list-style: disc;
      padding-left: 18px;
      font-size: 10px;
      color: #7F1D1D;
      line-height: 1.6;
    }

    /* File Export Card */
    .file-export-card {
      border: 1px solid #CBD5E1;
      border-radius: 8px;
      padding: 10px 14px;
      display: flex;
      align-items: center;
      gap: 12px;
      background: #FFFFFF;
    }

    .file-export-icon {
      width: 34px;
      height: 34px;
      background: #DCFCE7;
      color: #16A34A;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 13px;
      flex-shrink: 0;
      font-family: 'JetBrains Mono', monospace;
    }

    .file-export-info {
      flex: 1;
    }

    .file-export-name {
      font-size: 11px;
      font-weight: 700;
      color: #0F172A;
    }

    .file-export-size {
      font-size: 11px;
      color: #64748B;
      margin-top: 2px;
    }

    /* PENYERAGAMAN DESAIN: PLUS JAKARTA SANS, TIPOGRAFI LEGA & BORDER HALUS */
    body, button, input, select, textarea,
    .nav-header-label, .sidebar-footer, .badge-admin-role, .btn-logout {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    .app-body { grid-template-columns: 240px minmax(0, 1fr); }
    .sidebar { width: 240px; min-width: 240px; padding: 20px 15px 16px 15px; }
    .nav-header-label { font-size: 10px; padding: 12px 10px 5px 10px; }
    .nav-item { font-size: 13px; padding: 10px 12px; }
    .nav-badge-count { font-size: 10.5px; padding: 2px 7px; }
    .sidebar-footer { font-size: 11px; }

    .main-workspace { padding: 24px 32px; gap: 18px; }
    .page-title { font-size: 18px; letter-spacing: -0.3px; }
    .page-subtitle { font-size: 12.5px; }
    .badge-admin-role, .btn-logout { font-size: 12px; height: 36px; padding: 0 14px; }

    .table-card, .card-panel, .kpi-card, .stat-card, .filter-bar, .toolbar-card {
      border-color: #E5E7EB;
      border-radius: 10px;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }
    table th {
      background: #F8FAFC !important;
      color: #475569 !important;
      font-size: 11.5px !important;
      font-weight: 700 !important;
      padding: 12px 16px !important;
      border-bottom: 1.5px solid #E2E8F0 !important;
    }
    table td {
      font-size: 12.5px;
      padding: 13px 16px !important;
      border-bottom: 1px solid #F1F5F9 !important;
    }
    .form-label, .modal-body label { font-size: 12px; }
    .form-input, .form-select, .form-textarea, .search-input { font-size: 12.5px; padding: 9px 12px; border-color: #D8DEE9; }
    .file-export-name { font-size: 12.5px; }

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

  <!-- APP BODY (FULLSCREEN VERSI TANPA BINGKAI) -->
  <div class="app-body">
    
    <!-- LEFT SIDEBAR (PERSISTEN & KONSISTEN PERSIS PENGELOLA) -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('images/logo-unm-white.png') }}" alt="UNM SI-SAPRAS JTIK" class="brand-logo-img">
      </div>

      <!-- Navigation -->
      <nav class="sidebar-nav">
        <div class="nav-header-label">Menu Administrator</div>

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

        <!-- 2. Data Ruang & Lokasi -->
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
            <span>Akun &amp; Monitoring</span>
          </div>
          @if(($pendingPengelolaCount ?? 0) > 0)
            <span class="nav-badge-count">{{ $pendingPengelolaCount }}</span>
          @endif
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
          <h1 class="page-title">Alat dan Bahan</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">Katalog alat praktikum, bahan, komponen, dan inventaris jurusan</span>
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
        <span style="display:inline-flex;align-items:center;gap:8px;"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><span>{{ session('success') }}</span></span>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; color:var(--success-green); font-weight:700; cursor:pointer;">&times;</button>
      </div>
      @endif

      <!-- Flash Error Alert -->
      @if(session('error'))
      <div class="alert-danger-banner">
        <span style="display:inline-flex;align-items:center;gap:8px;"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg><span>{{ session('error') }}</span></span>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; color:#DC2626; font-weight:700; cursor:pointer;">&times;</button>
      </div>
      @endif

      <!-- Validation Errors Alert -->
      @if(isset($errors) && $errors->any())
      <div class="alert-danger-banner">
        <div>
          <div style="font-weight: 700; margin-bottom: 4px;"><span style="display:inline-flex;align-items:center;gap:6px;"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg><span>Perhatian:</span></span> Terdapat kesalahan saat menyimpan data sarpras:</div>
          <ul style="margin: 0; padding-left: 18px; font-size: 11px;">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; color:#DC2626; font-weight:700; cursor:pointer;">&times;</button>
      </div>
      @endif

      <!-- Unified Toolbar (Filters, Search & Add Action in 1 Clean Row) -->
      <div class="toolbar-row">
        <div class="toolbar-left">
          <!-- Room Dropdown Pill -->
          <div class="pill-select-wrap">
            <select class="pill-filter-select" onchange="window.location.href='{{ route('admin.dashboard') }}?ruangan=' + encodeURIComponent(this.value) + '&kondisi={{ urlencode($kondisiFilter ?? 'all') }}&search={{ urlencode($search ?? '') }}'">
              <option value="all" {{ empty($ruanganFilter) || $ruanganFilter === 'all' ? 'selected' : '' }}>Semua Ruangan</option>
              @foreach($ruangans as $r)
                <option value="{{ $r->id }}" {{ (string)($ruanganFilter ?? '') === (string)$r->id ? 'selected' : '' }}>
                  {{ $r->nama_ruangan }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Condition Dropdown Pill -->
          <div class="pill-select-wrap">
            <select class="pill-filter-select" onchange="window.location.href='{{ route('admin.dashboard') }}?ruangan={{ urlencode($ruanganFilter ?? 'all') }}&kondisi=' + encodeURIComponent(this.value) + '&search={{ urlencode($search ?? '') }}'">
              <option value="all" {{ empty($kondisiFilter) || $kondisiFilter === 'all' ? 'selected' : '' }}>Semua Kondisi</option>
              <option value="baik" {{ ($kondisiFilter ?? '') === 'baik' ? 'selected' : '' }}>Kondisi: Baik</option>
              <option value="rusak" {{ ($kondisiFilter ?? '') === 'rusak' ? 'selected' : '' }}>Kondisi: Rusak Ringan</option>
              <option value="perbaikan" {{ ($kondisiFilter ?? '') === 'perbaikan' ? 'selected' : '' }}>Kondisi: Dalam Perbaikan</option>
            </select>
          </div>

          <!-- Search Input -->
          <form method="GET" action="{{ route('admin.dashboard') }}" class="toolbar-search-form">
            <input type="hidden" name="ruangan" value="{{ $ruanganFilter ?? 'all' }}">
            <input type="hidden" name="kondisi" value="{{ $kondisiFilter ?? 'all' }}">
            <div class="search-input-box">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kode sarpras atau nama alat/bahan...">
            </div>
          </form>
        </div>

        <!-- Add Button on the Right -->
        <div class="toolbar-right">
          <button class="btn-add-primary" type="button" onclick="openAddModal()">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Alat &amp; Bahan</span>
          </button>
        </div>
      </div>

      <!-- Master Data Table Container Card -->
      <div class="table-card">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 12%; text-align: center;">Kode Aset</th>
              <th style="width: 33%;">Nama Sarpras</th>
              <th style="width: 18%;">Unit &amp; Ruangan</th>
              <th style="width: 17%; text-align: center;">Stok (Total/Ready)</th>
              <th style="width: 10%; text-align: center;">Kondisi</th>
              <th style="width: 10%; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>

            @forelse($sarpras as $index => $item)
            @php
              $badgeClass = 'room-badge-lab';
              $kodeR = $item->ruangan->kode_ruangan ?? '';
              $namaR = $item->ruangan->nama_ruangan ?? '';
              if (stripos($namaR, 'Laboratorium') !== false || stripos($namaR, 'Lab') !== false || stripos($kodeR, 'LAB') !== false) {
                $badgeClass = 'room-badge-lab';
              } elseif (stripos($kodeR, 'BENGKEL') !== false || stripos($kodeR, 'BKL') !== false || stripos($kodeR, 'BAV') !== false || stripos($namaR, 'Bengkel') !== false) {
                $badgeClass = 'room-badge-bkl';
              } elseif (stripos($kodeR, 'ADMIN') !== false || stripos($kodeR, 'ADM') !== false || stripos($namaR, 'Admin') !== false || stripos($namaR, 'JTIK') !== false) {
                $badgeClass = 'room-badge-adm';
              } else {
                $badgeClass = 'room-badge-lab';
              }
            @endphp
            <tr>
              <td style="text-align: center;">
                <span class="badge-asset-code">{{ $item->kode_sarpras }}</span>
              </td>
              <td>
                <div class="asset-name-title">{{ $item->nama_sarpras }}</div>
              </td>
              <td>
                <span class="room-badge {{ $badgeClass }}">{{ $item->ruangan->nama_ruangan ?? 'Ruangan' }}</span>
              </td>
              <td style="text-align: center;">
                <div class="stock-stack">
                  <span class="stock-box-total">Jumlah: {{ $item->jumlah_total }}</span>
                  <span class="stock-box-ready">Ready: {{ $item->jumlah_tersedia }}</span>
                </div>
              </td>
              <td style="text-align: center;">
                @if($item->kondisi === 'rusak')
                  <span class="condition-badge condition-rusak">Rusak</span>
                @elseif($item->kondisi === 'perbaikan')
                  <span class="condition-badge condition-perbaikan">Perbaikan</span>
                @else
                  <span class="condition-badge condition-baik">Baik</span>
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
                    <button type="button" class="action-menu-item" onclick='closeAllActionMenus(); openDetailModal({!! htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                      <span>Lihat Detail</span>
                    </button>
                    <button type="button" class="action-menu-item" onclick='closeAllActionMenus(); openEditModal({!! htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      <span>Edit Data</span>
                    </button>
                    <div class="action-menu-divider"></div>
                    <button type="button" class="action-menu-item action-menu-danger" onclick='closeAllActionMenus(); openDeleteModal({!! htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                      <span>Hapus Data</span>
                    </button>
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" style="text-align: center; padding: 28px; color: #64748B; font-size: 11px;">
                Belum ada data sarpras pada kriteria filter ini.
              </td>
            </tr>
            @endforelse

          </tbody>
        </table>
      </div>

      @include('partials.pagination', ['paginator' => $sarpras])

    </main>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 1: TAMBAH DATA SARPRAS BARU                                       -->
  <!-- ======================================================================= -->
  <div class="modal-overlay" id="addModal">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon">+</div>
          <div class="modal-title-text">Tambah Data Sarpras Baru</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeAddModal()">&times;</button>
      </div>

      <form action="{{ route('admin.sarpras.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="jenis_sarpras" value="alat_bahan">

        <div class="modal-body">
          
          <!-- Top Grid: Photo + Code & Category & Name -->
          <div class="modal-grid-top">
            <!-- Left: Foto Dropzone -->
            <div class="form-group-sm">
              <label class="form-label-sm">Foto Fisik Sarpras</label>
              <div class="photo-dropzone-box" onclick="document.getElementById('addFotoInput').click()">
                <div id="addPhotoPlaceholder">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0091FF" stroke-width="2" style="margin-bottom:4px;">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                  </svg>
                  <div style="font-size: 12px; font-weight: 700; color: #0F172A;">Unggah Foto</div>
                  <div style="font-size: 11.5px; color: #94A3B8;">(PNG/JPG/WEBP Maks. 10MB)</div>
                  <span class="btn-choose-file">Pilih Foto dari Disk</span>
                </div>
                <img id="addPhotoPreview" class="photo-preview-img" alt="Preview Foto">
                <input type="file" name="foto" id="addFotoInput" accept="image/*" style="display:none;" onchange="previewImg(this, 'addPhotoPreview', 'addPhotoPlaceholder')">
              </div>
            </div>

            <!-- Right: Kode & Nama -->
            <div style="display: flex; flex-direction: column; gap: 8px;">
              <div class="form-group-sm">
                <label class="form-label-sm">Kode Aset / Inventaris: <span class="req">*</span></label>
                <input type="text" name="kode_sarpras" value="{{ old('kode_sarpras') }}" class="form-input-sm" placeholder="Contoh: IOT-001-02" required>
                @error('kode_sarpras')
                  <div style="color: #DC2626; font-size: 11.5px; font-weight: 600; margin-top: 2px;">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group-sm">
                <label class="form-label-sm">Nama Sarpras / Peralatan Praktikum: <span class="req">*</span></label>
                <input type="text" name="nama_sarpras" value="{{ old('nama_sarpras') }}" class="form-input-sm" placeholder="Contoh: Kapasitor / MikroTik RB750Gr3" required>
                @error('nama_sarpras')
                  <div style="color: #DC2626; font-size: 11.5px; font-weight: 600; margin-top: 2px;">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <!-- Mid Grid: Ruangan, Stok, Ready, Kondisi, Kuota -->
          <div class="form-group-sm">
            <label class="form-label-sm">Nama Ruangan Penempatan: <span class="req">*</span></label>
            <select name="ruangan_id" class="form-select-sm" required>
              @foreach($ruangans as $r)
                <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-row-2col">
            <div class="form-group-sm">
              <label class="form-label-sm">Jumlah Total Unit Fisik: <span class="req">*</span></label>
              <input type="number" name="jumlah_total" id="addJumlahTotal" value="{{ old('jumlah_total', 1) }}" class="form-input-sm" placeholder="Jumlah Total: 50" min="1" required oninput="document.getElementById('addJumlahTersedia').value = this.value">
            </div>

            <div class="form-group-sm">
              <label class="form-label-sm">Jumlah Siap Dipinjam (Ready): <span class="req">*</span></label>
              <input type="number" name="jumlah_tersedia" id="addJumlahTersedia" value="{{ old('jumlah_tersedia', 1) }}" class="form-input-sm" placeholder="Jumlah Siap Pinjam: 50" min="0" required>
            </div>
          </div>

          <div class="form-row-2col">
            <div class="form-group-sm">
              <label class="form-label-sm">Kondisi Fisik Barang: <span class="req">*</span></label>
              <select name="kondisi" class="form-select-sm" style="color:var(--success-green); font-weight:700;" required>
                <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Kondisi Baik (100% Berfungsi)</option>
                <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}>Kondisi Rusak Ringan</option>
                <option value="perbaikan" {{ old('kondisi') == 'perbaikan' ? 'selected' : '' }}>Kondisi Dalam Perbaikan</option>
              </select>
            </div>

            <div class="form-group-sm">
              <label class="form-label-sm">Batas Maksimal Kuota Pinjam: <span class="req">*</span></label>
              <input type="number" name="maks_pinjam" value="{{ old('maks_pinjam', 2) }}" class="form-input-sm" min="1" placeholder="Maksimal 2 Unit / Mahasiswa" required>
            </div>
          </div>

          <!-- Bottom: Spesifikasi -->
          <div class="form-group-sm">
            <label class="form-label-sm">Spesifikasi Teknis / Keterangan Tambahan: <span class="req">*</span></label>
            <textarea name="spesifikasi" class="form-textarea-sm" placeholder="Keterangan dan spesifikasi teknis sarpras baru..." required>{{ old('spesifikasi') }}</textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn-modal-cancel" onclick="closeAddModal()">Batal</button>
          <button type="submit" class="btn-modal-submit">Simpan Sarpras Baru</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 2: EDIT DATA SARPRAS                                              -->
  <!-- ======================================================================= -->
  <div class="modal-overlay" id="editModal">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#FEF3C7; color:#B45309;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
          <div class="modal-title-text">Edit Data Sarpras</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeEditModal()">&times;</button>
      </div>

      <form id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          
          <div class="modal-grid-top">
            <!-- Left: Foto Dropzone -->
            <div class="form-group-sm">
              <label class="form-label-sm">Foto Fisik Terdaftar</label>
              <div class="photo-dropzone-box" onclick="document.getElementById('editFotoInput').click()">
                <div id="editPhotoPlaceholder">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0091FF" stroke-width="2" style="margin-bottom:4px;">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                  </svg>
                  <div style="font-size: 12px; font-weight: 700; color: #0F172A;">Ganti Foto Fisik</div>
                  <span class="btn-choose-file">Pilih Foto Baru</span>
                </div>
                <img id="editPhotoPreview" class="photo-preview-img" alt="Foto Sarpras">
                <input type="file" name="foto" id="editFotoInput" accept="image/*" style="display:none;" onchange="previewImg(this, 'editPhotoPreview', 'editPhotoPlaceholder')">
              </div>
            </div>

            <!-- Right: Kode (Read-Only) & Nama -->
            <div style="display: flex; flex-direction: column; gap: 8px;">
              <div class="form-group-sm">
                <label class="form-label-sm">Kode Aset (Read-Only ID):</label>
                <input type="text" id="editKodeSarpras" class="form-input-sm" style="background:#F1F5F9; color:#64748B; font-weight:700;" readonly>
              </div>

              <div class="form-group-sm">
                <label class="form-label-sm">Nama Sarpras / Peralatan Praktikum: <span class="req">*</span></label>
                <input type="text" name="nama_sarpras" id="editNamaSarpras" class="form-input-sm" required>
              </div>
            </div>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Nama Ruangan Penempatan: <span class="req">*</span></label>
            <select name="ruangan_id" id="editRuanganId" class="form-select-sm" required>
              @foreach($ruangans as $r)
                <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-row-2col">
            <div class="form-group-sm">
              <label class="form-label-sm">Jumlah Total Unit Fisik: <span class="req">*</span></label>
              <input type="number" name="jumlah_total" id="editJumlahTotal" class="form-input-sm" min="1" required>
            </div>

            <div class="form-group-sm">
              <label class="form-label-sm">Jumlah Siap Dipinjam (Ready): <span class="req">*</span></label>
              <input type="number" name="jumlah_tersedia" id="editJumlahTersedia" class="form-input-sm" min="0" required>
            </div>
          </div>

          <div class="form-row-2col">
            <div class="form-group-sm">
              <label class="form-label-sm">Kondisi Fisik Barang: <span class="req">*</span></label>
              <select name="kondisi" id="editKondisi" class="form-select-sm" required>
                <option value="baik">Kondisi Baik (100% Berfungsi)</option>
                <option value="rusak">Kondisi Rusak Ringan</option>
                <option value="perbaikan">Kondisi Dalam Perbaikan</option>
              </select>
            </div>

            <div class="form-group-sm">
              <label class="form-label-sm">Batas Maksimal Kuota Pinjam: <span class="req">*</span></label>
              <input type="number" name="maks_pinjam" id="editMaksPinjam" class="form-input-sm" min="1" required>
            </div>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Spesifikasi Teknis / Keterangan: <span class="req">*</span></label>
            <textarea name="spesifikasi" id="editSpesifikasi" class="form-textarea-sm" required></textarea>
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
  <!-- MODAL 3: SPESIFIKASI SARPRAS (DETAIL)                                   -->
  <!-- ======================================================================= -->
  <div class="modal-overlay" id="detailModal">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#E0F2FE; color:#0369A1;">ℹ️</div>
          <div class="modal-title-text">Spesifikasi Sarpras</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeDetailModal()">&times;</button>
      </div>

      <div class="modal-body">
        
        <!-- Header Info Sarpras -->
        <div style="display: flex; gap: 16px; align-items: center; border-bottom: 1px solid var(--border-subtle); padding-bottom: 14px;">
          <div style="width: 70px; height: 70px; border-radius: 8px; border: 1.5px solid var(--border-color); background: #F8FAFC; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
            <img id="detailFoto" src="" alt="Foto" style="width:100%; height:100%; object-fit:contain; display:none;">
            <svg id="detailNoFoto" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
            </svg>
          </div>
          <div>
            <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
              <span id="detailKode" class="badge-asset-code" style="font-size: 11.5px;">-</span>
            </div>
            <h3 id="detailNama" style="font-size: 13px; font-weight: 800; color: #0F172A; margin: 0 0 4px 0;">Nama Sarpras</h3>
            <span id="detailKondisiBadge" class="condition-badge condition-baik">Baik</span>
          </div>
        </div>

        <!-- 2 Grid Cards: Ruangan & Ringkasan Stok -->
        <div class="detail-info-grid">
          <div class="detail-card-box">
            <span class="detail-card-title">Unit Ruangan Penugasan</span>
            <div id="detailRuanganNama" class="detail-card-val">Laboratorium</div>
            <div id="detailRuanganPJ" class="detail-card-sub">Penanggung Jawab: Sulaeman, S.T.</div>
          </div>

          <div class="detail-card-box">
            <span class="detail-card-title">Stok Total Fisik</span>
            <div id="detailStokTotal" style="font-size: 11px; font-weight: 800; color: #08296E; font-family:'Plus Jakarta Sans', sans-serif; margin-bottom: 6px;">Jumlah: 0 Unit</div>
            <div style="border-top: 1px dashed var(--border-color); padding-top: 6px;">
              <span class="detail-card-title">Stok Siap Pakai (Ready)</span>
              <div id="detailStokReady" style="font-size: 11px; font-weight: 800; color: var(--success-green); font-family:'Plus Jakarta Sans', sans-serif;">Jumlah: 0 Unit Siap Dipinjam</div>
            </div>
          </div>
        </div>

        <!-- Kuota & Deskripsi -->
        <div class="detail-card-box">
          <span class="detail-card-title">Ketentuan Kuota Pinjam</span>
          <div id="detailMaksPinjam" class="detail-card-val" style="color: #B45309;">Maksimal 2 Unit / Mahasiswa</div>
        </div>

        <div class="detail-card-box">
          <span class="detail-card-title">Deskripsi &amp; Spesifikasi Teknis</span>
          <div id="detailSpesifikasi" style="font-size: 11.5px; color: #334155; line-height: 1.5; white-space: pre-line;">-</div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn-modal-submit" onclick="closeDetailModal()">Tutup</button>
      </div>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 4: KONFIRMASI HAPUS SARPRAS                                       -->
  <!-- ======================================================================= -->
  <div id="deleteModal" class="modal-overlay">
    <div class="modal-card" style="max-width: 480px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#FEE2E2; color:#DC2626; width:26px; height:26px; border-radius:6px; display:flex; align-items:center; justify-content:center;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
          <div class="modal-title-text" style="font-size: 13px;">Konfirmasi Hapus Sarpras</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeDeleteModal()">&times;</button>
      </div>

      <form id="deleteSarprasForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body" style="padding: 20px 22px; gap: 14px;">
          <div style="text-align: center;">
            <span style="display:inline-block; padding: 4px 14px; background:#FEE2E2; color:#DC2626; border-radius:6px; font-size: 12px; font-weight:700;">
              Perhatian: Tindakan Tidak Dapat Dibatalkan
            </span>
          </div>

          <h3 style="text-align: center; font-size: 14px; font-weight: 800; color: #0F172A; margin: 2px 0;">
            Yakin Ingin Menghapus Alat/Bahan ini?
          </h3>

          <p style="text-align: center; font-size: 11px; color: #64748B; margin-top: -6px;">
            Data inventaris ini akan dihapus secara permanen dari sistem inventaris jurusan.
          </p>

          <!-- Asset Info Box (Dashed Box Sesuai Figma) -->
          <div style="background: #F8FAFC; border: 1.5px dashed #CBD5E1; border-radius: 8px; padding: 12px 16px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <span id="deleteKodeSarpras" class="badge-asset-code" style="font-size: 12px;">-</span>
              <div>
                <div id="deleteNamaSarpras" style="font-size: 11.5px; font-weight: 700; color: #0F172A;">-</div>
                <div id="deleteRuanganSarpras" style="font-size: 12px; color: #64748B;">-</div>
              </div>
            </div>
            <div id="deleteStokSarpras" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11.5px; font-weight: 700; color: #08296E; white-space: nowrap;">-</div>
          </div>

          <!-- Alert Note Box -->
          <div class="modal-alert-box">
            <ul class="modal-alert-list">
              <li>Pastikan alat/bahan ini tidak sedang dalam status dipinjam oleh mahasiswa.</li>
              <li>Riwayat peminjaman terkait aset ini akan dihapus secara permanen dari sistem.</li>
            </ul>
          </div>
        </div>

        <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: center;">
          <span style="font-size: 11.5px; color: #94A3B8;">Tindakan penghapusan tercatat pada log</span>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
            <button type="submit" class="btn-modal-danger">Hapus Permanen</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 5: CETAK / EKSPOR REKAPITULASI SARPRAS                            -->
  <!-- ======================================================================= -->
  <div id="exportModal" class="modal-overlay">
    <div class="modal-card" style="max-width: 480px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#DCFCE7; color:#16A34A; width:26px; height:26px; border-radius:6px; display:flex; align-items:center; justify-content:center;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
          <div class="modal-title-text" style="font-size: 13px;">Cetak / Ekspor Data Sarpras</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeExportModal()">&times;</button>
      </div>

      <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 12px;">
        <p style="font-size: 11px; color: #64748B; margin: 0; line-height: 1.4;">
          Silakan pilih format laporan rekapitulasi alat dan bahan yang ingin dicetak atau diunduh:
        </p>

        <!-- File Card -->
        <div class="file-export-card">
          <div class="file-export-icon">XLS</div>
          <div class="file-export-info">
            <div class="file-export-name">Rekapitulasi_Alat_Bahan_JTIK_{{ date('Y') }}.xlsx</div>
            <div class="file-export-size">Tahun Akademik {{ date('Y') }}/{{ date('Y')+1 }} | Format Spreadsheet Excel</div>
          </div>
          <span style="font-size: 12px; color: #64748B; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif;">48 KB</span>
        </div>

        <!-- 2 Column Stat Cards -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 12px;">
            <div style="font-size: 11.5px; font-weight: 700; color: #64748B; ">Total Komoditas</div>
            <div style="font-size: 11.5px; font-weight: 700; color: #08296E; margin-top: 2px;">{{ $totalKomoditas ?? $sarpras->count() }} Item Sarpras</div>
          </div>
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 12px;">
            <div style="font-size: 11.5px; font-weight: 700; color: #64748B; ">Total Fisik / Ready</div>
            <div style="font-size: 11.5px; font-weight: 700; color: #16A34A; margin-top: 2px;">{{ $totalFisik ?? $sarpras->sum('jumlah_total') }} Fisik | {{ $totalReady ?? $sarpras->sum('jumlah_tersedia') }} Ready</div>
          </div>
        </div>
      </div>

      <div class="modal-footer" style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; padding: 14px 20px; background: #F8FAFC; border-top: 1px solid #E2E8F0;">
        <button type="button" class="btn-modal-cancel" onclick="closeExportModal()">Batal</button>
        <button type="button" class="btn-modal-cancel" onclick="window.print()" style="display: inline-flex; align-items: center; gap: 6px;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
          <span>Cetak PDF</span>
        </button>
        <button type="button" class="btn-modal-submit" onclick="exportDataExcel()" style="background: #16A34A; border-color: #16A34A; display: inline-flex; align-items: center; gap: 6px;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Unduh File Excel</span>
        </button>
      </div>
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
          <div class="modal-title-text" style="color: #08296E;">Profil Saya (Administrator)</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeProfileModal()">&times;</button>
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
                <span style="background: #08296E; color: #FFFFFF; font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">Administrator Sarpras</span>
              </div>
            </div>
          </div>

          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Nama Lengkap &amp; Gelar</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" required style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Alamat Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" required style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">NIP / Nomor Induk</label>
              <input type="text" name="nomor_induk" value="{{ Auth::user()->nomor_induk }}" style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
            </div>
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Jabatan</label>
              <input type="text" name="jabatan" value="{{ Auth::user()->jabatan ?? 'Administrator Jurusan JTIK' }}" style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
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
          <div class="modal-title-text" style="color: #ED7411;">Ganti Kata Sandi</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeChangePasswordModal()">&times;</button>
      </div>

      <form action="{{ route('profile.password') }}" method="POST">
        @csrf
        <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 12px;">
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Kata Sandi Saat Ini</label>
            <input type="password" name="current_password" required maxlength="32" placeholder="Masukkan kata sandi lama Anda" style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Kata Sandi Baru</label>
            <input type="password" name="password" required minlength="8" maxlength="32" placeholder="Minimal 8, maksimal 32 karakter" style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
          <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="password_confirmation" required minlength="8" maxlength="32" placeholder="Ketik ulang kata sandi baru (8–32 karakter)" style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
          </div>
        </div>

        <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 8px; padding: 12px 20px; background: #F8FAFC; border-top: 1px solid var(--border-color);">
          <button type="button" class="btn-modal-cancel" onclick="closeChangePasswordModal()">Batal</button>
          <button type="submit" class="btn-modal-submit" style="background: #ED7411; border-color: #ED7411;">Perbarui Kata Sandi</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- JAVASCRIPT LOGIC                                                        -->
  <!-- ======================================================================= -->
  <script>
    // Preview Gambar saat upload
    function previewImg(input, previewId, placeholderId) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const preview = document.getElementById(previewId);
          preview.src = e.target.result;
          preview.style.display = 'block';
          if (placeholderId) {
            document.getElementById(placeholderId).style.display = 'none';
          }
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    // Modal 1: Tambah Sarpras
    function openAddModal() {
      document.getElementById('addModal').classList.add('active');
    }
    function closeAddModal() {
      document.getElementById('addModal').classList.remove('active');
    }

    // Modal 2: Edit Sarpras
    function openEditModal(item) {
      document.getElementById('editForm').action = '/admin/sarpras/' + item.id;
      document.getElementById('editKodeSarpras').value = item.kode_sarpras;
      document.getElementById('editNamaSarpras').value = item.nama_sarpras;
      document.getElementById('editRuanganId').value = item.ruangan_id;
      document.getElementById('editJumlahTotal').value = item.jumlah_total;
      document.getElementById('editJumlahTersedia').value = item.jumlah_tersedia;
      document.getElementById('editMaksPinjam').value = item.maks_pinjam || 2;
      document.getElementById('editKondisi').value = item.kondisi;
      document.getElementById('editSpesifikasi').value = item.spesifikasi || '';

      if (item.foto) {
        document.getElementById('editPhotoPreview').src = '/storage/' + item.foto;
        document.getElementById('editPhotoPreview').style.display = 'block';
        document.getElementById('editPhotoPlaceholder').style.display = 'none';
      } else {
        document.getElementById('editPhotoPreview').style.display = 'none';
        document.getElementById('editPhotoPlaceholder').style.display = 'block';
      }

      document.getElementById('editModal').classList.add('active');
    }
    function closeEditModal() {
      document.getElementById('editModal').classList.remove('active');
    }

    // Modal 3: Detail Sarpras
    function openDetailModal(item) {
      document.getElementById('detailKode').textContent = item.kode_sarpras;
      document.getElementById('detailNama').textContent = item.nama_sarpras;
      document.getElementById('detailKondisiBadge').textContent = item.kondisi ? item.kondisi.charAt(0).toUpperCase() + item.kondisi.slice(1) : 'Baik';
      
      const badgeElem = document.getElementById('detailKondisiBadge');
      badgeElem.className = 'condition-badge condition-' + (item.kondisi || 'baik');

      const ruangNama = (item.ruangan && item.ruangan.nama_ruangan) ? item.ruangan.nama_ruangan : 'Ruang JTIK';
      const ruangPJ = (item.ruangan && item.ruangan.pj_ruangan) ? 'Penanggung Jawab: ' + item.ruangan.pj_ruangan : 'Penanggung Jawab: Koordinator Ruangan';
      
      document.getElementById('detailRuanganNama').textContent = ruangNama;
      document.getElementById('detailRuanganPJ').textContent = ruangPJ;
      document.getElementById('detailStokTotal').textContent = 'Jumlah: ' + item.jumlah_total + ' Unit Fisik Tercatat';
      document.getElementById('detailStokReady').textContent = 'Jumlah: ' + item.jumlah_tersedia + ' Unit Siap Dipinjam';
      document.getElementById('detailMaksPinjam').textContent = 'Maksimal ' + (item.maks_pinjam || 2) + ' Unit / Mahasiswa';
      document.getElementById('detailSpesifikasi').textContent = item.spesifikasi || 'Spesifikasi inventaris standar jurusan JTIK FT UNM.';

      if (item.foto) {
        document.getElementById('detailFoto').src = '/storage/' + item.foto;
        document.getElementById('detailFoto').style.display = 'block';
        document.getElementById('detailNoFoto').style.display = 'none';
      } else {
        document.getElementById('detailFoto').style.display = 'none';
        document.getElementById('detailNoFoto').style.display = 'block';
      }

      document.getElementById('detailModal').classList.add('active');
    }
    function closeDetailModal() {
      document.getElementById('detailModal').classList.remove('active');
    }

    // Modal 4: Hapus Sarpras
    function openDeleteModal(item) {
      document.getElementById('deleteSarprasForm').action = '/admin/sarpras/' + item.id;
      document.getElementById('deleteKodeSarpras').textContent = item.kode_sarpras;
      document.getElementById('deleteNamaSarpras').textContent = item.nama_sarpras;
      document.getElementById('deleteRuanganSarpras').textContent = (item.ruangan && item.ruangan.nama_ruangan) ? item.ruangan.nama_ruangan : 'Direktori Jurusan';
      document.getElementById('deleteStokSarpras').textContent = item.jumlah_total + ' Unit Fisik';
      document.getElementById('deleteModal').classList.add('active');
    }
    function closeDeleteModal() {
      document.getElementById('deleteModal').classList.remove('active');
    }

    // Modal 5: Cetak / Ekspor
    function openExportModal() {
      document.getElementById('exportModal').classList.add('active');
    }
    function closeExportModal() {
      document.getElementById('exportModal').classList.remove('active');
    }

    // Ekspor Data ke CSV/Excel dengan UTF-8 BOM
    function exportDataExcel() {
      let csvContent = "\uFEFF";
      csvContent += "KODE ASET,NAMA SARPRAS,RUANGAN PENEMPATAN,JUMLAH TOTAL,JUMLAH READY,KONDISI\r\n";

      @foreach($sarpras as $s)
        csvContent += '"{{ $s->kode_sarpras }}","{{ addslashes($s->nama_sarpras) }}","{{ $s->ruangan->nama_ruangan ?? '-' }}","{{ $s->jumlah_total }}","{{ $s->jumlah_tersedia }}","{{ strtoupper($s->kondisi) }}"\r\n';
      @endforeach

      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.setAttribute("href", url);
      link.setAttribute("download", "Rekapitulasi_Alat_Bahan_JTIK_{{ date('Y') }}.csv");
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);

      closeExportModal();
    }

    // Toggle User Profile Dropdown (Selaras Pengelola)
    function toggleUserDropdown(e) {
      if (e) e.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) {
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
      }
    }

    document.addEventListener('click', function(e) {
      const dropdown = document.getElementById('userDropdown');
      const btn = document.getElementById('adminBtn') || document.querySelector('.btn-header-admin') || document.querySelector('.badge-admin-role');
      if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
        dropdown.classList.remove('active');
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

    // Close modal on Escape key or backdrop click
    window.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAddModal();
        closeEditModal();
        closeDetailModal();
        closeDeleteModal();
        closeExportModal();
        closeProfileModal();
        closeChangePasswordModal();
      }
    });

    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
      overlay.addEventListener('click', function(e) {
        if (e.target === this) {
          closeAddModal();
          closeEditModal();
          closeDetailModal();
          closeDeleteModal();
          closeExportModal();
          closeProfileModal();
          closeChangePasswordModal();
        }
      });
    });

    // 3-Dots Action Dropdown Toggle (YouTube Style)
    function toggleActionMenu(event, btn) {
      event.stopPropagation();
      const wrap = btn.closest('.action-dropdown-wrap');
      const menu = wrap.querySelector('.action-dropdown-menu');
      const isOpen = menu.classList.contains('show');

      closeAllActionMenus();

      if (!isOpen) {
        btn.classList.add('active');
        const rect = btn.getBoundingClientRect();
        const spaceBelow = window.innerHeight - rect.bottom;
        if (spaceBelow < 160) {
          menu.classList.add('drop-up');
        } else {
          menu.classList.remove('drop-up');
        }
        menu.classList.add('show');
      }
    }

    function closeAllActionMenus() {
      document.querySelectorAll('.action-dropdown-menu.show').forEach(m => m.classList.remove('show'));
      document.querySelectorAll('.btn-action-dots.active').forEach(b => b.classList.remove('active'));
    }

    document.addEventListener('click', function(e) {
      if (!e.target.closest('.action-dropdown-wrap')) {
        closeAllActionMenus();
      }
    });

    @if($errors->any())
    // Otomatis tampilkan modal tambah jika terdapat error validasi
    window.addEventListener('DOMContentLoaded', function() {
      openAddModal();
    });
    @endif
  </script>


  @include('partials.ui_feedback')
</body>
</html>
