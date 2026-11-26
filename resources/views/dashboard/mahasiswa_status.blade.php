<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM — Status Pinjam & Riwayat Tiket</title>
  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
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

    .portal-layout {
      display: grid;
      grid-template-columns: 220px 1fr;
      width: 100%;
      min-height: 100vh;
    }

    /* SIDEBAR KONSISTEN 220PX */
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
      text-decoration: none;
    }

    .nav-parent-header:hover {
      background: rgba(255, 255, 255, 0.08);
      color: #FFFFFF;
    }

    .nav-parent-header.active {
      background: #ED7411 !important;
      color: #FFFFFF !important;
      font-weight: 700;
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
      padding: 7px 12px 7px 14px;
      color: #CBD5E1;
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

    /* PAGE HEADER */
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

    /* ALERT BANNERS */
    .alert-banner {
      padding: 10px 16px;
      border-radius: 8px;
      font-size: 11.5px;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: space-between;
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

    /* STATUS TOOLBAR & FILTER TABS (FIGMA COLUMN 4) */
    .status-toolbar-panel {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 14px 18px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .status-filter-pills {
      display: flex;
      align-items: center;
      gap: 6px;
      flex-wrap: wrap;
    }

    .filter-pill-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 5.5px 12px;
      border-radius: 6px;
      font-size: 10.5px;
      font-weight: 600;
      background: #F8FAFC;
      border: 1px solid var(--border-subtle);
      color: #475569;
      text-decoration: none;
      transition: all 0.15s ease;
    }

    .filter-pill-btn:hover {
      background: #EFF6FF;
      color: var(--primary-navy);
      border-color: #BFDBFE;
    }

    .filter-pill-btn.active {
      background: #08296E;
      color: #FFFFFF;
      border-color: #08296E;
    }

    .filter-pill-count {
      font-size: 9px;
      font-weight: 800;
      padding: 1px 6px;
      border-radius: 4px;
      background: rgba(0, 0, 0, 0.08);
    }

    .filter-pill-btn.active .filter-pill-count {
      background: #FFFFFF;
      color: #08296E;
    }

    .status-search-box {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
      max-width: 380px;
    }

    .status-search-input {
      width: 100%;
      padding: 6.5px 12px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      outline: none;
    }

    .status-search-input:focus {
      border-color: #08296E;
    }

    /* TABLE SECTION */
    .table-container-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
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
      padding: 10px 14px;
      text-align: left;
    }

    .custom-table td {
      padding: 12px 14px;
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
      letter-spacing: 0.5px;
    }

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
      padding: 4px 10px;
      border-radius: 4px;
      font-size: 9.5px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: all 0.15s ease;
    }

    .btn-detail:hover {
      background: #08296E;
      color: #FFFFFF;
    }

    .btn-cancel {
      background: #FEE2E2;
      border: 1px solid #FCA5A5;
      color: #DC2626;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 9.5px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.15s ease;
    }

    .btn-cancel:hover {
      background: #DC2626;
      color: #FFFFFF;
    }

    /* MODAL POPUP */
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
      max-width: 650px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
      border: 1px solid #E2E8F0;
      max-height: 90vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .modal-header {
      padding: 16px 20px;
      border-bottom: 1px solid #E2E8F0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h3 {
      font-size: 13.5px;
      font-weight: 800;
      color: #08296E;
    }

    .modal-close-btn {
      background: none;
      border: none;
      font-size: 20px;
      color: #64748B;
      cursor: pointer;
      line-height: 1;
    }

    .modal-body {
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .modal-footer {
      padding: 12px 20px;
      border-top: 1px solid #E2E8F0;
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      background: #F8FAFC;
    }

    .detail-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .detail-card {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 6px;
      padding: 8px 10px;
    }

    .detail-card-label {
      font-size: 9px;
      font-weight: 700;
      color: #64748B;
      text-transform: uppercase;
      margin-bottom: 2px;
    }

    .detail-card-value {
      font-size: 11px;
      font-weight: 700;
      color: #0F172A;
    }

    /* TIMELINE TRACKING (PERSIS FIGMA REKOMENDASI) */
    .timeline-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
      position: relative;
      margin-left: 10px;
      padding-left: 18px;
      border-left: 2px solid #E2E8F0;
      margin-top: 8px;
    }

    .timeline-step {
      position: relative;
    }

    .timeline-dot {
      position: absolute;
      left: -24px;
      top: 2px;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #CBD5E1;
      border: 2px solid #FFFFFF;
    }

    .timeline-step.completed .timeline-dot {
      background: #16A34A;
    }

    .timeline-step.active .timeline-dot {
      background: #ED7411;
      box-shadow: 0 0 0 3px rgba(237, 116, 17, 0.2);
    }

    .timeline-title {
      font-size: 11px;
      font-weight: 700;
      color: #0F172A;
    }

    .timeline-sub {
      font-size: 9.5px;
      color: #64748B;
      margin-top: 1px;
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

    /* SHARED MODAL PROFIL & GANTI KATA SANDI STYLES */
    #modalProfile .modal-dialog,
    #modalChangePassword .modal-dialog {
      max-width: 580px;
    }
    #modalProfile .modal-body,
    #modalChangePassword .modal-body {
      display: block;
      padding: 18px 20px;
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
    .form-input:focus, .form-select:focus, .form-textarea:focus, select.auto-prodi-input:focus {
      outline: none;
      border-color: #08296E !important;
      box-shadow: 0 0 0 2px rgba(8, 41, 110, 0.08);
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

    /* PERBAIKAN SKALA TIPOGRAFI, FONT PLUS JAKARTA SANS & BORDER HALUS */
    body, button, input, select, textarea,
    .nav-header-label, .cart-btn-header, .badge-role-pill, .btn-header-mahasiswa,
    .user-dropdown-btn, .filter-pill-btn, .status-search-input, .tbl-filter-btn,
    .form-input, .form-select, .form-textarea, .btn-primary, .btn-secondary,
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

    .status-toolbar-panel {
      border: 1px solid #E5E7EB;
      border-radius: 10px;
      padding: 14px 18px;
      gap: 14px;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }
    .table-container-card { border: 1px solid #E5E7EB; border-radius: 10px; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04); }
    .status-filter-pills { gap: 8px; }
    .filter-pill-btn {
      font-size: 12px;
      padding: 7px 13px;
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      color: #475569;
    }
    .filter-pill-btn:hover { background: #F1F5F9; color: #08296E; border-color: #CBD5E1; }
    .filter-pill-btn.active { background: #08296E; color: #FFFFFF; border-color: #08296E; }
    .filter-pill-count { font-size: 11px; }
    .status-search-input { font-size: 12.5px; padding: 8px 13px; border-color: #D8DEE9; }

    .table-header-bar { padding: 14px 20px; }
    .th-title { font-size: 14px; text-transform: none; }
    .tbl-filter-btn { font-size: 11.5px; padding: 5px 11px; }
    .custom-table { font-size: 12.5px; }
    .custom-table th {
      background: #F8FAFC;
      color: #475569;
      font-size: 11.5px;
      font-weight: 700;
      padding: 12px 16px;
      border-bottom: 1.5px solid #E2E8F0;
    }
    .custom-table td { padding: 13px 16px; border-bottom: 1px solid #F1F5F9; }
    .trx-tag { font-size: 12px; }
    .pill-status { font-size: 11px; padding: 4px 10px; border-radius: 5px; font-weight: 600; }
    .btn-detail { font-size: 11.5px; padding: 5px 13px; border-radius: 6px; }

    .modal-title, .modal-header h3 { font-size: 15px; }
    .detail-card-label { font-size: 10.5px; }
    .detail-card-value { font-size: 12.5px; }
    .timeline-title { font-size: 12.5px; }
    .timeline-sub { font-size: 11.5px; }
    .form-label { font-size: 12px; }
    .form-input, .form-select, .form-textarea { font-size: 12.5px; padding: 9px 12px; border-color: #D8DEE9; }
    .btn-primary, .btn-secondary { font-size: 12.5px; padding: 9px 16px; }

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

  <div class="portal-layout">
    
    <!-- SIDEBAR KONSISTEN 220PX -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('images/logo-unm-white.png') }}" alt="UNM SI-SAPRAS JTIK" class="brand-logo-img">
      </div>

      <!-- MENU NAVIGASI MAHASISWA -->
      <nav class="sidebar-nav">
        <!-- 1. Dashboard -->
        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item" title="Dashboard Utama Mahasiswa">
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

        <!-- LAYANAN MAHASISWA -->
        <div class="nav-header-label">Layanan Mahasiswa</div>

        <!-- 3. Pengembalian -->
        <a href="{{ route('mahasiswa.pengembalian') }}" class="nav-item" title="Layanan Pengembalian Fisik & Bukti Serah Terima">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <polyline points="9 14 4 9 9 4"></polyline>
              <path d="M20 20v-7a4 4 0 0 0-4-4H4"></path>
            </svg>
            <span>Pengembalian</span>
          </div>
        </a>

        <!-- 4. Status Pinjam (ACTIVE) -->
        <a href="{{ route('mahasiswa.status-pinjam') }}" class="nav-item active" title="Lihat Status & Riwayat Peminjaman">
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
        <a href="{{ route('mahasiswa.bebas-sarpras') }}" class="nav-item" title="Pemeriksaan & Pengajuan Bebas Sarpras">
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

      <div class="sidebar-footer">
        SI-SAPRAS JTIK FT UNM
      </div>
    </aside>

    <!-- MAIN WORKSPACE -->
    <main class="workspace">

      <!-- PAGE HEADER -->
      <div class="page-header-row">
        <div style="display: flex; align-items: baseline; gap: 8px; flex: 1; min-width: 0; flex-wrap: wrap;">
          <h1 class="page-title">Status Pinjam &amp; Riwayat Tiket</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">Pantau perjalanan persetujuan &amp; serah terima sarpras | <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->nomor_induk }})</span>
        </div>
        <div class="header-actions">
          <!-- Tombol Keranjang Peminjaman (Ikon & Badge Angka Sesuai Figma) -->
          <button class="cart-btn-header" type="button" onclick="openCartModal()" title="Keranjang Peminjaman">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="cart-badge-count" id="cartCountBadge">0</span>
          </button>

          <!-- User Role Pill Badge Mahasiswa (Persis Pengelola) -->
          <div style="position: relative;">
            <button type="button" id="userPillBtn" class="btn-header-mahasiswa" onclick="toggleUserDropdown(event)" title="Menu Akun Mahasiswa">
              <span>Mahasiswa</span>
              <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>

            <!-- Dropdown Profil & Menu Fungsional (Selaras Pengelola) -->
            <div id="userDropdown" class="user-dropdown-panel" style="display: none;">
              <!-- Header Profil (Klik untuk Buka Profil Saya) -->
              <div class="user-dropdown-header-card" onclick="openProfileModal()" title="Klik untuk lihat / ubah Profil">
                <div class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}</div>
                <div style="flex: 1; min-width: 0;">
                  <div class="user-dropdown-name">{{ Auth::user()->name ?? 'Mahasiswa' }}</div>
                  <div class="user-dropdown-email">{{ Auth::user()->email ?? '-' }}</div>
                  <div class="user-dropdown-tag">{{ Auth::user()->jurusan ? Auth::user()->jurusan : (Auth::user()->nomor_induk ? 'NIM: ' . Auth::user()->nomor_induk : 'Mahasiswa JTIK') }}</div>
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

      <!-- FLASH NOTIFIKASI -->
      @if(session('success'))
        <div class="alert-banner success">
          <div style="display: flex; align-items: center; gap: 8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ session('success') }}</span>
          </div>
          <button type="button" class="alert-close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert-banner error">
          <div style="display: flex; align-items: center; gap: 8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>{{ session('error') }}</span>
          </div>
          <button type="button" class="alert-close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
      @endif

      <!-- TOOLBAR & FILTER TIKET (FIGMA UI SCREEN 4) -->
      <div class="status-toolbar-panel">
        <div class="status-filter-pills">
          <a href="{{ route('mahasiswa.status-pinjam', ['status' => 'semua', 'search' => $search ?? '']) }}" class="filter-pill-btn {{ ($statusFilter ?? 'semua') === 'semua' ? 'active' : '' }}">
            <span>Semua Tiket</span>
            <span class="filter-pill-count">{{ $totalCount ?? 0 }}</span>
          </a>
          <a href="{{ route('mahasiswa.status-pinjam', ['status' => 'aktif', 'search' => $search ?? '']) }}" class="filter-pill-btn {{ ($statusFilter ?? '') === 'aktif' ? 'active' : '' }}">
            <span>Sedang Dipinjam</span>
            <span class="filter-pill-count">{{ $aktifCount ?? 0 }}</span>
          </a>
          <a href="{{ route('mahasiswa.status-pinjam', ['status' => 'menunggu', 'search' => $search ?? '']) }}" class="filter-pill-btn {{ ($statusFilter ?? '') === 'menunggu' ? 'active' : '' }}">
            <span>Menunggu ACC</span>
            <span class="filter-pill-count">{{ $menungguCount ?? 0 }}</span>
          </a>
          <a href="{{ route('mahasiswa.status-pinjam', ['status' => 'selesai', 'search' => $search ?? '']) }}" class="filter-pill-btn {{ ($statusFilter ?? '') === 'selesai' ? 'active' : '' }}">
            <span>Selesai</span>
            <span class="filter-pill-count">{{ $selesaiCount ?? 0 }}</span>
          </a>
          <a href="{{ route('mahasiswa.status-pinjam', ['status' => 'ditolak', 'search' => $search ?? '']) }}" class="filter-pill-btn {{ ($statusFilter ?? '') === 'ditolak' ? 'active' : '' }}">
            <span>Ditolak</span>
            <span class="filter-pill-count">{{ $ditolakCount ?? 0 }}</span>
          </a>
        </div>

        <form method="GET" action="{{ route('mahasiswa.status-pinjam') }}" class="status-search-box">
          <input type="hidden" name="status" value="{{ $statusFilter ?? 'semua' }}">
          <input type="text" name="search" class="status-search-input" value="{{ $search ?? '' }}" placeholder="Cari No. Tiket, barang, keperluan...">
          <button type="submit" class="btn-detail" style="background:#08296E; color:#FFFFFF; padding: 6.5px 12px; font-size:11px;">Cari</button>
        </form>
      </div>

      <!-- TABEL DAFTAR TIKET -->
      <div class="table-container-card">
        @if($tikets->isEmpty())
          <div style="text-align: center; padding: 48px 16px; color: #64748B;">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#CBD5E1" stroke-width="1.8" style="margin-bottom: 8px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
            <h3 style="font-size: 13.5px; font-weight: 700; color: #0F172A;">Tidak Ada Tiket Ditemukan</h3>
            <p style="font-size: 11px; margin-top: 4px;">Tidak ada riwayat atau permohonan pinjam dengan status yang dipilih.</p>
          </div>
        @else
          <div style="overflow-x: auto;">
            <table class="custom-table">
              <thead>
                <tr>
                  <th style="width: 145px;">No. Tiket</th>
                  <th>Fasilitas / Barang</th>
                  <th>Unit / Lokasi</th>
                  <th>Waktu Pinjam</th>
                  <th style="text-align:center; width: 210px;">Status</th>
                  <th style="text-align:center; width: 120px;">Tindakan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tikets as $t)
                  @php
                    $isMenunggu = $t->status === 'menunggu_verifikasi';
                    $isPartialPending = $t->status === 'diproses_sebagian';
                    $isPartialApproved = $t->status === 'disetujui_sebagian';
                    $isSelesai = $t->status === 'selesai';
                    $isSedangDipinjam = $t->status === 'sedang_dipinjam';
                    $isDisetujui = $t->status === 'disetujui';
                    $isDitolak = $t->status === 'ditolak';
                    $barangNama = $t->sarpras->nama_sarpras ?? 'Barang Sarpras';
                    $ruangNama = $t->rooms_summary ?? ($t->sarpras->ruangan->nama_ruangan ?? 'Laboratorium JTIK');
                    $itemCount = $t->total_items_count ?? 1;
                    $itemsPayload = collect($t->ticket_items ?? [$t])->map(function($it) {
                      return [
                        'id' => $it->id,
                        'nama' => optional($it->sarpras)->nama_sarpras ?? 'Barang Sarpras',
                        'jumlah' => (int) ($it->jumlah ?? 1),
                        'ruangan' => $it->room_name ?? (optional(optional($it->sarpras)->ruangan)->nama_ruangan ?? 'Laboratorium JTIK'),
                        'status' => $it->status ?? 'menunggu_verifikasi',
                        'status_pengembalian' => $it->status_pengembalian ?? null,
                        'catatan' => $it->clean_catatan ?? ($it->catatan_pengelola ?? ''),
                      ];
                    })->values();
                    $tiketDetailPayload = [
                      'kode' => $t->kode_peminjaman,
                      'barang' => $barangNama,
                      'jumlah' => (int) ($t->jumlah ?? 1),
                      'total_units_sum' => (int) ($t->total_units_sum ?? $t->jumlah ?? 1),
                      'approved_units_sum' => (int) ($t->approved_units_sum ?? $t->jumlah ?? 1),
                      'ruangan' => $ruangNama,
                      'keperluan' => $t->keperluan,
                      'dosen' => $t->dosen_penanggung_jawab ?? 'Dosen Pengampu',
                      'pinjam' => $t->jadwal_lengkap,
                      'kembali' => date('d M Y H:i', strtotime($t->tgl_kembali_rencana)) . ' WITA',
                      'status' => $t->status,
                      'status_breakdown' => $t->status_breakdown ?? '',
                      'catatan' => $t->catatan_pengelola ?? '',
                      'items' => $itemsPayload,
                    ];
                  @endphp
                  <tr>
                    <td class="trx-tag">{{ $t->kode_peminjaman }}</td>
                    <td>
                      <div style="font-weight: 700; color: #0F172A;">{{ $barangNama }} ({{ $t->jumlah }} Unit)</div>
                      @if($itemCount > 1)
                        <div style="font-size: 11.5px; color: #64748B; font-weight: 600;">+{{ $itemCount - 1 }} barang lainnya ({{ $itemCount }} barang)</div>
                      @else
                        <div style="font-size: 11.5px; color: #64748B;">Keperluan: {{ Str::limit($t->keperluan, 45) }}</div>
                      @endif
                    </td>
                    <td>
                      <div>{{ $ruangNama }}</div>
                    </td>
                    <td>
                      <div>{{ $t->jadwal_lengkap }}</div>
                      <div style="font-size: 11.5px; color: #D97706;">Kembali: {{ date('d M Y', strtotime($t->tgl_kembali_rencana)) }}</div>
                    </td>
                    <td style="text-align:center;">
                      @if($isSedangDipinjam)
                        <span class="pill-status pill-orange">Sedang Dipinjam</span>
                      @elseif($isPartialApproved)
                        <span class="pill-status pill-partial">Sebagian Disetujui</span>
                      @elseif($isPartialPending)
                        <span class="pill-status pill-indigo">Diproses Sebagian</span>
                      @elseif($isDisetujui)
                        <span class="pill-status pill-blue">Disetujui</span>
                      @elseif($isMenunggu)
                        <span class="pill-status pill-yellow">Menunggu ACC</span>
                      @elseif($isSelesai)
                        <span class="pill-status pill-green">Selesai</span>
                      @elseif($isDitolak)
                        <span class="pill-status pill-red">Ditolak</span>
                      @else
                        <span class="pill-status pill-blue">{{ ucwords(str_replace('_', ' ', $t->status)) }}</span>
                      @endif
                      @if(!empty($t->status_breakdown))
                        <div class="status-breakdown-note">
                          {{ $t->status_breakdown }}
                        </div>
                      @endif
                    </td>
                    <td style="text-align:center;">
                      <div style="display: inline-flex; align-items: center; gap: 5px;">
                        <button type="button" class="btn-detail"
                          onclick="openTiketDetail({{ json_encode($tiketDetailPayload) }})">
                          Detail
                        </button>

                        @if($isMenunggu || ($isPartialPending && !empty($t->cancelable_peminjaman_id)))
                          <form method="POST" action="{{ route('mahasiswa.peminjaman.batal', $t->cancelable_peminjaman_id ?? $t->id) }}" onsubmit="return confirmFormSubmit(event, this, 'Batalkan Permohonan', 'Apakah Anda yakin ingin membatalkan item permohonan yang masih menunggu verifikasi ini?', 'Ya, Batalkan', true)" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-cancel" title="Batalkan Permohonan">Batal</button>
                          </form>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

    </main>
  </div>

  <!-- POPUP MODAL: DETAIL TIKET & TRACKING TIMELINE -->
  <div id="modalTiketDetail" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalTiketDetail')">
    <div class="modal-dialog">
      <div class="modal-header">
        <h3 id="tdKodeTitle">Detail Tiket Peminjaman</h3>
        <button type="button" class="modal-close-btn" onclick="closeModal('modalTiketDetail')">×</button>
      </div>
      <div class="modal-body">
        <div class="detail-grid">
          <div class="detail-card">
            <div class="detail-card-label">Nomor Tiket</div>
            <div class="detail-card-value" id="tdKode" style="font-family: 'JetBrains Mono', monospace; color: #08296E;">TRX-00</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Status Tiket</div>
            <div class="detail-card-value" id="tdStatus">-</div>
          </div>
          <div class="detail-card" style="grid-column: 1 / -1;">
            <div class="detail-card-label">Rincian Fasilitas / Barang</div>
            <div class="detail-card-value" id="tdBarang">-</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Jumlah Unit</div>
            <div class="detail-card-value" id="tdJumlah">-</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Unit / Laboratorium</div>
            <div class="detail-card-value" id="tdRuangan">-</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Waktu Pinjam</div>
            <div class="detail-card-value" id="tdWaktuPinjam">-</div>
          </div>
          <div class="detail-card">
            <div class="detail-card-label">Batas Pengembalian</div>
            <div class="detail-card-value" id="tdBatasKembali" style="color: #D97706;">-</div>
          </div>
        </div>

        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 12px; font-size: 11px;">
          <div style="font-size: 11.5px; font-weight: 700; color: #64748B; ">Dosen Pembimbing / PJ:</div>
          <div style="font-weight: 700; color: #0F172A;" id="tdDosen">-</div>
          <div style="font-size: 11.5px; font-weight: 700; color: #64748B; margin-top: 6px;">Keperluan:</div>
          <div style="color: #334155;" id="tdKeperluan">-</div>
        </div>

        <div id="tdRejectedWrap" style="display: none; border-radius: 6px; padding: 10px 12px; font-size: 11px; border: 1px solid #FECACA; background: #FEF2F2; margin-top: 8px;">
          <div id="tdRejectedLabel" style="font-size: 11.5px; font-weight: 800; color: #B91C1C; margin-bottom: 3px;">Alasan Penolakan Pengelola:</div>
          <div id="tdRejected" style="color: #7F1D1D; font-weight: 500; line-height: 1.5;">-</div>
        </div>

        <div id="tdCatatanWrap" style="display: none; border-radius: 6px; padding: 10px 12px; font-size: 11px; border: 1px solid #FDE68A; background: #FFFBEB; margin-top: 8px;">
          <div id="tdCatatanLabel" style="font-size: 11.5px; font-weight: 800; color: #B45309; margin-bottom: 3px;">Informasi Pengambilan &amp; Catatan Pengelola:</div>
          <div id="tdCatatan" style="color: #92400E; font-weight: 500; line-height: 1.5;">-</div>
        </div>

        <!-- TIMELINE PERJALANAN TIKET (PERSIS FIGMA) -->
        <div style="margin-top: 4px;">
          <div style="font-size: 11px; font-weight: 700; color: #0F172A;">Perjalanan Verifikasi Layanan:</div>
          <div class="timeline-list">
            <div class="timeline-step completed" id="tStep1">
              <div class="timeline-dot"></div>
              <div class="timeline-title">1. Permohonan Pinjam Diajukan</div>
              <div class="timeline-sub">Mahasiswa mengirimkan formulir permohonan ke sistem.</div>
            </div>
            <div class="timeline-step" id="tStep2">
              <div class="timeline-dot"></div>
              <div class="timeline-title">2. Verifikasi Dosen &amp; Laboran</div>
              <div class="timeline-sub">Peninjauan ketersediaan stok &amp; persetujuan penanggung jawab.</div>
            </div>
            <div class="timeline-step" id="tStep3">
              <div class="timeline-dot"></div>
              <div class="timeline-title">3. Pengambilan Fisik Barang</div>
              <div class="timeline-sub">Pemeriksaan fisik awal dan serah terima instrumen di loket lab.</div>
            </div>
            <div class="timeline-step" id="tStep4">
              <div class="timeline-dot"></div>
              <div class="timeline-title">4. Pengembalian Selesai</div>
              <div class="timeline-sub">Pemeriksaan kondisi akhir fisik dan penerbitan bukti bebas sarpras.</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-detail" onclick="closeModal('modalTiketDetail')">Tutup</button>
      </div>
    </div>
  </div>

  <!-- MODAL: FORMULIR PENGAJUAN PINJAM (FIGMA DESIGN BATCH CHECKOUT) -->
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
                <input type="hidden" name="kelas_id" class="auto-kelas-id-input" value="{{ Auth::user()->kelas_id }}">
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Kelas (Ketik untuk Mencari) <span style="color: #DC2626;">*</span></label>
                <div class="searchable-combobox" id="cartStatusKelasComboboxWrapper" style="position: relative;">
                  <div style="position: relative; display: flex; align-items: center;">
                    <svg style="position: absolute; left: 10px; width: 13px; height: 13px; color: #94A3B8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" 
                           id="cartStatusInputKelas" 
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
                  <div id="cartStatusDropdownListKelas" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; max-height: 180px; overflow-y: auto; background: #FFFFFF; border: 1.5px solid #0091FF; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12); z-index: 99999;"></div>
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
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Jadwal / Sesi Penggunaan <span style="color: #DC2626;">*</span></label>
                <input type="text" name="jadwal_penggunaan" id="batchJadwal" value="08:00 - 15:00 WITA" placeholder="Contoh: 08:00 - 15:00 WITA" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #FFFFFF; color: #334155;">
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

  <!-- MODAL: PROFIL SAYA (PERSIS GAYA ADMIN & PENGELOLA) -->
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
              <input type="hidden" name="kelas_id" class="auto-kelas-id-input" value="{{ Auth::user()->kelas_id }}">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Kelas (Ketik untuk Mencari) <span class="req">*</span></label>
              <div class="searchable-combobox" id="profileKelasComboboxWrapper" style="position: relative;">
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

  <!-- MODAL: GANTI KATA SANDI (PERSIS GAYA ADMIN & PENGELOLA) -->
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

  <script>
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

    function openProfileModal() {
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) dropdown.style.display = 'none';
      openModal('modalProfile');
    }

    function openChangePasswordModal() {
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) dropdown.style.display = 'none';
      openModal('modalChangePassword');
    }

    function openModal(id) {
      const el = document.getElementById(id);
      if (el) el.classList.add('active');
    }

    function closeModal(id) {
      const el = document.getElementById(id);
      if (el) el.classList.remove('active');
    }

    function closeModalOnOverlay(e, id) {
      if (e.target.id === id) closeModal(id);
    }

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
        const reason = cleanDetailNote(it.catatan) || 'Permohonan ditolak oleh pengelola ruangan terkait.';
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

    function getStatusItemBadge(it) {
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

    function openTiketDetail(item) {
      document.getElementById('tdKodeTitle').textContent = 'Detail Tiket #' + item.kode;
      document.getElementById('tdKode').textContent = item.kode;

      const items = (Array.isArray(item.items) && item.items.length > 0)
        ? item.items
        : [{ nama: item.barang, jumlah: item.jumlah || 1, ruangan: item.ruangan || 'Laboratorium JTIK', status: item.status, catatan: item.catatan || '' }];

      const totalItems = items.length;
      const approvedItems = items.filter(it => ['disetujui', 'sedang_dipinjam', 'selesai'].includes(it.status));
      const activeItems = items.filter(it => ['disetujui', 'sedang_dipinjam'].includes(it.status));
      const rejectedItems = items.filter(it => it.status === 'ditolak');
      const pendingItems = items.filter(it => it.status === 'menunggu_verifikasi');
      const finishedItems = items.filter(it => it.status === 'selesai');

      const totalUnits = items.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);
      const approvedUnits = approvedItems.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);
      const rejectedUnits = rejectedItems.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);
      const pendingUnits = pendingItems.reduce((sum, it) => sum + (parseInt(it.jumlah, 10) || 1), 0);

      document.getElementById('tdBarang').innerHTML = items.map(it => {
        const nm = it.nama || 'Barang Sarpras';
        const qt = parseInt(it.jumlah, 10) || 1;
        const rm = it.ruangan || 'Laboratorium JTIK';
        const parsed = parseStructuredNote(it.catatan);
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
              <div style="flex-shrink:0;">${getStatusItemBadge(it)}</div>
            </div>
            ${renderItemNoteHtml(it, rm, parsed)}
          </div>
        `;
      }).join('');

      if (totalItems > 1 && (rejectedItems.length > 0 || pendingItems.length > 0)) {
        const subParts = [`Dari total ${totalUnits} unit diminta`];
        if (rejectedUnits > 0) subParts.push(`${rejectedUnits} ditolak`);
        if (pendingUnits > 0) subParts.push(`${pendingUnits} menunggu ACC`);
        document.getElementById('tdJumlah').innerHTML = `
          <div>${approvedUnits} Unit Disetujui</div>
          <div style="font-size:9.5px; color:#64748B; font-weight:600; margin-top:2px;">${escapeDetailHtml(subParts.join(', '))}</div>
        `;
      } else if (totalItems > 1) {
        document.getElementById('tdJumlah').textContent = `${totalUnits} Unit (${totalItems} Barang)`;
      } else {
        document.getElementById('tdJumlah').textContent = (item.jumlah || 1) + ' Unit';
      }

      const approvedRooms = [...new Set(approvedItems.map(it => it.ruangan).filter(Boolean))];
      const rejectedRooms = [...new Set(rejectedItems.map(it => it.ruangan).filter(Boolean))];
      if (approvedRooms.length > 0 && rejectedRooms.length > 0) {
        document.getElementById('tdRuangan').innerHTML = `
          <div>Disetujui: ${escapeDetailHtml(approvedRooms.join(', '))}</div>
          <div style="font-size:9.5px; color:#B91C1C; font-weight:600; margin-top:2px;">Ditolak: ${escapeDetailHtml(rejectedRooms.join(', '))}</div>
        `;
      } else {
        document.getElementById('tdRuangan').textContent = item.ruangan || '-';
      }

      document.getElementById('tdWaktuPinjam').textContent = item.pinjam;
      document.getElementById('tdBatasKembali').textContent = item.kembali;
      document.getElementById('tdDosen').textContent = item.dosen;
      document.getElementById('tdKeperluan').textContent = item.keperluan;

      // Detail penolakan & info pengambilan sudah ditampilkan terstruktur di setiap kartu barang di atas
      const tdRejectedWrap = document.getElementById('tdRejectedWrap');
      if (tdRejectedWrap) tdRejectedWrap.style.display = 'none';
      const tdCatatanWrap = document.getElementById('tdCatatanWrap');
      if (tdCatatanWrap) tdCatatanWrap.style.display = 'none';

      const tdStatus = document.getElementById('tdStatus');
      const s2 = document.getElementById('tStep2');
      const s3 = document.getElementById('tStep3');
      const s4 = document.getElementById('tStep4');
      const s2Title = s2.querySelector('.timeline-title');
      const s2Sub = s2.querySelector('.timeline-sub');

      s2.className = 'timeline-step';
      s3.className = 'timeline-step';
      s4.className = 'timeline-step';
      if (s2Title) s2Title.textContent = '2. Verifikasi Dosen & Laboran';
      if (s2Sub) s2Sub.textContent = 'Peninjauan ketersediaan stok & persetujuan penanggung jawab.';

      let statusHtml = '';
      let statusDesc = '';
      if (item.status === 'selesai') {
        statusHtml = '<span class="pill-status pill-green">Selesai</span>';
        statusDesc = rejectedItems.length > 0
          ? `${finishedItems.length} barang selesai dikembalikan, ${rejectedItems.length} barang ditolak saat pengajuan.`
          : 'Seluruh barang pada tiket ini sudah selesai dikembalikan.';
        s2.classList.add('completed');
        s3.classList.add('completed');
        s4.classList.add('completed');
      } else if (item.status === 'disetujui_sebagian') {
        statusHtml = '<span class="pill-status pill-partial">Sebagian Disetujui</span>';
        statusDesc = `${approvedItems.length} dari ${totalItems} barang disetujui (${approvedUnits} unit), ${rejectedItems.length} barang ditolak.`;
        if (s2Sub) s2Sub.textContent = `${approvedItems.length} barang disetujui, ${rejectedItems.length} barang ditolak pengelola ruangan.`;
        s2.classList.add('completed');
        s3.classList.add('active');
      } else if (item.status === 'diproses_sebagian') {
        statusHtml = '<span class="pill-status pill-indigo">Diproses Sebagian</span>';
        const decidedParts = [];
        if (approvedItems.length > 0) decidedParts.push(`${approvedItems.length} disetujui`);
        if (rejectedItems.length > 0) decidedParts.push(`${rejectedItems.length} ditolak`);
        statusDesc = `${decidedParts.join(', ')}${decidedParts.length > 0 ? ', ' : ''}${pendingItems.length} menunggu ACC.`;
        s2.classList.add('active');
      } else if (item.status === 'sedang_dipinjam') {
        statusHtml = '<span class="pill-status pill-orange">Sedang Dipinjam</span>';
        statusDesc = totalItems > 1
          ? `${activeItems.length} barang sedang berjalan${finishedItems.length > 0 ? ', ' + finishedItems.length + ' sudah selesai' : ''}.`
          : 'Barang sedang dalam masa peminjaman aktif.';
        s2.classList.add('completed');
        s3.classList.add('active');
      } else if (item.status === 'disetujui') {
        statusHtml = '<span class="pill-status pill-blue">Disetujui</span>';
        statusDesc = totalItems > 1
          ? `Semua ${totalItems} barang disetujui (${approvedUnits} unit). Silakan ambil barang di masing-masing ruangan.`
          : 'Permohonan disetujui pengelola. Silakan ambil barang di loket lab.';
        s2.classList.add('completed');
        s3.classList.add('active');
      } else if (item.status === 'ditolak') {
        statusHtml = '<span class="pill-status pill-red">Ditolak</span>';
        statusDesc = totalItems > 1
          ? 'Seluruh barang pada tiket ini ditolak oleh pengelola.'
          : 'Permohonan ditolak oleh pengelola ruangan.';
        if (s2Title) s2Title.textContent = '2. Permohonan Ditolak Pengelola';
        if (s2Sub) s2Sub.textContent = 'Permohonan tidak disetujui. Periksa alasan penolakan di atas.';
        s2.classList.add('active');
      } else {
        statusHtml = '<span class="pill-status pill-yellow">Menunggu ACC</span>';
        statusDesc = 'Menunggu persetujuan pengelola ruangan terkait.';
        s2.classList.add('active');
      }

      tdStatus.innerHTML = statusHtml + (statusDesc
        ? `<div style="font-size:9.5px; color:#475569; font-weight:600; margin-top:4px; line-height:1.35;">${escapeDetailHtml(statusDesc)}</div>`
        : '');

      openModal('modalTiketDetail');
    }

    /* --- SISTEM KERANJANG PEMINJAMAN --- */
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

      localStorage.removeItem('sisapras_cart');
      updateCartBadge();

      return true;
    }

    // DATA KELAS & PRODI LANGSUNG DARI DATABASE (TABEL kelas & program_studis)
    const MASTER_KELAS_DB = @json(\App\Models\Kelas::getForDropdownJs());

    // SEARCHABLE COMBOBOX UNTUK KELAS BIODATA MAHASISWA
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

    document.addEventListener('DOMContentLoaded', function() {
      @if(session('clear_cart'))
        localStorage.removeItem('sisapras_cart');
        localStorage.removeItem('sisapras_relokasi');
      @endif
      updateCartBadge();
      initSearchableClassDropdown('cartStatusInputKelas', 'cartStatusDropdownListKelas', 'cartStatusKelasComboboxWrapper');
      initSearchableClassDropdown('profileInputKelas', 'profileDropdownListKelas', 'profileKelasComboboxWrapper');
    });
  </script>

  @include('partials.ui_feedback')
</body>
</html>
