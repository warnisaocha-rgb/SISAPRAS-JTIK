<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM — Katalog & Peminjaman Sarpras</title>
  <!-- Google Fonts: Poppins & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg-workspace);
      color: var(--text-dark);
      margin: 0;
      padding: 0;
      line-height: 1.45;
      display: flex;
      min-height: 100vh;
      width: 100%;
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
      font-family: 'Poppins', sans-serif;
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

    .sidebar-footer {
      margin-top: auto;
      padding-top: 14px;
      border-top: 1px dashed rgba(255, 255, 255, 0.08);
      font-size: 9px;
      color: #515F7C;
      letter-spacing: 0.5px;
      text-align: center;
      font-family: 'Poppins', sans-serif;
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
      font-family: 'Poppins', sans-serif;
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
      font-family: 'Poppins', sans-serif;
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

    /* SUB-NAV TABS & TOOLBAR */
    .catalog-toolbar-section {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 16px 20px;
      display: flex;
      flex-direction: column;
      gap: 14px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    }

    .catalog-tabs-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
    }

    .catalog-nav-tabs {
      display: flex;
      align-items: center;
      gap: 8px;
      background: #F1F5F9;
      padding: 4px;
      border-radius: 8px;
    }

    .catalog-tab-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 600;
      color: #475569;
      text-decoration: none;
      transition: all 0.15s ease;
    }

    .catalog-tab-btn.active {
      background: #FFFFFF;
      color: var(--primary-navy);
      box-shadow: 0 1px 3px rgba(0,0,0,0.08);
      font-weight: 700;
    }

    .catalog-search-form {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
      max-width: 480px;
    }

    .search-input-box {
      position: relative;
      width: 100%;
    }

    .search-input-box input {
      width: 100%;
      padding: 7.5px 12px 7.5px 34px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 11px;
      font-family: 'Poppins', sans-serif;
      outline: none;
      transition: all 0.15s ease;
    }

    .search-input-box input:focus {
      border-color: #08296E;
      box-shadow: 0 0 0 2px rgba(8, 41, 110, 0.1);
    }

    .search-icon-left {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #94A3B8;
      pointer-events: none;
    }

    /* KATEGORI PILL BUTTONS */
    .kategori-pills-row {
      display: flex;
      align-items: center;
      gap: 8px;
      overflow-x: auto;
      padding-bottom: 2px;
    }

    .kategori-pill {
      white-space: nowrap;
      padding: 4px 12px;
      border-radius: 999px;
      font-size: 10.5px;
      font-weight: 600;
      background: #F8FAFC;
      border: 1px solid var(--border-subtle);
      color: #475569;
      text-decoration: none;
      transition: all 0.15s ease;
    }

    .kategori-pill:hover {
      background: #EFF6FF;
      color: var(--primary-navy);
      border-color: #BFDBFE;
    }

    .kategori-pill.active {
      background: #08296E;
      color: #FFFFFF;
      border-color: #08296E;
    }

    /* CATALOG GRID CARDS (PERSIS FIGMA REKOMENDASI TERBARU) */
    .catalog-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(265px, 1fr));
      gap: 16px;
    }

    .item-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
      transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
    }

    .item-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px -4px rgba(8, 41, 110, 0.12);
      border-color: #94A3B8;
    }

    .item-thumb-box {
      width: 100%;
      height: 155px;
      background: #F8FAFC;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      border-bottom: 1px solid var(--border-subtle);
      overflow: hidden;
    }

    .item-thumb-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.2s ease;
    }

    .item-card:hover .item-thumb-img {
      transform: scale(1.03);
    }

    .item-thumb-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #94A3B8;
      gap: 6px;
    }

    .badge-stock {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 3px 8px;
      border-radius: 999px;
      font-size: 9px;
      font-weight: 700;
      box-shadow: 0 2px 4px rgba(0,0,0,0.08);
      z-index: 2;
    }

    .badge-stock.available {
      background: #DCFCE7;
      color: #15803D;
      border: 1px solid #86EFAC;
    }

    .badge-stock.empty {
      background: #FEE2E2;
      color: #DC2626;
      border: 1px solid #FCA5A5;
    }

    .badge-category-tag {
      position: absolute;
      bottom: 8px;
      left: 10px;
      background: rgba(15, 23, 42, 0.75);
      backdrop-filter: blur(4px);
      color: #FFFFFF;
      font-size: 8.5px;
      font-weight: 700;
      padding: 2px 7px;
      border-radius: 4px;
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }

    .item-body {
      padding: 14px 16px;
      display: flex;
      flex-direction: column;
      flex: 1;
      gap: 6px;
    }

    .item-code {
      font-family: 'JetBrains Mono', monospace;
      font-size: 9.5px;
      font-weight: 700;
      color: #64748B;
    }

    .item-title {
      font-size: 13px;
      font-weight: 700;
      color: #0F172A;
      line-height: 1.35;
      min-height: 35px;
    }

    .item-location {
      font-size: 10px;
      color: #475569;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .item-specs-snippet {
      font-size: 10px;
      color: #64748B;
      line-height: 1.4;
      margin-top: 4px;
      flex: 1;
    }

    .item-footer-actions {
      padding: 12px 16px 14px 16px;
      border-top: 1px solid var(--border-subtle);
      display: flex;
      align-items: center;
      gap: 8px;
      background: #FAFAFC;
    }

    .btn-card-detail {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      color: #475569;
      padding: 6.5px 12px;
      border-radius: 6px;
      font-size: 10.5px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.15s ease;
      flex: 1;
      text-align: center;
    }

    .btn-card-detail:hover {
      background: #F1F5F9;
      color: var(--primary-navy);
      border-color: #94A3B8;
    }

    .btn-card-action {
      background: #16A34A;
      color: #FFFFFF;
      border: none;
      padding: 6.5px 14px;
      border-radius: 6px;
      font-size: 10.5px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.15s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      flex: 1.2;
    }

    .btn-card-action:hover {
      background: #15803D;
    }

    .btn-card-action.btn-orange {
      background: #ED7411;
    }

    .btn-card-action.btn-orange:hover {
      background: #D96005;
    }

    .btn-card-action:disabled {
      background: #CBD5E1;
      color: #64748B;
      cursor: not-allowed;
    }

    /* EMPTY STATE */
    .empty-catalog-box {
      background: #FFFFFF;
      border: 1.5px dashed var(--border-color);
      border-radius: 12px;
      padding: 48px 24px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 12px;
      color: #64748B;
    }

    .empty-catalog-box h3 {
      font-size: 14px;
      font-weight: 700;
      color: #0F172A;
    }

    .empty-catalog-box p {
      font-size: 11px;
      max-width: 400px;
      line-height: 1.5;
    }

    /* MODAL STYLES */
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
      max-width: 620px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
      border: 1px solid #E2E8F0;
      max-height: 90vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .modal-dialog.modal-lg {
      max-width: 760px;
    }

    .modal-header {
      padding: 16px 22px;
      border-bottom: 1px solid #E2E8F0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      background: #FFFFFF;
      z-index: 10;
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

    .modal-close-btn:hover {
      color: #0F172A;
    }

    .modal-body {
      padding: 20px 22px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .modal-footer {
      padding: 14px 22px;
      border-top: 1px solid #E2E8F0;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 10px;
      background: #F8FAFC;
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .form-group label {
      font-size: 10.5px;
      font-weight: 700;
      color: #334155;
    }

    .form-input, .form-select, .form-textarea {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #CBD5E1;
      border-radius: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 11px;
      color: #0F172A;
      transition: all 0.15s ease;
      background: #FFFFFF;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
      outline: none;
      border-color: #08296E;
      box-shadow: 0 0 0 2px rgba(8, 41, 110, 0.08);
    }

    .form-hint {
      font-size: 9.5px;
      color: var(--text-muted);
      margin-top: 3px;
    }

    .btn-primary {
      background: #08296E;
      color: #FFFFFF;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
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
      font-family: 'Poppins', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-secondary:hover {
      background: #F1F5F9;
      color: var(--text-dark);
    }

    .detail-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
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
      font-family: 'Poppins', sans-serif;
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
      font-family: 'Poppins', sans-serif;
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
  </style>
</head>
<body>

  <div class="portal-layout">
    
    <!-- SIDEBAR MAHASISWA (KONSISTEN 220PX) -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('images/logo-unm-white.png') }}" alt="UNM SI-SAPRAS JTIK" class="brand-logo-img">
      </div>

      <!-- MENU NAVIGASI MAHASISWA -->
      <nav class="sidebar-nav">
        <div class="nav-header-label">MENU MAHASISWA</div>

        <!-- 1. Dashboard -->
        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item">
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

        <!-- 2. Peminjaman (ACTIVE) -->
        <a href="{{ route('mahasiswa.peminjaman') }}" class="nav-item active" title="Katalog & Formulir Pinjam Alat & Sarana">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
            </svg>
            <span>Peminjaman</span>
          </div>
          @if(($menungguAccCount ?? 0) > 0)
            <span class="nav-badge-count">{{ $menungguAccCount }}</span>
          @endif
        </a>

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

        <!-- 4. Status Pinjam -->
        <a href="{{ route('mahasiswa.status-pinjam') }}" class="nav-item" title="Lihat Status & Riwayat Peminjaman">
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
          <h1 class="page-title">KATALOG &amp; PEMINJAMAN SARPRAS</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">Peminjaman sarana laboratorium &amp; relokasi mebelair · Selamat datang, <strong>{{ Auth::user()->name ?? 'Mahasiswa' }}</strong> ({{ Auth::user()->nomor_induk ?? '-' }})</span>
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

      <!-- NOTIFIKASI FLASH -->
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

      <!-- TOOLBAR KATALOG: TABS & PENCARIAN & KATEGORI -->
      <div class="catalog-toolbar-section">
        <div class="catalog-tabs-row">
          <!-- Sub-Nav Tabs -->
          <div class="catalog-nav-tabs">
            <a href="{{ route('mahasiswa.peminjaman', ['tab' => 'alat']) }}" class="catalog-tab-btn {{ ($tab ?? 'alat') !== 'ruangan' ? 'active' : '' }}">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
              <span>Alat &amp; Bahan Lab ({{ \App\Models\Sarpras::where(function($q){$q->where('jenis_sarpras','alat_bahan')->orWhereNull('jenis_sarpras');})->count() }})</span>
            </a>
            <a href="{{ route('mahasiswa.peminjaman', ['tab' => 'ruangan']) }}" class="catalog-tab-btn {{ ($tab ?? 'alat') === 'ruangan' ? 'active' : '' }}">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
              <span>Sarana Ruangan / Mebelair ({{ \App\Models\Sarpras::where('jenis_sarpras','sarana_ruangan')->count() }})</span>
            </a>
          </div>

          <!-- Form Pencarian Real-Time / Query -->
          <form method="GET" action="{{ route('mahasiswa.peminjaman') }}" class="catalog-search-form">
            <input type="hidden" name="tab" value="{{ $tab ?? 'alat' }}">
            @if(!empty($kategoriId))
              <input type="hidden" name="kategori" value="{{ $kategoriId }}">
            @endif
            <div class="search-input-box">
              <svg class="search-icon-left" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
              <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama barang, spesifikasi, kode...">
            </div>
            <button type="submit" class="btn-primary" style="padding: 7.5px 14px; font-size: 11px;">Cari</button>
            @if(!empty($search))
              <a href="{{ route('mahasiswa.peminjaman', ['tab' => $tab ?? 'alat']) }}" class="btn-secondary" style="padding: 7.5px 10px; font-size: 10px; text-decoration:none;">Reset</a>
            @endif
          </form>
        </div>

        <!-- Filter Pill Kategori -->
        @if(($tab ?? 'alat') !== 'ruangan')
          <div class="kategori-pills-row">
            <a href="{{ route('mahasiswa.peminjaman', ['tab' => 'alat', 'search' => $search ?? '']) }}" class="kategori-pill {{ empty($kategoriId) ? 'active' : '' }}">
              Semua Kategori
            </a>
            @foreach($kategoris as $kat)
              <a href="{{ route('mahasiswa.peminjaman', ['tab' => 'alat', 'kategori' => $kat->id, 'search' => $search ?? '']) }}" class="kategori-pill {{ ($kategoriId == $kat->id) ? 'active' : '' }}">
                {{ $kat->nama_kategori }}
              </a>
            @endforeach
          </div>
        @endif
      </div>

      <!-- MAIN CATALOG GRID -->
      @if($sarpras->isEmpty())
        <div class="empty-catalog-box">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#CBD5E1" stroke-width="1.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          <h3>Tidak Ada Sarpras Yang Ditemukan</h3>
          <p>Sarpras dengan kriteria pencarian atau kategori yang Anda pilih tidak tersedia saat ini. Silakan coba kata kunci lain atau reset filter pencarian.</p>
          <a href="{{ route('mahasiswa.peminjaman', ['tab' => $tab ?? 'alat']) }}" class="btn-primary" style="text-decoration: none;">Tampilkan Semua Sarpras</a>
        </div>
      @else
        <div class="catalog-grid">
          @foreach($sarpras as $item)
            @php
              $isAvailable = $item->jumlah_tersedia > 0;
              $fotoUrl = $item->foto ? asset('storage/' . $item->foto) : null;
              $ruangName = $item->ruangan ? $item->ruangan->nama_ruangan : 'Laboratorium JTIK';
              $katName = $item->kategori ? $item->kategori->nama_kategori : 'Sarpras Umum';
            @endphp
            <div class="item-card">
              <!-- Thumbnail Box -->
              <div class="item-thumb-box">
                @if($fotoUrl)
                  <img src="{{ $fotoUrl }}" alt="{{ $item->nama_sarpras }}" class="item-thumb-img">
                @else
                  <div class="item-thumb-placeholder">
                    @if(($tab ?? 'alat') === 'ruangan')
                      <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    @else
                      <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                    @endif
                    <span style="font-size: 9px; font-weight: 600;">UNM FT JTIK</span>
                  </div>
                @endif

                <!-- Badge Kategori Tag -->
                <span class="badge-category-tag">{{ $katName }}</span>

                <!-- Badge Stok Tersedia -->
                @if($isAvailable)
                  <span class="badge-stock available">Tersedia: {{ $item->jumlah_tersedia }} Unit</span>
                @else
                  <span class="badge-stock empty">Stok Habis</span>
                @endif
              </div>

              <!-- Body Item Info -->
              <div class="item-body">
                <span class="item-code">{{ $item->kode_sarpras }}</span>
                <h3 class="item-title" title="{{ $item->nama_sarpras }}">{{ $item->nama_sarpras }}</h3>
                <div class="item-location">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  <span>{{ $ruangName }} · Rak: {{ $item->lokasi_rak ?? 'Utama' }}</span>
                </div>
                <p class="item-specs-snippet">{{ Str::limit($item->spesifikasi ?? 'Instrumen sarana penunjang praktikum laboratorium.', 68) }}</p>
              </div>

              <!-- Footer Actions -->
              <div class="item-footer-actions">
                <button type="button" class="btn-card-detail" 
                  onclick='openDetailModal({
                    id: {{ $item->id }},
                    kode: "{{ addslashes($item->kode_sarpras) }}",
                    nama: "{{ addslashes($item->nama_sarpras) }}",
                    kategori: "{{ addslashes($katName) }}",
                    ruangan: "{{ addslashes($ruangName) }}",
                    rak: "{{ addslashes($item->lokasi_rak ?? '-') }}",
                    tersedia: {{ $item->jumlah_tersedia }},
                    total: {{ $item->jumlah_total }},
                    maks: {{ $item->maks_pinjam ?? 2 }},
                    kondisi: "{{ addslashes($item->kondisi ?? 'baik') }}",
                    spesifikasi: "{{ addslashes($item->spesifikasi ?? 'Tidak ada spesifikasi khusus.') }}",
                    foto: "{{ $fotoUrl ?? '' }}",
                    isRuangan: {{ ($tab ?? 'alat') === 'ruangan' ? 'true' : 'false' }}
                  })'>
                  Detail
                </button>

                @if(($tab ?? 'alat') === 'ruangan')
                  <button type="button" class="btn-card-action btn-orange"
                    onclick='openRelokasiModal({
                      id: {{ $item->id }},
                      kode: "{{ addslashes($item->kode_sarpras) }}",
                      nama: "{{ addslashes($item->nama_sarpras) }}",
                      ruanganId: {{ $item->ruangan_id ?? "null" }},
                      ruanganNama: "{{ addslashes($ruangName) }}",
                      tersedia: {{ $item->jumlah_tersedia }}
                    })'>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    <span>Relokasi</span>
                  </button>
                @else
                  <button type="button" class="btn-card-action" {{ !$isAvailable ? 'disabled' : '' }}
                    onclick='openPinjamModal({
                      id: {{ $item->id }},
                      kode: "{{ addslashes($item->kode_sarpras) }}",
                      nama: "{{ addslashes($item->nama_sarpras) }}",
                      tersedia: {{ $item->jumlah_tersedia }},
                      maks: {{ $item->maks_pinjam ?? 2 }},
                      ruangan: "{{ addslashes($ruangName) }}"
                    })'>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <span>Pinjam</span>
                  </button>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @endif

    </main>
  </div>

  <!-- MODAL 1: DETAIL SARPRAS LENGKAP -->
  <div id="modalDetailSarpras" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalDetailSarpras')">
    <div class="modal-dialog modal-lg">
      <div class="modal-header">
        <h3 id="detModalTitle">Detail Sarana &amp; Prasarana</h3>
        <button type="button" class="modal-close-btn" onclick="closeModal('modalDetailSarpras')">×</button>
      </div>
      <div class="modal-body">
        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
          <!-- Foto Preview -->
          <div style="width: 200px; height: 160px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0;" id="detFotoBox">
            <img id="detFotoImg" src="" alt="Foto Sarpras" style="width:100%; height:100%; object-fit:cover; display:none;">
            <div id="detFotoPlaceholder" style="text-align: center; color: #94A3B8; font-size: 11px;">
              <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
              <div>No Image</div>
            </div>
          </div>

          <!-- Ringkasan Cepat -->
          <div style="flex: 1; min-width: 240px; display: flex; flex-direction: column; gap: 8px;">
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 700; color: #08296E;" id="detKode">KODE-01</div>
            <h2 style="font-size: 15px; font-weight: 800; color: #0F172A;" id="detNama">Nama Barang</h2>
            <div style="font-size: 11px; color: #64748B;">Kategori: <strong id="detKategori" style="color: #0F172A;">-</strong></div>
            <div style="font-size: 11px; color: #64748B;">Lokasi: <strong id="detRuangan" style="color: #0F172A;">-</strong> (Rak: <span id="detRak">-</span>)</div>
            
            <div style="display: flex; gap: 10px; margin-top: 6px;">
              <div class="detail-card" style="flex: 1; padding: 6px 10px;">
                <div class="detail-card-label">Stok Tersedia</div>
                <div class="detail-card-value" id="detTersedia" style="color: #15803D;">0 Unit</div>
              </div>
              <div class="detail-card" style="flex: 1; padding: 6px 10px;">
                <div class="detail-card-label">Maks. Pinjam</div>
                <div class="detail-card-value" id="detMaks">2 Unit / Mhs</div>
              </div>
              <div class="detail-card" style="flex: 1; padding: 6px 10px;">
                <div class="detail-card-label">Kondisi Fisik</div>
                <div class="detail-card-value" id="detKondisi" style="text-transform: capitalize;">Baik</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Spesifikasi Lengkap -->
        <div class="form-group" style="margin-top: 10px;">
          <label>Spesifikasi &amp; Deskripsi Instrumen:</label>
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 12px; font-size: 11px; color: #334155; line-height: 1.5; white-space: pre-wrap;" id="detSpesifikasi">
            -
          </div>
        </div>

        <!-- Ketentuan Peminjaman -->
        <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 6px; padding: 12px; font-size: 10.5px; color: #1E40AF;">
          <strong>Ketentuan Peminjaman UCD FT UNM:</strong>
          <ul style="margin-left: 18px; margin-top: 4px; line-height: 1.5;">
            <li>Wajib digunakan untuk kegiatan perkuliahan, praktikum, atau riset tugas akhir.</li>
            <li>Barang harus dikembalikan dalam kondisi bersih, lengkap, dan tepat waktu sesuai batas rencana.</li>
            <li>Kerusakan atau kehilangan yang disengaja menjadi tanggung jawab peminjam.</li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary" onclick="closeModal('modalDetailSarpras')">Tutup</button>
        <button type="button" class="btn-primary" id="detActionBtn" onclick="actionFromDetail()">
          Pinjam Barang Ini
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL 2: FORMULIR PEMINJAMAN ALAT & BAHAN -->
  <div id="modalPinjamAlat" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalPinjamAlat')">
    <div class="modal-dialog">
      <div class="modal-header">
        <h3>Formulir Peminjaman Alat &amp; Bahan</h3>
        <button type="button" class="modal-close-btn" onclick="closeModal('modalPinjamAlat')">×</button>
      </div>
      <form method="POST" action="{{ route('mahasiswa.peminjaman.store') }}">
        @csrf
        <input type="hidden" name="sarpras_id" id="formPinjamSarprasId" value="">

        <div class="modal-body">
          <!-- Identitas Peminjam Readonly -->
          <div class="detail-grid">
            <div class="detail-card">
              <div class="detail-card-label">Nama Mahasiswa</div>
              <div class="detail-card-value">{{ Auth::user()->name }}</div>
            </div>
            <div class="detail-card">
              <div class="detail-card-label">NIM Mahasiswa</div>
              <div class="detail-card-value">{{ Auth::user()->nomor_induk }}</div>
            </div>
          </div>

          <!-- Barang Terpilih -->
          <div class="form-group">
            <label>Alat / Bahan Yang Dipinjam <span style="color:#DC2626;">*</span></label>
            <input type="text" id="formPinjamNamaBarang" class="form-input" readonly style="background: #F1F5F9; font-weight: 700; color: #08296E;" value="">
            <div class="form-hint" id="formPinjamStokHint">Sisa stok tersedia: - Unit</div>
          </div>

          <!-- Jumlah Unit & Dosen PJ -->
          <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
            <div class="form-group">
              <label>Jumlah Unit <span style="color:#DC2626;">*</span></label>
              <input type="number" name="jumlah" id="formPinjamJumlah" class="form-input" min="1" max="2" value="1" required>
            </div>
            <div class="form-group">
              <label>Dosen PJ / Pembimbing</label>
              <input type="text" name="dosen_penanggung_jawab" class="form-input" placeholder="Contoh: Dr. Mustari Lamada, M.T.">
            </div>
          </div>

          <!-- Waktu Pinjam & Rencana Pengembalian -->
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div class="form-group">
              <label>Tanggal &amp; Waktu Pinjam <span style="color:#DC2626;">*</span></label>
              <input type="datetime-local" name="tgl_pinjam" class="form-input" value="{{ date('Y-m-d\T08:00') }}" required>
            </div>
            <div class="form-group">
              <label>Rencana Pengembalian <span style="color:#DC2626;">*</span></label>
              <input type="datetime-local" name="tgl_kembali_rencana" class="form-input" value="{{ date('Y-m-d\T16:00') }}" required>
            </div>
          </div>

          <!-- Ruangan Penggunaan -->
          <div class="form-group">
            <label>Ruangan Tempat Penggunaan</label>
            <select name="ruangan_tujuan_id" class="form-select">
              <option value="">-- Gunakan di Ruangan Laboratorium Asal --</option>
              @foreach($daftarRuangan as $r)
                <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
              @endforeach
            </select>
          </div>

          <!-- Keperluan -->
          <div class="form-group">
            <label>Keperluan Praktikum / Riset <span style="color:#DC2626;">*</span></label>
            <textarea name="keperluan" class="form-textarea" rows="3" placeholder="Tuliskan mata kuliah, modul praktikum, atau judul riset tugas akhir..." required></textarea>
          </div>

          <!-- Checkbox Persetujuan -->
          <div style="display: flex; align-items: flex-start; gap: 8px; margin-top: 4px;">
            <input type="checkbox" id="agreeUCD" required style="margin-top: 3px;">
            <label for="agreeUCD" style="font-size: 10px; color: #475569; font-weight: normal; cursor: pointer;">
              Saya bertanggung jawab penuh atas keutuhan dan kelengkapan barang ini serta setuju untuk mengembalikannya tepat waktu.
            </label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('modalPinjamAlat')">Batal</button>
          <button type="submit" class="btn-primary">Kirim Permohonan Pinjam</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL 3: FORMULIR RELOKASI RUANG -->
  <div id="modalRelokasiRuang" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalRelokasiRuang')">
    <div class="modal-dialog">
      <div class="modal-header">
        <h3>Formulir Relokasi Sarana Ruang / Mebelair</h3>
        <button type="button" class="modal-close-btn" onclick="closeModal('modalRelokasiRuang')">×</button>
      </div>
      <form method="POST" action="{{ route('mahasiswa.relokasi.store') }}">
        @csrf
        <input type="hidden" name="sarpras_id" id="formRelokasiSarprasId" value="">
        <input type="hidden" name="ruangan_asal_id" id="formRelokasiAsalId" value="">

        <div class="modal-body">
          <div class="form-group">
            <label>Sarana Yang Dipindahkan <span style="color:#DC2626;">*</span></label>
            <input type="text" id="formRelokasiNamaBarang" class="form-input" readonly style="background: #F1F5F9; font-weight: 700; color: #08296E;" value="">
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div class="form-group">
              <label>Ruangan Asal</label>
              <input type="text" id="formRelokasiAsalNama" class="form-input" readonly style="background: #F8FAFC;" value="">
            </div>
            <div class="form-group">
              <label>Ruangan Tujuan <span style="color:#DC2626;">*</span></label>
              <select name="ruangan_tujuan_id" class="form-select" required>
                <option value="">-- Pilih Ruang Tujuan --</option>
                @foreach($daftarRuangan as $r)
                  <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
            <div class="form-group">
              <label>Jumlah Unit <span style="color:#DC2626;">*</span></label>
              <input type="number" name="jumlah" id="formRelokasiJumlah" class="form-input" min="1" value="1" required>
            </div>
            <div class="form-group">
              <label>Dosen / Penanggung Jawab Acara</label>
              <input type="text" name="dosen_penanggung_jawab" class="form-input" placeholder="Contoh: Panitia Kuliah Tamu JTIK">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div class="form-group">
              <label>Waktu Pemindahan <span style="color:#DC2626;">*</span></label>
              <input type="datetime-local" name="tgl_pinjam" class="form-input" value="{{ date('Y-m-d\T08:00') }}" required>
            </div>
            <div class="form-group">
              <label>Rencana Pengembalian <span style="color:#DC2626;">*</span></label>
              <input type="datetime-local" name="tgl_kembali_rencana" class="form-input" value="{{ date('Y-m-d\T17:00') }}" required>
            </div>
          </div>

          <div class="form-group">
            <label>Keperluan Pemindahan / Relokasi <span style="color:#DC2626;">*</span></label>
            <textarea name="keperluan" class="form-textarea" rows="3" placeholder="Contoh: Kebutuhan tambahan meja & bangku untuk ujian skripsi / seminar..." required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('modalRelokasiRuang')">Batal</button>
          <button type="submit" class="btn-primary" style="background:#ED7411;">Ajukan Relokasi Ruang</button>
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
          <span class="modal-title">PROFIL SAYA</span>
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
                <span style="background: #08296E; color: #FFFFFF; font-size: 9px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">{{ Auth::user()->jurusan ?? 'Mahasiswa JTIK' }}</span>
                <span style="background: #DCFCE7; color: #15803D; font-size: 9px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">Akun Mahasiswa</span>
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
              <input type="text" class="form-input" value="Pendidikan Teknik Informatika dan Komputer" readonly style="background: #F8FAFC; color: #64748B;">
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
                         placeholder="Ketik untuk mencari kelas (contoh: PTIK A 22)..." 
                         value="{{ Auth::user()->jurusan ?? 'PTIK A 22' }}"
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
          <span class="modal-title" style="color: #ED7411;">GANTI KATA SANDI</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalChangePassword')">×</button>
      </div>
      <form action="{{ route('profile.password') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label">Kata Sandi Saat Ini <span class="req">*</span></label>
            <input type="password" name="current_password" class="form-input" placeholder="Masukkan kata sandi lama Anda" required>
          </div>
          <div class="form-group">
            <label class="form-label">Kata Sandi Baru <span class="req">*</span></label>
            <input type="password" name="password" class="form-input" placeholder="Minimal 6 karakter" required>
          </div>
          <div class="form-group">
            <label class="form-label">Konfirmasi Kata Sandi Baru <span class="req">*</span></label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru" required>
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
          <h3 style="font-size: 13.5px; font-weight: 800; color: #08296E; text-transform: uppercase; margin: 0; letter-spacing: 0.3px;">FORMULIR PENGAJUAN PINJAM</h3>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeModal('modalKeranjang')">×</button>
      </div>

      <form method="POST" action="{{ route('mahasiswa.peminjaman.batch') }}" id="formBatchCheckout" onsubmit="return handleBatchSubmit(event)">
        @csrf
        <input type="hidden" name="cart_items" id="batchCartItems">
        <input type="hidden" name="has_relokasi" id="batchHasRelokasi" value="0">

        <div class="modal-body" style="padding: 16px 20px; max-height: calc(88vh - 120px); overflow-y: auto;">
          
          <!-- SECTION 1: DATA PENGAJU (MAHASISWA) -->
          <div class="cart-figma-box">
            <div class="cart-figma-box-title">DATA PENGAJU (MAHASISWA)</div>
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
                <input type="text" name="jurusan" value="{{ Auth::user()->jurusan ?? 'Pendidikan Teknik Informatika dan Komputer' }}" readonly style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #F8FAFC; color: #334155; font-weight: 600;">
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Kelas (Ketik untuk Mencari) <span style="color: #DC2626;">*</span></label>
                <div class="searchable-combobox" id="cartPeminjamanKelasComboboxWrapper" style="position: relative;">
                  <div style="position: relative; display: flex; align-items: center;">
                    <svg style="position: absolute; left: 10px; width: 13px; height: 13px; color: #94A3B8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" 
                           id="cartPeminjamanInputKelas" 
                           name="kelas" 
                           autocomplete="off" 
                           placeholder="Ketik untuk mencari kelas (contoh: PTIK A 22)..." 
                           value="{{ Auth::user()->jurusan ?? 'PTIK A 22' }}"
                           required
                           style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 28px 7px 28px; font-size: 11px; background: #FFFFFF; color: #334155; font-weight: 600; outline: none; font-family: inherit;">
                    <button type="button" class="combobox-toggle-btn" style="position: absolute; right: 4px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 4px; cursor: pointer; color: #64748B;">
                      <svg class="combobox-chevron" style="width: 13px; height: 13px; transition: transform 0.2s;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </button>
                  </div>
                  <div id="cartPeminjamanDropdownListKelas" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; max-height: 180px; overflow-y: auto; background: #FFFFFF; border: 1.5px solid #0091FF; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12); z-index: 99999;"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- SECTION 2: 1. PEMINJAMAN ALAT & BAHAN PRAKTIKUM -->
          <div id="sectionAlatBahanFigma" style="margin-bottom: 14px;">
            <div style="font-size: 11px; font-weight: 800; color: #08296E; text-transform: uppercase; margin-bottom: 8px;">1. PEMINJAMAN ALAT &amp; BAHAN PRAKTIKUM</div>
            
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
                <div id="errorBatchKeperluan" style="display:none; color: #DC2626; font-size: 10px; margin-top: 3px; font-weight: 600;">* Alasan / keperluan pinjam wajib diisi</div>
              </div>
            </div>
          </div>

          <!-- SECTION 3: 2. RELOKASI SARANA RUANGAN (KELAS) -->
          @php
            $daftarRuangan = $daftarRuangan ?? \App\Models\Ruangan::orderBy('nama_ruangan')->get();
          @endphp
          <div id="sectionSaranaRuanganFigma" style="display: none; border-top: 1px solid #E2E8F0; padding-top: 14px; margin-bottom: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
              <span style="font-size: 11px; font-weight: 800; color: #08296E; text-transform: uppercase;">2. RELOKASI SARANA RUANGAN (KELAS)</span>
              <button type="button" class="btn-hapus-sarana" onclick="hapusSaranaRuangan()">Hapus sarana</button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 10px;">
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">1. Ruang Asal Pengambilan <span style="color: #DC2626;">*</span></label>
                <select name="ruang_asal_id" id="figmaRuangAsal" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #FFFFFF;">
                  @foreach($daftarRuangan as $r)
                    @if($r->jenis_ruangan === 'sarana_ruangan' || str_starts_with($r->kode_ruangan, 'AE'))
                      <option value="{{ $r->id }}" {{ $r->kode_ruangan === 'AE 101' ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">2. Ruang Tujuan Pemindahan <span style="color: #DC2626;">*</span></label>
                <select name="ruang_tujuan_id" id="figmaRuangTujuan" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px; background: #FFFFFF;">
                  @foreach($daftarRuangan as $r)
                    @if($r->jenis_ruangan === 'sarana_ruangan' || str_starts_with($r->kode_ruangan, 'AE'))
                      <option value="{{ $r->id }}" {{ $r->kode_ruangan === 'AE 110' ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 12px; margin-bottom: 10px;">
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Alasan <span style="color: #DC2626;">*</span></label>
                <input type="text" name="alasan_relokasi" id="figmaAlasanRelokasi" placeholder="Jumlah bangku dan meja tidak sama..." oninput="this.style.borderColor='#CBD5E1'; const err=document.getElementById('errorFigmaAlasan'); if(err) err.style.display='none';" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px;">
                <div id="errorFigmaAlasan" style="display:none; color: #DC2626; font-size: 10px; margin-top: 3px; font-weight: 600;">* Alasan relokasi ruangan wajib diisi</div>
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Jumlah Bangku</label>
                <input type="number" name="jumlah_bangku" id="figmaJumlahBangku" value="3" min="0" max="30" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px;">
                <span style="font-size: 9px; color: #64748B;">*Maks: 30 unit</span>
              </div>
              <div>
                <label style="font-size: 10.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Jumlah Meja</label>
                <input type="number" name="jumlah_meja" id="figmaJumlahMeja" value="1" min="0" max="30" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 7px 10px; font-size: 11px;">
                <span style="font-size: 9px; color: #64748B;">*Maks: 30 unit</span>
              </div>
            </div>

            <div style="display: flex; align-items: center; gap: 8px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 8px 12px;">
              <input type="checkbox" id="figmaAgreeRelokasi" checked style="accent-color: #08296E;">
              <label for="figmaAgreeRelokasi" style="font-size: 10.5px; color: #334155; font-weight: 500; cursor: pointer;">
                Saya bertanggung jawab mengembalikan seluruh fasilitas dengan tepat waktu
              </label>
            </div>
          </div>

          <div id="errorBatchEmpty" style="display:none; color: #DC2626; font-size: 11px; font-weight: 600; padding: 0 4px 10px 4px; text-align: right;">* Pilih alat praktikum atau relokasi sarana ruangan terlebih dahulu</div>
        </div>

        <div class="modal-footer" style="padding: 12px 20px; background: #FFFFFF; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" class="btn-batal-figma" onclick="closeModal('modalKeranjang')">BATAL</button>
          <button type="submit" class="btn-submit-figma-orange">KIRIM PENGAJUAN PINJAM</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    let currentDetailItem = null;

    function openModal(id) {
      const modal = document.getElementById(id);
      if (modal) modal.classList.add('active');
    }

    function closeModal(id) {
      const modal = document.getElementById(id);
      if (modal) modal.classList.remove('active');
    }

    function closeModalOnOverlay(e, id) {
      if (e.target.id === id) {
        closeModal(id);
      }
    }

    function toggleUserDropdown(event) {
      if (event) event.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      if (dropdown) {
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
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



    // DETAIL MODAL HANDLER
    function openDetailModal(item) {
      currentDetailItem = item;
      document.getElementById('detKode').textContent = item.kode;
      document.getElementById('detNama').textContent = item.nama;
      document.getElementById('detKategori').textContent = item.kategori;
      document.getElementById('detRuangan').textContent = item.ruangan;
      document.getElementById('detRak').textContent = item.rak;
      document.getElementById('detTersedia').textContent = item.tersedia + ' Unit';
      document.getElementById('detMaks').textContent = item.maks + ' Unit / Mhs';
      document.getElementById('detKondisi').textContent = item.kondisi;
      document.getElementById('detSpesifikasi').textContent = item.spesifikasi;

      const img = document.getElementById('detFotoImg');
      const placeholder = document.getElementById('detFotoPlaceholder');
      if (item.foto) {
        img.src = item.foto;
        img.style.display = 'block';
        placeholder.style.display = 'none';
      } else {
        img.style.display = 'none';
        placeholder.style.display = 'block';
      }

      const actionBtn = document.getElementById('detActionBtn');
      if (item.isRuangan) {
        actionBtn.textContent = 'Ajukan Relokasi Ruang';
        actionBtn.style.background = '#ED7411';
        actionBtn.disabled = false;
      } else {
        actionBtn.textContent = item.tersedia > 0 ? 'Pinjam Sekarang' : 'Stok Habis';
        actionBtn.style.background = '#08296E';
        actionBtn.disabled = item.tersedia <= 0;
      }

      openModal('modalDetailSarpras');
    }

    function actionFromDetail() {
      if (!currentDetailItem) return;
      closeModal('modalDetailSarpras');
      if (currentDetailItem.isRuangan) {
        openRelokasiModal(currentDetailItem);
      } else {
        openPinjamModal(currentDetailItem);
      }
    }

    // FORM PINJAM MODAL
    function openPinjamModal(item) {
      document.getElementById('formPinjamSarprasId').value = item.id;
      document.getElementById('formPinjamNamaBarang').value = item.nama + ' (' + item.kode + ')';
      document.getElementById('formPinjamStokHint').textContent = 'Sisa stok tersedia: ' + item.tersedia + ' Unit · Maks. pinjam: ' + (item.maks || 2) + ' Unit';
      
      const inputJumlah = document.getElementById('formPinjamJumlah');
      inputJumlah.max = Math.min(item.tersedia, item.maks || 2);
      inputJumlah.value = 1;

      openModal('modalPinjamAlat');
    }

    // FORM RELOKASI MODAL
    function openRelokasiModal(item) {
      document.getElementById('formRelokasiSarprasId').value = item.id;
      document.getElementById('formRelokasiNamaBarang').value = item.nama + ' (' + item.kode + ')';
      document.getElementById('formRelokasiAsalId').value = item.ruanganId || '';
      document.getElementById('formRelokasiAsalNama').value = item.ruanganNama || item.ruangan || 'Lokasi Asal';
      
      const inputJumlah = document.getElementById('formRelokasiJumlah');
      inputJumlah.max = item.tersedia || 50;
      inputJumlah.value = 1;

      openModal('modalRelokasiRuang');
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
      const relokasi = JSON.parse(localStorage.getItem('sisapras_relokasi') || 'null');
      const count = cart.length + (relokasi ? 1 : 0);
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
      const relokasi = JSON.parse(localStorage.getItem('sisapras_relokasi') || 'null');
      const container = document.getElementById('figmaCartItemsContainer');
      const metaFields = document.getElementById('figmaCartMetaFields');
      const secSarana = document.getElementById('sectionSaranaRuanganFigma');
      const submitBtn = document.querySelector('#modalKeranjang .btn-submit-figma-orange');

      // 1. Render Alat & Bahan Praktikum
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

      // 2. Render Sarana Ruangan
      if (relokasi && secSarana) {
        secSarana.style.display = 'block';
        document.getElementById('batchHasRelokasi').value = '1';
        if (relokasi.ruang_asal_id && document.getElementById('figmaRuangAsal')) {
          document.getElementById('figmaRuangAsal').value = relokasi.ruang_asal_id;
        }
        if (relokasi.ruang_tujuan_id && document.getElementById('figmaRuangTujuan')) {
          document.getElementById('figmaRuangTujuan').value = relokasi.ruang_tujuan_id;
        }
        if (relokasi.bangku !== undefined && document.getElementById('figmaJumlahBangku')) {
          document.getElementById('figmaJumlahBangku').value = relokasi.bangku;
        }
        if (relokasi.meja !== undefined && document.getElementById('figmaJumlahMeja')) {
          document.getElementById('figmaJumlahMeja').value = relokasi.meja;
        }
        if (relokasi.alasan && document.getElementById('figmaAlasanRelokasi')) {
          document.getElementById('figmaAlasanRelokasi').value = relokasi.alasan;
        }
        if (submitBtn) {
          submitBtn.textContent = 'KIRIM PENGAJUAN RELOKASI';
        }
      } else if (secSarana) {
        secSarana.style.display = 'none';
        document.getElementById('batchHasRelokasi').value = '0';
        if (submitBtn) {
          submitBtn.textContent = 'KIRIM PENGAJUAN PINJAM';
        }
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

    function hapusSaranaRuangan() {
      localStorage.removeItem('sisapras_relokasi');
      const sec = document.getElementById('sectionSaranaRuanganFigma');
      if (sec) sec.style.display = 'none';
      document.getElementById('batchHasRelokasi').value = '0';
      const submitBtn = document.querySelector('#modalKeranjang .btn-submit-figma-orange');
      if (submitBtn) submitBtn.textContent = 'KIRIM PENGAJUAN PINJAM';
      updateCartBadge();
    }

    function handleBatchSubmit(event) {
      const cart = getCart();
      const relokasi = JSON.parse(localStorage.getItem('sisapras_relokasi') || 'null');
      const errEmpty = document.getElementById('errorBatchEmpty');
      const errKep = document.getElementById('errorBatchKeperluan');
      const errRel = document.getElementById('errorFigmaAlasan');

      if (errEmpty) errEmpty.style.display = 'none';
      if (errKep) errKep.style.display = 'none';
      if (errRel) errRel.style.display = 'none';

      if (cart.length === 0 && !relokasi) {
        if (errEmpty) errEmpty.style.display = 'block';
        event.preventDefault();
        return false;
      }

      document.getElementById('batchCartItems').value = JSON.stringify(cart);
      document.getElementById('batchHasRelokasi').value = relokasi ? '1' : '0';

      let hasError = false;

      if (cart.length > 0) {
        const inpKep = document.getElementById('batchKeperluan');
        if (!inpKep.value.trim()) {
          inpKep.style.borderColor = '#DC2626';
          if (errKep) errKep.style.display = 'block';
          inpKep.focus();
          hasError = true;
        }
      }

      if (relokasi) {
        const inpRel = document.getElementById('figmaAlasanRelokasi');
        if (!inpRel.value.trim()) {
          inpRel.style.borderColor = '#DC2626';
          if (errRel) errRel.style.display = 'block';
          if (!hasError) inpRel.focus();
          hasError = true;
        }
      }

      if (hasError) {
        event.preventDefault();
        return false;
      }

      // Hapus data keranjang seketika agar saat redirect keranjang sudah kosong
      localStorage.removeItem('sisapras_cart');
      localStorage.removeItem('sisapras_relokasi');
      updateCartBadge();

      return true;
    }

    // SEARCHABLE COMBOBOX UNTUK KELAS BIODATA MAHASISWA
    function initSearchableClassDropdown(inputId, listId, wrapperId) {
      const input = document.getElementById(inputId);
      const list = document.getElementById(listId);
      const wrapper = document.getElementById(wrapperId);
      if (!input || !list || !wrapper) return;

      const DAFTAR_KELAS = [
        'PTIK A 2021', 'PTIK B 2021', 'PTIK C 2021', 'PTIK D 2021', 'PTIK E 2021', 'PTIK F 2021',
        'PTIK A 2022', 'PTIK B 2022', 'PTIK C 2022', 'PTIK D 2022', 'PTIK E 2022', 'PTIK F 2022',
        'PTIK A 2023', 'PTIK B 2023', 'PTIK C 2023', 'PTIK D 2023', 'PTIK E 2023', 'PTIK F 2023',
        'PTIK A 2024', 'PTIK B 2024', 'PTIK C 2024', 'PTIK D 2024', 'PTIK E 2024', 'PTIK F 2024',
        'PTIK A 22', 'PTIK B 22', 'PTIK C 22', 'PTIK D 22', 'PTIK E 22', 'PTIK F 22',
        'PTIK A 23', 'PTIK B 23', 'PTIK C 23', 'PTIK D 23', 'PTIK E 23', 'PTIK F 23',
        'PTIK A 24', 'PTIK B 24', 'PTIK C 24', 'PTIK D 24', 'PTIK E 24', 'PTIK F 24',
        'TEKOM A 2021', 'TEKOM B 2021',
        'TEKOM A 2022', 'TEKOM B 2022', 'TEKOM C 2022',
        'TEKOM A 2023', 'TEKOM B 2023', 'TEKOM C 2023',
        'TEKOM A 2024', 'TEKOM B 2024', 'TEKOM C 2024',
        'TEKOM A 22', 'TEKOM B 22', 'TEKOM C 22',
        'TEKOM A 23', 'TEKOM B 23', 'TEKOM C 23',
        'TEKOM A 24', 'TEKOM B 24', 'TEKOM C 24',
        'Kelas Reguler'
      ];

      let lastValidValue = input.value.trim() || 'PTIK A 22';
      input.dataset.selected = lastValidValue;

      function renderList(query = '') {
        const q = query.toLowerCase().trim();
        const filtered = DAFTAR_KELAS.filter(item => item.toLowerCase().includes(q));

        list.innerHTML = '';
        if (filtered.length === 0) {
          const emptyDiv = document.createElement('div');
          emptyDiv.style.padding = '10px 12px';
          emptyDiv.style.fontSize = '10.5px';
          emptyDiv.style.color = '#94A3B8';
          emptyDiv.style.textAlign = 'center';
          emptyDiv.style.fontStyle = 'italic';
          emptyDiv.textContent = 'Kelas tidak ditemukan. Silakan cari nama kelas lain.';
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

            const isCurrent = (item.toLowerCase() === input.value.toLowerCase().trim());
            if (isCurrent) {
              option.style.background = '#EFF6FF';
              option.style.color = '#0091FF';
            }

            option.innerHTML = `
              <span>${item}</span>
              <span style="font-size: 9px; color: ${isCurrent ? '#0091FF' : '#64748B'}; font-weight: 700; background: ${isCurrent ? '#DBEAFE' : '#F1F5F9'}; padding: 2px 6px; border-radius: 4px;">PILIH</span>
            `;

            option.addEventListener('mouseenter', () => {
              option.style.background = '#F1F5F9';
            });
            option.addEventListener('mouseleave', () => {
              option.style.background = (item.toLowerCase() === input.value.toLowerCase().trim()) ? '#EFF6FF' : '#FFFFFF';
            });

            option.addEventListener('mousedown', (e) => {
              e.preventDefault();
              selectOption(item);
            });

            list.appendChild(option);
          });
        }
      }

      function selectOption(val) {
        input.value = val;
        input.dataset.selected = val;
        lastValidValue = val;
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

      function openDropdown() {
        renderList(input.value);
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
        const exactMatch = DAFTAR_KELAS.find(k => k.toLowerCase() === currentVal.toLowerCase());
        if (exactMatch) {
          input.value = exactMatch;
          input.dataset.selected = exactMatch;
          lastValidValue = exactMatch;
        } else {
          input.value = lastValidValue;
        }
      }

      input.addEventListener('focus', openDropdown);
      input.addEventListener('click', openDropdown);
      input.addEventListener('input', () => {
        openDropdown();
        renderList(input.value);
      });

      const toggleBtn = wrapper.querySelector('.combobox-toggle-btn');
      if (toggleBtn) {
        toggleBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          if (list.style.display === 'block') {
            closeDropdown();
          } else {
            input.focus();
            openDropdown();
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
      initSearchableClassDropdown('cartPeminjamanInputKelas', 'cartPeminjamanDropdownListKelas', 'cartPeminjamanKelasComboboxWrapper');
      initSearchableClassDropdown('profileInputKelas', 'profileDropdownListKelas', 'profileKelasComboboxWrapper');
    });
  </script>

</body>
</html>
