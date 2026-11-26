<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akun &amp; Monitoring Login - SI-SAPRAS JTIK FT UNM</title>
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
      padding: 16px 20px;
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
      gap: 12px;
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

    /* Alert Banner Messages */
    .alert-success-banner {
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
      color: var(--success-green);
      padding: 9px 12px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 600;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .alert-danger-banner {
      background: #FEF2F2;
      border: 1px solid #FECACA;
      color: var(--danger-red);
      padding: 9px 12px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 600;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* Filter & Search Bar Row */
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
      display: inline-block;
      line-height: 32px;
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

    /* Table Container Card */
    .table-card {
      background: #FFFFFF;
      border: 1px solid var(--border-subtle);
      border-radius: 8px;
      overflow-x: auto;
      box-shadow: 0 1px 3px rgba(0,0,0,0.02);
      margin-bottom: 12px;
      width: 100%;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 11px;
    }

    .data-table thead th {
      background: #F8FAFC;
      color: #334155;
      font-weight: 800;
      font-size: 10.5px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 10px 12px;
      border-bottom: 1.5px solid var(--border-color);
      border-right: 1px solid var(--border-subtle);
    }

    .data-table thead th:last-child {
      border-right: none;
    }

    .data-table tbody td {
      padding: 11px 12px;
      border-bottom: 1px solid var(--border-subtle);
      border-right: 1px solid #F1F5F9;
      vertical-align: middle;
    }

    .data-table tbody td:last-child {
      border-right: none;
    }

    .data-table tbody tr:hover {
      background-color: #F8FAFC;
    }

    /* Code Asset / Nomor Induk (Clean bold Navy Blue font sesuai desain referensi) */
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
      color: #64748B;
      line-height: 1.35;
    }

    /* Unit & Ruangan Text (Langsung Tulisan Rapi Tanpa Fill Badge) */
    .room-badge, .room-unit-text {
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
    .room-badge-lab, .room-unit-lab {
      color: #0284C7 !important;
      font-weight: 700;
    }
    .room-badge-bkl, .room-unit-bkl {
      color: #334155 !important;
      font-weight: 700;
    }
    .room-badge-adm, .room-unit-adm {
      color: #D97706 !important;
      font-weight: 700;
    }
    .room-badge-all, .room-unit-all {
      color: #64748B !important;
      font-weight: 500;
      font-size: 11px;
    }

    /* Role Badges */
    .role-badge {
      display: inline-block;
      padding: 3px 12px;
      border-radius: 9999px;
      font-size: 10.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      white-space: nowrap;
    }
    .role-badge-admin {
      background: #FEF3C7;
      border: 1px solid #FDE68A;
      color: #B45309;
    }
    .role-badge-pengelola {
      background: #E0F2FE;
      border: 1px solid #BAE6FD;
      color: #0284C7;
    }
    .role-badge-mahasiswa {
      background: #DCFCE7;
      border: 1px solid #BBF7D0;
      color: #15803D;
    }

    /* Condition / Status Badge */
    .condition-badge {
      display: inline-block;
      padding: 2.5px 8px;
      border-radius: 4px;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      margin-top: 3px;
    }
    .condition-baik { background: #DCFCE7; color: #15803D; border: 1px solid #BBF7D0; }

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

    /* Table Footer / Summary Card */
    .table-footer-card {
      background: #FFFFFF;
      border: 1px solid var(--border-subtle);
      border-radius: 8px;
      padding: 10px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .rekap-title {
      font-size: 11px;
      font-weight: 700;
      color: var(--primary-navy);
    }

    .rekap-desc {
      font-size: 9.5px;
      color: var(--text-muted);
      margin-top: 1px;
    }

    .btn-print-rekap-orange {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #ED7411;
      color: #FFFFFF;
      border: none;
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 10px;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.15s ease;
    }

    .btn-print-rekap-orange:hover {
      background: #D9650A;
    }

    /* Modal Component System */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(2px);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 999;
      padding: 20px;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal-card {
      background: #FFFFFF;
      border-radius: 10px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      overflow: hidden;
      animation: modalFadeIn 0.2s ease-out;
    }

    @keyframes modalFadeIn {
      from { opacity: 0; transform: scale(0.97); }
      to { opacity: 1; transform: scale(1); }
    }

    .modal-header {
      padding: 12px 18px;
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
      border-radius: 4px;
      background: #E0F2FE;
      color: #0284C7;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 800;
    }

    .modal-title-text {
      font-size: 12.5px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.2px;
    }

    .modal-close-btn {
      background: none;
      border: none;
      color: #94A3B8;
      cursor: pointer;
      font-size: 14px;
      font-weight: 700;
      padding: 4px;
    }
    .modal-close-btn:hover {
      color: #0F172A;
    }

    .modal-body {
      padding: 18px;
      max-height: 80vh;
      overflow-y: auto;
    }

    .modal-footer {
      padding: 12px 18px;
      border-top: 1px solid var(--border-subtle);
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #F8FAFC;
    }

    .modal-footer-note {
      font-size: 9.5px;
      color: #64748B;
      font-style: italic;
    }

    .form-group-sm {
      margin-bottom: 12px;
    }

    .form-group-sm:last-child {
      margin-bottom: 0;
    }

    .form-label-sm {
      display: block;
      font-size: 10px;
      font-weight: 700;
      color: #334155;
      margin-bottom: 4px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .form-label-sm .req {
      color: #DC2626;
    }

    .form-input-sm, .form-select-sm {
      width: 100%;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      padding: 6px 10px;
      font-size: 11px;
      font-family: inherit;
      color: var(--text-dark);
      outline: none;
      background: #FFFFFF;
      transition: border-color 0.15s ease;
    }

    .form-input-sm:focus, .form-select-sm:focus {
      border-color: #0091FF;
      box-shadow: 0 0 0 2px rgba(0, 145, 255, 0.15);
    }

    .form-row-2col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .btn-modal-cancel {
      padding: 6px 14px;
      border: 1px solid var(--border-color);
      background: #FFFFFF;
      color: #475569;
      font-size: 10.5px;
      font-weight: 700;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-modal-cancel:hover {
      background: #F1F5F9;
    }

    .btn-modal-submit {
      padding: 6px 16px;
      border: none;
      background: #08296E;
      color: #FFFFFF;
      font-size: 10.5px;
      font-weight: 700;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-modal-submit:hover {
      background: #061F56;
    }

    .btn-modal-danger {
      padding: 6px 16px;
      border: none;
      background: #DC2626;
      color: #FFFFFF;
      font-size: 10.5px;
      font-weight: 700;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-modal-danger:hover {
      background: #B91C1C;
    }

    /* Modal Ekspor Card */
    .file-export-card {
      background: #FFFFFF;
      border: 1.5px solid #CBD5E1;
      border-radius: 8px;
      padding: 12px 14px;
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 12px 0;
    }

    .file-export-icon {
      width: 34px;
      height: 38px;
      background: #16A34A;
      color: #FFFFFF;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 11px;
      letter-spacing: 0.5px;
    }

    .file-export-info {
      flex: 1;
    }

    .file-export-name {
      font-size: 11.5px;
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

    /* Unified Section Headers, ACC Pengelola Queue & Monitoring Riwayat Login */
    .unified-section-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      margin-bottom: 10px;
    }
    .unified-section-title {
      font-size: 15px;
      font-weight: 800;
      color: #08296E;
      letter-spacing: -0.2px;
    }
    .unified-section-sub {
      font-size: 12px;
      color: #64748B;
      margin-top: 2px;
    }
    .unified-section-divider {
      margin-top: 26px;
      padding-top: 20px;
      border-top: 1px solid #E2E8F0;
    }
    .section-stat-pills {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .section-stat-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 5px 10px;
      border-radius: 6px;
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      font-size: 11.5px;
      font-weight: 600;
      color: #475569;
    }
    .section-stat-pill strong {
      font-weight: 800;
      color: #08296E;
    }
    .section-stat-pill.stat-ok strong { color: #15803D; }
    .section-stat-pill.stat-warn strong { color: #B91C1C; }
    .pending-queue-card {
      background: #FFFFFF;
      border: 1px solid #FED7AA;
      border-left: 4px solid #EA580C;
      border-radius: 10px;
      padding: 14px 16px;
      margin-bottom: 14px;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }
    .pending-queue-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 10px;
      flex-wrap: wrap;
    }
    .pending-queue-title {
      font-size: 13.5px;
      font-weight: 800;
      color: #9A3412;
    }
    .pending-queue-sub {
      font-size: 12px;
      color: #64748B;
      margin-top: 2px;
    }
    .pending-queue-list {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .pending-queue-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 10px 12px;
      background: #FFF7ED;
      border: 1px solid #FFEDD5;
      border-radius: 8px;
      flex-wrap: wrap;
    }
    .pending-item-meta {
      font-size: 12px;
      color: #334155;
      line-height: 1.45;
    }
    .pending-item-meta strong {
      color: #0F172A;
      font-size: 13px;
    }
    .account-status-badge,
    .log-status-badge {
      display: inline-block;
      padding: 4px 9px;
      border-radius: 5px;
      font-size: 11px;
      font-weight: 700;
      border: 1px solid transparent;
      white-space: nowrap;
    }
    .status-aktif,
    .log-berhasil { background: #ECFDF5; color: #065F46; border-color: #A7F3D0; }
    .status-menunggu_acc,
    .log-menunggu_acc { background: #FFFBEB; color: #92400E; border-color: #FDE68A; }
    .status-nonaktif,
    .log-nonaktif { background: #F1F5F9; color: #475569; border-color: #CBD5E1; }
    .status-ditolak,
    .log-ditolak,
    .log-gagal { background: #FEF2F2; color: #B91C1C; border-color: #FECACA; }
    .log-terkunci { background: #FFF1F2; color: #9F1239; border-color: #FECDD3; }
    .row-action-group {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      flex-wrap: wrap;
    }
    .btn-acc-approve {
      background: #15803D;
      color: #FFFFFF;
      border: 1px solid #15803D;
      padding: 6px 11px;
      border-radius: 6px;
      font-size: 11.5px;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
    }
    .btn-acc-approve:hover { background: #166534; }
    .btn-acc-reject {
      background: #FFFFFF;
      color: #B91C1C;
      border: 1px solid #FCA5A5;
      padding: 6px 11px;
      border-radius: 6px;
      font-size: 11.5px;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
    }
    .btn-acc-reject:hover { background: #FEF2F2; }
    .btn-row-status {
      background: #F8FAFC;
      color: #334155;
      border: 1px solid #CBD5E1;
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 11.5px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
    }
    .btn-row-status:hover {
      background: #EFF6FF;
      color: #08296E;
      border-color: #93C5FD;
    }
    .btn-row-history {
      display: inline-flex;
      align-items: center;
      background: #EFF6FF;
      color: #08296E;
      border: 1px solid #BFDBFE;
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 11.5px;
      font-weight: 700;
      text-decoration: none;
    }
    .btn-row-history:hover {
      background: #08296E;
      color: #FFFFFF;
      border-color: #08296E;
    }
    .log-stat-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      margin-bottom: 14px;
    }
    .log-stat-card {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 10px;
      padding: 12px 16px;
    }
    .log-stat-label {
      font-size: 11.5px;
      font-weight: 600;
      color: #64748B;
      margin-bottom: 4px;
    }
    .log-stat-value {
      font-size: 22px;
      font-weight: 800;
      color: #08296E;
    }
    .active-user-filter-chip {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      background: #EFF6FF;
      border: 1px solid #BFDBFE;
      border-radius: 8px;
      padding: 9px 14px;
      margin-bottom: 12px;
      font-size: 12px;
      color: #1E3A8A;
      flex-wrap: wrap;
    }
    @media (max-width: 768px) {
      .log-stat-grid {
        grid-template-columns: 1fr;
      }
      .row-action-group {
        width: 100%;
        justify-content: flex-start;
      }
      .row-action-group > form {
        flex: 1 1 110px;
        display: flex;
      }
      .btn-acc-approve,
      .btn-acc-reject,
      .btn-row-status,
      .btn-row-history {
        min-height: 36px;
        flex: 1 1 auto;
        justify-content: center;
      }
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
          <h1 class="page-title">Akun &amp; Monitoring Login</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">ACC pendaftaran Pengelola &amp; monitoring riwayat login</span>
        </div>
        <div class="header-right">
          <!-- Admin Profile Pill -->
          <div style="position: relative;">
            <button type="button" id="adminBtn" class="btn-header-admin" onclick="toggleUserDropdown(event)" title="Menu Akun Administrator">
              <span>Admin</span>
              <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>

            <div id="userDropdown" class="user-dropdown-panel" style="display: none;">
              <div class="user-dropdown-header-card" onclick="openProfileModal()" title="Klik untuk lihat / ubah Profil">
                <div class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <div style="flex: 1; min-width: 0;">
                  <div class="user-dropdown-name">{{ Auth::user()->name ?? 'Administrator' }}</div>
                  <div class="user-dropdown-email">{{ Auth::user()->email ?? 'admin.sarpras@unm.ac.id' }}</div>
                  <div class="user-dropdown-tag">Administrator Sarpras</div>
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

      <!-- Pemberitahuan Antrean ACC Pendaftaran Pengelola Baru -->
      @if(isset($pendingPengelolas) && $pendingPengelolas->count() > 0)
      <div class="pending-queue-card">
        <div class="pending-queue-header">
          <div>
            <div class="pending-queue-title">Pemberitahuan Pendaftaran Pengelola Baru ({{ $pendingPengelolas->count() }} Menunggu ACC)</div>
            <div class="pending-queue-sub">Tinjau data pendaftar di bawah ini sebelum menyetujui (ACC) akses Pengelola ke sistem.</div>
          </div>
        </div>

        <div class="pending-queue-list">
          @foreach($pendingPengelolas as $pending)
          <div class="pending-queue-item">
            <div class="pending-item-meta">
              <strong>{{ $pending->name }}</strong>
              <div>NIP: {{ $pending->nomor_induk }} | Email: {{ $pending->email }}</div>
              <div>Unit: {{ $pending->ruangan?->nama_ruangan ?? '-' }} | Jabatan: {{ $pending->jabatan ?: 'Pengelola Sarpras' }} | Daftar: {{ $pending->created_at?->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA</div>
            </div>
            <div class="row-action-group">
              <form action="{{ route('admin.users.approve', $pending->id) }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-acc-approve" onclick="return confirmUserAction(event, this.form, 'Setujui (ACC) Pengelola', 'Setujui akun Pengelola atas nama {{ addslashes($pending->name) }} agar dapat masuk ke sistem?', 'Ya, ACC Akun', false)">ACC Pengelola</button>
              </form>
              <form action="{{ route('admin.users.reject', $pending->id) }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-acc-reject" onclick="return confirmUserAction(event, this.form, 'Tolak Pendaftaran Pengelola', 'Tolak pendaftaran Pengelola atas nama {{ addslashes($pending->name) }}?', 'Ya, Tolak', true)">Tolak</button>
              </form>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      <!-- BAGIAN 1: DAFTAR AKUN PENGGUNA -->
      <section>
        <div class="unified-section-head">
          <div>
            <div class="unified-section-title">Daftar Akun Pengguna</div>
            <div class="unified-section-sub">Kelola persetujuan ACC Pengelola, status aktif akun, dan pantau login terakhir setiap pengguna.</div>
          </div>
          <div class="section-stat-pills">
            <span class="section-stat-pill">Total Akun: <strong>{{ $totalUsers }}</strong></span>
            <span class="section-stat-pill">Pengelola: <strong>{{ $totalPengelola }}</strong></span>
            <span class="section-stat-pill">Mahasiswa: <strong>{{ $totalMahasiswa }}</strong></span>
          </div>
        </div>

        <!-- Filter Toolbar Akun -->
        <div class="toolbar-row">
          <div class="toolbar-left">
            <div class="pill-select-wrap">
              <select id="filterRole" class="pill-filter-select" onchange="applyAccountFilters()">
                <option value="all" {{ empty($roleFilter) || $roleFilter === 'all' ? 'selected' : '' }}>Semua Role ({{ $totalUsers }})</option>
                <option value="pengelola" {{ ($roleFilter ?? '') === 'pengelola' ? 'selected' : '' }}>Role: Pengelola ({{ $totalPengelola }})</option>
                <option value="admin" {{ ($roleFilter ?? '') === 'admin' ? 'selected' : '' }}>Role: Admin ({{ $totalAdmin }})</option>
                <option value="mahasiswa" {{ ($roleFilter ?? '') === 'mahasiswa' ? 'selected' : '' }}>Role: Mahasiswa ({{ $totalMahasiswa }})</option>
              </select>
            </div>

            <div class="pill-select-wrap">
              <select id="filterStatus" class="pill-filter-select" onchange="applyAccountFilters()">
                <option value="all" {{ empty($statusFilter) || $statusFilter === 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="menunggu_acc" {{ ($statusFilter ?? '') === 'menunggu_acc' ? 'selected' : '' }}>Status: Menunggu ACC</option>
                <option value="aktif" {{ ($statusFilter ?? '') === 'aktif' ? 'selected' : '' }}>Status: Aktif</option>
                <option value="nonaktif" {{ ($statusFilter ?? '') === 'nonaktif' ? 'selected' : '' }}>Status: Nonaktif</option>
                <option value="ditolak" {{ ($statusFilter ?? '') === 'ditolak' ? 'selected' : '' }}>Status: Ditolak</option>
              </select>
            </div>

            <div class="pill-select-wrap">
              <select id="filterUnit" class="pill-filter-select" onchange="applyAccountFilters()">
                <option value="all" {{ empty($unitFilter) || $unitFilter === 'all' ? 'selected' : '' }}>Semua Unit</option>
                <option value="bengkel" {{ ($unitFilter ?? '') === 'bengkel' ? 'selected' : '' }}>Unit: Bengkel IT</option>
                <option value="lab" {{ ($unitFilter ?? '') === 'lab' ? 'selected' : '' }}>Unit: Laboratorium</option>
                <option value="admin" {{ ($unitFilter ?? '') === 'admin' ? 'selected' : '' }}>Unit: Administrasi</option>
              </select>
            </div>

            <form id="searchForm" method="GET" action="{{ route('admin.users') }}" class="toolbar-search-form">
              <input type="hidden" name="role" value="{{ $roleFilter ?? 'all' }}">
              <input type="hidden" name="status" value="{{ $statusFilter ?? 'all' }}">
              <input type="hidden" name="unit" value="{{ $unitFilter ?? 'all' }}">
              <div class="search-input-box">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
                  <circle cx="11" cy="11" r="8"/>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="searchAccountInput" name="search" value="{{ $search ?? '' }}" placeholder="Cari NIP/NIM, nama, atau email...">
              </div>
            </form>
          </div>
        </div>

        <!-- Daftar Akun Table -->
        <div class="table-card">
          <table class="data-table">
            <thead>
              <tr>
                <th style="width: 15%; text-align: center;">Nomor Induk</th>
                <th style="width: 23%;">Nama Lengkap &amp; Email</th>
                <th style="width: 14%; text-align: center;">Unit &amp; Ruangan</th>
                <th style="width: 10%; text-align: center;">Role</th>
                <th style="width: 10%; text-align: center;">Status</th>
                <th style="width: 14%;">Login Terakhir</th>
                <th style="width: 14%; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $u)
              @php
                $badgeClass = 'room-badge-lab';
                $namaR = $u->ruangan->nama_ruangan ?? '';
                if (stripos($namaR, 'Laboratorium') !== false || stripos($namaR, 'Lab') !== false) {
                  $badgeClass = 'room-badge-lab';
                } elseif (stripos($namaR, 'Bengkel') !== false) {
                  $badgeClass = 'room-badge-bkl';
                } elseif (stripos($namaR, 'Admin') !== false || stripos($namaR, 'JTIK') !== false) {
                  $badgeClass = 'room-badge-adm';
                }

                $statusTextMap = [
                  'aktif' => 'Aktif',
                  'menunggu_acc' => 'Menunggu ACC',
                  'nonaktif' => 'Nonaktif',
                  'ditolak' => 'Ditolak',
                ];
                $stKey = $u->status_akun ?: 'aktif';
                $stText = $statusTextMap[$stKey] ?? ucfirst($stKey);
                $lastLog = $u->latestLoginHistory;
                $lastTs = $lastLog ? ($lastLog->logged_in_at ?? $lastLog->created_at) : null;
              @endphp
              <tr>
                <td style="text-align: center;">
                  <span class="badge-asset-code">{{ $u->nomor_induk }}</span>
                </td>
                <td>
                  <div class="asset-name-title">{{ $u->name }}</div>
                  <div class="asset-spec-text">{{ $u->email }}</div>
                </td>
                <td style="text-align: center;">
                  @if($u->ruangan)
                    <span class="room-badge {{ $badgeClass }}">{{ $u->ruangan->nama_ruangan }}</span>
                  @elseif($u->role === 'mahasiswa')
                    <span class="room-badge-all">{{ $u->nama_kelas }}</span>
                  @else
                    <span class="room-badge-all">Semua Unit</span>
                  @endif
                </td>
                <td style="text-align: center;">
                  <span class="role-badge role-badge-{{ $u->role }}">
                    @if($u->role === 'admin')
                      Admin
                    @elseif($u->role === 'pengelola')
                      Pengelola
                    @else
                      Mahasiswa
                    @endif
                  </span>
                </td>
                <td style="text-align: center;">
                  <span class="account-status-badge status-{{ $stKey }}">{{ $stText }}</span>
                </td>
                <td>
                  @if($lastLog && $lastTs)
                    <div style="font-size:11.5px; font-weight:700; color:#0F172A;">{{ $lastTs->timezone('Asia/Makassar')->format('d M Y, H:i') }}</div>
                    <div style="font-size:11px; color:#64748B;">{{ $lastLog->device_label ?: ($lastLog->ip_address ?: '-') }}</div>
                  @else
                    <span style="font-size:11.5px; color:#94A3B8;">Belum tercatat</span>
                  @endif
                </td>
                <td style="text-align: center;">
                  <div class="row-action-group">
                    @if($u->role === 'pengelola' && $stKey === 'menunggu_acc')
                      <form action="{{ route('admin.users.approve', $u->id) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-acc-approve" onclick="return confirmUserAction(event, this.form, 'Setujui (ACC) Pengelola', 'Setujui akun Pengelola {{ addslashes($u->name) }}?', 'Ya, ACC', false)">ACC</button>
                      </form>
                      <form action="{{ route('admin.users.reject', $u->id) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-acc-reject" onclick="return confirmUserAction(event, this.form, 'Tolak Pengelola', 'Tolak pendaftaran Pengelola {{ addslashes($u->name) }}?', 'Ya, Tolak', true)">Tolak</button>
                      </form>
                    @else
                      @if(Auth::id() !== $u->id)
                        <form action="{{ route('admin.users.toggle-status', $u->id) }}" method="POST" style="margin:0;">
                          @csrf
                          <button type="submit" class="btn-row-status" onclick="return confirmUserAction(event, this.form, '{{ $stKey === 'aktif' ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}', '{{ $stKey === 'aktif' ? 'Nonaktifkan sementara akses masuk untuk ' . addslashes($u->name) . '?' : 'Aktifkan kembali akses masuk untuk ' . addslashes($u->name) . '?' }}', '{{ $stKey === 'aktif' ? 'Ya, Nonaktifkan' : 'Ya, Aktifkan' }}', {{ $stKey === 'aktif' ? 'true' : 'false' }})">
                            {{ $stKey === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                          </button>
                        </form>
                      @endif
                      <a href="{{ route('admin.users', ['user_id' => $u->id]) }}#riwayat-login" class="btn-row-history">Riwayat</a>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" style="text-align:center; padding: 28px; color:#64748B; font-size: 12px;">
                  Tidak ada data akun yang sesuai dengan filter pencarian.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @include('partials.pagination', ['paginator' => $users])
      </section>

      <!-- BAGIAN 2: MONITORING RIWAYAT LOGIN SEMUA PENGGUNA (TERPADU DI HALAMAN YANG SAMA) -->
      <section id="riwayat-login" class="unified-section-divider">
        <div class="unified-section-head">
          <div>
            <div class="unified-section-title">Monitoring Riwayat Login Pengguna</div>
            <div class="unified-section-sub">Catatan aktivitas masuk seluruh akun Mahasiswa, Pengelola, dan Admin secara real-time.</div>
          </div>
          <div class="section-stat-pills">
            <span class="section-stat-pill">Total Log: <strong>{{ $totalLogCount ?? 0 }}</strong></span>
            <span class="section-stat-pill stat-ok">Berhasil Hari Ini: <strong>{{ $todayLoginCount ?? 0 }}</strong></span>
            <span class="section-stat-pill stat-warn">Gagal / Terkunci Hari Ini: <strong>{{ $failedLoginCount ?? 0 }}</strong></span>
          </div>
        </div>

        @if(!empty($selectedLogUser))
        <div class="active-user-filter-chip">
          <span>Menampilkan riwayat login khusus akun: <strong>{{ $selectedLogUser->name }}</strong> ({{ $selectedLogUser->nomor_induk }})</span>
          <a href="{{ route('admin.users') }}#riwayat-login" style="color:#08296E; font-weight:700; text-decoration:underline;">Tampilkan Semua User</a>
        </div>
        @endif

        <div class="toolbar-row">
          <div class="toolbar-left">
            <div class="pill-select-wrap">
              <select id="filterLogRole" class="pill-filter-select" onchange="applyLogFilters()">
                <option value="all" {{ ($logRole ?? 'all') === 'all' ? 'selected' : '' }}>Semua Role</option>
                <option value="mahasiswa" {{ ($logRole ?? '') === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="pengelola" {{ ($logRole ?? '') === 'pengelola' ? 'selected' : '' }}>Pengelola</option>
                <option value="admin" {{ ($logRole ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
            </div>

            <div class="pill-select-wrap">
              <select id="filterLogStatus" class="pill-filter-select" onchange="applyLogFilters()">
                <option value="all" {{ ($logStatus ?? 'all') === 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="berhasil" {{ ($logStatus ?? '') === 'berhasil' ? 'selected' : '' }}>Berhasil</option>
                <option value="gagal" {{ ($logStatus ?? '') === 'gagal' ? 'selected' : '' }}>Gagal</option>
                <option value="terkunci" {{ ($logStatus ?? '') === 'terkunci' ? 'selected' : '' }}>Terkunci</option>
                <option value="menunggu_acc" {{ ($logStatus ?? '') === 'menunggu_acc' ? 'selected' : '' }}>Menunggu ACC</option>
                <option value="nonaktif" {{ ($logStatus ?? '') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                <option value="ditolak" {{ ($logStatus ?? '') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
              </select>
            </div>

            <div class="pill-select-wrap">
              <select id="filterLogPortal" class="pill-filter-select" onchange="applyLogFilters()">
                <option value="all" {{ ($logPortal ?? 'all') === 'all' ? 'selected' : '' }}>Semua Portal</option>
                <option value="mahasiswa" {{ ($logPortal ?? '') === 'mahasiswa' ? 'selected' : '' }}>Portal Mahasiswa</option>
                <option value="petugas" {{ ($logPortal ?? '') === 'petugas' ? 'selected' : '' }}>Portal Petugas</option>
              </select>
            </div>

            <form id="logSearchForm" method="GET" action="{{ route('admin.users') }}#riwayat-login" class="toolbar-search-form">
              <input type="hidden" name="log_role" value="{{ $logRole ?? 'all' }}">
              <input type="hidden" name="log_status" value="{{ $logStatus ?? 'all' }}">
              <input type="hidden" name="log_portal" value="{{ $logPortal ?? 'all' }}">
              @if(!empty($selectedLogUser))
                <input type="hidden" name="user_id" value="{{ $selectedLogUser->id }}">
              @endif
              <div class="search-input-box">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
                  <circle cx="11" cy="11" r="8"/>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="logSearchInput" name="log_search" value="{{ $logSearch ?? '' }}" placeholder="Cari nama, NIM/NIP, IP, atau perangkat...">
              </div>
            </form>
          </div>
        </div>

        <div class="table-card">
          <table class="data-table">
            <thead>
              <tr>
                <th style="width: 17%;">Waktu (WITA)</th>
                <th style="width: 24%;">Pengguna</th>
                <th style="width: 11%; text-align: center;">Role</th>
                <th style="width: 13%; text-align: center;">Portal</th>
                <th style="width: 17%;">IP &amp; Perangkat</th>
                <th style="width: 18%; text-align: center;">Status &amp; Catatan</th>
              </tr>
            </thead>
            <tbody>
              @forelse($loginHistories as $log)
              @php
                $logStatusLabels = [
                  'berhasil' => 'Berhasil',
                  'gagal' => 'Gagal',
                  'terkunci' => 'Terkunci',
                  'menunggu_acc' => 'Menunggu ACC',
                  'nonaktif' => 'Nonaktif',
                  'ditolak' => 'Ditolak',
                ];
                $stLog = $log->status ?: 'gagal';
                $tsLog = $log->logged_in_at ?? $log->created_at;
              @endphp
              <tr>
                <td>
                  <div style="font-weight:700; color:#0F172A; font-size:12px;">{{ $tsLog ? $tsLog->timezone('Asia/Makassar')->format('d M Y') : '-' }}</div>
                  <div style="font-size:11.5px; color:#64748B;">{{ $tsLog ? $tsLog->timezone('Asia/Makassar')->format('H:i:s') . ' WITA' : '' }}</div>
                </td>
                <td>
                  <div class="asset-name-title">{{ $log->user?->name ?? 'Akun Tidak Dikenal' }}</div>
                  <div class="asset-spec-text">{{ $log->identifier }}</div>
                </td>
                <td style="text-align: center;">
                  @if($log->role)
                    <span class="role-badge role-badge-{{ $log->role }}">{{ ucfirst($log->role) }}</span>
                  @else
                    <span class="room-badge-all">-</span>
                  @endif
                </td>
                <td style="text-align: center;">
                  <span class="room-badge-all">{{ $log->portal === 'petugas' ? 'Portal Petugas' : 'Portal Mahasiswa' }}</span>
                </td>
                <td>
                  <div style="font-weight:600; color:#0F172A; font-size:12px;">{{ $log->ip_address ?: '-' }}</div>
                  <div style="font-size:11.5px; color:#64748B;">{{ $log->device_label ?: 'Perangkat Tidak Dikenal' }}</div>
                </td>
                <td style="text-align: center;">
                  <div>
                    <span class="log-status-badge log-{{ $stLog }}">{{ $logStatusLabels[$stLog] ?? ucfirst($stLog) }}</span>
                  </div>
                  @if($log->notes)
                    <div style="font-size:11px; color:#64748B; margin-top:4px; line-height:1.35;">{{ $log->notes }}</div>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" style="text-align:center; padding: 28px; color:#64748B; font-size: 12px;">
                  Belum ada catatan riwayat login pada filter yang dipilih.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @include('partials.pagination', ['paginator' => $loginHistories])
      </section>

    </main>
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
    function toggleUserDropdown(e) {
      if (e) e.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) {
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
      }
    }

    document.addEventListener('click', function(e) {
      const dropdown = document.getElementById('userDropdown');
      const btn = document.getElementById('adminBtn') || document.querySelector('.btn-header-admin');
      if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
        dropdown.classList.remove('active');
      }
    });

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

    function applyAccountFilters() {
      const role = document.getElementById('filterRole').value;
      const status = document.getElementById('filterStatus').value;
      const unit = document.getElementById('filterUnit').value;
      const searchEl = document.getElementById('searchAccountInput');
      const search = searchEl ? searchEl.value : '';
      const params = new URLSearchParams({
        role: role,
        status: status,
        unit: unit,
        search: search
      });
      window.location.href = "{{ route('admin.users') }}?" + params.toString();
    }

    function applyLogFilters() {
      const logRole = document.getElementById('filterLogRole').value;
      const logStatus = document.getElementById('filterLogStatus').value;
      const logPortal = document.getElementById('filterLogPortal').value;
      const searchEl = document.getElementById('logSearchInput');
      const logSearch = searchEl ? searchEl.value : '';
      const params = new URLSearchParams({
        log_role: logRole,
        log_status: logStatus,
        log_portal: logPortal,
        log_search: logSearch
      });
      @if(!empty($selectedLogUser))
        params.set('user_id', '{{ $selectedLogUser->id }}');
      @endif
      window.location.href = "{{ route('admin.users') }}?" + params.toString() + "#riwayat-login";
    }

    function confirmUserAction(event, form, title, message, confirmText, isDanger) {
      if (typeof openConfirmDialog === 'function') {
        event.preventDefault();
        openConfirmDialog({
          title: title,
          message: message,
          confirmText: confirmText,
          danger: Boolean(isDanger),
          onConfirm: function() {
            form.submit();
          }
        });
        return false;
      }
      return true;
    }
  </script>

  @include('partials.ui_feedback')
</body>
</html>
