<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM — Bebas Sarana & Prasarana</title>
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
      font-family: 'Plus Jakarta Sans', sans-serif;
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

    /* NOTICE BANNER */
    .notice-card {
      background: #FFFDF0;
      border: 1.2px solid #FDE68A;
      border-radius: 8px;
      padding: 14px 18px;
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }

    .notice-icon {
      color: #D97706;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .notice-content h4 {
      font-size: 12px;
      font-weight: 700;
      color: #92400E;
    }

    .notice-content p {
      font-size: 10.5px;
      color: #78350F;
      margin-top: 2px;
      line-height: 1.45;
    }

    /* 3 LAB STATUS CARDS (PERSIS FIGMA COLUMN 5) */
    .lab-cards-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    @media (max-width: 992px) {
      .lab-cards-grid {
        grid-template-columns: 1fr;
      }
    }

    .lab-box-card {
      background: #FFFFFF;
      border: 1.5px solid var(--border-color);
      border-radius: 10px;
      padding: 18px 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
      transition: all 0.15s ease;
    }

    .lab-box-card.bebas {
      border-color: #86EFAC;
      background: #FAFEFC;
    }

    .lab-box-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 10px;
    }

    .lab-icon-box {
      width: 38px;
      height: 38px;
      border-radius: 8px;
      background: #EFF6FF;
      color: var(--primary-navy);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .lab-box-card.bebas .lab-icon-box {
      background: #DCFCE7;
      color: #15803D;
    }

    .lab-title-text h3 {
      font-size: 12.5px;
      font-weight: 800;
      color: #0F172A;
    }

    .lab-title-text span {
      font-size: 10px;
      color: #64748B;
    }

    .badge-lab-status {
      padding: 4px 9px;
      border-radius: 5px;
      font-size: 9.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      white-space: nowrap;
    }

    .badge-lab-status.bebas {
      background: #DCFCE7;
      color: #15803D;
      border: 1px solid #86EFAC;
    }

    .badge-lab-status.tertahan {
      background: #FEE2E2;
      color: #DC2626;
      border: 1px solid #FCA5A5;
    }

    .badge-lab-status.belum {
      background: #FEF3C7;
      color: #D97706;
      border: 1px solid #FDE68A;
    }

    .lab-meta-row {
      display: flex;
      flex-direction: column;
      gap: 4px;
      font-size: 10.5px;
      color: #475569;
      border-top: 1px solid var(--border-subtle);
      padding-top: 10px;
    }

    /* FINAL STATUS CARD */
    .final-status-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 14px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .final-status-card.approved {
      background: #F0FDF4;
      border-color: #86EFAC;
    }

    .btn-action-bebas {
      background: #16A34A;
      color: #FFFFFF;
      border: none;
      padding: 10px 22px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.15s ease;
      box-shadow: 0 2px 4px rgba(22, 163, 74, 0.2);
    }

    .btn-action-bebas:hover {
      background: #15803D;
      transform: translateY(-1px);
    }

    /* MODAL CETAK RESMI */
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
      max-width: 780px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
      border: 1px solid #E2E8F0;
      max-height: 90vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .modal-header {
      padding: 14px 20px;
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
      padding: 24px;
    }

    .modal-footer {
      padding: 12px 20px;
      border-top: 1px solid #E2E8F0;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      background: #F8FAFC;
    }

    /* PRINT STYLES (SURAT DIKELOLA OLEH PARTIAL surat_bebas_sarpras) */
    @media print {
      body * {
        visibility: hidden;
      }
      #modalCetakBebasPinjam, #modalCetakBebasPinjam * {
        visibility: visible;
      }
      #modalCetakBebasPinjam {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background: #FFFFFF;
        padding: 0;
        display: block !important;
      }
      .modal-dialog {
        max-width: 100% !important;
        box-shadow: none !important;
        border: none !important;
      }
      .modal-header, .modal-footer, .no-print {
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
    .user-dropdown-btn, .btn-action-bebas, .form-input, .form-select, .form-textarea,
    .btn-primary, .btn-secondary, .btn-submit-figma-orange, .btn-batal-figma {
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

    .bebas-progress-card {
      background: #FFFFFF;
      border: 1px solid #E5E7EB;
      border-radius: 10px;
      padding: 16px 20px;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .bebas-progress-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
    }
    .bebas-progress-track {
      width: 100%;
      height: 8px;
      background: #F1F5F9;
      border-radius: 999px;
      overflow: hidden;
    }
    .bebas-progress-fill {
      height: 100%;
      border-radius: 999px;
      transition: width 0.3s ease;
    }
    .lab-box-card, .final-status-card { border: 1px solid #E5E7EB; border-radius: 10px; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04); }
    .lab-title-text h3 { font-size: 14px; }
    .lab-title-text span { font-size: 12px; }
    .badge-lab-status { font-size: 11px; padding: 4px 10px; letter-spacing: 0.2px; }
    .badge-lab-status.bebas { background: #ECFDF3; color: #15803D; border: 1px solid #BBF7D0; }
    .badge-lab-status.tertahan { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
    .badge-lab-status.belum { background: #FEF9E7; color: #B45309; border: 1px solid #FDE68A; }
    .lab-meta-row { font-size: 12px; }
    .btn-action-bebas { font-size: 13px; padding: 11px 24px; border-radius: 7px; }

    .modal-title, .modal-header h3 { font-size: 15px; }
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

    /* Tata Letak Form Bebas Sarpras (Bersih, Ringkas & Natural) */
    .bebas-apply-grid {
      display: grid;
      grid-template-columns: 1.55fr 1fr;
      gap: 18px;
      align-items: start;
      width: 100%;
    }
    .bebas-panel-card {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 20px 22px;
    }
    .bebas-panel-head {
      font-size: 14px;
      font-weight: 700;
      color: #0F172A;
      padding-bottom: 12px;
      margin: 0 0 16px 0;
      border-bottom: 1px solid #E2E8F0;
    }
    .bebas-field-label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: #334155;
      margin-bottom: 6px;
    }
    .bebas-input-clean {
      width: 100%;
      padding: 9px 12px;
      border: 1px solid #CBD5E1;
      border-radius: 6px;
      font-size: 13px;
      background: #FFFFFF;
      color: #0F172A;
      font-family: inherit;
      outline: none;
    }
    .bebas-input-clean:focus {
      border-color: #08296E;
    }
    .bebas-meta-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12.5px;
    }
    .bebas-meta-table td {
      padding: 9px 0;
      border-bottom: 1px solid #F1F5F9;
      color: #334155;
    }
    .bebas-meta-table tr:last-child td {
      border-bottom: none;
    }
    .bebas-meta-table td:last-child {
      text-align: right;
      color: #64748B;
      font-size: 12px;
    }
    .bebas-loan-note {
      font-size: 12px;
      color: #64748B;
      margin-top: 12px;
    }
    .bebas-loan-note a {
      color: #08296E;
      font-weight: 600;
      text-decoration: underline;
    }
    @media (max-width: 900px) {
      .bebas-apply-grid {
        grid-template-columns: 1fr;
        gap: 14px;
      }
      .bebas-panel-card {
        padding: 16px;
      }
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

        <!-- 5. Bebas Sarpras (ACTIVE) -->
        <a href="{{ route('mahasiswa.bebas-sarpras') }}" class="nav-item active" title="Pemeriksaan & Pengajuan Bebas Sarpras">
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
          <h1 class="page-title">Bebas Sarana &amp; Prasarana</h1>
          <span class="header-divider">|</span>
          <span class="page-subtitle"><strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->nomor_induk }})</span>
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


      @php
        $stLabKomputer = $bebasPinjam->status_lab_komputer ?? 'belum_cek';
        $stLabJaringan = $bebasPinjam->status_lab_jaringan ?? 'belum_cek';
        $stRuangInv = $bebasPinjam->status_ruang_inventaris ?? 'belum_cek';
        $verifiedUnitsCount = ($stLabKomputer === 'bebas' ? 1 : 0) + ($stLabJaringan === 'bebas' ? 1 : 0) + ($stRuangInv === 'bebas' ? 1 : 0);
        $progressPercent = (int) round(($verifiedUnitsCount / 3) * 100);
        $isAllBebas = ($stLabKomputer === 'bebas' && $stLabJaringan === 'bebas' && $stRuangInv === 'bebas');
        $kodePengajuan = $bebasPinjam->kode_pengajuan ?? ('BP-' . date('Y') . '-0001');
        $presetKeperluanMap = [
          'Yudisium & Wisuda' => 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM',
          'Ujian Tutup / Skripsi' => 'Persyaratan Ujian Tutup / Tugas Akhir (Skripsi)',
          'Cuti Akademik' => 'Pengurusan Cuti Akademik',
          'Pindah Prodi' => 'Pindah Program Studi / Perguruan Tinggi',
        ];
        $currentKeperluan = $bebasPinjam->keperluan ?? 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM';
        $activeLoanAlertCount = ($pinjamanAktifCount ?? 0) + ($menungguAccCount ?? 0);
      @endphp

      @if(!$bebasPinjam)
        <!-- FORM PENGAJUAN BEBAS SARPRAS -->
        <div class="bebas-apply-grid">
          <div class="bebas-panel-card">
            <h2 class="bebas-panel-head">Ajukan Bebas Sarpras</h2>

            <form method="POST" action="{{ route('mahasiswa.bebas-pinjam.store') }}">
              @csrf
              <label for="keperluanSelectNew" class="bebas-field-label">Keperluan Surat</label>
              <select id="keperluanSelectNew" class="bebas-input-clean" onchange="handleKeperluanSelect('keperluanSelectNew', 'keperluanCustomWrapNew', 'keperluanInputNew')">
                @foreach($presetKeperluanMap as $shortLabel => $fullText)
                  <option value="{{ $fullText }}">{{ $fullText }}</option>
                @endforeach
                <option value="__custom__">Keperluan Lainnya (Isi Sendiri)</option>
              </select>

              <div id="keperluanCustomWrapNew" style="display: none; margin-top: 10px;">
                <input type="text" id="keperluanInputNew" name="keperluan" maxlength="255" value="Pemberkasan Yudisium &amp; Wisuda Sarjana FT UNM" placeholder="Ketik keperluan surat Anda..." required class="bebas-input-clean">
              </div>

              @if($activeLoanAlertCount > 0)
                <div class="bebas-loan-note">
                  Pinjaman berjalan: {{ $pinjamanAktifCount ?? 0 }} aktif, {{ $menungguAccCount ?? 0 }} menunggu ACC (<a href="{{ route('mahasiswa.status-pinjam') }}">Lihat status</a>)
                </div>
              @endif

              <div style="margin-top: 16px;">
                <button type="submit" class="btn-action-bebas" style="background: #08296E; box-shadow: none;">
                  <span>Ajukan Verifikasi</span>
                </button>
              </div>
            </form>
          </div>

          <div class="bebas-panel-card">
            <h2 class="bebas-panel-head">Unit Verifikasi</h2>
            <table class="bebas-meta-table">
              <tbody>
                <tr>
                  <td><strong>Laboratorium</strong></td>
                  <td>Gedung A</td>
                </tr>
                <tr>
                  <td><strong>Administrasi</strong></td>
                  <td>Gedung A</td>
                </tr>
                <tr>
                  <td><strong>Bengkel IT</strong></td>
                  <td>Gedung B</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      @else
        <!-- RINGKASAN PROGRES VERIFIKASI 3 UNIT -->
        <div class="bebas-progress-card">
          <div class="bebas-progress-top">
            <div>
              <div style="font-size: 13.5px; font-weight: 700; color: #0F172A;">Progres Verifikasi Bebas Sarpras ({{ $kodePengajuan }})</div>
              <div style="font-size: 12px; color: #64748B; margin-top: 2px;">
                @if($isAllBebas)
                  Seluruh 3 unit laboratorium telah memverifikasi bebas tanggungan Anda. Surat resmi siap dicetak.
                @else
                  <strong>{{ $verifiedUnitsCount }} dari 3 unit</strong> telah diverifikasi bebas tanggungan.
                @endif
              </div>
            </div>
            <div style="font-size: 13px; font-weight: 800; color: {{ $isAllBebas ? '#15803D' : '#08296E' }};">
              {{ $verifiedUnitsCount }}/3 Unit ({{ $progressPercent }}%)
            </div>
          </div>
          <div class="bebas-progress-track">
            <div class="bebas-progress-fill" style="width: {{ $progressPercent }}%; background: {{ $isAllBebas ? '#15803D' : '#08296E' }};"></div>
          </div>
        </div>

        <!-- 3 LAB VERIFICATION CARDS -->
        <div class="lab-cards-grid">
          <!-- Lab 1: Laboratorium -->
          <div class="lab-box-card {{ $stLabKomputer === 'bebas' ? 'bebas' : '' }}">
            <div class="lab-box-top">
              <div class="lab-icon-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
              </div>
              <span class="badge-lab-status {{ $stLabKomputer === 'bebas' ? 'bebas' : ($stLabKomputer === 'tertahan' ? 'tertahan' : 'belum') }}">
                {{ $stLabKomputer === 'bebas' ? 'BEBAS' : ($stLabKomputer === 'tertahan' ? 'TERTAHAN' : 'BELUM CEK') }}
              </span>
            </div>
            <div class="lab-title-text">
              <h3>Laboratorium</h3>
              <span>Gedung A (Lab Terpadu JTIK)</span>
            </div>
            <div class="lab-meta-row">
              <div>Laboran: <strong>{{ $bebasPinjam->petugas_lab_komputer ?? 'Laboran' }}</strong></div>
              <div>Waktu: <strong>{{ $bebasPinjam->tgl_lab_komputer ? date('d M Y H:i', strtotime($bebasPinjam->tgl_lab_komputer)) . ' WITA' : '-' }}</strong></div>
              <div style="font-size: 11.5px; color: #64748B;">Catatan: {{ $bebasPinjam->catatan_lab_komputer ?? ($stLabKomputer === 'bebas' ? 'Tidak ada tanggungan praktikum.' : 'Belum diperiksa oleh petugas unit.') }}</div>
            </div>
          </div>

          <!-- Lab 2: Administrasi -->
          <div class="lab-box-card {{ $stLabJaringan === 'bebas' ? 'bebas' : '' }}">
            <div class="lab-box-top">
              <div class="lab-icon-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
              </div>
              <span class="badge-lab-status {{ $stLabJaringan === 'bebas' ? 'bebas' : ($stLabJaringan === 'tertahan' ? 'tertahan' : 'belum') }}">
                {{ $stLabJaringan === 'bebas' ? 'BEBAS' : ($stLabJaringan === 'tertahan' ? 'TERTAHAN' : 'BELUM CEK') }}
              </span>
            </div>
            <div class="lab-title-text">
              <h3>Administrasi</h3>
              <span>Gedung A (Gedung Utama JTIK)</span>
            </div>
            <div class="lab-meta-row">
              <div>Petugas: <strong>{{ $bebasPinjam->petugas_lab_jaringan ?? 'Administrasi' }}</strong></div>
              <div>Waktu: <strong>{{ $bebasPinjam->tgl_lab_jaringan ? date('d M Y H:i', strtotime($bebasPinjam->tgl_lab_jaringan)) . ' WITA' : '-' }}</strong></div>
              <div style="font-size: 11.5px; color: #64748B;">Catatan: {{ $bebasPinjam->catatan_lab_jaringan ?? ($stLabJaringan === 'bebas' ? 'Seluruh perangkat inventaris telah dikembalikan.' : 'Belum diperiksa oleh petugas unit.') }}</div>
            </div>
          </div>

          <!-- Lab 3: Bengkel IT -->
          <div class="lab-box-card {{ $stRuangInv === 'bebas' ? 'bebas' : '' }}">
            <div class="lab-box-top">
              <div class="lab-icon-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
              </div>
              <span class="badge-lab-status {{ $stRuangInv === 'bebas' ? 'bebas' : ($stRuangInv === 'tertahan' ? 'tertahan' : 'belum') }}">
                {{ $stRuangInv === 'bebas' ? 'BEBAS' : ($stRuangInv === 'tertahan' ? 'TERTAHAN' : 'BELUM CEK') }}
              </span>
            </div>
            <div class="lab-title-text">
              <h3>Bengkel IT</h3>
              <span>Gedung B (Bengkel IT)</span>
            </div>
            <div class="lab-meta-row">
              <div>Laboran: <strong>{{ $bebasPinjam->petugas_ruang_inventaris ?? 'Kepala Bengkel IT' }}</strong></div>
              <div>Waktu: <strong>{{ $bebasPinjam->tgl_ruang_inventaris ? date('d M Y H:i', strtotime($bebasPinjam->tgl_ruang_inventaris)) . ' WITA' : '-' }}</strong></div>
              <div style="font-size: 11.5px; color: #64748B;">Catatan: {{ $bebasPinjam->catatan_ruang_inventaris ?? ($stRuangInv === 'bebas' ? 'Modul dan perabot ruangan dalam keadaan lengkap.' : 'Belum diperiksa oleh petugas unit.') }}</div>
            </div>
          </div>
        </div>

        <!-- FINAL STATUS & PENGATURAN KEPERLUAN -->
        @if($isAllBebas || $bebasPinjam->status_final === 'bebas')
          <div class="final-status-card approved">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <div>
              <h2 style="font-size: 17px; font-weight: 800; color: #15803D;">Lengkap &amp; Dinyatakan Bebas Sarana Prasarana</h2>
              <p style="font-size: 13px; color: #166534; margin-top: 6px; max-width: 560px; line-height: 1.55;">
                Selamat! Anda telah diverifikasi bebas dari seluruh tanggungan laboratorium dan inventaris. Surat Keterangan resmi bertanda tangan digital Ketua Jurusan Teknik Informatika dan Komputer telah diterbitkan.
              </p>
              <div style="font-size: 12px; color: #14532D; margin-top: 6px;">Keperluan: <strong>{{ $currentKeperluan }}</strong></div>
            </div>
            <button type="button" class="btn-action-bebas" onclick="openPrintBebasModal()">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
              <span>Cetak Surat Bebas Sarpras Resmi</span>
            </button>
          </div>
        @else
          <div class="final-status-card" style="text-align: left; align-items: stretch; gap: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap;">
              <div>
                <h2 style="font-size: 15px; font-weight: 700; color: #B45309; margin: 0;">Permohonan Dalam Proses Pengecekan ({{ $kodePengajuan }})</h2>
                <p style="font-size: 12px; color: #64748B; margin-top: 3px;">
                  Diajukan {{ date('d M Y', strtotime($bebasPinjam->tgl_pengajuan)) }}. Hubungi pengelola unit terkait jika perlu verifikasi cepat.
                </p>
              </div>
              <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <button type="button" class="btn-action-bebas" style="background:#08296E; box-shadow:none;" onclick="openPrintBebasModal()">
                  <span>Pratinjau Surat</span>
                </button>
                <form method="POST" action="{{ route('mahasiswa.bebas-pinjam.batal') }}" onsubmit="return confirmFormSubmit(event, this, 'Batalkan Pengajuan Bebas Sarpras', 'Pengajuan ini akan dihapus dari antrean verifikasi. Lanjutkan?', 'Ya, Batalkan', true)" style="margin: 0;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-action-bebas" style="background: #FFFFFF; color: #DC2626; border: 1px solid #FCA5A5; box-shadow:none;">
                    <span>Batalkan Pengajuan</span>
                  </button>
                </form>
              </div>
            </div>

            @php
              $isCustomEdit = !in_array($currentKeperluan, array_values($presetKeperluanMap), true);
            @endphp
            <form method="POST" action="{{ route('mahasiswa.bebas-pinjam.update') }}" id="formAturKeperluan" style="border-top: 1px solid #E2E8F0; padding-top: 12px;">
              @csrf
              @method('PATCH')
              <label for="keperluanSelectEdit" class="bebas-field-label">Keperluan Surat</label>
              <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <select id="keperluanSelectEdit" class="bebas-input-clean" style="flex: 1 1 280px;" onchange="handleKeperluanSelect('keperluanSelectEdit', 'keperluanCustomWrapEdit', 'keperluanInputEdit')">
                  @foreach($presetKeperluanMap as $shortLabel => $fullText)
                    <option value="{{ $fullText }}" {{ $currentKeperluan === $fullText ? 'selected' : '' }}>{{ $fullText }}</option>
                  @endforeach
                  <option value="__custom__" {{ $isCustomEdit ? 'selected' : '' }}>Keperluan Lainnya (Isi Sendiri)</option>
                </select>
                <button type="submit" class="btn-action-bebas" style="background: #0F172A; padding: 8px 16px; font-size: 12px; box-shadow:none;">
                  <span>Simpan</span>
                </button>
              </div>
              <div id="keperluanCustomWrapEdit" style="display: {{ $isCustomEdit ? 'block' : 'none' }}; margin-top: 8px;">
                <input type="text" id="keperluanInputEdit" name="keperluan" maxlength="255" value="{{ $currentKeperluan }}" placeholder="Ketik keperluan surat Anda..." required class="bebas-input-clean">
              </div>
            </form>
          </div>
        @endif
      @endif

    </main>
  </div>

  <!-- MODAL CETAK & PREVIEW SURAT RESMI BEBAS SARPRAS -->
  <div id="modalCetakBebasPinjam" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modalCetakBebasPinjam')">
    <div class="modal-dialog">
      <div class="modal-header">
        <h3>Pratinjau Surat Keterangan Bebas Sarana Prasarana</h3>
        <button type="button" class="modal-close-btn" onclick="closeModal('modalCetakBebasPinjam')">×</button>
      </div>
      <div class="modal-body">
        @include('partials.surat_bebas_sarpras', ['bebasPinjam' => $bebasPinjam ?? null])
      </div>
      <div class="modal-footer">
        @if($isAllBebas)
          <button type="button" class="btn-action-bebas" style="background: #08296E;" onclick="window.print()">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            <span>Cetak Surat (Print / PDF)</span>
          </button>
        @else
          <button type="button" class="btn-action-bebas" style="background: #94A3B8; cursor: not-allowed;" disabled title="Surat resmi baru dapat dicetak setelah seluruh unit (3/3) telah diverifikasi BEBAS.">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
            <span>Belum Dapat Dicetak (Menunggu Verifikasi 3 Unit)</span>
          </button>
        @endif
        @if(!$isAllBebas && isset($bebasPinjam) && $bebasPinjam->status_final !== 'bebas')
          <button type="button" class="btn-action-bebas" style="background: #FFFBEB; color: #B45309; border: 1px solid #FDE68A;" onclick="closeModal('modalCetakBebasPinjam'); focusAturKeperluan();">
            <span>Atur Keperluan</span>
          </button>
        @endif
        <button type="button" class="btn-action-bebas" style="background: #64748B;" onclick="closeModal('modalCetakBebasPinjam')">
          Tutup
        </button>
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
                <div class="searchable-combobox" id="cartBebasKelasComboboxWrapper" style="position: relative;">
                  <div style="position: relative; display: flex; align-items: center;">
                    <svg style="position: absolute; left: 10px; width: 13px; height: 13px; color: #94A3B8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" 
                           id="cartBebasInputKelas" 
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
                  <div id="cartBebasDropdownListKelas" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; max-height: 180px; overflow-y: auto; background: #FFFFFF; border: 1.5px solid #0091FF; border-radius: 6px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12); z-index: 99999;"></div>
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

    function openPrintBebasModal() {
      openModal('modalCetakBebasPinjam');
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

    function handleKeperluanSelect(selectId, wrapId, inputId) {
      const sel = document.getElementById(selectId);
      const wrap = document.getElementById(wrapId);
      const inp = document.getElementById(inputId);
      if (!sel || !wrap || !inp) return;

      if (sel.value === '__custom__') {
        wrap.style.display = 'block';
        inp.readOnly = false;
        inp.disabled = false;
        if (inp.value && Array.from(sel.options).some(function(o) { return o.value === inp.value; })) {
          inp.value = '';
        }
        setTimeout(function() { inp.focus(); }, 20);
      } else {
        wrap.style.display = 'none';
        inp.value = sel.value;
      }
    }

    function focusAturKeperluan() {
      const inp = document.getElementById('keperluanInputEdit');
      if (inp) {
        inp.scrollIntoView({ behavior: 'smooth', block: 'center' });
        setTimeout(() => {
          inp.focus();
        }, 250);
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      @if(session('clear_cart'))
        localStorage.removeItem('sisapras_cart');
        localStorage.removeItem('sisapras_relokasi');
      @endif
      updateCartBadge();
      initSearchableClassDropdown('cartBebasInputKelas', 'cartBebasDropdownListKelas', 'cartBebasKelasComboboxWrapper');
      initSearchableClassDropdown('profileInputKelas', 'profileDropdownListKelas', 'profileKelasComboboxWrapper');
    });
  </script>

  @include('partials.ui_feedback')
</body>
</html>
