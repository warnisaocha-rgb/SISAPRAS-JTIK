<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Master Data Ruangan &amp; Lokasi - SI-SAPRAS JTIK FT UNM</title>
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

    /* Table Container Card (Disamakan persis dengan Alat dan Bahan) */
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

    /* Code Asset / Room (Clean bold Navy Blue font sesuai desain referensi) */
    .badge-asset-code {
      display: inline-block;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      font-weight: 800;
      color: #08296E;
      letter-spacing: -0.2px;
      text-align: center;
    }

    /* Name & Subtitle */
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

    /* Location Tag (Disamakan dengan Lokasi Rak di Alat dan Bahan) */
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

    /* Stacked Stock / Allocation Boxes */
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
    }

    .action-menu-danger {
      color: #DC2626;
    }

    .action-menu-danger:hover {
      background: #FEF2F2;
      color: #B91C1C;
    }

    .action-menu-divider {
      height: 1px;
      background: #E2E8F0;
      margin: 4px 0;
    }

    /* Table Footer Summary Card (Disamakan dengan Alat dan Bahan) */
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

    /* ========================================================================= */
    /* MODAL WINDOW SYSTEM (Disamakan dengan Alat dan Bahan)                     */
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
      max-width: 560px;
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
      width: 22px;
      height: 22px;
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
      height: 32px;
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

    .form-input-sm:focus, .form-select-sm:focus {
      border-color: var(--accent-blue);
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
      justify-content: space-between;
      align-items: center;
      gap: 8px;
      border-radius: 0 0 10px 10px;
    }

    .modal-footer-note {
      font-size: 9px;
      color: #94A3B8;
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
          <h1 class="page-title">Data Ruang &amp; Lokasi</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">Direktori ruangan teori, laboratorium komputer, bengkel, serta penanggung jawab</span>
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
          <div style="font-weight: 700; margin-bottom: 4px;"><span style="display:inline-flex;align-items:center;gap:6px;"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg><span>Perhatian:</span></span> Terdapat kesalahan saat menyimpan data ruangan:</div>
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
          <!-- Room Type Dropdown Pill -->
          <div class="pill-select-wrap">
            <select class="pill-filter-select" onchange="window.location.href='{{ route('admin.ruangan') }}?tipe=' + this.value + '&search={{ urlencode($search ?? '') }}'">
              <option value="all" {{ empty($tipeFilter) || $tipeFilter === 'all' ? 'selected' : '' }}>Semua Ruangan</option>
              <option value="bengkel" {{ ($tipeFilter ?? '') === 'bengkel' ? 'selected' : '' }}>Unit: Bengkel IT</option>
              <option value="lab" {{ ($tipeFilter ?? '') === 'lab' ? 'selected' : '' }}>Unit: Laboratorium</option>
              <option value="admin" {{ ($tipeFilter ?? '') === 'admin' ? 'selected' : '' }}>Unit: Administrasi</option>
            </select>
          </div>

          <!-- Search Input Form -->
          <form method="GET" action="{{ route('admin.ruangan') }}" class="toolbar-search-form">
            <input type="hidden" name="tipe" value="{{ $tipeFilter ?? 'all' }}">
            <div class="search-input-box">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kode ruang, nama ruangan, lokasi gedung, atau laboran...">
            </div>
          </form>
        </div>

        <!-- Add Button on the Right -->
        <div class="toolbar-right">
          <button type="button" class="btn-add-primary" onclick="openAddRuanganModal()">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Ruangan</span>
          </button>
        </div>
      </div>

      <!-- Master Data Table Container Card (Gaya sama persis dengan Alat dan Bahan) -->
      <div class="table-card">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 14%; text-align: center;">Kode Ruang</th>
              <th style="width: 18%;">Unit &amp; Ruangan</th>
              <th style="width: 22%;">Lokasi Gedung</th>
              <th style="width: 22%;">Penanggung Jawab (Laboran)</th>
              <th style="width: 12%; text-align: center;">Alokasi Aset</th>
              <th style="width: 6%; text-align: center;">Kondisi</th>
              <th style="width: 6%; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($ruangans as $r)
            @php
              $badgeClass = 'room-badge-lab';
              $kodeR = $r->kode_ruangan ?? '';
              $namaR = $r->nama_ruangan ?? '';
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
                <span class="badge-asset-code">{{ $r->kode_ruangan }}</span>
              </td>
              <td>
                <span class="room-badge {{ $badgeClass }}">{{ $r->nama_ruangan }}</span>
              </td>
              <td>
                <div class="rack-label-tag">Lokasi Gedung:</div>
                <div class="rack-location-title">
                  {{ $r->lokasi_gedung ?: 'Gedung A (Lab Terpadu JTIK)' }}
                </div>
              </td>
              <td>
                <div class="asset-name-title">{{ $r->pj_ruangan ?? 'Penanggung Jawab Belum Diatur' }}</div>
                <div class="asset-spec-text" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11.5px; font-weight: 500;">
                  {{ $r->nip_pj ?: 'NIP. 19850314 201212 1 001' }}
                </div>
                <div style="font-size: 11.5px; color: #0284C7; font-weight: 600; margin-top: 1px;">
                  {{ $r->role_pj ?: 'Laboran Penanggung Jawab' }}
                </div>
              </td>
              <td style="text-align: center;">
                <div class="stock-stack">
                  <span class="stock-box-total">Aset: {{ $r->sarpras_count ?? 0 }}</span>
                  <span class="stock-box-ready">Aktif</span>
                </div>
              </td>
              <td style="text-align: center;">
                <span class="condition-badge condition-baik">Baik</span>
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
                    <button type="button" class="action-menu-item" onclick='closeAllActionMenus(); openDetailRuanganModal({!! htmlspecialchars(json_encode($r), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                      <span>Lihat Detail</span>
                    </button>
                    <button type="button" class="action-menu-item" onclick='closeAllActionMenus(); openEditRuanganModal({!! htmlspecialchars(json_encode($r), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      <span>Edit Data</span>
                    </button>
                    <div class="action-menu-divider"></div>
                    <button type="button" class="action-menu-item action-menu-danger" onclick='closeAllActionMenus(); openDeleteRuanganModal({!! htmlspecialchars(json_encode($r), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                      <span>Hapus Data</span>
                    </button>
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align:center; padding: 28px; color:#64748B; font-size: 11px;">
                Belum ada data master ruangan pada kriteria filter ini. Klik "+ Tambah Ruangan" untuk menambahkan.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 1: TAMBAH MASTER RUANGAN BARU                                     -->
  <!-- ======================================================================= -->
  <div id="addModal" class="modal-overlay">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon">+</div>
          <div class="modal-title-text">Master Ruangan Baru</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeAddRuanganModal()">&times;</button>
      </div>

      <form action="{{ route('admin.ruangan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="jenis_ruangan" value="alat_bahan">
        <div class="modal-body">
          <div class="form-group-sm">
            <label class="form-label-sm">Kode Ruangan: <span class="req">*</span></label>
            <input type="text" name="kode_ruangan" value="{{ old('kode_ruangan') }}" class="form-input-sm" placeholder="Contoh: RNG-LIT-04 / RNG-LAB-04" required>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Nama Ruangan / Otoritas: <span class="req">*</span></label>
            <input type="text" name="nama_ruangan" value="{{ old('nama_ruangan') }}" class="form-input-sm" placeholder="Contoh: Lab Multimedia / Lab Jaringan" required>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Lokasi Gedung: <span class="req">*</span></label>
            <input type="text" name="lokasi_gedung" value="{{ old('lokasi_gedung') }}" class="form-input-sm" placeholder="Contoh: Gedung A (Lab Terpadu JTIK)" required>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Penanggung Jawab (Laboran): <span class="req">*</span></label>
            <input type="text" name="pj_ruangan" value="{{ old('pj_ruangan') }}" class="form-input-sm" placeholder="Contoh: Sulaeman, S.T. / Hendra Pratama, S.Pd., M.T." required>
          </div>
        </div>

        <div class="modal-footer">
          <span class="modal-footer-note">Form direktori master ruangan jurusan JTIK</span>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-modal-cancel" onclick="closeAddRuanganModal()">Batal</button>
            <button type="submit" class="btn-modal-submit">Tambah Ruangan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 2: EDIT DATA RUANGAN & LOKASI                                     -->
  <!-- ======================================================================= -->
  <div id="editModal" class="modal-overlay">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#FEF3C7; color:#B45309;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
          <div class="modal-title-text">Data Ruangan &amp; Lokasi</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeEditRuanganModal()">&times;</button>
      </div>

      <form id="editRuanganForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group-sm">
            <label class="form-label-sm">Kode Ruangan (Read-Only):</label>
            <div style="position: relative; display: flex; align-items: center;">
              <input type="text" id="editKodeRuangan" class="form-input-sm" style="background:#F1F5F9; color:#0F172A; font-weight:700; font-family:'JetBrains Mono', monospace; padding-right: 75px;" readonly>
              <span style="position: absolute; right: 8px; background: #E2E8F0; color: #475569; font-size: 11.5px; font-weight: 700; padding: 2px 7px; border-radius: 4px;">Terkunci</span>
            </div>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Nama Ruangan / Laboratorium: <span class="req">*</span></label>
            <input type="text" name="nama_ruangan" id="editNamaRuangan" class="form-input-sm" required>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Lokasi Gedung: <span class="req">*</span></label>
            <input type="text" name="lokasi_gedung" id="editLokasiGedung" class="form-input-sm" required>
          </div>

          <div class="form-group-sm">
            <label class="form-label-sm">Penanggung Jawab (Laboran): <span class="req">*</span></label>
            <input type="text" name="pj_ruangan" id="editPjRuangan" class="form-input-sm" required>
          </div>
        </div>

        <div class="modal-footer">
          <span class="modal-footer-note">Perubahan direktori master tersinkronisasi otomatis</span>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-modal-cancel" onclick="closeEditRuanganModal()">Batal</button>
            <button type="submit" class="btn-modal-submit">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 3: DETAIL DATA RUANGAN & LOKASI                                   -->
  <!-- ======================================================================= -->
  <div id="detailModal" class="modal-overlay">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#E0F2FE; color:#0369A1;">ℹ️</div>
          <div class="modal-title-text">Spesifikasi Ruangan &amp; Lokasi</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeDetailRuanganModal()">&times;</button>
      </div>

      <div class="modal-body">
        <div style="display: flex; gap: 14px; align-items: center; border-bottom: 1px solid var(--border-subtle); padding-bottom: 12px;">
          <div style="width: 56px; height: 56px; border-radius: 8px; border: 1.5px solid var(--border-color); background: #F8FAFC; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--primary-navy);">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <rect x="4" y="2" width="16" height="20" rx="2" ry="2"/>
              <path d="M9 22v-4h6v4"/>
              <path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/>
              <path d="M8 10h.01"/><path d="M16 10h.01"/><path d="M12 10h.01"/>
              <path d="M8 14h.01"/><path d="M16 14h.01"/><path d="M12 14h.01"/>
            </svg>
          </div>
          <div>
            <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
              <span id="detailKodeRuangan" class="badge-asset-code" style="font-size: 11.5px;">-</span>
              <span id="detailBadgeRuangan" class="room-badge room-badge-lab" style="font-size: 11.5px; padding: 2px 10px;">RUANGAN</span>
            </div>
            <h3 id="detailNamaRuangan" style="font-size: 13px; font-weight: 800; color: #0F172A; margin: 0 0 4px 0;">-</h3>
            <span class="condition-badge condition-baik">Status: Tersedia &amp; Aktif</span>
          </div>
        </div>

        <div class="detail-info-grid">
          <div class="detail-card-box">
            <span class="detail-card-title">Lokasi Lantai &amp; Gedung</span>
            <div id="detailLokasiGedung" class="detail-card-val">-</div>
            <div class="detail-card-sub">Gedung Jurusan JTIK FT UNM</div>
          </div>

          <div class="detail-card-box">
            <span class="detail-card-title">Penanggung Jawab (Laboran)</span>
            <div id="detailPjRuangan" class="detail-card-val">-</div>
            <div id="detailNipPj" class="detail-card-sub">-</div>
          </div>

          <div class="detail-card-box">
            <span class="detail-card-title">Jabatan / Otoritas Unit</span>
            <div id="detailRolePj" class="detail-card-val" style="color: #0284C7;">-</div>
            <div class="detail-card-sub">Otoritas verifikasi sarana &amp; prasarana</div>
          </div>

          <div class="detail-card-box" style="background: #F0FDF4; border: 1px solid #86EFAC;">
            <span class="detail-card-title" style="color:var(--success-green);">Total Inventaris Teralokasi</span>
            <div id="detailJumlahSarpras" style="font-size: 11px; font-weight: 800; color: var(--success-green); font-family:'Plus Jakarta Sans', sans-serif;">0 Komoditas Sarpras</div>
            <div class="detail-card-sub" style="color:#166534;">Terhubung dengan katalog Alat, Bahan &amp; Sarana</div>
          </div>
        </div>
      </div>

      <div class="modal-footer" style="justify-content: flex-end;">
        <button type="button" class="btn-modal-submit" onclick="closeDetailRuanganModal()">Tutup</button>
      </div>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 4: KONFIRMASI HAPUS RUANGAN                                       -->
  <!-- ======================================================================= -->
  <div id="deleteModal" class="modal-overlay">
    <div class="modal-card" style="max-width: 480px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#FEE2E2; color:#DC2626; width:26px; height:26px; border-radius:6px; display:flex; align-items:center; justify-content:center;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
          <div class="modal-title-text" style="font-size: 13px;">Hapus Ruangan</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeDeleteRuanganModal()">&times;</button>
      </div>

      <form id="deleteRuanganForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body" style="padding: 20px 22px; gap: 14px;">
          <div style="text-align: center;">
            <span style="display:inline-block; padding: 4px 14px; background:#FEE2E2; color:#DC2626; border-radius:6px; font-size: 12px; font-weight:700;">
              Peringatan: Hapus Ruangan
            </span>
          </div>

          <h3 style="text-align: center; font-size: 14px; font-weight: 800; color: #0F172A; margin: 2px 0;">
            Yakin Ingin Menghapus Ruangan Ini?
          </h3>

          <p style="text-align: center; font-size: 11px; color: #64748B; margin-top: -6px;">
            Tindakan ini akan menghapus data master ruangan dari direktori jurusan.
          </p>

          <!-- Dashed Info Box (Sama dengan Alat dan Bahan) -->
          <div style="background: #F8FAFC; border: 1.5px dashed #CBD5E1; border-radius: 8px; padding: 12px 16px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <span id="deleteKodeRuangan" class="badge-asset-code" style="font-size: 12px;">-</span>
              <div>
                <div id="deleteNamaRuangan" style="font-size: 11.5px; font-weight: 700; color: #0F172A;">-</div>
                <div id="deletePjRuangan" style="font-size: 12px; color: #64748B;">-</div>
              </div>
            </div>
            <div id="deleteCountSarpras" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11.5px; font-weight: 700; color: #08296E; white-space: nowrap;">-</div>
          </div>

          <div class="modal-alert-box">
            <ul class="modal-alert-list">
              <li>Seluruh inventaris yang dialokasikan di ruangan ini perlu dipindahkan ke ruangan lain.</li>
              <li>Perubahan alokasi ruangan akan langsung diperbarui dalam sistem.</li>
            </ul>
          </div>
        </div>

        <div class="modal-footer">
          <span class="modal-footer-note">Tindakan penghapusan bersifat permanen</span>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-modal-cancel" onclick="closeDeleteRuanganModal()">Batal</button>
            <button type="submit" class="btn-modal-danger">Hapus</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- ======================================================================= -->
  <!-- MODAL 5: CETAK / EKSPOR REKAPITULASI (Gaya Alat dan Bahan)              -->
  <!-- ======================================================================= -->
  <div id="exportModal" class="modal-overlay">
    <div class="modal-card" style="max-width: 480px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <div class="modal-title-icon" style="background:#DCFCE7; color:#16A34A; width:26px; height:26px; border-radius:6px; display:flex; align-items:center; justify-content:center;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
          <div class="modal-title-text" style="font-size: 13px;">Rekapitulasi Sarpras &amp; Ruangan</div>
        </div>
        <button type="button" class="modal-close-btn" onclick="closeExportModal()">&times;</button>
      </div>

      <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 12px;">
        <p style="font-size: 11px; color: #64748B; margin: 0; line-height: 1.4;">
          Silakan pilih format laporan direktori ruangan dan alokasi aset yang ingin dicetak atau diunduh:
        </p>

        <div class="file-export-card">
          <div class="file-export-icon">XLS</div>
          <div class="file-export-info">
            <div class="file-export-name">Rekapitulasi_Ruangan_JTIK_{{ date('Y') }}.xlsx</div>
            <div class="file-export-size">Tahun Akademik {{ date('Y') }}/{{ date('Y')+1 }} | Format Spreadsheet Excel</div>
          </div>
          <span style="font-size: 12px; color: #64748B; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif;">48 KB</span>
        </div>

        <!-- 2 Column Stat Cards -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 12px;">
            <div style="font-size: 11.5px; font-weight: 700; color: #64748B; ">Total Ruangan</div>
            <div style="font-size: 11.5px; font-weight: 700; color: #08296E; margin-top: 2px;">{{ $totalRuangan }} Unit Ruangan</div>
          </div>
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 12px;">
            <div style="font-size: 11.5px; font-weight: 700; color: #64748B; ">Aset Teralokasi</div>
            <div style="font-size: 11.5px; font-weight: 700; color: #16A34A; margin-top: 2px;">{{ $sarpras->count() }} Komoditas Sarpras</div>
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

  <script>
    // Profile Dropdown (Selaras Pengelola)
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

    // Modal 1: Tambah Ruangan
    function openAddRuanganModal() {
      document.getElementById('addModal').classList.add('active');
    }
    function closeAddRuanganModal() {
      document.getElementById('addModal').classList.remove('active');
    }

    // Modal 2: Edit Ruangan
    function openEditRuanganModal(room) {
      document.getElementById('editRuanganForm').action = '/admin/ruangan/' + room.id;
      document.getElementById('editKodeRuangan').value = room.kode_ruangan;
      document.getElementById('editNamaRuangan').value = room.nama_ruangan;
      document.getElementById('editLokasiGedung').value = room.lokasi_gedung || '';
      document.getElementById('editPjRuangan').value = room.pj_ruangan || '';

      document.getElementById('editModal').classList.add('active');
    }
    function closeEditRuanganModal() {
      document.getElementById('editModal').classList.remove('active');
    }

    // Modal 3: Detail Ruangan
    function openDetailRuanganModal(room) {
      document.getElementById('detailKodeRuangan').textContent = room.kode_ruangan || '-';
      document.getElementById('detailNamaRuangan').textContent = room.nama_ruangan || '-';
      document.getElementById('detailLokasiGedung').textContent = room.lokasi_gedung || 'Gedung A (Lab Terpadu JTIK)';
      document.getElementById('detailPjRuangan').textContent = room.pj_ruangan || 'Penanggung Jawab Belum Diatur';
      document.getElementById('detailNipPj').textContent = room.nip_pj || 'NIP. 19850314 201212 1 001';
      document.getElementById('detailRolePj').textContent = room.role_pj || 'Laboran Penanggung Jawab';
      document.getElementById('detailJumlahSarpras').textContent = (room.sarpras_count || 0) + ' Komoditas Sarpras Terdaftar';

      const badge = document.getElementById('detailBadgeRuangan');
      badge.textContent = room.nama_ruangan || 'RUANGAN';
      const kodeR = (room.kode_ruangan || '').toUpperCase();
      const namaR = (room.nama_ruangan || '').toUpperCase();
      if (kodeR.includes('BENGKEL') || kodeR.includes('BKL') || namaR.includes('BENGKEL')) {
        badge.className = 'room-badge room-badge-bkl';
      } else if (kodeR.includes('ADMIN') || kodeR.includes('ADM') || namaR.includes('ADMIN') || namaR.includes('JTIK')) {
        badge.className = 'room-badge room-badge-adm';
      } else {
        badge.className = 'room-badge room-badge-lab';
      }

      document.getElementById('detailModal').classList.add('active');
    }
    function closeDetailRuanganModal() {
      document.getElementById('detailModal').classList.remove('active');
    }

    // Modal 4: Hapus Ruangan
    function openDeleteRuanganModal(room) {
      document.getElementById('deleteRuanganForm').action = '/admin/ruangan/' + room.id;
      document.getElementById('deleteNamaRuangan').textContent = room.nama_ruangan;
      document.getElementById('deleteKodeRuangan').textContent = room.kode_ruangan;
      document.getElementById('deletePjRuangan').textContent = 'PJ: ' + (room.pj_ruangan || 'Laboran JTIK');
      document.getElementById('deleteCountSarpras').textContent = (room.sarpras_count || 0) + ' Aset';

      document.getElementById('deleteModal').classList.add('active');
    }
    function closeDeleteRuanganModal() {
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
      csvContent += "KODE RUANG,NAMA RUANGAN,LOKASI GEDUNG,PENANGGUNG JAWAB,NIP PJ,JABATAN,TOTAL ASET\r\n";

      @foreach($ruangans as $r)
        csvContent += '"{{ $r->kode_ruangan }}","{{ addslashes($r->nama_ruangan) }}","{{ addslashes($r->lokasi_gedung ?? '-') }}","{{ addslashes($r->pj_ruangan ?? '-') }}","{{ addslashes($r->nip_pj ?? '-') }}","{{ addslashes($r->role_pj ?? '-') }}","{{ $r->sarpras_count ?? 0 }}"\r\n';
      @endforeach

      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.setAttribute("href", url);
      link.setAttribute("download", "Rekapitulasi_Ruangan_JTIK_{{ date('Y') }}.csv");
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);

      closeExportModal();
    }

    // Close on Escape or overlay click
    window.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAddRuanganModal();
        closeEditRuanganModal();
        closeDetailRuanganModal();
        closeDeleteRuanganModal();
        closeExportModal();
      }
    });

    document.querySelectorAll('.modal-overlay').forEach(overlay => {
      overlay.addEventListener('click', function(e) {
        if (e.target === this) {
          this.classList.remove('active');
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

    @if(isset($errors) && $errors->any())
    window.addEventListener('DOMContentLoaded', function() {
      openAddRuanganModal();
    });
    @endif
  </script>

  @include('partials.ui_feedback')
</body>
</html>
