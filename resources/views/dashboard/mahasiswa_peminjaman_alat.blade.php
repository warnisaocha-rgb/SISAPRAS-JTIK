<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM — Katalog Alat & Bahan</title>
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

    /* SIDEBAR (KONSISTEN 220PX FIGMA DENGAN SUB-MENU TERBAGI) */
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
      gap: 3px;
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

    /* SUB-MENU ACCORDION PEMINJAMAN (FIGMA) */
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
      position: relative;
    }

    .nav-sub-item:hover {
      background: rgba(255, 255, 255, 0.06);
      color: #FFFFFF;
    }

    /* ACTIVE SUB-ITEM ORANGE FIGMA */
    .nav-sub-item.active {
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
      padding: 1px 6px;
      border-radius: 999px;
      line-height: 1.2;
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
    }

    .badge-role-pill:hover {
      background: #DBEAFE;
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

    /* TOOLBAR PENCARIAN & UNIT PILLS (SERAGAM ADMIN & PENGELOLA) */
    .catalog-toolbar-panel {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 12px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .unit-pills-group {
      display: flex;
      align-items: center;
      gap: 6px;
      flex-wrap: wrap;
    }

    .unit-pill-btn {
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
      white-space: nowrap;
    }

    .unit-pill-btn:hover {
      background: #EFF6FF;
      color: var(--primary-navy);
      border-color: #BFDBFE;
    }

    .unit-pill-btn.active {
      background: #08296E;
      color: #FFFFFF;
      border-color: #08296E;
    }

    .unit-pill-count {
      font-size: 9px;
      font-weight: 800;
      padding: 1px 6px;
      border-radius: 4px;
      background: rgba(0, 0, 0, 0.08);
      color: #475569;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 16px;
      line-height: 1.2;
    }

    .unit-pill-btn.active .unit-pill-count {
      background: #FFFFFF;
      color: #08296E;
    }

    .catalog-search-box {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
      max-width: 380px;
      position: relative;
    }

    .catalog-search-input {
      width: 100%;
      padding: 6.5px 12px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      outline: none;
      background: #FFFFFF;
    }

    .catalog-search-input:focus {
      border-color: #08296E;
      box-shadow: 0 0 0 2px rgba(8, 41, 110, 0.08);
    }

    .btn-search-action {
      background: #08296E;
      color: #FFFFFF;
      border: none;
      border-radius: 6px;
      padding: 6.5px 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.15s ease;
      white-space: nowrap;
    }

    .btn-search-action:hover {
      background: #0d3896;
    }

    .btn-clear-search {
      position: absolute;
      right: 56px;
      color: #94A3B8;
      text-decoration: none;
      font-size: 14px;
      font-weight: 700;
      line-height: 1;
    }

    /* GRID KATALOG KARTU ALAT & BAHAN (FIGMA UI) */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    @media (max-width: 1100px) {
      .cards-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .cards-grid {
        grid-template-columns: 1fr;
      }
    }

    .item-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
      transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .item-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 14px -3px rgba(8, 41, 110, 0.1);
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
    }

    .badge-stock-pill {
      position: absolute;
      top: 8px;
      right: 8px;
      padding: 2.5px 8px;
      border-radius: 5px;
      font-size: 8.5px;
      font-weight: 700;
      z-index: 2;
    }

    .badge-stock-pill.ready {
      background: #DCFCE7;
      color: #15803D;
      border: 1px solid #86EFAC;
    }

    .badge-stock-pill.empty {
      background: #FEE2E2;
      color: #DC2626;
      border: 1px solid #FCA5A5;
    }

    .item-body {
      padding: 12px 14px;
      display: flex;
      flex-direction: column;
      gap: 2px;
      flex: 1;
    }

    .item-code {
      font-family: 'JetBrains Mono', monospace;
      font-size: 9px;
      color: #64748B;
      font-weight: 600;
    }

    .item-title {
      font-size: 13px;
      font-weight: 700;
      color: #0F172A;
      line-height: 1.3;
    }

    .item-room {
      font-size: 10px;
      color: #64748B;
      margin-top: 2px;
    }

    .item-footer-btn {
      padding: 10px 14px 12px 14px;
      background: #FFFFFF;
      border-top: 1px solid var(--border-subtle);
    }

    .btn-green-pinjam {
      width: 100%;
      background: #15803D;
      color: #FFFFFF;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10.5px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      transition: background 0.15s ease;
    }

    .btn-green-pinjam:hover {
      background: #166534;
    }

    .btn-green-pinjam:disabled {
      background: #CBD5E1;
      color: #64748B;
      cursor: not-allowed;
    }

    /* MODAL STYLES (FIGMA SCREENSHOT POPUP) */
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
      max-width: 540px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
      border: 1px solid #E2E8F0;
      max-height: 90vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .modal-dialog.modal-step {
      max-width: 620px;
    }

    .modal-header {
      padding: 14px 20px;
      border-bottom: 1px solid #E2E8F0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h3 {
      font-size: 13px;
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
      gap: 10px;
      background: #F8FAFC;
    }

    /* STEP PINJAM DETAIL */
    .qty-counter-row {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-counter {
      width: 28px;
      height: 28px;
      border-radius: 5px;
      border: 1px solid var(--border-color);
      background: #FFFFFF;
      color: #0F172A;
      font-weight: 700;
      font-size: 14px;
      line-height: 1;
      padding: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: transform 0.1s ease, background-color 0.15s ease;
    }

    .btn-counter:hover:not(:disabled) {
      background: #F1F5F9;
    }

    .btn-counter:active:not(:disabled) {
      transform: scale(0.94);
    }

    .btn-counter:disabled {
      opacity: 0.45;
      cursor: not-allowed;
    }

    .input-counter {
      width: 48px;
      height: 28px;
      text-align: center;
      padding: 0;
      line-height: 26px;
      font-variant-numeric: tabular-nums;
      border: 1px solid var(--border-color);
      border-radius: 5px;
      font-weight: 700;
      font-size: 12.5px;
      color: #0F172A;
      background: #FFFFFF;
      outline: none;
      appearance: textfield;
      -moz-appearance: textfield;
    }

    .input-counter::-webkit-outer-spin-button,
    .input-counter::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .btn-orange-pinjam {
      background: #ED7411;
      color: #FFFFFF;
      border: none;
      padding: 8px 18px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.15s ease;
    }

    .btn-orange-pinjam:hover {
      background: #D96005;
    }

    .btn-white-cart {
      background: #FFFFFF;
      color: #0F172A;
      border: 1px solid var(--border-color);
      padding: 8px 14px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
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
      background: #FEF2F2;
    }

    /* DATA VERIFIKASI BOX */
    .verified-user-box {
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
      border-radius: 8px;
      padding: 12px 14px;
    }

    .verified-user-title {
      font-size: 10px;
      font-weight: 800;
      color: #15803D;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 5px;
      margin-bottom: 8px;
    }

    .verified-user-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
      font-size: 10.5px;
    }

    .vu-label {
      font-size: 9px;
      color: #64748B;
    }

    .vu-value {
      font-weight: 700;
      color: #0F172A;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .form-group label {
      font-size: 10.5px;
      font-weight: 700;
      color: #334155;
    }

    .form-input, .form-textarea {
      width: 100%;
      padding: 7px 10px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
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
    #modalProfile .form-group,
    #modalChangePassword .form-group {
      display: block;
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
    .user-dropdown-btn, .catalog-search-input, .btn-search-action, .btn-green-pinjam,
    .form-input, .form-select, .form-textarea, .btn-primary, .btn-secondary,
    .btn-orange-pinjam, .btn-white-cart, .btn-submit-figma-orange, .btn-batal-figma {
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

    .catalog-toolbar-panel { border: 1px solid #E5E7EB; border-radius: 10px; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04); }
    .unit-pill-btn { font-size: 12.5px; padding: 7px 14px; border-color: #E2E8F0; border-radius: 6px; }
    .unit-pill-count { font-size: 11px; padding: 2px 7px; border-radius: 4px; }
    .catalog-search-input { font-size: 12.5px; padding: 8px 13px; border-color: #D8DEE9; }
    .btn-search-action { font-size: 12.5px; padding: 8px 16px; }
    .item-card { border: 1px solid #E5E7EB; border-radius: 10px; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04); }
    .item-thumb-box { height: 180px; background: #F1F5F9; }
    .badge-stock-pill { font-size: 10.5px; padding: 3.5px 10px; }
    .item-body { padding: 14px 16px; gap: 5px; }
    .item-code { font-size: 11px; }
    .item-title { font-size: 14.5px; }
    .item-room { font-size: 12px; display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-top: 4px; }
    .item-meta-cat { font-size: 11px; color: #475569; background: #F1F5F9; padding: 2px 8px; border-radius: 5px; font-weight: 600; display: inline-block; width: fit-content; }
    .btn-green-pinjam {
      font-size: 12.5px;
      padding: 10px 14px;
      text-transform: none;
      letter-spacing: 0;
      border-radius: 7px;
      background: #F8FAFC;
      color: #08296E;
      border: 1.5px solid #08296E;
      transition: all 0.15s ease;
    }
    .btn-green-pinjam:hover:not(:disabled) {
      background: #08296E;
      color: #FFFFFF;
    }
    .btn-green-pinjam:disabled {
      background: #F1F5F9;
      color: #94A3B8;
      border-color: #CBD5E1;
    }

    .modal-title, .modal-header h3 { font-size: 15px; }
    .form-label, .form-group label { font-size: 12px; }
    .form-input, .form-select, .form-textarea { font-size: 12.5px; padding: 9px 12px; border-color: #D8DEE9; }
    .btn-primary, .btn-secondary, .btn-orange-pinjam, .btn-white-cart { font-size: 12.5px; padding: 9px 16px; }

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
    
    <!-- SIDEBAR KONSISTEN 220PX FIGMA (SUB-MENU TERBAGI) -->
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

        <div class="nav-header-label">Menu Peminjaman</div>

        <!-- 2. Peminjaman -->
        <a href="{{ route('mahasiswa.peminjaman.alat') }}" class="nav-item active" title="Katalog Alat & Bahan Laboratorium">
          <div class="nav-left-part">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
            </svg>
            <span>Peminjaman</span>
          </div>
        </a>

        <div class="nav-header-label" style="margin-top: 10px;">Layanan Mahasiswa</div>

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
          <h1 class="page-title">Katalog Alat &amp; Bahan</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle">Eksplorasi inventaris laboratorium &amp; alat praktikum JTIK</span>
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
          <span>{{ session('success') }}</span>
          <button type="button" class="alert-close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
      @endif

      <!-- TOOLBAR PENCARIAN & UNIT PILLS (SERAGAM ADMIN & PENGELOLA) -->
      <div class="catalog-toolbar-panel">
        <div class="unit-pills-group">
          <a href="{{ route('mahasiswa.peminjaman.alat', ['unit' => 'semua', 'search' => $search ?? '']) }}" class="unit-pill-btn {{ ($unitFilter ?? 'semua') === 'semua' ? 'active' : '' }}">
            <span>Semua Unit</span>
            <span class="unit-pill-count">{{ $totalUnitCount ?? 56 }}</span>
          </a>
          <a href="{{ route('mahasiswa.peminjaman.alat', ['unit' => 'bengkel', 'search' => $search ?? '']) }}" class="unit-pill-btn {{ ($unitFilter ?? '') === 'bengkel' ? 'active' : '' }}">
            <span>Bengkel IT</span>
            <span class="unit-pill-count">{{ $bengkelCount ?? 10 }}</span>
          </a>
          <a href="{{ route('mahasiswa.peminjaman.alat', ['unit' => 'lab', 'search' => $search ?? '']) }}" class="unit-pill-btn {{ ($unitFilter ?? '') === 'lab' ? 'active' : '' }}">
            <span>Laboratorium</span>
            <span class="unit-pill-count">{{ $labCount ?? 18 }}</span>
          </a>
          <a href="{{ route('mahasiswa.peminjaman.alat', ['unit' => 'admin', 'search' => $search ?? '']) }}" class="unit-pill-btn {{ ($unitFilter ?? '') === 'admin' ? 'active' : '' }}">
            <span>Administrasi</span>
            <span class="unit-pill-count">{{ $adminCount ?? 5 }}</span>
          </a>
        </div>

        <form method="GET" action="{{ route('mahasiswa.peminjaman.alat') }}" class="catalog-search-box">
          <input type="hidden" name="unit" value="{{ $unitFilter ?? 'semua' }}">
          <input type="text" name="search" class="catalog-search-input" value="{{ $search ?? '' }}" placeholder="Cari nama atau kode barang...">
          <button type="submit" class="btn-search-action">Cari</button>
          @if(!empty($search))
            <a href="{{ route('mahasiswa.peminjaman.alat', ['unit' => $unitFilter ?? 'semua']) }}" title="Hapus Pencarian" class="btn-clear-search">×</a>
          @endif
        </form>
      </div>

      <!-- CARDS GRID ALAT & BAHAN -->
      <div class="cards-grid">
        @forelse($sarpras as $item)
          @php
            $isReady = $item->jumlah_tersedia > 0;
            $fotoUrl = $item->foto ? asset('storage/' . $item->foto) : null;
            $ruangNama = $item->ruangan ? $item->ruangan->nama_ruangan : 'Laboratorium';
          @endphp
          <div class="item-card">
            <div class="item-thumb-box">
              @if($fotoUrl)
                <img src="{{ $fotoUrl }}" alt="{{ $item->nama_sarpras }}" class="item-thumb-img">
              @else
                <div style="text-align: center; color: #94A3B8; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                  <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                  <span style="font-size: 11px; font-weight: 500; color: #94A3B8;">Foto belum tersedia</span>
                </div>
              @endif
            </div>

            <div class="item-body">
              <span class="item-code">{{ $item->kode_sarpras }}</span>
              <h3 class="item-title">{{ $item->nama_sarpras }}</h3>
              <div class="item-room">
                <span>{{ $ruangNama }}</span>
                <span style="font-weight: 600; color: {{ $isReady ? '#15803D' : '#DC2626' }};">Stok: {{ $item->jumlah_tersedia }}/{{ $item->jumlah_total }}</span>
              </div>
            </div>

            <div class="item-footer-btn">
              <button type="button" class="btn-green-pinjam" {{ !$isReady ? 'disabled' : '' }}
                onclick='openModalDetailOpsi({
                  id: {{ $item->id }},
                  kode: "{{ addslashes($item->kode_sarpras) }}",
                  nama: "{{ addslashes($item->nama_sarpras) }}",
                  ruangan: "{{ addslashes($ruangNama) }}",
                  tersedia: {{ $item->jumlah_tersedia }},
                  maks: {{ $item->maks_pinjam ?? 2 }},
                  foto: "{{ $fotoUrl ?? '' }}"
                })'>
                Lihat Detail &amp; Pinjam
              </button>
            </div>
          </div>
        @empty
          <div style="grid-column: 1 / -1; background: #FFFFFF; border: 1.5px dashed var(--border-color); border-radius: 8px; padding: 40px; text-align: center; color: #64748B;">
            <p>Tidak ada alat &amp; bahan praktikum yang sesuai dengan unit atau pencarian yang Anda pilih.</p>
          </div>
        @endforelse
      </div>

      @include('partials.pagination', ['paginator' => $sarpras])

    </main>
  </div>

  <!-- MODAL 1: DETAIL BARANG & OPSI PINJAM (FIGMA MIDDLE LEFT POPUP) -->
  <div id="modalDetailOpsi" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalDetailOpsi')">
    <div class="modal-dialog">
      <div class="modal-header">
        <h3>Detail Barang &amp; Opsi Pinjam</h3>
        <button type="button" class="modal-close-btn" onclick="closeModal('modalDetailOpsi')">×</button>
      </div>
      <div class="modal-body">
        <div style="display: flex; gap: 16px; align-items: center;">
          <div style="width: 100px; height: 80px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <img id="mdoFoto" src="" alt="Foto" style="width: 100%; height: 100%; object-fit: cover; display: none;">
            <span id="mdoPlaceholder" style="font-size: 12px; color: #94A3B8;">No Image</span>
          </div>
          <div>
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 12px; color: #64748B;" id="mdoKode">-</div>
            <h3 style="font-size: 14px; font-weight: 800; color: #0F172A;" id="mdoNama">-</h3>
            <span class="badge-stock-pill ready" id="mdoTersedia" style="position: static; display: inline-block; margin-top: 4px;">2 Unit Tersedia</span>
          </div>
        </div>

        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 14px; font-size: 11px; display: flex; flex-direction: column; gap: 6px;">
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #64748B;">Unit Pengelola:</span>
            <strong id="mdoPengelola" style="color: #0F172A;">Laboratorium JTIK</strong>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #64748B;">Lokasi Ruangan:</span>
            <strong id="mdoRuangan" style="color: #0F172A;">-</strong>
          </div>
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0;">
          <div>
            <div style="font-size: 11.5px; font-weight: 700; color: #334155;">Jumlah Unit yang diajukan:</div>
            <div id="mdoMaxHint" style="font-size: 11px; color: #64748B; margin-top: 2px;">Maks. 2 unit</div>
          </div>
          <div class="qty-counter-row">
            <button type="button" id="mdoBtnMinus" class="btn-counter" onclick="adjustQty(-1)" aria-label="Kurangi jumlah">-</button>
            <input type="number" id="mdoQtyInput" class="input-counter" value="1" min="1" max="2" readonly aria-label="Jumlah unit">
            <button type="button" id="mdoBtnPlus" class="btn-counter" onclick="adjustQty(1)" aria-label="Tambah jumlah">+</button>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="justify-content: space-between;">
        <button type="button" class="btn-white-cart" onclick="addToCartFromModalDetail()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
          <span>Masukkan Keranjang</span>
        </button>
        <button type="button" class="btn-orange-pinjam" onclick="proceedToQuickPinjam()">
          Pinjam Sekarang
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL 2: LANGKAH CEPAT: PINJAM SEKARANG (FIGMA BOTTOM LEFT POPUP) -->
  <div id="modalQuickPinjam" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalQuickPinjam')">
    <div class="modal-dialog modal-step">
      <div class="modal-header">
        <h3>Langkah Cepat: Pinjam Sekarang</h3>
        <button type="button" class="modal-close-btn" onclick="closeModal('modalQuickPinjam')">×</button>
      </div>
      <form method="POST" action="{{ route('mahasiswa.peminjaman.store') }}" onsubmit="return handleQuickPinjamSubmit()">
        @csrf
        <input type="hidden" name="sarpras_id" id="qpSarprasId" value="">
        <input type="hidden" name="jumlah" id="qpJumlah" value="1">

        <div class="modal-body">
          <!-- Item Summary Header -->
          <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <div style="width: 48px; height: 40px; background: #F1F5F9; border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                <img id="qpFoto" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                <svg id="qpIcon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="1.8"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
              </div>
              <div>
                <h4 style="font-size: 13px; font-weight: 800; color: #08296E;" id="qpNamaBarang">-</h4>
                <div style="font-size: 12px; color: #64748B;">Jumlah Diajukan: <strong id="qpQtyDisplay">1 Unit</strong></div>
              </div>
            </div>
          </div>

          <!-- Data Pengaju (Mahasiswa) - Seragam & Dapat Diedit Seperti di Keranjang -->
          <div class="cart-figma-box" style="margin-bottom: 0;">
            <div class="cart-figma-box-title" style="text-transform: none;">Data Pengaju (Mahasiswa)</div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 10px;">
              <div>
                <label style="font-size: 11.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Nomor Induk Mahasiswa (NIM) <span style="color: #DC2626;">*</span></label>
                <input type="text" name="nomor_induk" value="{{ Auth::user()->nomor_induk }}" readonly style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 8px 11px; font-size: 12px; background: #F8FAFC; color: #334155; font-weight: 700;">
              </div>
              <div>
                <label style="font-size: 11.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Nama Lengkap Pengaju <span style="color: #DC2626;">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ Auth::user()->name }}" readonly style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 8px 11px; font-size: 12px; background: #F8FAFC; color: #334155; font-weight: 700;">
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
              <div>
                <label style="font-size: 11.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Program Studi / Jurusan <span style="color: #DC2626;">*</span></label>
                <select name="jurusan" class="auto-prodi-input" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 8px 11px; font-size: 12px; background: #FFFFFF; color: #334155; font-weight: 600; outline: none; font-family: inherit; cursor: pointer;">
                  <option value="Pendidikan Teknik Informatika dan Komputer" {{ Auth::user()->program_studi === 'Pendidikan Teknik Informatika dan Komputer' ? 'selected' : '' }}>Pendidikan Teknik Informatika dan Komputer</option>
                  <option value="Teknik Komputer" {{ Auth::user()->program_studi === 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                </select>
              </div>
              <div>
                <label style="font-size: 11.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Kelas (Ketik untuk Mencari) <span style="color: #DC2626;">*</span></label>
                <div class="searchable-combobox" id="quickPinjamKelasComboboxWrapper" style="position: relative;">
                  <input type="hidden" name="kelas_id" class="auto-kelas-id-input" value="{{ Auth::user()->kelas_id }}">
                  <div style="position: relative; display: flex; align-items: center;">
                    <svg style="position: absolute; left: 10px; width: 13px; height: 13px; color: #94A3B8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text"
                           id="quickPinjamInputKelas"
                           name="kelas"
                           autocomplete="off"
                           placeholder="Ketik untuk mencari kelas (contoh: PTIK A 24)..."
                           value="{{ Auth::user()->nama_kelas }}"
                           required
                           style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 8px 28px 8px 28px; font-size: 12px; background: #FFFFFF; color: #334155; font-weight: 600; outline: none; font-family: inherit;">
                    <button type="button" class="combobox-toggle-btn" style="position: absolute; right: 4px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 4px; cursor: pointer; color: #64748B;">
                      <svg class="combobox-chevron" style="width: 13px; height: 13px; transition: transform 0.2s;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </button>
                  </div>
                  <div id="quickPinjamDropdownListKelas" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; max-height: 180px; overflow-y: auto; background: #FFFFFF; border: 1.5px solid #08296E; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12); z-index: 99999;"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Waktu Pinjam & Rencana Pengembalian (Maks. 3 Hari) -->
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div class="form-group">
              <label>Tanggal Pinjam <span style="color:#DC2626;">*</span></label>
              <input type="datetime-local" id="qpTglPinjam" name="tgl_pinjam" class="form-input" value="{{ date('Y-m-d\T08:00') }}" min="{{ date('Y-m-d\T00:00') }}" onchange="syncQuickPinjamDateBounds()" required>
            </div>
            <div class="form-group">
              <label>Batas Waktu Pengembalian (Maks. 3 Hari) <span style="color:#DC2626;">*</span></label>
              <input type="datetime-local" id="qpTglKembali" name="tgl_kembali_rencana" class="form-input" value="{{ date('Y-m-d\T14:00') }}" min="{{ date('Y-m-d\T08:00') }}" max="{{ date('Y-m-d\T23:59', strtotime('+3 days')) }}" onchange="validateQuickPinjamReturnDate()" required>
            </div>
          </div>

          <!-- Dosen Penanggung Jawab -->
          <div class="form-group">
            <label>Dosen Penanggung Jawab <span style="color:#DC2626;">*</span></label>
            <input type="text" name="dosen_penanggung_jawab" class="form-input" placeholder="Contoh: Dr. Ir. H. Ramly, M.Pd." required>
          </div>

          <!-- Keperluan -->
          <div class="form-group">
            <label>Keperluan / Alasan Peminjaman <span style="color:#DC2626;">*</span></label>
            <textarea name="keperluan" class="form-textarea" rows="2" placeholder="Contoh: Tugas mata kuliah, proyek, atau kegiatan di lingkungan JTIK..." required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-white-cart" onclick="closeModal('modalQuickPinjam')">Batal</button>
          <button type="submit" class="btn-green-pinjam" style="width: auto; padding: 9px 20px;">
            Ajukan Pinjam Sekarang
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
                <div class="searchable-combobox" id="cartAlatKelasComboboxWrapper" style="position: relative;">
                  <input type="hidden" name="kelas_id" class="auto-kelas-id-input" value="{{ Auth::user()->kelas_id }}">
                  <div style="position: relative; display: flex; align-items: center;">
                    <svg style="position: absolute; left: 10px; width: 13px; height: 13px; color: #94A3B8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" 
                           id="cartAlatInputKelas" 
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
                  <div id="cartAlatDropdownListKelas" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; max-height: 180px; overflow-y: auto; background: #FFFFFF; border: 1.5px solid #0091FF; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12); z-index: 99999;"></div>
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
    let activeItem = null;

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

    function syncQtyCounterButtons() {
      const input = document.getElementById('mdoQtyInput');
      const btnMinus = document.getElementById('mdoBtnMinus');
      const btnPlus = document.getElementById('mdoBtnPlus');
      if (!input) return;
      const val = parseInt(input.value, 10) || 1;
      const min = parseInt(input.min, 10) || 1;
      const max = parseInt(input.max, 10) || 2;
      if (btnMinus) btnMinus.disabled = val <= min;
      if (btnPlus) btnPlus.disabled = val >= max;
    }

    function openModalDetailOpsi(item) {
      activeItem = item;
      document.getElementById('mdoKode').textContent = item.kode;
      document.getElementById('mdoNama').textContent = item.nama;
      document.getElementById('mdoRuangan').textContent = item.ruangan;
      document.getElementById('mdoTersedia').textContent = item.tersedia + ' Unit Tersedia';
      const maxAllowed = Math.max(1, Math.min(item.tersedia, item.maks || 2));
      document.getElementById('mdoQtyInput').value = 1;
      document.getElementById('mdoQtyInput').max = maxAllowed;
      const maxHintEl = document.getElementById('mdoMaxHint');
      if (maxHintEl) {
        maxHintEl.textContent = item.tersedia < (item.maks || 2)
          ? 'Maks. ' + maxAllowed + ' unit (sesuai stok)'
          : 'Maks. ' + maxAllowed + ' unit';
      }
      syncQtyCounterButtons();

      const img = document.getElementById('mdoFoto');
      const ph = document.getElementById('mdoPlaceholder');
      if (item.foto) {
        img.src = item.foto;
        img.style.display = 'block';
        ph.style.display = 'none';
      } else {
        img.style.display = 'none';
        ph.style.display = 'block';
      }

      openModal('modalDetailOpsi');
    }

    function adjustQty(delta) {
      const input = document.getElementById('mdoQtyInput');
      let val = (parseInt(input.value, 10) || 1) + delta;
      const min = parseInt(input.min, 10) || 1;
      const max = parseInt(input.max, 10) || 2;
      if (val >= min && val <= max) {
        input.value = val;
      }
      syncQtyCounterButtons();
    }

    function proceedToQuickPinjam() {
      if (!activeItem) return;
      closeModal('modalDetailOpsi');

      const qty = document.getElementById('mdoQtyInput').value;
      document.getElementById('qpSarprasId').value = activeItem.id;
      document.getElementById('qpJumlah').value = qty;
      document.getElementById('qpNamaBarang').textContent = activeItem.nama + ' (' + activeItem.kode + ')';
      document.getElementById('qpQtyDisplay').textContent = qty + ' Unit (Maks: ' + (activeItem.maks || 2) + ' unit)';

      const img = document.getElementById('qpFoto');
      const icon = document.getElementById('qpIcon');
      if (activeItem.foto) {
        img.src = activeItem.foto;
        img.style.display = 'block';
        icon.style.display = 'none';
      } else {
        img.style.display = 'none';
        icon.style.display = 'block';
      }

      const qpKeperluan = document.querySelector('#modalQuickPinjam textarea[name="keperluan"]');
      if (qpKeperluan) {
        qpKeperluan.value = '';
      }

      openModal('modalQuickPinjam');
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
      const badge = document.getElementById('cartCountBadge');
      if (badge) {
        badge.textContent = cart.length;
      }
    }

    function addToCartFromModalDetail() {
      if (!activeItem) return;
      const qty = parseInt(document.getElementById('mdoQtyInput').value) || 1;
      const cart = getCart();
      const existing = cart.find(item => item.id == activeItem.id);
      if (existing) {
        existing.jumlah += qty;
      } else {
        cart.push({
          id: activeItem.id,
          nama: activeItem.nama + ' (' + activeItem.kode + ')',
          ruangan: activeItem.ruangan,
          jumlah: qty
        });
      }
      saveCart(cart);
      closeModal('modalDetailOpsi');
      if (window.showSystemToast) {
        window.showSystemToast(activeItem.nama + ' (' + qty + ' unit) ditambahkan ke keranjang.', 'success');
      }
      const cartBadge = document.getElementById('cartCountBadge');
      if (cartBadge && typeof cartBadge.animate === 'function') {
        cartBadge.animate([{ transform: 'scale(1)' }, { transform: 'scale(1.22)' }, { transform: 'scale(1)' }], { duration: 240, easing: 'ease-out' });
      }
    }

    function openCartModal() {
      renderCartUI();
      openModal('modalKeranjang');
    }

    function updateCartBadge() {
      const cart = getCart();
      const count = cart.length;
      const badge = document.getElementById('cartCountBadge');
      if (badge) {
        badge.textContent = count;
      }
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

    function handleQuickPinjamSubmit() {
      const qpId = document.getElementById('qpSarprasId').value;
      if (qpId) {
        let cart = getCart();
        cart = cart.filter(item => item.id != qpId);
        saveCart(cart);
      }
      return true;
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

    function syncQuickPinjamDateBounds() {
      const pinjamEl = document.getElementById('qpTglPinjam');
      const kembaliEl = document.getElementById('qpTglKembali');
      if (!pinjamEl || !kembaliEl || !pinjamEl.value) return;

      const baseDate = new Date(pinjamEl.value);
      if (isNaN(baseDate.getTime())) return;

      const maxDate = new Date(baseDate.getTime());
      maxDate.setDate(maxDate.getDate() + 3);
      const pad = n => String(n).padStart(2, '0');
      const maxStr = maxDate.getFullYear() + '-' + pad(maxDate.getMonth() + 1) + '-' + pad(maxDate.getDate()) + 'T23:59';

      kembaliEl.min = pinjamEl.value;
      kembaliEl.max = maxStr;

      if (kembaliEl.value && kembaliEl.value < pinjamEl.value) {
        kembaliEl.value = pinjamEl.value;
      } else if (kembaliEl.value && kembaliEl.value > maxStr) {
        kembaliEl.value = maxStr;
        if (window.showSystemToast) {
          showSystemToast('Batas waktu pengembalian maksimal 3 hari dari tanggal pinjam.', 'warning');
        }
      }
    }

    function validateQuickPinjamReturnDate() {
      const pinjamEl = document.getElementById('qpTglPinjam');
      const kembaliEl = document.getElementById('qpTglKembali');
      if (!pinjamEl || !kembaliEl || !kembaliEl.value) return;

      if (kembaliEl.min && kembaliEl.value < kembaliEl.min) {
        kembaliEl.value = kembaliEl.min;
        if (window.showSystemToast) {
          showSystemToast('Batas waktu pengembalian tidak boleh sebelum tanggal pinjam.', 'warning');
        }
      } else if (kembaliEl.max && kembaliEl.value > kembaliEl.max) {
        kembaliEl.value = kembaliEl.max;
        if (window.showSystemToast) {
          showSystemToast('Batas waktu pengembalian maksimal 3 hari dari tanggal pinjam.', 'warning');
        }
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      @if(session('clear_cart'))
        localStorage.removeItem('sisapras_cart');
        localStorage.removeItem('sisapras_relokasi');
      @endif
      updateCartBadge();
      syncQuickPinjamDateBounds();
      initSearchableClassDropdown('quickPinjamInputKelas', 'quickPinjamDropdownListKelas', 'quickPinjamKelasComboboxWrapper');
      initSearchableClassDropdown('cartAlatInputKelas', 'cartAlatDropdownListKelas', 'cartAlatKelasComboboxWrapper');
      initSearchableClassDropdown('profileInputKelas', 'profileDropdownListKelas', 'profileKelasComboboxWrapper');
    });
  </script>

  @include('partials.ui_feedback')
</body>
</html>
