<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM - Verifikasi Bebas Sarpras</title>

  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-navy: #0F172A;
      --sidebar-navy: #16192E;
      --accent-orange: #ED7411;
      --accent-orange-hover: #D96509;
      --accent-blue: #0091FF;
      --bg-page: #F8FAFC;
      --bg-card: #FFFFFF;
      --text-dark: #0F172A;
      --text-body: #334155;
      --text-muted: #64748B;
      --text-subtle: #94A3B8;
      --border-color: #E2E8F0;
      --border-subtle: #F1F5F9;
      --success-green: #16A34A;
      --danger-red: #DC2626;
      --warning-amber: #D97706;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    body {
      background-color: var(--bg-page);
      color: var(--text-dark);
      min-height: 100vh;
      overflow-x: hidden;
      font-size: 12px;
      line-height: 1.4;
    }

    /* FULLPAGE PORTAL LAYOUT */
    .portal-layout {
      display: grid;
      grid-template-columns: 220px 1fr;
      min-height: 100vh;
      width: 100%;
    }

    /* SIDEBAR KONSISTEN (UNIFIED 220PX) */
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
      background-color: rgba(255, 255, 255, 0.06);
      color: #FFFFFF;
    }

    .nav-item.active {
      background-color: #ED7411 !important;
      color: #FFFFFF !important;
      font-weight: 700;
    }

    .nav-left-part {
      display: flex;
      align-items: center;
      gap: 9px;
    }

    .nav-badge-count {
      background: #ED7411;
      color: #FFFFFF;
      font-size: 9px;
      font-weight: 800;
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
    }

    /* MAIN WORKSPACE */
    .workspace {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 18px 24px 28px 24px;
      gap: 14px;
      min-width: 0;
    }

    /* NOTIFIKASI BANNER */
    .alert-banner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 16px;
      border-radius: 8px;
      font-size: 11px;
      font-weight: 600;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
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

    /* PAGE HEADER ROW */
    .page-header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--border-subtle);
      flex-wrap: wrap;
      gap: 12px;
    }

    .page-title {
      font-size: 15px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.2px;
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

    /* TOOLBAR ROW 1: SEGMENTED BUTTONS */
    .toolbar-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
    }

    .filter-btn-group {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      flex-wrap: wrap;
    }

    .filter-btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      height: 36px;
      padding: 0 14px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.15s ease;
      background: #FFFFFF;
      color: #475569;
      border: 1.2px solid #CBD5E1;
      cursor: pointer;
      white-space: nowrap;
    }

    .filter-btn:hover {
      background: #F8FAFC;
      border-color: #94A3B8;
      color: #0F172A;
    }

    .filter-btn.active {
      background: var(--primary-navy);
      color: #FFFFFF;
      border-color: var(--primary-navy);
      box-shadow: 0 2px 4px rgba(15, 23, 42, 0.15);
    }

    .filter-btn .btn-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 9.5px;
      font-weight: 700;
      padding: 1.5px 7.5px;
      border-radius: 12px;
      background: #E2E8F0;
      color: #475569;
      line-height: 1.2;
    }

    .filter-btn.active .btn-badge {
      background: var(--accent-orange);
      color: #FFFFFF;
    }

    /* TOOLBAR ROW 2: DROPDOWNS + SEARCH */
    .filter-controls-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 2px;
    }

    .controls-left {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
      flex: 1;
    }

    .select-pill {
      height: 34px;
      padding: 0 10px;
      border-radius: 6px;
      border: 1.2px solid #CBD5E1;
      background: #FFFFFF;
      color: #334155;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 500;
      outline: none;
      cursor: pointer;
    }

    .search-input-box {
      display: flex;
      align-items: center;
      background: #FFFFFF;
      border: 1.2px solid #CBD5E1;
      border-radius: 6px;
      padding: 0 12px;
      height: 34px;
      width: 280px;
      position: relative;
      transition: all 0.15s;
    }

    .search-input-box:focus-within {
      border-color: var(--accent-blue);
      box-shadow: 0 0 0 3px rgba(0, 145, 255, 0.1);
    }

    .search-input-box input {
      border: none;
      outline: none;
      background: transparent;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      color: var(--text-dark);
      width: 100%;
      padding-left: 8px;
    }

    .search-input-box input::placeholder {
      color: #94A3B8;
      font-size: 11px;
    }

    /* TABLE CARD */
    .table-card {
      background: var(--bg-card);
      border-radius: 8px;
      border: 1px solid var(--border-color);
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
      overflow: visible;
    }

    .table-caption-bar {
      padding: 13px 18px;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #FFFFFF;
    }

    .table-caption-title {
      font-size: 12px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.1px;
      text-transform: uppercase;
    }

    .approval-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    .approval-table th {
      background: #F8FAFC;
      color: #475569;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.4px;
      text-transform: uppercase;
      padding: 11px 16px;
      border-bottom: 1.5px solid var(--border-color);
      white-space: nowrap;
    }

    .approval-table td {
      padding: 13px 16px;
      border-bottom: 1px solid var(--border-subtle);
      vertical-align: middle;
      color: #334155;
      font-size: 11px;
    }

    .approval-table tbody tr:hover {
      background-color: #F8FAFC;
    }

    .row-striped {
      background-color: #FCFDFE;
    }

    /* TYPOGRAPHY KOLOM */
    .bbs-id {
      font-size: 12px;
      font-weight: 800;
      color: var(--primary-navy);
      display: block;
      line-height: 1.25;
      letter-spacing: -0.2px;
    }

    .bbs-date {
      font-size: 10.5px;
      color: #64748B;
      display: block;
      margin-top: 3px;
    }

    .mhs-name {
      font-size: 12px;
      font-weight: 700;
      color: var(--text-dark);
      display: block;
      line-height: 1.25;
    }

    .mhs-nim {
      font-size: 10px;
      color: #64748B;
      display: block;
      margin-top: 2px;
    }

    .mhs-class {
      font-size: 9.5px;
      color: #475569;
      display: block;
      margin-top: 1px;
      font-weight: 500;
    }

    /* STACK 3 RUANGAN STATUS */
    .room-status-stack {
      display: flex;
      flex-direction: column;
      gap: 3.5px;
      width: 100%;
      max-width: 220px;
    }

    .room-status-pill {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 3px 8px;
      border-radius: 4px;
      font-size: 9px;
      font-weight: 600;
      border: 1px solid transparent;
    }

    .room-status-pill.bebas {
      background: #DCFCE7;
      color: #166534;
      border-color: #BBF7D0;
    }

    .room-status-pill.tertahan {
      background: #FEE2E2;
      color: #991B1B;
      border-color: #FECACA;
    }

    .room-status-pill.belum_cek {
      background: #FEF3C7;
      color: #92400E;
      border-color: #FDE68A;
    }

    /* TANGGUNGAN KHUSUS LAB INI */
    .liability-box {
      border-radius: 6px;
      padding: 8px 12px;
      font-size: 10.5px;
      font-weight: 600;
      display: inline-flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      min-width: 140px;
      line-height: 1.35;
    }

    .liability-box.clean {
      border: 1.2px dashed #94A3B8;
      background: #F8FAFC;
      color: #334155;
    }

    .liability-box.waiting {
      border: 1.2px solid #FCD34D;
      background: #FFFBEB;
      color: #B45309;
    }

    .liability-box.held {
      border: 1.2px solid #FCA5A5;
      background: #FEF2F2;
      color: #991B1B;
    }

    /* 3-DOTS ACTION DROPDOWN (YOUTUBE STYLE) */
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
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.08);
      padding: 6px;
      min-width: 175px;
      z-index: 1000;
      display: none;
      flex-direction: column;
      gap: 2px;
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

    .action-menu-item.action-menu-success {
      color: #15803D;
    }

    .action-menu-item.action-menu-success svg {
      color: #15803D;
    }

    .action-menu-item.action-menu-success:hover {
      background: #F0FDF4;
      color: #166534;
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

    .action-menu-divider {
      height: 1px;
      background: #F1F5F9;
      margin: 3px 0;
    }

    /* AKSI BUTTONS (SINGLE CONTEXTUAL ACTION) */
    .btn-action-green {
      background: var(--success-green);
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      padding: 7px 16px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
      box-shadow: 0 1px 3px rgba(22, 163, 74, 0.2);
    }

    .btn-action-green:hover {
      background: #15803D;
      transform: translateY(-1px);
    }

    .btn-action-navy {
      background: var(--primary-navy);
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      padding: 7px 16px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.15);
    }

    .btn-action-navy:hover {
      background: #1E293B;
      transform: translateY(-1px);
    }

    .btn-action-outline {
      background: #FFFFFF;
      color: #334155;
      border: 1.2px solid #CBD5E1;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      padding: 7px 16px;
      border-radius: 6px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
    }

    .btn-action-outline:hover {
      background: #F1F5F9;
      color: #0F172A;
      border-color: #94A3B8;
    }

    /* MODAL OVERLAY & DIALOG */
    .modal-overlay {
      position: fixed;
      inset: 0;
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
      animation: fadeIn 0.15s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-dialog {
      background: #FFFFFF;
      border-radius: 12px;
      width: 100%;
      max-width: 640px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
      border: 1px solid #CBD5E1;
      max-height: 92vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .modal-header {
      padding: 16px 20px;
      border-bottom: 1px solid #E2E8F0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #FFFFFF;
    }

    .btn-close-modal {
      width: 30px;
      height: 30px;
      border-radius: 6px;
      background: #F1F5F9;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #64748B;
      font-size: 18px;
      font-weight: 700;
      transition: all 0.15s;
    }

    .btn-close-modal:hover {
      background: #E2E8F0;
      color: #0F172A;
    }

    .modal-body {
      padding: 18px 20px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .modal-footer {
      padding: 14px 20px;
      border-top: 1px solid #E2E8F0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      background: #F8FAFC;
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
    }

    .btn-cancel {
      padding: 8px 18px;
      border-radius: 6px;
      border: 1.2px solid #CBD5E1;
      background: #FFFFFF;
      color: #475569;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.15s;
    }

    .btn-cancel:hover {
      background: #F1F5F9;
      color: #0F172A;
    }

    .btn-orange-download {
      padding: 8.5px 20px;
      border-radius: 6px;
      border: none;
      background: var(--accent-orange);
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      transition: background 0.15s;
    }

    .btn-orange-download:hover {
      background: var(--accent-orange-hover);
    }

    /* CARD VERIFIKASI 3 RUANGAN DI MODAL */
    .room-cert-card {
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 12px 14px;
      background: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .room-cert-left {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .room-cert-title {
      font-size: 11.5px;
      font-weight: 700;
      color: var(--primary-navy);
    }

    .room-cert-sub {
      font-size: 9.5px;
      color: #64748B;
    }

    .room-cert-badge {
      font-size: 10px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 4px;
    }

    .room-cert-badge.bebas {
      background: #DCFCE7;
      color: #166534;
      border: 1px solid #86EFAC;
    }

    .room-cert-badge.tertahan {
      background: #FEE2E2;
      color: #991B1B;
      border: 1px solid #FCA5A5;
    }

    .room-cert-badge.belum_cek {
      background: #FEF3C7;
      color: #92400E;
      border: 1px solid #FDE68A;
    }

    /* BADGE ASSET CODE & METADATA (PERSIS DENGAN ALAT & BAHAN) */
    .badge-asset-code {
      display: inline-block;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 800;
      color: #08296E;
      letter-spacing: -0.2px;
    }

    .asset-name-title {
      font-size: 11.5px;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 2px;
    }

    .asset-spec-text {
      font-size: 10px;
      color: var(--text-muted);
      line-height: 1.35;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    /* RACK LOCATION */
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

    /* STACKED STOCK BOXES (TOTAL / READY) */
    .stock-stack {
      display: flex;
      flex-direction: column;
      gap: 3px;
      width: 95px;
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
      color: #15803D;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 9.5px;
      font-weight: 700;
      padding: 2.5px 6px;
      border-radius: 4px;
      text-align: center;
      line-height: 1.2;
    }

    /* CONDITION BADGE */
    .condition-badge {
      display: inline-block;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 9.5px;
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
      border: 1.2px solid #F59E0B;
      color: #D97706;
    }

    /* TABLE FOOTER SUMMARY CARD (PERSIS ALAT & BAHAN) */
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
    }

    /* TOMBOL RUANGAN & DROPDOWN PROFIL HEADER */
    .btn-header-room {
      background: #0F172A;
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 700;
      padding: 5.5px 12px;
      border-radius: 6px;
      border: 1px solid #1E293B;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: all 0.15s ease;
      user-select: none;
    }
    .btn-header-room:hover {
      background: #1E293B;
      border-color: #ED7411;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(15, 23, 42, 0.18);
    }
    .btn-header-room:active {
      transform: translateY(0);
    }

    .btn-header-pengelola {
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
    .btn-header-pengelola:hover {
      background: #DBEAFE;
      border-color: #93C5FD;
    }

    .user-dropdown-panel {
      position: absolute;
      top: calc(100% + 6px);
      right: 0;
      background: #FFFFFF;
      border: 1px solid var(--border-color);
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

    .user-dropdown-btn {
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
    .user-dropdown-btn:hover {
      background: #F1F5F9;
      color: #08296E;
    }
    .user-dropdown-btn svg {
      flex-shrink: 0;
      stroke: #64748B;
      transition: stroke 0.15s ease;
    }
    .user-dropdown-btn:hover svg {
      stroke: #08296E;
    }

    .user-dropdown-sep {
      height: 1px;
      background: #E2E8F0;
      margin: 4px 0;
    }

    .user-dropdown-btn.logout {
      color: var(--danger-red);
      font-weight: 600;
    }
    .user-dropdown-btn.logout:hover {
      background: #FEF2F2;
      color: #B91C1C;
    }
    .user-dropdown-btn.logout svg {
      stroke: var(--danger-red);
    }
    .user-dropdown-btn.logout:hover svg {
      stroke: #B91C1C;
    }

    /* PENYERAGAMAN DESAIN: PLUS JAKARTA SANS, TIPOGRAFI LEGA & BORDER HALUS */
    body, button, input, select, textarea {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    .portal-layout { grid-template-columns: 240px 1fr; }
    .sidebar { width: 240px; min-width: 240px; padding: 20px 15px 16px 15px; }
    .nav-header-label { font-size: 10px; padding: 12px 10px 5px 10px; }
    .nav-item { font-size: 13px; padding: 10px 12px; }
    .nav-badge-count, .badge-sidebar { font-size: 10.5px; padding: 2px 7px; }
    .sidebar-footer { font-size: 11px; }

    .workspace, .main-content { padding: 24px 32px; gap: 18px; }
    .page-title { font-size: 18px; letter-spacing: -0.3px; }
    .page-subtitle { font-size: 12.5px; }
    .btn-header-room, .btn-header-pengelola, .badge-role-pill { font-size: 11px; font-weight: 600; height: 28px; padding: 0 14px; line-height: 1; display: inline-flex; align-items: center; justify-content: center; box-sizing: border-box; white-space: nowrap; }
    .user-dropdown-panel { width: 255px; border-color: #E2E8F0; }
    .user-dropdown-name { font-size: 12.5px; }
    .user-dropdown-email, .user-dropdown-tag { font-size: 10.5px; }
    .user-dropdown-btn { font-size: 12.5px; padding: 8.5px 10px; }

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
    .btn-modal-cancel, .btn-modal-submit-green, .btn-modal-submit-red { font-size: 12.5px; padding: 9px 16px; }

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

    <!-- SIDEBAR (PERSISTEN & KONSISTEN) -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('images/logo-unm-white.png') }}" alt="UNM SI-SAPRAS JTIK" class="brand-logo-img">
      </div>

      <!-- MENU NAVIGASI -->
      <nav class="sidebar-nav">
        <div class="nav-header-label">Menu Pengelola</div>

        <!-- 1. Persetujuan Pinjam -->
        <a href="{{ route('pengelola.dashboard') }}" class="nav-item {{ request()->routeIs('pengelola.dashboard') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <span>Persetujuan Pinjam</span>
          </div>
          @if(($menungguCount ?? 0) > 0)
            <span class="nav-badge-count">{{ $menungguCount }}</span>
          @endif
        </a>

        <!-- 2. Riwayat Keputusan -->
        <a href="{{ route('pengelola.riwayat') }}" class="nav-item {{ request()->routeIs('pengelola.riwayat') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            <span>Riwayat Keputusan</span>
          </div>
        </a>

        <!-- 3. Verifikasi Pengembalian -->
        <a href="{{ route('pengelola.pengembalian') }}" class="nav-item {{ request()->routeIs('pengelola.pengembalian') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/></svg>
            <span>Verifikasi Pengembalian</span>
          </div>
          @if(($menungguCekCount ?? 0) > 0)
            <span class="nav-badge-count">{{ $menungguCekCount }}</span>
          @endif
        </a>

        <!-- 4. Verifikasi Bebas Pinjam -->
        <a href="{{ route('pengelola.bebas-pinjam') }}" class="nav-item {{ request()->routeIs('pengelola.bebas-pinjam') ? 'active' : '' }}">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
            <span>Verifikasi Bebas Pinjam</span>
          </div>
          @if(($belumCekCount ?? 0) > 0)
            <span class="nav-badge-count" style="background: #FFFFFF; color: var(--accent-orange);">{{ $belumCekCount }}</span>
          @endif
        </a>

        <!-- 5. Cek Stok -->
        <a href="javascript:void(0)" onclick="openRoomInfoModal()" class="nav-item" title="Cek Stok &amp; Ketersediaan Sarpras Ruangan">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
            <span>Cek Stok</span>
          </div>
        </a>
      </nav>

      <!-- FOOTER -->
      <div class="sidebar-footer">
        SI-SAPRAS JTIK FT UNM
      </div>
    </aside>

    <!-- MAIN WORKSPACE -->
    <main class="workspace">

      <!-- NOTIFIKASI SUKSES / ERROR -->
      @if(session('success'))
      <div class="alert-banner success">
        <div style="display: flex; align-items: center; gap: 8px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <span>{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; color:#166534; font-size:16px;">×</button>
      </div>
      @endif

      @if(session('error'))
      <div class="alert-banner error">
        <div style="display: flex; align-items: center; gap: 8px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <span>{{ session('error') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; color:#991B1B; font-size:16px;">×</button>
      </div>
      @endif

      <!-- PAGE HEADER -->
      <div class="page-header-row">
        <div style="display: flex; align-items: baseline; gap: 8px;">
          <h1 class="page-title">Verifikasi Bebas Sarpras</h1>
          <span class="header-divider">|</span>
          <span style="font-size: 11px; color: #64748B;">Pengecekan tanggungan sarpras {{ $namaRuangan ?? 'Bengkel' }}</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
          <!-- Tombol Ruangan (Buka Info Ruangan & Cek Stok) -->
          <button type="button" class="btn-header-room" onclick="openRoomInfoModal()" title="Klik untuk Informasi Ruangan &amp; Cek Stok Sarpras">
            <span>{{ $badgeRuangan ?? $namaRuangan ?? 'Bengkel' }}</span>
          </button>

          <div style="position: relative;">
            <button type="button" id="pengelolaBtn" onclick="togglePengelolaDropdown(event)" class="btn-header-pengelola" title="Menu Akun Pengelola">
              <span>Pengelola</span>
              <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>

            <!-- Dropdown Profil & Menu Fungsional -->
            <div id="pengelolaDropdown" class="user-dropdown-panel" style="display: none;">
              <!-- Header Profil (Klik untuk Buka Profil Saya) -->
              <div class="user-dropdown-header-card" onclick="openProfileModal()" title="Klik untuk lihat / ubah Profil">
                <div class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}</div>
                <div style="flex: 1; min-width: 0;">
                  <div class="user-dropdown-name">{{ Auth::user()->name ?? 'Pengelola Laboratorium' }}</div>
                  <div class="user-dropdown-email">{{ Auth::user()->email ?? '' }}</div>
                  <div class="user-dropdown-tag">{{ $namaRuangan ?? 'Laboratorium' }}</div>
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

                <!-- 4. Keluar (Logout) -->
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

      <!-- TOOLBAR ROW 1: SEGMENTED BUTTONS STATUS -->
      <div class="toolbar-row">
        <div class="filter-btn-group">
          <a href="{{ route('pengelola.bebas-pinjam', array_filter(['status' => 'semua', 'prodi' => $prodiFilter, 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? 'semua') === 'semua' ? 'active' : '' }}"
             title="Tampilkan seluruh pengajuan">
            <span>Semua Status</span>
            <span class="btn-badge">{{ $semuaCount ?? 0 }}</span>
          </a>

          <a href="{{ route('pengelola.bebas-pinjam', array_filter(['status' => 'bebas', 'prodi' => $prodiFilter, 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? '') === 'bebas' ? 'active' : '' }}"
             title="Telah bebas dari seluruh ruangan">
            <span>Bebas (Full Lab)</span>
            <span class="btn-badge">{{ $bebasCount ?? 0 }}</span>
          </a>

          <a href="{{ route('pengelola.bebas-pinjam', array_filter(['status' => 'tertahan', 'prodi' => $prodiFilter, 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? '') === 'tertahan' ? 'active' : '' }}"
             title="Pengajuan yang ditolak karena tanggungan">
            <span>Ditolak</span>
            <span class="btn-badge">{{ $tertahanCount ?? 0 }}</span>
          </a>

          <a href="{{ route('pengelola.bebas-pinjam', array_filter(['status' => 'belum_cek', 'prodi' => $prodiFilter, 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? '') === 'belum_cek' ? 'active' : '' }}"
             title="Belum diverifikasi di lab ini">
            <span>Belum Cek</span>
            <span class="btn-badge">{{ $belumCekCount ?? 0 }}</span>
          </a>
        </div>
      </div>

      <!-- TOOLBAR ROW 2: FILTERS & SEARCH -->
      <form method="GET" action="{{ route('pengelola.bebas-pinjam') }}" class="filter-controls-row">
        <input type="hidden" name="status" value="{{ $statusFilter ?? 'semua' }}">
        
        <div class="controls-left">
          <select name="prodi" class="select-pill" onchange="this.form.submit()">
            <option value="all">Semua Kelas &amp; Prodi</option>
            <option value="PTIK" {{ ($prodiFilter ?? '') === 'PTIK' ? 'selected' : '' }}>Pendidikan Teknik Informatika dan Komputer (PTIK)</option>
            <option value="Teknik Komputer" {{ ($prodiFilter ?? '') === 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer (TEKOM)</option>
          </select>

          <select class="select-pill" onchange="this.form.submit()">
            <option>Semua Otoritas Ruangan</option>
            <option>Bengkel IT</option>
            <option>Laboratorium</option>
            <option>Administrasi</option>
          </select>

          <div class="search-input-box">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari Nama / NIM Mahasiswa...">
            @if(!empty($search))
              <a href="{{ route('pengelola.bebas-pinjam', ['status' => $statusFilter ?? 'semua']) }}" title="Hapus" style="position:absolute; right:10px; color:#94A3B8; text-decoration:none; font-size:14px; font-weight:700;">×</a>
            @endif
          </div>
        </div>

        <div style="font-size: 11px; color: #64748B;">
          Menampilkan <strong>{{ $pengajuan->count() }}</strong> Mahasiswa
        </div>
      </form>

      <!-- DAFTAR PENGAJUAN BEBAS SARPRAS TABLE CARD -->
      <div class="table-card">
        <div class="table-caption-bar">
          <div>
            <span class="table-caption-title">Daftar Pengajuan Bebas Sarpras Mahasiswa</span>
            <div style="font-size:11px; color:#64748B; margin-top:2px;">Hanya menampilkan mahasiswa yang mengajukan permohonan Bebas Sarpras.</div>
          </div>
          <span style="font-size:11px; color:#64748B;">Otoritas Verifikasi: <strong>{{ $badgeRuangan ?? 'Bengkel IT' }}</strong></span>
        </div>

        <table class="approval-table">
          <thead>
            <tr>
              <th style="width: 17%;">No. Pengajuan &amp; Tgl</th>
              <th style="width: 25%;">Identitas Mahasiswa</th>
              <th style="width: 25%;">Status 3 Ruangan</th>
              <th style="width: 18%; text-align: center;">Tanggungan Khusus Lab Ini</th>
              <th style="width: 15%; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pengajuan as $item)
            <tr class="{{ $loop->iteration % 2 === 0 ? 'row-striped' : '' }}">
              <!-- KOLOM 1: NO PENGAJUAN & TGL -->
              <td>
                <span class="bbs-id">{{ $item->kode_pengajuan }}</span>
                <span class="bbs-date">{{ \Carbon\Carbon::parse($item->tgl_pengajuan)->translatedFormat('d/m/Y') }}</span>
              </td>

              <!-- KOLOM 2: IDENTITAS MAHASISWA -->
              <td>
                <span class="mhs-name">{{ $item->user->name ?? 'Mahasiswa' }}</span>
                <span class="mhs-nim">NIM: {{ $item->user->nomor_induk ?? '-' }}</span>
                <span class="mhs-class">{{ $item->user->jurusan ?? 'PTIK A 2022' }}</span>
                <div style="font-size: 11px; color: #475569; margin-top: 3px;">Keperluan: <strong>{{ Str::limit($item->keperluan ?? '-', 55) }}</strong></div>
              </td>

              <!-- KOLOM 3: STATUS 3 RUANGAN -->
              @php
                $statusUnitIni = ($namaRuangan ?? '') === 'Bengkel IT'
                  ? $item->status_ruang_inventaris
                  : (((($namaRuangan ?? '') === 'Administrasi') || (($namaRuangan ?? '') === 'Admin JTIK'))
                    ? $item->status_lab_jaringan
                    : $item->status_lab_komputer);
              @endphp
              <td>
                <div class="room-status-stack">
                  <!-- 1. Bengkel IT -->
                  <div class="room-status-pill {{ $item->status_ruang_inventaris }}">
                    <span>Bengkel IT</span>
                    <span>{{ $item->status_ruang_inventaris === 'tertahan' ? 'Ditolak' : ($item->status_ruang_inventaris === 'belum_cek' ? 'Menunggu' : 'Bebas') }}</span>
                  </div>

                  <!-- 2. Laboratorium -->
                  <div class="room-status-pill {{ $item->status_lab_komputer }}">
                    <span>Laboratorium</span>
                    <span>{{ $item->status_lab_komputer === 'tertahan' ? 'Ditolak' : ($item->status_lab_komputer === 'belum_cek' ? 'Menunggu' : 'Bebas') }}</span>
                  </div>

                  <!-- 3. Administrasi -->
                  <div class="room-status-pill {{ $item->status_lab_jaringan }}">
                    <span>Administrasi</span>
                    <span>{{ $item->status_lab_jaringan === 'tertahan' ? 'Ditolak' : ($item->status_lab_jaringan === 'belum_cek' ? 'Menunggu' : 'Bebas') }}</span>
                  </div>
                </div>
              </td>

              <!-- KOLOM 4: TANGGUNGAN KHUSUS UNIT INI -->
              <td style="text-align: center; vertical-align: middle;">
                @if($statusUnitIni === 'tertahan')
                  <div class="liability-box held" title="{{ $item->catatan_lab_komputer ?? $item->catatan_ruang_inventaris ?? $item->catatan_lab_jaringan ?? 'Terdapat pinjaman bermasalah / ditolak' }}">
                    <span>1 Pinjaman Aktif</span>
                    <span style="font-size: 11.5px; opacity: 0.9;">(Status: Ditolak)</span>
                  </div>
                @elseif(($item->loan_count ?? 0) > 0)
                  <div class="liability-box waiting">
                    <span>{{ $item->loan_count }} Pinjaman Aktif</span>
                    <span style="font-size: 11.5px; opacity: 0.9;">(Status: Menunggu)</span>
                  </div>
                @else
                  <div class="liability-box clean">
                    <span>0 Tanggungan Fisik</span>
                  </div>
                @endif
              </td>

              <!-- KOLOM 5: AKSI (3-DOTS ACTION DROPDOWN) -->
              <td style="text-align: center; vertical-align: middle; position: relative;">
                <div class="action-dropdown-wrap">
                  <button type="button" class="btn-action-dots" onclick="toggleActionMenu(event, this)" title="Pilihan Aksi">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                      <circle cx="5" cy="12" r="2"/>
                      <circle cx="12" cy="12" r="2"/>
                      <circle cx="19" cy="12" r="2"/>
                    </svg>
                  </button>

                  <div class="action-dropdown-menu">
                    <!-- 1. LIHAT DETAIL (HANYA BACA) -->
                    <button type="button" class="action-menu-item" onclick='closeAllActionMenus(); openDetailModal({!! htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                      <span>Lihat Detail</span>
                    </button>

                    <!-- 2. SAHKAN BEBAS (KHUSUS UNIT PENGELOLA INI) -->
                    @if($statusUnitIni !== 'bebas')
                    <form action="{{ route('pengelola.bebas-pinjam.sahkan', $item->id) }}" method="POST" style="margin:0; width:100%;">
                      @csrf
                      <button type="submit" class="action-menu-item action-menu-success">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Sahkan Bebas ({{ $namaRuangan ?? 'Unit Ini' }})</span>
                      </button>
                    </form>
                    @endif

                    <!-- 3. TOLAK -->
                    @if($statusUnitIni !== 'tertahan')
                    <button type="button" class="action-menu-item action-menu-danger" onclick='closeAllActionMenus(); openTolakModal({!! htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                      <span>Tolak</span>
                    </button>
                    @else
                    <!-- 3B. BATALKAN PENOLAKAN -->
                    <form action="{{ route('pengelola.bebas-pinjam.lepas-tahan', $item->id) }}" method="POST" style="margin:0; width:100%;">
                      @csrf
                      <button type="submit" class="action-menu-item" style="color: #0284C7;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
                        <span>Batalkan Penolakan</span>
                      </button>
                    </form>
                    @endif
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align: center; padding: 40px 16px; color: #64748B;">
                <div style="font-weight: 700; font-size: 13px; color: #0F172A; margin-bottom: 4px;">Tidak Ada Pengajuan Bebas Sarpras</div>
                <div style="font-size: 11px;">Belum ada pengajuan bebas pinjam sarpras dari mahasiswa pada filter ini.</div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </main>
  </div>

  <!-- ========================================================
       MODAL 1: KARTU BEBAS PEMINJAMAN SARPRAS TUNGGAL (PREVIEW & CETAK)
       ======================================================== -->
  <div id="modalCertificate" class="modal-overlay">
    <div class="modal-dialog">
      <!-- HEADER -->
      <div class="modal-header">
        <div style="display:flex; align-items:center; gap:8px;">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="var(--primary-navy)" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          <h2 style="font-size:12px; font-weight:800; color:var(--primary-navy); ">Kartu Verifikasi Bebas Peminjaman Sarpras Tunggal</h2>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeCertModal()">×</button>
      </div>

      <!-- BODY (SURAT RESMI BEBAS SARPRAS) -->
      <div class="modal-body">
        
        <div style="border: 1.5px solid #E2E8F0; border-radius: 8px; padding: 18px; background: #FFFFFF;">
          <!-- KOP SURAT -->
          <div style="display:flex; justify-content:space-between; align-items:flex-start; border-bottom: 1.5px solid #0F172A; padding-bottom: 12px; margin-bottom: 14px;">
            <div>
              <div style="font-size: 12px; font-weight: 900; color: var(--primary-navy); letter-spacing: -0.2px;">KARTU BEBAS PEMINJAMAN SARPRAS TUNGGAL</div>
              <div style="font-size: 12px; color: #64748B; font-weight: 600;">JURUSAN TEKNIK INFORMATIKA DAN KOMPUTER - FT UNM</div>
            </div>
            <div id="certKodeBadge" style="font-size: 11px; font-weight: 800; background: #F1F5F9; color: var(--primary-navy); padding: 4px 10px; border-radius: 4px; border: 1px solid #CBD5E1;">
              BBS-2026-036
            </div>
          </div>

          <!-- GREEN STATUS BANNER -->
          <div style="background: #F0FDF4; border: 1.2px solid #86EFAC; border-radius: 6px; padding: 10px 14px; margin-bottom: 16px;">
            <div style="display:flex; align-items:center; gap:6px; font-size: 11px; font-weight: 800; color: #166534;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span>BEBAS PEMINJAMAN SELURUH RUANGAN (3/3 DISAHKAN)</span>
            </div>
            <div style="font-size: 11.5px; color: #15803D; margin-top: 3px;">
              Bebas di semua ruangan/laboratorium serta inventaris terdaftar pada lingkungan JTIK.
            </div>
          </div>

          <!-- BIODATA MAHASISWA -->
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 10.5px; padding-bottom: 14px; border-bottom: 1px solid #E2E8F0; margin-bottom: 14px;">
            <div>
              <div style="font-size: 11.5px; color: #64748B; ">Nama Mahasiswa</div>
              <div id="certNamaMhs" style="font-weight: 700; color: var(--primary-navy); font-size: 11.5px;">Nayla Azzahra</div>
              <div style="font-size: 11.5px; color: #64748B; margin-top: 8px;">Program Studi</div>
              <div id="certProdi" style="font-weight: 600; color: #334155;">Pendidikan Teknik Informatika &amp; Komputer (PTIK A)</div>
            </div>
            <div>
              <div style="font-size: 11.5px; color: #64748B; ">NIM &amp; Angkatan</div>
              <div id="certNim" style="font-weight: 700; color: var(--primary-navy); font-size: 11.5px;">220209501002 (Angkatan 2022)</div>
              <div style="font-size: 11.5px; color: #64748B; margin-top: 8px;">Keperluan</div>
              <div id="certKeperluan" style="font-weight: 600; color: #334155;">Pemberkasan Yudisium &amp; Wisuda Sarjana FT UNM</div>
            </div>
          </div>

          <!-- STATUS PENGESAHAN 3 RUANGAN OTORITAS -->
          <div style="font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 8px; letter-spacing: 0.3px;">
            STATUS PENGESAHAN 3 RUANGAN OTORITAS (3/3 DISAHKAN)
          </div>

          <div style="display:flex; flex-direction:column; gap:8px;">
            <!-- RUANGAN 1 -->
            <div class="room-cert-card">
              <div class="room-cert-left">
                <div class="room-cert-title">1. Bengkel IT</div>
                <div class="room-cert-sub">Petugas: <span id="certPetugas1">Fahrul, S.Pd., M.T. | 22/06/2026, 09:15 WITA</span></div>
                <div style="font-size: 11.5px; color: #059669; font-weight: 600;">Tanggungan : 0 Barang</div>
              </div>
              <span class="room-cert-badge bebas">Bebas</span>
            </div>

            <!-- RUANGAN 2 -->
            <div class="room-cert-card">
              <div class="room-cert-left">
                <div class="room-cert-title">2. Laboratorium</div>
                <div class="room-cert-sub">Petugas: <span id="certPetugas2">Sulaeman, S.T. | 22/06/2026, 10:22 WITA</span></div>
                <div style="font-size: 11.5px; color: #059669; font-weight: 600;">Tanggungan : 0 Barang</div>
              </div>
              <span class="room-cert-badge bebas">Bebas</span>
            </div>

            <!-- RUANGAN 3 -->
            <div class="room-cert-card">
              <div class="room-cert-left">
                <div class="room-cert-title">3. Administrasi</div>
                <div class="room-cert-sub">Petugas: <span id="certPetugas3">Ahmad Dahlan, S.Kom. | 22/06/2026, 11:05 WITA</span></div>
                <div style="font-size: 11.5px; color: #059669; font-weight: 600;">Tanggungan : 0 Barang</div>
              </div>
              <span class="room-cert-badge bebas">Bebas</span>
            </div>
          </div>
        </div>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="closeCertModal()">Tutup Pratinjau</button>
        <button type="button" class="btn-orange-download" onclick="window.print()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Unduh Kartu Bebas (PDF)</span>
        </button>
      </div>
    </div>
  </div>

  <!-- ========================================================
       MODAL 2: DETAIL PENGAJUAN BEBAS SARPRAS (READ-ONLY)
       ======================================================== -->
  <div id="modalDetail" class="modal-overlay">
    <div class="modal-dialog">
      <!-- HEADER -->
      <div class="modal-header">
        <div style="display:flex; align-items:center; gap:8px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary-navy)" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
          <h2 style="font-size:12px; font-weight:800; color:var(--primary-navy); letter-spacing:0.3px;">Detail Pengajuan Bebas Pinjaman Mahasiswa</h2>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeDetailModal()">×</button>
      </div>

      <!-- BODY (MURNI HANYA BACA / TIDAK BISA DI-EDIT ATAU DIAKSIKAN) -->
      <div class="modal-body">
        
        <!-- BIODATA MAHASISWA -->
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:12px 16px; font-size:11px; line-height:1.6;">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <div style="font-size: 11.5px; color:#64748B; font-weight:700; ">No. Pengajuan</div>
              <div id="detailKode" style="font-weight:800; color:var(--primary-navy); font-size:12px;">-</div>
              
              <div style="font-size: 11.5px; color:#64748B; font-weight:700; margin-top:8px;">NIM &amp; Program Studi</div>
              <div id="detailNimProdi" style="font-weight:600; color:#334155;">-</div>

              <div style="font-size: 11.5px; color:#64748B; font-weight:700; margin-top:8px;">Tanggal Pengajuan</div>
              <div id="detailTglPengajuan" style="font-weight:600; color:#334155;">-</div>
            </div>
            <div>
              <div style="font-size: 11.5px; color:#64748B; font-weight:700; ">Nama Lengkap Mahasiswa</div>
              <div id="detailNamaMhs" style="font-weight:800; color:var(--primary-navy); font-size:12px;">-</div>

              <div style="font-size: 11.5px; color:#64748B; font-weight:700; margin-top:8px;">Keperluan</div>
              <div id="detailKeperluan" style="font-weight:600; color:#334155;">-</div>

              <div style="font-size: 11.5px; color:#64748B; font-weight:700; margin-top:8px;">Status Final Sistem</div>
              <div id="detailStatusFinal" style="font-weight:700;">-</div>
            </div>
          </div>
        </div>

        <!-- STATUS VERIFIKASI 3 RUANGAN -->
        <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-radius:8px; padding:12px 16px;">
          <div style="font-size: 12px; font-weight:800; color:var(--primary-navy); margin-bottom:8px;">Status Verifikasi 3 Unit Ruangan</div>
          <div style="display:flex; flex-direction:column; gap:6px;">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:6px 10px; background:#F8FAFC; border-radius:6px; font-size:11px;">
              <span style="font-weight:600; color:#334155;">1. Bengkel IT</span>
              <span id="detailStatusBengkel">-</span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:6px 10px; background:#F8FAFC; border-radius:6px; font-size:11px;">
              <span style="font-weight:600; color:#334155;">2. Laboratorium</span>
              <span id="detailStatusLabKomputer">-</span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:6px 10px; background:#F8FAFC; border-radius:6px; font-size:11px;">
              <span style="font-weight:600; color:#334155;">3. Administrasi</span>
              <span id="detailStatusLabJaringan">-</span>
            </div>
          </div>
        </div>

        <!-- TANGGUNGAN PINJAMAN DI RUANGAN INI -->
        <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-radius:8px; padding:12px 16px; display:flex; justify-content:space-between; align-items:center;">
          <div>
            <div style="font-size: 11.5px; color:#64748B; font-weight:700; ">Tanggungan Pinjaman di Ruangan Ini</div>
            <div style="font-size:11px; color:#334155; margin-top:2px;">Otoritas: <strong>{{ $badgeRuangan ?? 'Bengkel IT' }}</strong></div>
          </div>
          <div>
            <div id="detailBadgeTanggungan" class="liability-box clean">
              <span>0 Tanggungan Fisik</span>
            </div>
          </div>
        </div>

        <!-- CATATAN DARI PENGELOLA (JIKA ADA PENOLAKAN/CATATAN) -->
        <div id="detailBoxCatatan" style="display:none; background:#FEF2F2; border:1px solid #FECACA; border-radius:8px; padding:12px 16px;">
          <div style="font-size: 12px; font-weight:800; color:#991B1B; margin-bottom:4px;">Catatan dari Pengelola:</div>
          <div id="detailTextCatatan" style="font-size:11px; color:#7F1D1D; line-height:1.5;"></div>
        </div>

      </div>

      <!-- FOOTER: HANYA TOMBOL TUTUP (TIDAK BISA DI-EDIT ATAU DIAKSIKAN) -->
      <div class="modal-footer" style="display:flex; justify-content:flex-end;">
        <button type="button" class="btn-cancel" onclick="closeDetailModal()" style="min-width:100px;">Tutup</button>
      </div>
    </div>
  </div>

  <!-- ========================================================
       MODAL 3: FORM TOLAK PENGAJUAN BEBAS PINJAM
       ======================================================== -->
  <div id="modalTolak" class="modal-overlay">
    <div class="modal-dialog">
      <!-- HEADER -->
      <div class="modal-header">
        <div style="display:flex; align-items:center; gap:8px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
          <h2 style="font-size:12px; font-weight:800; color:#DC2626; letter-spacing:0.3px;">Tolak Bebas Pinjaman Mahasiswa</h2>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeTolakModal()">×</button>
      </div>

      <!-- BODY -->
      <div class="modal-body">
        
        <!-- BIODATA SINGKAT -->
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:6px; padding:10px 14px; font-size:10.5px; line-height:1.6;">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">
            <div>
              <div style="font-size: 11.5px; color:#64748B; font-weight:700; ">No. Pengajuan</div>
              <div id="tolakKode" style="font-weight:700; color:var(--primary-navy);">BBS-2026-037</div>
              <div style="font-size: 11.5px; color:#64748B; font-weight:700; margin-top:4px;">NIM &amp; Prodi</div>
              <div id="tolakNimProdi" style="font-weight:600; color:#334155;">220209502041 (PTIK B 2022)</div>
            </div>
            <div>
              <div style="font-size: 11.5px; color:#64748B; font-weight:700; ">Nama Mahasiswa</div>
              <div id="tolakNamaMhs" style="font-weight:700; color:var(--primary-navy);">Nurul Fadilah</div>
              <div style="font-size: 11.5px; color:#64748B; font-weight:700; margin-top:4px;">Keperluan</div>
              <div id="tolakKeperluan" style="font-weight:600; color:#334155;">Pemberkasan Bebas Sarpras</div>
            </div>
          </div>
        </div>

        <!-- TANGGUNGAN STATUS STRIP -->
        <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-radius:6px; padding:10px 14px; display:flex; justify-content:space-between; align-items:center;">
          <div>
            <div style="font-size: 11.5px; color:#64748B; font-weight:700; ">Tanggungan Pinjaman Ruangan Ini</div>
            <div style="font-size: 12px; color:#334155; margin-top:2px;">Otoritas: <strong>{{ $badgeRuangan ?? 'Bengkel IT' }}</strong></div>
          </div>
          <div>
            <div id="tolakBadgeTanggungan" class="liability-box clean">
              <span>0 Tanggungan Fisik</span>
            </div>
          </div>
        </div>

        <!-- FORM TOLAK / ALASAN PENOLAKAN -->
        <form id="formTolakAction" method="POST" action="">
          @csrf
          <div style="margin-bottom:10px;">
            <label style="display:block; font-size:11px; font-weight:700; color:var(--primary-navy); margin-bottom:6px;">
              Alasan Penolakan / Catatan Tanggungan yang Belum Selesai: <span style="color:#DC2626;">*</span>
            </label>
            <textarea id="inputAlasanTolak" name="alasan_penahanan" rows="3" required placeholder="Tuliskan alasan penolakan pengajuan..." style="width:100%; border:1.2px solid #CBD5E1; border-radius:6px; padding:10px; font-family:'Plus Jakarta Sans', sans-serif; font-size:11px; outline:none; resize:vertical;">Terdapat 1 unit alat sarpras di ruangan ini yang belum dikembalikan atau formulir pengembalian belum divalidasi laboran.</textarea>
          </div>

          <!-- INFO PENOLAKAN -->
          <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:6px; padding:9px 12px; font-size: 12px; color:#991B1B; line-height:1.45;">
            <strong>Info Penolakan:</strong> Status pengajuan akan diubah menjadi <strong>Ditolak</strong> dan memberitahukan kepada mahasiswa bahwa terdapat tanggungan yang wajib diselesaikan terlebih dahulu.
          </div>

          <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:14px;">
            <button type="button" class="btn-cancel" onclick="closeTolakModal()">Batal</button>
            <button type="submit" class="btn-orange-download" style="background:#DC2626;" id="btnSubmitTolak">
              Tolak Pengajuan
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- MODAL: PROFIL SAYA (PENGELOLA) -->
  <div id="modalProfile" class="modal-overlay">
    <div class="modal-dialog" style="max-width: 520px; background: #FFFFFF; border-radius: 12px; width: 100%; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15); border: 1px solid #E2E8F0; max-height: 90vh; overflow-y: auto;">
      <div class="modal-header" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 10px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <span style="font-size: 13.5px; font-weight: 800; color: #08296E;">Profil Akun Pengelola</span>
        </div>
        <button type="button" onclick="closeProfileModal()" style="border:none; background:none; font-size:18px; cursor:pointer; color:#64748B;">×</button>
      </div>

      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 14px;">
          <!-- Kartu Identitas Singkat -->
          <div style="display: flex; align-items: center; gap: 14px; background: #F8FAFC; padding: 12px 14px; border-radius: 8px; border: 1px solid #E2E8F0;">
            <div class="user-avatar-initial" style="width: 44px; height: 44px; font-size: 16px; flex-shrink: 0;">
              {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
            </div>
            <div>
              <div style="font-size: 13px; font-weight: 700; color: #0F172A;">{{ Auth::user()->name ?? 'Pengelola' }}</div>
              <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 6px; margin-top: 4px;">
                <span style="background: #0F172A; color: #FFFFFF; font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">{{ $badgeRuangan ?? 'Laboratorium' }}</span>
              </div>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Nama Lengkap &amp; Gelar</label>
              <input type="text" name="name" value="{{ Auth::user()->name }}" required style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
            </div>
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Alamat Email</label>
              <input type="email" name="email" value="{{ Auth::user()->email }}" required style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">NIP / Nomor Induk</label>
              <input type="text" name="nomor_induk" value="{{ Auth::user()->nomor_induk }}" style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #E2E8F0; background: #F8FAFC; border-radius: 6px; outline: none; box-sizing: border-box;">
            </div>
            <div>
              <label style="font-size: 10.5px; font-weight: 600; color: #334155; margin-bottom: 4px; display: block;">Jabatan / Posisi</label>
              <input type="text" name="jabatan" value="{{ Auth::user()->jabatan ?? ($ruangan->role_pj ?? 'Pengelola / Laboran') }}" style="width: 100%; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 6px; outline: none; box-sizing: border-box;">
            </div>
          </div>

          <div style="background: #EFF6FF; border: 1px solid #BFDBFE; padding: 10px 12px; border-radius: 6px; font-size: 12px; color: #1E40AF; display: flex; align-items: flex-start; gap: 8px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0; margin-top:2px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            <span>Akun ini bertindak sebagai <strong>Pengelola {{ $badgeRuangan ?? 'Laboratorium' }}</strong> dengan hak verifikasi peminjaman, pengembalian, dan validasi bebas tanggungan sarpras.</span>
          </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; border-top: 1px solid #E2E8F0; background: #F8FAFC;">
          <button type="button" class="btn-cancel" onclick="closeProfileModal()">Tutup</button>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-cancel" onclick="closeProfileModal(); openChangePasswordModal();" style="color: #08296E; border-color: #08296E;">Ganti Sandi</button>
            <button type="submit" class="btn-cancel" style="background: #08296E; color:#FFFFFF; border-color: #08296E;">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL: GANTI KATA SANDI -->
  <div id="modalChangePassword" class="modal-overlay">
    <div class="modal-dialog" style="max-width: 440px; background: #FFFFFF; border-radius: 12px; width: 100%; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15); border: 1px solid #E2E8F0; max-height: 90vh; overflow-y: auto;">
      <div class="modal-header" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 10px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ED7411" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <span style="font-size: 13.5px; font-weight: 800; color: #ED7411;">Ganti Kata Sandi</span>
        </div>
        <button type="button" onclick="closeChangePasswordModal()" style="border:none; background:none; font-size:18px; cursor:pointer; color:#64748B;">×</button>
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

        <div style="display: flex; justify-content: flex-end; gap: 8px; padding: 14px 20px; border-top: 1px solid #E2E8F0; background: #F8FAFC;">
          <button type="button" class="btn-cancel" onclick="closeChangePasswordModal()">Batal</button>
          <button type="submit" class="btn-cancel" style="background: #ED7411; color:#FFFFFF; border-color: #ED7411;">Perbarui Kata Sandi</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL: INFORMASI RUANGAN & CEK STOK SARPRAS -->
  <div id="modalRoomInfo" class="modal-overlay">
    <div class="modal-dialog" style="max-width: 720px; background: #FFFFFF; border-radius: 12px; width: 100%; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15); border: 1px solid #E2E8F0; max-height: 90vh; overflow-y: auto;">
      <div class="modal-header" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 10px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0F172A" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span style="font-size: 13.5px; font-weight: 800; color: #0F172A;">{{ strtoupper($ruangan->nama_ruangan ?? $badgeRuangan ?? 'LABORATORIUM') }} — Informasi &amp; Cek Stok</span>
        </div>
        <button type="button" onclick="closeRoomInfoModal()" style="border:none; background:none; font-size:18px; cursor:pointer; color:#64748B;">×</button>
      </div>

      <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 14px;">
        <!-- Ringkasan Profil Ruangan -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 12px 14px; border-radius: 8px;">
          <div>
            <div style="font-size: 11.5px; color: #64748B; font-weight: 700; ">Kode Ruangan</div>
            <div style="font-size: 11px; font-weight: 700; color: #0F172A; margin-top: 2px;">{{ $ruangan->kode_ruangan ?? 'RNG-LJT-01' }}</div>
          </div>
          <div>
            <div style="font-size: 11.5px; color: #64748B; font-weight: 700; ">Lokasi Gedung</div>
            <div style="font-size: 11px; font-weight: 700; color: #0F172A; margin-top: 2px;">{{ $ruangan->lokasi_gedung ?? 'Gedung A (Lab Terpadu JTIK)' }}</div>
          </div>
          <div>
            <div style="font-size: 11.5px; color: #64748B; font-weight: 700; ">Penanggung Jawab</div>
            <div style="font-size: 11px; font-weight: 700; color: #0F172A; margin-top: 2px;">{{ $ruangan->pj_ruangan ?? Auth::user()->name }}</div>
          </div>
          <div>
            <div style="font-size: 11.5px; color: #64748B; font-weight: 700; ">Kondisi Unit</div>
            <div style="font-size: 11px; font-weight: 700; color: #15803D; margin-top: 2px;"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px; margin-right:4px;"><polyline points="20 6 9 17 4 12"/></svg>Siap Operasional</div>
          </div>
        </div>

        <!-- Metric Mini Bar -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
          <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 6px; padding: 8px 12px;">
            <div style="font-size: 11.5px; color: #64748B; font-weight: 600;">Total Komoditas Sarpras</div>
            <div style="font-size: 16px; font-weight: 800; color: #08296E; margin-top: 2px;">{{ isset($sarprasRuangan) ? $sarprasRuangan->count() : 0 }} <span style="font-size: 12px; font-weight: 500; color: #64748B;">Item</span></div>
          </div>
          <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 6px; padding: 8px 12px;">
            <div style="font-size: 11.5px; color: #64748B; font-weight: 600;">Total Unit Fisik</div>
            <div style="font-size: 16px; font-weight: 800; color: #0F172A; margin-top: 2px;">{{ isset($sarprasRuangan) ? $sarprasRuangan->sum('jumlah_total') : 0 }} <span style="font-size: 12px; font-weight: 500; color: #64748B;">Unit</span></div>
          </div>
          <div style="background: #DCFCE7; border: 1px solid #86EFAC; border-radius: 6px; padding: 8px 12px;">
            <div style="font-size: 11.5px; color: #166534; font-weight: 600;">Siap Dipinjam (Ready)</div>
            <div style="font-size: 16px; font-weight: 800; color: #15803D; margin-top: 2px;">{{ isset($sarprasRuangan) ? $sarprasRuangan->sum('jumlah_tersedia') : 0 }} <span style="font-size: 12px; font-weight: 500; color: #166534;">Unit</span></div>
          </div>
        </div>

        <!-- Tabel Cek Stok Sarpras -->
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <div style="font-size: 11px; font-weight: 700; color: #0F172A;">Daftar Stok &amp; Inventaris Ruangan</div>
            <input type="text" id="stokSearchInput" onkeyup="filterStokTable()" placeholder="Cari nama alat / kode..." style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12px; padding: 4px 10px; border: 1px solid #CBD5E1; border-radius: 5px; width: 180px; outline: none;">
          </div>

          <div style="border: 1px solid #E2E8F0; border-radius: 8px; overflow: hidden; background: #FFFFFF;">
            <table id="stokTable" style="width: 100%; border-collapse: collapse; font-size: 10.5px; text-align: left;">
              <thead>
                <tr style="background: #F8FAFC; border-bottom: 1.2px solid var(--border-color); color: #475569; font-weight: 800; font-size: 11.5px;">
                  <th style="padding: 10px 12px; width: 110px;">Kode Aset</th>
                  <th style="padding: 10px 12px;">Nama Sarpras</th>
                  <th style="padding: 10px 12px; text-align: center; width: 110px;">Stok (Total/Ready)</th>
                  <th style="padding: 10px 12px; text-align: center; width: 85px;">Kondisi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($sarprasRuangan ?? [] as $sp)
                <tr style="border-bottom: 1px solid #F1F5F9;">
                  <td style="padding: 10px 12px; text-align: center;">
                    <span class="badge-asset-code">{{ $sp->kode_sarpras }}</span>
                  </td>
                  <td style="padding: 10px 12px;">
                    <div class="asset-name-title">{{ $sp->nama_sarpras }}</div>
                  </td>
                  <td style="padding: 10px 12px; text-align: center;">
                    <div class="stock-stack">
                      <span class="stock-box-total">Jumlah: {{ $sp->jumlah_total }}</span>
                      <span class="stock-box-ready">Ready: {{ $sp->jumlah_tersedia }}</span>
                    </div>
                  </td>
                  <td style="padding: 10px 12px; text-align: center;">
                    @if($sp->kondisi === 'rusak')
                      <span class="condition-badge condition-rusak">Rusak</span>
                    @elseif($sp->kondisi === 'perbaikan')
                      <span class="condition-badge condition-perbaikan">Perbaikan</span>
                    @else
                      <span class="condition-badge condition-baik">Baik</span>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" style="padding: 24px 16px; text-align: center; color: #64748B;">
                    <div style="font-weight: 700; font-size: 12px; color: #0F172A; margin-bottom: 2px;">Tidak Ada Sarpras</div>
                    <div style="font-size: 10.5px;">Belum ada sarpras yang terdaftar pada ruangan ini.</div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; padding: 14px 20px; border-top: 1px solid #E2E8F0; background: #F8FAFC;">
        <button type="button" class="btn-cancel" onclick="closeRoomInfoModal()">Tutup</button>
      </div>
    </div>
  </div>

  <!-- JAVASCRIPT LOGIC -->
  <script>
    // 3-Dots Action Dropdown Menu
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
        if (spaceBelow < 190) {
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

    function openCertificateModal(item) {
      document.getElementById('certKodeBadge').innerText = item.kode_pengajuan || 'BBS-2026-036';
      document.getElementById('certNamaMhs').innerText = item.user ? item.user.name : 'Mahasiswa';
      document.getElementById('certNim').innerText = (item.user ? item.user.nomor_induk : '220209501002') + ' (Angkatan 2022)';
      document.getElementById('certProdi').innerText = item.user ? item.user.jurusan : 'Pendidikan Teknik Informatika & Komputer (PTIK)';
      document.getElementById('certKeperluan').innerText = item.keperluan || 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM';

      if (item.petugas_lab_komputer) {
        document.getElementById('certPetugas1').innerText = item.petugas_lab_komputer + ' | Disahkan';
      }

      document.getElementById('modalCertificate').classList.add('active');
    }

    function closeCertModal() {
      document.getElementById('modalCertificate').classList.remove('active');
    }

    function getStatusBadgeHtml(status) {
      if (status === 'bebas') {
        return '<span class="room-cert-badge bebas">Bebas</span>';
      } else if (status === 'tertahan') {
        return '<span class="room-cert-badge tertahan">Ditolak</span>';
      } else {
        return '<span class="room-cert-badge belum_cek">◷ MENUNGGU</span>';
      }
    }

    // Modal 1: Detail Pengajuan (HANYA BACA)
    function openDetailModal(item) {
      document.getElementById('detailKode').innerText = item.kode_pengajuan || '-';
      document.getElementById('detailNamaMhs').innerText = item.user ? item.user.name : 'Mahasiswa';
      document.getElementById('detailNimProdi').innerText = (item.user ? item.user.nomor_induk : '-') + ' (' + (item.user ? item.user.jurusan : '-') + ')';
      document.getElementById('detailKeperluan').innerText = item.keperluan || 'Pemberkasan Bebas Sarpras';
      document.getElementById('detailTglPengajuan').innerText = item.tgl_pengajuan ? new Date(item.tgl_pengajuan).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-';

      const finalStatusEl = document.getElementById('detailStatusFinal');
      if (item.status_final === 'bebas') {
        finalStatusEl.innerHTML = '<span class="room-cert-badge bebas">LENGKAP &amp; BEBAS SEMUA LAB</span>';
      } else if (item.status_final === 'tertahan') {
        finalStatusEl.innerHTML = '<span class="room-cert-badge tertahan">DITOLAK (ADA TANGGUNGAN)</span>';
      } else {
        finalStatusEl.innerHTML = '<span class="room-cert-badge belum_cek">PROSES VERIFIKASI</span>';
      }

      document.getElementById('detailStatusLabKomputer').innerHTML = getStatusBadgeHtml(item.status_lab_komputer);
      document.getElementById('detailStatusLabJaringan').innerHTML = getStatusBadgeHtml(item.status_lab_jaringan);
      document.getElementById('detailStatusBengkel').innerHTML = getStatusBadgeHtml(item.status_ruang_inventaris);

      const badgeTanggungan = document.getElementById('detailBadgeTanggungan');
      if (item.status_lab_komputer === 'tertahan') {
        badgeTanggungan.className = 'liability-box held';
        badgeTanggungan.innerHTML = '<span>1 Pinjaman Aktif</span><span style="font-size: 11.5px;opacity:0.9;">(Status: Ditolak)</span>';
      } else if ((item.loan_count || 0) > 0) {
        badgeTanggungan.className = 'liability-box waiting';
        badgeTanggungan.innerHTML = '<span>' + item.loan_count + ' Pinjaman Aktif</span><span style="font-size: 11.5px;opacity:0.9;">(Status: Menunggu)</span>';
      } else {
        badgeTanggungan.className = 'liability-box clean';
        badgeTanggungan.innerHTML = '<span>0 Tanggungan Fisik</span>';
      }

      const boxCatatan = document.getElementById('detailBoxCatatan');
      if (item.catatan_lab_komputer) {
        boxCatatan.style.display = 'block';
        document.getElementById('detailTextCatatan').innerText = item.catatan_lab_komputer;
      } else {
        boxCatatan.style.display = 'none';
      }

      document.getElementById('modalDetail').classList.add('active');
    }

    function closeDetailModal() {
      document.getElementById('modalDetail').classList.remove('active');
    }

    // Modal 2: Tolak Pengajuan
    function openTolakModal(item) {
      document.getElementById('tolakKode').innerText = item.kode_pengajuan;
      document.getElementById('tolakNamaMhs').innerText = item.user ? item.user.name : 'Mahasiswa';
      document.getElementById('tolakNimProdi').innerText = (item.user ? item.user.nomor_induk : '-') + ' (' + (item.user ? item.user.jurusan : '-') + ')';
      document.getElementById('tolakKeperluan').innerText = item.keperluan || 'Pemberkasan Bebas Sarpras';

      // Status Tanggungan
      const badgeTanggungan = document.getElementById('tolakBadgeTanggungan');
      if (item.status_lab_komputer === 'tertahan') {
        badgeTanggungan.className = 'liability-box held';
        badgeTanggungan.innerHTML = '<span>1 Pinjaman Aktif</span><span style="font-size: 11.5px;opacity:0.9;">(Status: Ditolak)</span>';
      } else if ((item.loan_count || 0) > 0) {
        badgeTanggungan.className = 'liability-box waiting';
        badgeTanggungan.innerHTML = '<span>' + item.loan_count + ' Pinjaman Aktif</span><span style="font-size: 11.5px;opacity:0.9;">(Status: Menunggu)</span>';
      } else {
        badgeTanggungan.className = 'liability-box clean';
        badgeTanggungan.innerHTML = '<span>0 Tanggungan Fisik</span>';
      }

      if (item.catatan_lab_komputer) {
        document.getElementById('inputAlasanTolak').value = item.catatan_lab_komputer;
      } else {
        document.getElementById('inputAlasanTolak').value = 'Terdapat 1 unit alat sarpras di ruangan ini yang belum dikembalikan atau formulir pengembalian belum divalidasi laboran.';
      }

      document.getElementById('formTolakAction').action = '/pengelola/bebas-pinjam/' + item.id + '/tahan';
      document.getElementById('btnSubmitTolak').innerText = item.status_lab_komputer === 'tertahan' ? 'Perbarui Alasan Penolakan' : 'Tolak Pengajuan';

      document.getElementById('modalTolak').classList.add('active');
    }

    function closeTolakModal() {
      document.getElementById('modalTolak').classList.remove('active');
    }

    // Pengelola Dropdown & Profile Actions
    function togglePengelolaDropdown(e) {
      if (e) e.stopPropagation();
      const dropdown = document.getElementById('pengelolaDropdown');
      if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      }
    }

    function openProfileModal() {
      const dropdown = document.getElementById('pengelolaDropdown');
      if (dropdown) dropdown.style.display = 'none';
      document.getElementById('modalProfile').classList.add('active');
    }

    function closeProfileModal() {
      document.getElementById('modalProfile').classList.remove('active');
    }

    function openChangePasswordModal() {
      const dropdown = document.getElementById('pengelolaDropdown');
      if (dropdown) dropdown.style.display = 'none';
      document.getElementById('modalChangePassword').classList.add('active');
    }

    function closeChangePasswordModal() {
      document.getElementById('modalChangePassword').classList.remove('active');
    }

    function openRoomInfoModal() {
      const dropdown = document.getElementById('pengelolaDropdown');
      if (dropdown) dropdown.style.display = 'none';
      document.getElementById('modalRoomInfo').classList.add('active');
    }

    function closeRoomInfoModal() {
      document.getElementById('modalRoomInfo').classList.remove('active');
    }

    function filterStokTable() {
      const input = document.getElementById('stokSearchInput');
      const filter = (input ? input.value : '').toLowerCase();
      const table = document.getElementById('stokTable');
      if (!table) return;
      const trs = table.getElementsByTagName('tr');
      for (let i = 1; i < trs.length; i++) {
        const text = trs[i].textContent || trs[i].innerText;
        trs[i].style.display = text.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
      }
    }

    // Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeCertModal();
        closeDetailModal();
        closeTolakModal();
        closeProfileModal();
        closeChangePasswordModal();
        closeRoomInfoModal();
        closeAllActionMenus();
        const dropdown = document.getElementById('pengelolaDropdown');
        if (dropdown) dropdown.style.display = 'none';
      }
    });

    // Close dropdown on outside click
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.action-dropdown-wrap')) {
        closeAllActionMenus();
      }
      const dropdown = document.getElementById('pengelolaDropdown');
      const btn = document.getElementById('pengelolaBtn');
      if (dropdown && btn && !btn.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>


  @include('partials.ui_feedback')
</body>
</html>
