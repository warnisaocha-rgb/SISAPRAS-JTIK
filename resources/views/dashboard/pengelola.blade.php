<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM — Meja Persetujuan Peminjaman Sarpras</title>
  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono (Standar UI SI-SAPRAS UNM) -->
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

    /* PORTAL LAYOUT FULLSCREEN */
    .portal-layout {
      display: grid;
      grid-template-columns: 220px 1fr;
      width: 100%;
      min-height: 100vh;
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

    /* WARNA ACTIVE SIDEBAR KONSISTEN ORANGE SEPERTI ADMIN */
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
    }

    /* MAIN WORKSPACE */
    .workspace {
      background: var(--bg-workspace);
      padding: 24px 32px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      overflow-y: auto;
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

    /* TOOLBAR ROW */
    .toolbar-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 4px;
      flex-wrap: wrap;
    }

    .toolbar-left {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      min-width: 0;
    }

    /* FILTER STATUS BUTTON GROUP (MASING-MASING TOMBOL / BUKAN DROPDOWN) */
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
      padding: 0 13px;
      border-radius: 6px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.15s ease;
      cursor: pointer;
      white-space: nowrap;
      border: 1.2px solid var(--border-color);
      background: #FFFFFF;
      color: #475569;
    }

    .filter-btn:hover {
      background: #F8FAFC;
      border-color: #CBD5E1;
      color: #0F172A;
    }

    /* TOMBOL AKTIF: WARNA GELAP DENGAN BADGE KUNING PERSIS TAMPILAN USER */
    .filter-btn.active {
      background: #0F172A;
      color: #FFFFFF;
      border-color: #0F172A;
      font-weight: 700;
      box-shadow: 0 1px 2px rgba(15, 23, 42, 0.12);
    }

    .filter-btn .btn-badge {
      font-size: 9.5px;
      font-weight: 800;
      padding: 1px 7px;
      border-radius: 999px;
      background: #F1F5F9;
      color: #64748B;
      transition: all 0.15s ease;
    }

    .filter-btn.active .btn-badge {
      background: var(--unm-orange);
      color: #FFFFFF;
    }

    .filter-btn:not(.active):hover .btn-badge {
      background: #E2E8F0;
      color: #0F172A;
    }

    /* Toolbar Search Form (Langsung nempel dengan Filter) */
    .toolbar-search-form {
      display: flex;
      flex: 1;
      max-width: 380px;
      margin: 0;
    }

    .search-input-box {
      width: 100%;
      position: relative;
      display: flex;
      align-items: center;
    }

    .search-input-box svg {
      position: absolute;
      left: 12px;
      pointer-events: none;
      color: #94A3B8;
    }

    .search-input-box input {
      width: 100%;
      height: 36px;
      background: #FFFFFF;
      border: 1.2px solid var(--border-color);
      border-radius: 6px;
      padding: 0 12px 0 36px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      color: var(--text-dark);
      outline: none;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .search-input-box input:focus {
      border-color: #ED7411;
      box-shadow: 0 0 0 2px rgba(237, 116, 17, 0.12);
    }

    .toolbar-right {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }

    .toolbar-meta-badge {
      font-size: 11px;
      font-weight: 500;
      color: #64748B;
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      padding: 8px 14px;
      border-radius: 6px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    .toolbar-meta-badge strong {
      color: #08296E;
      font-weight: 700;
    }

    /* TABLE CARD */
    .table-card {
      background: #FFFFFF;
      border: 1.2px solid var(--border-color);
      border-radius: 8px;
      overflow: visible;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .table-caption-bar {
      padding: 12px 16px;
      background: #FFFFFF;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid var(--border-subtle);
    }

    .table-caption-title {
      font-size: 11.5px;
      font-weight: 800;
      color: var(--text-dark);
      letter-spacing: 0.3px;
    }

    .table-caption-meta {
      font-size: 10.5px;
      font-weight: 600;
      color: var(--text-muted);
    }

    /* TABLE */
    .approval-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10.5px;
    }

    .approval-table thead th {
      background: #F8FAFC;
      border-bottom: 1.2px solid var(--border-color);
      border-right: 1px solid var(--border-subtle);
      padding: 10px 14px;
      text-align: left;
      font-size: 9.5px;
      font-weight: 800;
      color: #475569;
      letter-spacing: 0.3px;
    }

    .approval-table thead th:last-child {
      border-right: none;
    }

    .approval-table tbody td {
      padding: 14px 14px;
      border-bottom: 1px solid var(--border-subtle);
      border-right: 1px solid #F1F5F9;
      vertical-align: top;
      background: #FFFFFF;
    }

    .approval-table tbody td:last-child {
      border-right: none;
    }

    .approval-table tbody tr.row-striped td {
      background: #F8FAFC;
    }

    .approval-table tbody tr:hover td {
      background: #F8FAFC;
    }

    /* TYPOGRAPHY KOLOM 1: NO TIKET & WAKTU */
    .trx-id {
      font-size: 12px;
      font-weight: 700;
      color: var(--primary-navy);
      display: block;
      margin-bottom: 2px;
      letter-spacing: -0.2px;
    }

    .trx-date {
      font-size: 10px;
      color: var(--text-muted);
      display: block;
      margin-bottom: 5px;
    }

    .trx-time-badge {
      display: inline-block;
      background: #F1F5F9;
      border: 1px solid #E2E8F0;
      padding: 2px 7px;
      border-radius: 4px;
      font-size: 9.5px;
      font-weight: 600;
      color: #475569;
    }

    /* TYPOGRAPHY KOLOM 2: IDENTITAS PEMINJAM */
    .mhs-name {
      font-size: 11.5px;
      font-weight: 700;
      color: var(--text-dark);
      display: block;
      margin-bottom: 2px;
    }

    .mhs-nim {
      font-size: 10px;
      font-weight: 600;
      color: var(--text-muted);
      display: block;
      margin-bottom: 2px;
    }

    .mhs-class {
      font-size: 10px;
      color: #475569;
      display: block;
    }

    /* TYPOGRAPHY KOLOM 3: SARPRAS & JUMLAH */
    .item-name {
      font-size: 11.5px;
      font-weight: 700;
      color: var(--text-dark);
      display: block;
      margin-bottom: 4px;
    }

    .item-qty-row {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 5px;
    }

    .item-qty {
      font-size: 10.5px;
      font-weight: 700;
      color: var(--primary-navy);
    }

    .tag-ready-green {
      background: var(--status-green-bg);
      color: var(--status-green-text);
      font-size: 9.5px;
      font-weight: 600;
      padding: 1px 7px;
      border-radius: 3px;
    }

    .item-meta-row {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 9.5px;
      color: #64748B;
    }

    .item-dot-sep {
      color: #CBD5E1;
    }

    /* TYPOGRAPHY KOLOM 4: JADWAL & KEPERLUAN */
    .sched-time {
      font-size: 10.5px;
      font-weight: 700;
      color: var(--text-dark);
      display: block;
      margin-bottom: 3px;
    }

    .sched-lecturer {
      font-size: 11px;
      font-weight: 700;
      color: var(--primary-navy);
      display: block;
    }

    .sched-purpose {
      font-size: 9.5px;
      color: #475569;
      font-style: italic;
      display: block;
      line-height: 1.35;
    }

    /* BADGE STATUS */
    .badge-status-box {
      display: inline-block;
      padding: 5px 9px;
      border-radius: 4px;
      font-size: 8.5px;
      font-weight: 800;
      text-align: center;
      letter-spacing: 0.3px;
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

    /* TABLE FOOTER */
    .table-footer {
      padding: 10px 16px;
      background: #F8FAFC;
      border-top: 1px solid var(--border-color);
      font-size: 10px;
      color: var(--text-muted);
    }

    /* MODAL STYLES (CLEAN & NON-AI BLOAT) */
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

    .modal-header {
      padding: 16px 20px;
      border-bottom: 1px solid #E2E8F0;
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
      color: #08296E;
      letter-spacing: -0.2px;
    }

    .btn-close-modal {
      width: 28px;
      height: 28px;
      border-radius: 6px;
      border: none;
      background: transparent;
      color: #64748B;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 18px;
      line-height: 1;
      transition: background 0.12s, color 0.12s;
    }

    .btn-close-modal:hover {
      background: #F1F5F9;
      color: #0F172A;
    }

    .modal-body {
      padding: 18px 20px;
      font-size: 11px;
      color: #334155;
      line-height: 1.5;
    }

    .modal-footer {
      padding: 14px 20px;
      border-top: 1px solid #E2E8F0;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
      background: #F8FAFC;
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
    }

    .btn-modal-cancel {
      padding: 8px 16px;
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

    .btn-modal-cancel:hover {
      background: #F1F5F9;
      color: #0F172A;
    }

    .btn-modal-submit-green {
      padding: 8px 18px;
      border-radius: 6px;
      border: none;
      background: #16A34A;
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.15s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-modal-submit-green:hover {
      background: #15803D;
    }

    .btn-modal-submit-red {
      padding: 8px 18px;
      border-radius: 6px;
      border: none;
      background: #DC2626;
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.15s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-modal-submit-red:hover {
      background: #B91C1C;
    }

    /* REASON CHIPS */
    .reason-chip {
      background: #F1F5F9;
      border: 1px solid #CBD5E1;
      color: #334155;
      padding: 5px 12px;
      border-radius: 999px;
      font-size: 10px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.15s ease;
      user-select: none;
    }

    .reason-chip:hover {
      background: #E2E8F0;
      color: #0F172A;
      border-color: #94A3B8;
      transform: translateY(-1px);
    }

    .reason-chip.selected {
      background: #FEE2E2;
      color: #DC2626;
      border-color: #FCA5A5;
      font-weight: 600;
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

    /* Baris barang milik ruangan lain (abu-abu, hanya lihat status, tidak bisa diapa-apakan) */
    .approval-table tr.row-other-room td {
      background-color: #F8FAFC !important;
      color: #94A3B8 !important;
      opacity: 0.72;
    }
    .approval-table tr.row-other-room:hover td {
      background-color: #F8FAFC !important;
    }
    .approval-table tr.row-other-room .trx-id,
    .approval-table tr.row-other-room .mhs-name,
    .approval-table tr.row-other-room .asset-name-title,
    .approval-table tr.row-other-room .sched-lecturer,
    .approval-table tr.row-other-room .badge-asset-code,
    .approval-table tr.row-other-room .stock-box-total,
    .approval-table tr.row-other-room .stock-box-ready {
      color: #64748B !important;
    }
  </style>
</head>
<body>

  <!-- PORTAL LAYOUT -->
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
          <h1 class="page-title">Persetujuan Peminjaman</h1>
          <span class="header-divider">|</span>
          <span style="font-size: 11px; color: #64748B;">Kelola dan verifikasi permohonan pinjam sarpras {{ $namaRuangan ?? 'Laboratorium' }}</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
          <!-- Tombol Ruangan (Buka Info Ruangan & Cek Stok) -->
          <button type="button" class="btn-header-room" onclick="openRoomInfoModal()" title="Klik untuk Informasi Ruangan &amp; Cek Stok Sarpras">
            <span>{{ $badgeRuangan ?? $namaRuangan ?? 'Laboratorium' }}</span>
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

      <!-- TOOLBAR: FILTER & SEARCH (UNIFIED COMPACT ROW) -->
      <div class="toolbar-row">
        <div class="toolbar-left">
          <!-- Filter Status Button Group (Masing-Masing Tombol) -->
          <div class="filter-btn-group">
            <a href="{{ route('pengelola.dashboard', array_filter(['status' => 'menunggu_verifikasi', 'search' => $search])) }}"
               class="filter-btn {{ ($statusFilter ?? 'menunggu_verifikasi') === 'menunggu_verifikasi' ? 'active' : '' }}"
               title="Permohonan menunggu ACC">
              <span>Menunggu ACC</span>
              <span class="btn-badge">{{ $menungguCount ?? 0 }}</span>
            </a>

            <a href="{{ route('pengelola.dashboard', array_filter(['status' => 'disetujui', 'search' => $search])) }}"
               class="filter-btn {{ ($statusFilter ?? '') === 'disetujui' ? 'active' : '' }}"
               title="Permohonan yang telah disetujui">
              <span>Disetujui</span>
              @if(isset($disetujuiCount))
                <span class="btn-badge">{{ $disetujuiCount }}</span>
              @endif
            </a>

            <a href="{{ route('pengelola.dashboard', array_filter(['status' => 'ditolak', 'search' => $search])) }}"
               class="filter-btn {{ ($statusFilter ?? '') === 'ditolak' ? 'active' : '' }}"
               title="Permohonan yang ditolak">
              <span>Ditolak</span>
              @if(isset($ditolakCount))
                <span class="btn-badge">{{ $ditolakCount }}</span>
              @endif
            </a>

            <a href="{{ route('pengelola.dashboard', array_filter(['status' => 'semua', 'search' => $search])) }}"
               class="filter-btn {{ ($statusFilter ?? '') === 'semua' ? 'active' : '' }}"
               title="Tampilkan semua permohonan">
              <span>Semua</span>
              @if(isset($semuaCount))
                <span class="btn-badge">{{ $semuaCount }}</span>
              @endif
            </a>
          </div>

          <!-- Search Form (Nempel Langsung di Samping Pill) -->
          <form method="GET" action="{{ route('pengelola.dashboard') }}" class="toolbar-search-form">
            <input type="hidden" name="status" value="{{ $statusFilter ?? 'menunggu_verifikasi' }}">
            <div class="search-input-box">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama peminjam, NIM, alat...">
              @if(!empty($search))
                <a href="{{ route('pengelola.dashboard', ['status' => $statusFilter ?? 'menunggu_verifikasi']) }}" title="Hapus pencarian" style="position: absolute; right: 10px; color: #94A3B8; text-decoration: none; font-size: 14px; font-weight: 700; line-height: 1;">×</a>
              @endif
            </div>
          </form>
        </div>

        <div class="toolbar-right">
          <div class="toolbar-meta-badge">
            Menampilkan <strong>{{ $antrian->count() }}</strong> Permohonan
          </div>
        </div>
      </div>

      <!-- ANTREAN PERMOHONAN PINJAMAN TABLE CARD -->
      <div class="table-card">
        <table class="approval-table">
          <thead>
            <tr>
              <th style="width: 14%; border-top-left-radius: 7px;">No. Tiket &amp; Waktu</th>
              <th style="width: 19%;">Identitas Peminjam</th>
              <th style="width: 24%;">Nama Sarpras</th>
              <th style="width: 14%; text-align: center;">Stok (Diminta/Ready)</th>
              <th style="width: 17%;">Dosen Pembimbing</th>
              <th style="width: 7%; text-align: center;">Status</th>
              <th style="width: 5%; text-align: center; border-top-right-radius: 7px;">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @forelse($antrian as $item)
            @php
              $itemCount = $item->total_items_count ?? 1;
              $hasPending = $item->has_pending_for_me ?? ($item->status === 'menunggu_verifikasi');
              $allApproved = $item->all_my_approved ?? in_array($item->status, ['disetujui', 'sedang_dipinjam', 'selesai']);
              $allRejected = $item->all_my_rejected ?? ($item->status === 'ditolak');
              $ruangItem = optional(optional($item->sarpras)->ruangan)->nama_ruangan ?? ($namaRuangan ?? 'Ruangan');
              $itemJsonAttr = htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8');
            @endphp
            <tr class="{{ $loop->iteration % 2 === 0 ? 'row-striped' : '' }}" style="cursor: pointer;" onclick='openDetailModal({!! $itemJsonAttr !!})'>
              <!-- KOLOM 1: NO TIKET & WAKTU -->
              <td>
                <span class="trx-id">{{ $item->kode_peminjaman }}</span>
                <span class="trx-date">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->translatedFormat('d M Y') }}</span>
                <span class="trx-time-badge">{{ $item->waktu_formatted }}</span>
              </td>

              <!-- KOLOM 2: IDENTITAS PEMINJAM -->
              <td>
                <span class="mhs-name">{{ $item->user->name ?? 'Mahasiswa' }}</span>
                <span class="mhs-nim">NIM: {{ $item->user->nomor_induk ?? '-' }}</span>
                <span class="mhs-class">{{ (stripos($item->user->jurusan ?? '', 'Informatika') !== false || stripos($item->user->jurusan ?? '', 'PTIK') !== false) ? 'PTIK' : 'Teknik Komputer' }}</span>
                @if(!empty($item->user->no_hp))
                  <div style="font-size: 11.5px; color: #64748B; margin-top: 2px;">{{ $item->user->no_hp }}</div>
                @endif
              </td>

              <!-- KOLOM 3: NAMA SARPRAS (1 BARIS RINGKAS PER TIKET) -->
              <td>
                <div class="asset-name-title">{{ $item->sarpras->nama_sarpras ?? 'Sarpras' }}</div>
                @if($itemCount > 1)
                  <div style="margin-top: 3px; font-size: 11.5px; color: #64748B; font-weight: 600;">
                    +{{ $itemCount - 1 }} barang lainnya ({{ $itemCount }} barang)
                  </div>
                @else
                  <div style="margin-top: 3px;">
                    <span class="badge-asset-code" style="font-size: 12px;">{{ $item->sarpras->kode_sarpras ?? '-' }}</span>
                  </div>
                @endif
              </td>

              <!-- KOLOM 4: STOK -->
              <td style="text-align: center; vertical-align: middle;">
                <div class="stock-stack">
                  @if($itemCount > 1)
                    <span class="stock-box-total">Total: {{ $item->total_units_sum ?? $item->jumlah }} Unit</span>
                    <span class="stock-box-ready">{{ $itemCount }} Barang</span>
                  @else
                    <span class="stock-box-total">Diminta: {{ $item->jumlah ?? 1 }} Unit</span>
                    <span class="stock-box-ready">Ready: {{ $item->sarpras->jumlah_tersedia ?? 0 }} Unit</span>
                  @endif
                </div>
              </td>

              <!-- KOLOM 5: DOSEN PEMBIMBING -->
              <td>
                <span class="sched-lecturer">{{ $item->dosen_penanggung_jawab ?? '-' }}</span>
                <div style="font-size: 11.5px; color: #64748B; margin-top: 3px; font-style: italic;">
                  "{{ Str::limit($item->keperluan, 40) }}"
                </div>
              </td>

              <!-- KOLOM 6: STATUS -->
              <td style="text-align: center; vertical-align: middle;">
                @if($hasPending)
                  <span class="badge-status-box" style="background:#FFF3E8; color:#F06A09; border:1px solid #FED7AA;">Menunggu ACC</span>
                @elseif($allApproved)
                  <span class="badge-status-box" style="background:#DCFCE7; color:#15803D; border:1px solid #BBF7D0;">Disetujui</span>
                @elseif($allRejected)
                  <span class="badge-status-box" style="background:#FEE2E2; color:#DC2626; border:1px solid #FECACA;">Ditolak</span>
                @else
                  <span class="badge-status-box" style="background:#F1F5F9; color:#475569; border:1px solid #CBD5E1;">{{ ucfirst($item->status) }}</span>
                @endif
              </td>

              <!-- KOLOM 7: TINDAKAN -->
              <td style="text-align: center; vertical-align: middle; position: relative;" onclick="event.stopPropagation();">
                <div class="action-dropdown-wrap">
                  <button type="button" class="btn-action-dots" onclick="toggleActionMenu(event, this)" title="Pilihan Aksi">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                      <circle cx="5" cy="12" r="2"/>
                      <circle cx="12" cy="12" r="2"/>
                      <circle cx="19" cy="12" r="2"/>
                    </svg>
                  </button>
                  <div class="action-dropdown-menu">
                    <button type="button" class="action-menu-item" onclick='closeAllActionMenus(); openDetailModal({!! $itemJsonAttr !!})'>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                      <span>Lihat Detail</span>
                    </button>

                    @if($hasPending)
                      @if(($item->my_items_count ?? 1) > 1)
                        <form action="{{ route('pengelola.peminjaman.setujui-tiket', $item->kode_peminjaman) }}" method="POST" style="margin: 0;">
                          @csrf
                          <button type="submit" class="action-menu-item action-menu-success">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>Setujui Semua ({{ $namaRuangan ?? 'Unit Ini' }})</span>
                          </button>
                        </form>
                        <div class="action-menu-divider"></div>
                        <button type="button" class="action-menu-item action-menu-danger" onclick='closeAllActionMenus(); openTolakTiketModal({!! $itemJsonAttr !!})'>
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                          <span>Tolak Semua ({{ $namaRuangan ?? 'Unit Ini' }})</span>
                        </button>
                      @else
                        <button type="button" class="action-menu-item action-menu-success" onclick='closeAllActionMenus(); openSetujuiModal({!! $itemJsonAttr !!})'>
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                          <span>Setujui</span>
                        </button>
                        <div class="action-menu-divider"></div>
                        <button type="button" class="action-menu-item action-menu-danger" onclick='closeAllActionMenus(); openTolakModal({!! $itemJsonAttr !!})'>
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                          <span>Tolak</span>
                        </button>
                      @endif
                    @endif
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align: center; padding: 36px 16px; color: #64748B;">
                <div style="font-weight: 700; font-size: 13px; color: #0F172A; margin-bottom: 4px;">Tidak Ada Antrean Peminjaman</div>
                <div style="font-size: 12px;">Semua permohonan peminjaman di {{ $namaRuangan ?? 'Laboratorium' }} telah diverifikasi.</div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </main>
  </div>

  <!-- MODAL 1: DETAIL PERMOHONAN PINJAMAN -->
  <div id="modalDetail" class="modal-overlay">
    <div class="modal-dialog" style="max-width: 580px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          <span class="modal-title">Detail Permohonan Pinjaman</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeDetailModal()">&times;</button>
      </div>
      <div class="modal-body" style="padding: 18px 20px;">
        
        <!-- Header Strip ID & Status -->
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 14px; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <div id="detailKodePeminjaman" style="font-size: 14px; font-weight: 800; color: #08296E; letter-spacing: -0.2px;">TRX-0000-0000</div>
            <div id="detailTglDiajukan" style="font-size: 11.5px; color: #64748B; margin-top: 2px;">Diajukan: -</div>
          </div>
          <div>
            <span id="detailStatusPill" class="badge-status-box" style="background:#FFF3E8; color:#F06A09; border:1px solid #FED7AA;">Menunggu ACC</span>
          </div>
        </div>

        <!-- Info Peminjam & Jadwal -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px 18px; margin-top: 14px; padding-bottom: 14px; border-bottom: 1px solid #F1F5F9;">
          <div>
            <div style="font-size: 11.5px; font-weight: 600; color: #64748B;">Nama Mahasiswa</div>
            <div id="detailNamaMhs" style="font-size: 12.5px; font-weight: 700; color: #0F172A; margin-top: 2px;">-</div>
            <div id="detailKontakMhs" style="font-size: 11.5px; color: #64748B; margin-top: 2px;">-</div>
          </div>
          <div>
            <div style="font-size: 11.5px; font-weight: 600; color: #64748B;">NIM &amp; Program Studi</div>
            <div id="detailNimProdi" style="font-size: 12.5px; font-weight: 700; color: #0F172A; margin-top: 2px;">-</div>
          </div>
          <div>
            <div style="font-size: 11.5px; font-weight: 600; color: #64748B;">Dosen Penanggung Jawab</div>
            <div id="detailDosenPj" style="font-size: 12.5px; font-weight: 600; color: #08296E; margin-top: 2px;">-</div>
          </div>
          <div>
            <div style="font-size: 11.5px; font-weight: 600; color: #64748B;">Jadwal Penggunaan</div>
            <div id="detailJadwal" style="font-size: 12.5px; font-weight: 600; color: #0F172A; margin-top: 2px;">-</div>
          </div>
          <div style="grid-column: 1 / -1;">
            <div style="font-size: 11.5px; font-weight: 600; color: #64748B;">Keperluan</div>
            <div id="detailKeperluan" style="font-size: 12.5px; color: #334155; margin-top: 2px;">-</div>
          </div>
        </div>

        <!-- Daftar Barang (Polos 1px Border, Turun per Barang, Ruangan Lain Abu-Abu) -->
        <div style="margin-top: 14px;">
          <div style="font-size: 12.5px; font-weight: 700; color: #0F172A; margin-bottom: 8px;">
            Daftar Barang (<span id="detailTicketItemCount">1</span>)
          </div>
          <div id="detailTicketItemsContainer" style="display: flex; flex-direction: column; gap: 8px; max-height: 280px; overflow-y: auto;">
            <!-- Rendered via openDetailModal() -->
          </div>
        </div>

      </div>
      <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
        <button type="button" class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
        <div id="detailBatchActions" style="display: none; align-items: center; gap: 8px;">
          <button type="button" onclick="closeDetailModal(); openTolakTiketModal(currentActiveItem);" style="background: #FEF2F2; color: #DC2626; border: 1px solid #FCA5A5; border-radius: 7px; padding: 8px 14px; font-size: 12px; font-weight: 600; cursor: pointer;">
            Tolak Semua
          </button>
          <form id="formDetailBatchApprove" method="POST" action="" style="display:inline; margin: 0;">
            @csrf
            <button type="submit" style="background: #15803D; color: #FFFFFF; border: 1px solid #15803D; border-radius: 7px; padding: 8px 16px; font-size: 12px; font-weight: 600; cursor: pointer;">
              Setujui Semua ({{ $namaRuangan ?? 'Unit Ini' }})
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL 2: FORMULIR PENOLAKAN PEMINJAMAN -->
  <div id="modalTolak" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          <span class="modal-title" style="color: #DC2626;">Formulir Penolakan Peminjaman</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeTolakModal()">×</button>
      </div>
      <form id="formTolakPinjaman" method="POST" action="">
        @csrf
        <div class="modal-body">
          
          <!-- Banner Pengingat Ringkas -->
          <div style="background: #FEF2F2; border: 1px solid #FECACA; border-radius: 6px; padding: 8px 12px; font-size: 12px; color: #991B1B; line-height: 1.4; margin-bottom: 12px;">
            Alasan penolakan akan dicatat dan dikirimkan langsung ke status peminjaman mahasiswa pemohon.
          </div>

          <!-- Ringkasan Tiket & Mahasiswa -->
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 9px 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
            <div>
              <div id="tolakKodeTrx" style="font-size: 11.5px; font-weight: 800; color: #08296E;">TRX-0000-0000</div>
              <div id="tolakSarprasInfo" style="font-size: 11.5px; color: #64748B; margin-top: 1px;">-</div>
            </div>
            <div style="text-align: right;">
              <div id="tolakNamaMhs" style="font-size: 10.5px; font-weight: 700; color: #0F172A;">-</div>
              <div id="tolakNimMhs" style="font-size: 11.5px; color: #64748B; margin-top: 1px;">-</div>
            </div>
          </div>

          <!-- Pilihan Alasan Cepat -->
          <div style="font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 6px; letter-spacing: 0.3px;">Pilihan Alasan Cepat (Klik untuk Mengisi):</div>
          <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px;">
            <button type="button" class="reason-chip" onclick="fillTolakReason('Peralatan sedang dalam tahap kalibrasi/validasi.', this)">Peralatan sedang divalidasi</button>
            <button type="button" class="reason-chip" onclick="fillTolakReason('Jadwal penggunaan bentrok atau kuota peminjaman penuh.', this)">Jadwal bentrok / kuota penuh</button>
            <button type="button" class="reason-chip" onclick="fillTolakReason('Dokumen pengajuan fisik atau surat izin belum lengkap.', this)">Dokumen belum lengkap</button>
            <button type="button" class="reason-chip" onclick="fillTolakReason('Keperluan peminjaman di luar prioritas operasional lab.', this)">Keperluan belum urgen</button>
            <button type="button" class="reason-chip" onclick="fillTolakReason('Waktu peminjaman berada di luar jam operasional resmi.', this)">Di luar jam operasional</button>
          </div>

          <!-- Textarea Alasan -->
          <div>
            <label for="tolakAlasanTextarea" style="display: block; font-size: 10.5px; font-weight: 700; color: #0F172A; margin-bottom: 4px;">Penjelasan Alasan Penolakan (Wajib)</label>
            <textarea name="catatan_pengelola" id="tolakAlasanTextarea" required rows="3" placeholder="Tuliskan secara jelas alasan penolakan permohonan peminjaman..." style="width: 100%; border: 1.2px solid #CBD5E1; border-radius: 6px; padding: 8px 12px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; outline: none;"></textarea>
          </div>

          <!-- Status Notice -->
          <div style="margin-top: 10px; font-size: 11.5px; color: #DC2626; display: flex; align-items: center; gap: 6px;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>Status permohonan akan diubah permanen menjadi <strong>Ditolak</strong>.</span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-modal-cancel" onclick="closeTolakModal()">Batal</button>
          <button type="submit" class="btn-modal-submit-red">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            <span>Konfirmasi Tolak Pinjaman</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL 3: KONFIRMASI PERSETUJUAN PEMINJAMAN -->
  <div id="modalSetujui" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <span class="modal-title" style="color: #166534;">Konfirmasi Persetujuan Peminjaman</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeSetujuiModal()">×</button>
      </div>
      <form id="formSetujuiPinjaman" method="POST" action="">
        @csrf
        <div class="modal-body">
          
          <!-- Summary Strip -->
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 14px; margin-bottom: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px; margin-bottom: 8px;">
              <span id="setujuiKodeTrx" style="font-size: 13px; font-weight: 800; color: #08296E;">TRX-0000-0000</span>
              <span id="setujuiTglPinjam" style="font-size: 11.5px; color: #64748B;">-</span>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
              <div>
                <div style="font-size: 11.5px; font-weight: 700; color: #64748B;">Nama Peminjam:</div>
                <div id="setujuiNamaMhs" style="font-size: 10.5px; font-weight: 700; color: #0F172A; margin-top: 1px;">-</div>
                <div style="font-size: 11.5px; font-weight: 700; color: #64748B; margin-top: 6px;">Dosen Pembimbing:</div>
                <div id="setujuiDosenPj" style="font-size: 12px; font-weight: 600; color: #08296E; margin-top: 1px;">-</div>
              </div>
              <div>
                <div style="font-size: 11.5px; font-weight: 700; color: #64748B;">Barang Pinjam:</div>
                <div id="setujuiNamaSarpras" style="font-size: 10.5px; font-weight: 700; color: #0F172A; margin-top: 1px;">-</div>
                <div style="font-size: 11.5px; font-weight: 700; color: #64748B; margin-top: 6px;">Lokasi Asal:</div>
                <div id="setujuiNamaRuang" style="font-size: 12px; font-weight: 600; color: #334155; margin-top: 1px;">-</div>
              </div>
            </div>
          </div>

          <!-- KETETAPAN PENGAMBILAN (TEREKAM OTOMATIS) -->
          <input type="hidden" name="lokasi_pengambilan" id="setujuiLokasiHidden" value="{{ $namaRuangan ?? 'Laboratorium' }}">
          <input type="hidden" name="syarat_jaminan" value="KTM Fisik Asli Mahasiswa">

          <div style="margin-bottom: 12px;">
            <label style="display: block; font-size: 10.5px; font-weight: 700; color: #0F172A; margin-bottom: 4px;">Catatan Pengelola Untuk Mahasiswa (Opsional)</label>
            <textarea name="catatan_pengelola" rows="2" placeholder="Contoh: Disetujui. Harap ambil di ruang laboratorium tepat waktu..." style="width: 100%; border: 1.2px solid #CBD5E1; border-radius: 6px; padding: 8px 12px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; outline: none;"></textarea>
          </div>

          <!-- Green Info Strip -->
          <div style="background: #ECFDF5; border: 1px solid #A7F3D0; border-radius: 6px; padding: 8px 12px; font-size: 11.5px; color: #065F46; line-height: 1.4; display: flex; align-items: center; gap: 6px;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Status permohonan akan diubah menjadi <strong>Disetujui</strong> dan kuota unit tersedia disesuaikan.</span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-modal-cancel" onclick="closeSetujuiModal()">Batal</button>
          <button type="submit" class="btn-modal-submit-green">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Konfirmasi Setujui Permohonan</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL 4: PRATINJAU DOKUMEN SURAT IZIN & KTM DIGITAL -->
  <div id="modalDocPreview" class="modal-overlay" style="z-index: 10001; background: rgba(15, 23, 42, 0.75);">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-header" style="background: #F8FAFC;">
        <div class="modal-title-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          <span class="modal-title">Pratinjau Dokumen Surat Izin &amp; KTM</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeDocPreview()">×</button>
      </div>
      <div class="modal-body" style="padding: 20px; background: #F1F5F9;">
        
        <!-- KERTAS SURAT RESMI -->
        <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 8px; padding: 22px 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
          
          <!-- KOP SURAT RESMI JTIK -->
          <div style="display: flex; align-items: center; gap: 12px; border-bottom: 2px solid #0F172A; padding-bottom: 10px; margin-bottom: 14px;">
            <img src="{{ asset('images/logo-unm-white.png') }}" alt="Logo UNM" style="height: 44px; width: auto; filter: invert(1) brightness(0.2);">
            <div>
              <div style="font-size: 12px; font-weight: 800; color: #08296E; letter-spacing: 0.3px;">KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</div>
              <div style="font-size: 11.5px; font-weight: 800; color: #0F172A;">UNIVERSITAS NEGERI MAKASSAR — FAKULTAS TEKNIK</div>
              <div style="font-size: 10.5px; font-weight: 700; color: #ED7411;">JURUSAN TEKNIK INFORMATIKA DAN KOMPUTER</div>
              <div style="font-size: 11px; color: #64748B;">JL. Daeng Tata Raya Parangtambung Makassar - 90224 | Email: jtik@unm.ac.id | Laman tik.ft.unm.ac.id</div>
            </div>
          </div>

          <!-- JUDUL SURAT -->
          <div style="text-align: center; margin-bottom: 14px;">
            <div style="font-size: 11.5px; font-weight: 800; text-decoration: underline; color: #08296E; letter-spacing: 0.3px;">SURAT REKOMENDASI &amp; PERMOHONAN PINJAM SARPRAS</div>
            <div style="font-size: 11.5px; color: #64748B; margin-top: 2px;">No. Registrasi: <span id="docPreviewTrx">TRX-0000-0000</span>/JTIK-FT/2026</div>
          </div>

          <!-- DETAIL PENGAJUAN -->
          <div style="font-size: 12px; color: #334155; line-height: 1.55; margin-bottom: 12px;">
            <p>Menerangkan bahwa mahasiswa pemohon di bawah ini:</p>
            <div style="display: grid; grid-template-columns: 130px 1fr; gap: 4px; margin: 8px 0; background: #F8FAFC; padding: 10px 12px; border-radius: 6px; border: 1px solid #E2E8F0;">
              <span style="font-weight: 600; color: #475569;">Nama Mahasiswa</span>
              <strong id="docPreviewNama" style="color: #0F172A;">-</strong>
              <span style="font-weight: 600; color: #475569;">Nomor Induk (NIM)</span>
              <span id="docPreviewNim" style="font-weight: 600; color: #08296E;">-</span>
              <span style="font-weight: 600; color: #475569;">Program Studi</span>
              <span id="docPreviewProdi" style="font-weight: 600; color: #0F172A;">-</span>
              <span style="font-weight: 600; color: #475569;">Sarpras Diminta</span>
              <strong id="docPreviewBarang" style="color: #0F172A;">-</strong>
              <span style="font-weight: 600; color: #475569;">Jadwal Penggunaan</span>
              <span id="docPreviewWaktu" style="color: #0F172A;">-</span>
              <span style="font-weight: 600; color: #475569;">Keperluan</span>
              <span id="docPreviewKeperluan" style="font-style: italic; color: #334155;">-</span>
            </div>
            <p>Telah mendapatkan rekomendasi dosen pembimbing: <strong id="docPreviewDosen" style="color: #08296E;">-</strong></p>
          </div>

          <!-- LAMPIRAN KTM FISIK RESMI -->
          <div style="border: 1px solid #CBD5E1; border-radius: 8px; padding: 10px 12px; background: #F8FAFC;">
            <div style="font-size: 11.5px; font-weight: 800; color: #08296E; letter-spacing: 0.5px; margin-bottom: 6px; display: flex; align-items: center; justify-content: space-between;">
              <span>LAMPIRAN DOKUMEN: KARTU TANDA MAHASISWA (KTM) RESMI</span>
              <span style="color: #16A34A; font-weight: 700;"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px; margin-right:4px;"><polyline points="20 6 9 17 4 12"/></svg>Terverifikasi Digital</span>
            </div>
            <div style="background: linear-gradient(135deg, #08296E, #16192E); border-radius: 6px; padding: 10px 14px; color: #FFFFFF; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-size: 11.5px; letter-spacing: 0.8px; color: #FBBF24; font-weight: 700;">UNIVERSITAS NEGERI MAKASSAR</div>
                <div id="ktmCardNama" style="font-size: 11px; font-weight: 800; margin-top: 2px;">-</div>
                <div id="ktmCardNim" style="font-size: 11.5px; color: #E2E8F0;">-</div>
                <div id="ktmCardProdi" style="font-size: 11.5px; color: #94A3B8; margin-top: 1px;">-</div>
              </div>
              <div style="text-align: right;">
                <div style="font-size: 11.5px; background: rgba(255,255,255,0.15); padding: 2px 7px; border-radius: 4px; display: inline-block;">KTM Resmi</div>
                <div style="font-size: 11.5px; color: #94A3B8; margin-top: 4px;">JTIK FT UNM</div>
              </div>
            </div>
          </div>

          <div style="margin-top: 14px; display: flex; justify-content: space-between; align-items: flex-end; font-size: 11.5px; color: #64748B;">
            <div>Dokumen digital resmi tervalidasi oleh sistem SI-SAPRAS JTIK FT UNM.</div>
            <div style="text-align: center;">
              <div>Mengetahui,</div>
              <div style="font-weight: 700; color: #0F172A; margin-top: 20px;">Pengelola Laboratorium JTIK</div>
            </div>
          </div>

        </div>

      </div>
      <div class="modal-footer" style="background: #FFFFFF;">
        <button type="button" class="btn-modal-cancel" onclick="closeDocPreview()">Tutup Pratinjau</button>
      </div>
    </div>
  </div>

  <!-- MODAL 5: PROFIL SAYA (PENGELOLA) -->
  <div id="modalProfile" class="modal-overlay">
    <div class="modal-dialog" style="max-width: 520px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <span class="modal-title">Profil Akun Pengelola</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeProfileModal()">×</button>
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

        <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: center;">
          <button type="button" class="btn-modal-cancel" onclick="closeProfileModal()">Tutup</button>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-modal-cancel" onclick="closeProfileModal(); openChangePasswordModal();" style="color: #08296E; border-color: #08296E;">Ganti Sandi</button>
            <button type="submit" class="btn-modal-submit-green" style="background: #08296E;">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL 6: GANTI KATA SANDI -->
  <div id="modalChangePassword" class="modal-overlay">
    <div class="modal-dialog" style="max-width: 440px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ED7411" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <span class="modal-title" style="color: #ED7411;">Ganti Kata Sandi</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeChangePasswordModal()">×</button>
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

        <div class="modal-footer">
          <button type="button" class="btn-modal-cancel" onclick="closeChangePasswordModal()">Batal</button>
          <button type="submit" class="btn-modal-submit-green" style="background: #ED7411;">Perbarui Kata Sandi</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL 7: INFORMASI RUANGAN & CEK STOK SARPRAS -->
  <div id="modalRoomInfo" class="modal-overlay">
    <div class="modal-dialog" style="max-width: 720px;">
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0F172A" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span class="modal-title">{{ $ruangan->nama_ruangan ?? $badgeRuangan ?? 'Laboratorium' }} — Informasi &amp; Cek Stok</span>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeRoomInfoModal()">×</button>
      </div>

      <div class="modal-body" style="padding: 18px 20px; display: flex; flex-direction: column; gap: 14px; max-height: 70vh; overflow-y: auto;">
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
                  <td colspan="4" style="padding: 24px; text-align: center; color: #64748B;">Belum ada sarpras yang terdaftar pada ruangan ini.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-modal-cancel" onclick="closeRoomInfoModal()">Tutup</button>
      </div>
    </div>
  </div>

  <script>
    // State item aktif yang sedang dibuka modalnya
    let currentActiveItem = null;

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
        if (spaceBelow < 170) {
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

    // Modal 1: Detail
    function openDetailModal(item) {
      currentActiveItem = item;
      document.getElementById('detailKodePeminjaman').textContent = item.kode_peminjaman || '-';
      
      let tglFormatted = item.tgl_pinjam || '-';
      if (item.tgl_pinjam) {
        try {
          const d = new Date(item.tgl_pinjam);
          tglFormatted = d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
        } catch(e) {}
      }
      document.getElementById('detailTglDiajukan').textContent = 'Diajukan: ' + tglFormatted;

      const siblings = (item.ticket_items && item.ticket_items.length > 0) ? item.ticket_items : [item];
      const myItems = siblings.filter(s => s.is_authorized);
      const hasPendingMine = myItems.some(s => s.status === 'menunggu_verifikasi');
      const allMineApproved = myItems.length > 0 && myItems.every(s => s.status === 'disetujui' || s.status === 'sedang_dipinjam' || s.status === 'selesai');
      const allMineRejected = myItems.length > 0 && myItems.every(s => s.status === 'ditolak');

      const pill = document.getElementById('detailStatusPill');
      if (hasPendingMine) {
        pill.style.background = '#FFF3E8';
        pill.style.color = '#F06A09';
        pill.style.borderColor = '#FED7AA';
        pill.textContent = 'Menunggu ACC';
      } else if (allMineApproved) {
        pill.style.background = '#DCFCE7';
        pill.style.color = '#15803D';
        pill.style.borderColor = '#BBF7D0';
        pill.textContent = 'Disetujui';
      } else if (allMineRejected) {
        pill.style.background = '#FEE2E2';
        pill.style.color = '#DC2626';
        pill.style.borderColor = '#FECACA';
        pill.textContent = 'Ditolak';
      } else {
        pill.style.background = '#F1F5F9';
        pill.style.color = '#475569';
        pill.style.borderColor = '#CBD5E1';
        pill.textContent = item.status || '-';
      }

      document.getElementById('detailNamaMhs').textContent = item.user ? item.user.name : '-';
      document.getElementById('detailNimProdi').textContent = (item.user ? item.user.nomor_induk : '-') + ' (' + (item.user && item.user.jurusan ? item.user.jurusan : 'Teknik Komputer') + ')';
      document.getElementById('detailKontakMhs').textContent = item.user ? (item.user.email || '-') : '-';
      document.getElementById('detailDosenPj').textContent = item.dosen_penanggung_jawab || '-';
      document.getElementById('detailJadwal').textContent = item.jadwal_lengkap || ((item.tgl_pinjam ? item.tgl_pinjam.replace('T', ' ') : '-') + ' WITA');
      document.getElementById('detailKeperluan').textContent = item.keperluan || '-';

      // Render daftar barang (turun per barang, border polos 1px, barang ruangan lain abu-abu tidak bisa diapa-apakan)
      const container = document.getElementById('detailTicketItemsContainer');
      document.getElementById('detailTicketItemCount').textContent = siblings.length;

      let html = '';
      siblings.forEach((sib) => {
        const isAuth = !!sib.is_authorized;
        const roomName = (sib.sarpras && sib.sarpras.ruangan) ? sib.sarpras.ruangan.nama_ruangan : (sib.authorized_room_name || '-');
        const sarprasName = sib.sarpras ? sib.sarpras.nama_sarpras : 'Sarpras';
        const qty = sib.jumlah || 1;
        const ready = sib.sarpras ? sib.sarpras.jumlah_tersedia : 0;

        let statusBadge = '';
        if (sib.status === 'menunggu_verifikasi') {
          statusBadge = '<span style="background:#FFF3E8; color:#C2410C; border:1px solid #FED7AA; font-size:11px; font-weight:600; padding:2px 8px; border-radius:5px;">Menunggu ACC</span>';
        } else if (sib.status === 'sedang_dipinjam') {
          statusBadge = '<span style="background:#FFF3E8; color:#F06A09; border:1px solid #FED7AA; font-size:11px; font-weight:600; padding:2px 8px; border-radius:5px;">Sedang Dipinjam</span>';
        } else if (sib.status === 'disetujui') {
          statusBadge = '<span style="background:#F0FDF4; color:#15803D; border:1px solid #BBF7D0; font-size:11px; font-weight:600; padding:2px 8px; border-radius:5px;">Disetujui</span>';
        } else if (sib.status === 'selesai') {
          statusBadge = '<span style="background:#DCFCE7; color:#15803D; border:1px solid #BBF7D0; font-size:11px; font-weight:600; padding:2px 8px; border-radius:5px;">Selesai</span>';
        } else if (sib.status === 'ditolak') {
          statusBadge = '<span style="background:#FEF2F2; color:#DC2626; border:1px solid #FECACA; font-size:11px; font-weight:600; padding:2px 8px; border-radius:5px;">Ditolak</span>';
        } else {
          statusBadge = '<span style="background:#F1F5F9; color:#475569; border:1px solid #CBD5E1; font-size:11px; font-weight:600; padding:2px 8px; border-radius:5px;">' + (sib.status || '-') + '</span>';
        }

        let rightHtml = '';
        if (isAuth) {
          if (sib.status === 'menunggu_verifikasi') {
            const sibJson = JSON.stringify(sib).replace(/"/g, '&quot;');
            rightHtml = `
              <div style="display: flex; gap: 6px;">
                <button type="button" onclick="closeDetailModal(); openSetujuiModal(${sibJson})"
                        style="background: #F0FDF4; color: #15803D; border: 1px solid #86EFAC; border-radius: 6px; padding: 6px 12px; font-size: 12px; font-weight: 600; cursor: pointer;">
                  Setujui
                </button>
                <button type="button" onclick="closeDetailModal(); openTolakModal(${sibJson})"
                        style="background: #FEF2F2; color: #DC2626; border: 1px solid #FCA5A5; border-radius: 6px; padding: 6px 12px; font-size: 12px; font-weight: 600; cursor: pointer;">
                  Tolak
                </button>
              </div>
            `;
          } else {
            rightHtml = statusBadge;
          }
        } else {
          rightHtml = statusBadge;
        }

        html += `
          <div style="background: ${isAuth ? '#FFFFFF' : '#F8FAFC'}; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 14px; display: flex; justify-content: space-between; align-items: center; gap: 12px; ${isAuth ? '' : 'opacity: 0.72;'}">
            <div style="min-width: 0; flex: 1;">
              <div style="font-size: 13px; font-weight: 700; color: ${isAuth ? '#0F172A' : '#475569'};">
                ${sarprasName}
                <span style="font-size: 11px; font-weight: 600; color: #64748B;">(${roomName})</span>
              </div>
              <div style="font-size: 12px; color: #64748B; margin-top: 3px;">
                Diminta: <strong style="color: ${isAuth ? '#0F172A' : '#475569'};">${qty} Unit</strong> | Ready: ${ready} Unit
              </div>
            </div>
            <div style="flex-shrink: 0;">
              ${rightHtml}
            </div>
          </div>
        `;
      });
      container.innerHTML = html;

      // Tombol massal di footer hanya tampil jika >= 2 barang milik ruangan ini masih menunggu ACC
      const pendingMineCount = myItems.filter(s => s.status === 'menunggu_verifikasi').length;
      const batchActions = document.getElementById('detailBatchActions');
      if (batchActions) {
        if (pendingMineCount >= 2) {
          batchActions.style.display = 'flex';
          const formApprove = document.getElementById('formDetailBatchApprove');
          if (formApprove) formApprove.action = '/pengelola/peminjaman/tiket/' + item.kode_peminjaman + '/setujui';
        } else {
          batchActions.style.display = 'none';
        }
      }

      document.getElementById('modalDetail').classList.add('active');
    }

    function closeDetailModal() {
      document.getElementById('modalDetail').classList.remove('active');
    }

    // Modal Tolak Seluruh Barang Tiket Milik Ruangan Ini
    function openTolakTiketModal(item) {
      currentActiveItem = item;
      document.getElementById('tolakKodeTrx').textContent = item.kode_peminjaman || '-';
      document.getElementById('tolakSarprasInfo').textContent = 'Seluruh Barang Milik Ruangan Ini pada Tiket #' + (item.kode_peminjaman || '-');
      document.getElementById('tolakNamaMhs').textContent = item.user ? item.user.name : 'Mahasiswa';
      document.getElementById('tolakNimMhs').textContent = 'NIM: ' + (item.user ? item.user.nomor_induk : '-');
      document.getElementById('tolakAlasanTextarea').value = '';

      document.querySelectorAll('.reason-chip').forEach(c => c.classList.remove('selected'));

      const form = document.getElementById('formTolakPinjaman');
      form.action = '/pengelola/peminjaman/tiket/' + item.kode_peminjaman + '/tolak';

      document.getElementById('modalTolak').classList.add('active');
    }

    // Modal 2: Tolak (Per Item)
    function openTolakModal(item) {
      currentActiveItem = item;
      document.getElementById('tolakKodeTrx').textContent = item.kode_peminjaman || '-';
      document.getElementById('tolakSarprasInfo').textContent = 'Permohonan: ' + (item.sarpras ? item.sarpras.nama_sarpras : 'Sarpras') + ' (' + (item.jumlah || 1) + ' Unit)';
      document.getElementById('tolakNamaMhs').textContent = item.user ? item.user.name : 'Mahasiswa';
      document.getElementById('tolakNimMhs').textContent = 'NIM: ' + (item.user ? item.user.nomor_induk : '-');
      document.getElementById('tolakAlasanTextarea').value = '';

      document.querySelectorAll('.reason-chip').forEach(c => c.classList.remove('selected'));

      const form = document.getElementById('formTolakPinjaman');
      form.action = '/pengelola/peminjaman/' + item.id + '/tolak';

      document.getElementById('modalTolak').classList.add('active');
    }

    function closeTolakModal() {
      document.getElementById('modalTolak').classList.remove('active');
    }

    function fillTolakReason(reasonText, chipEl) {
      const textarea = document.getElementById('tolakAlasanTextarea');
      textarea.value = reasonText;
      document.querySelectorAll('.reason-chip').forEach(c => c.classList.remove('selected'));
      if (chipEl) chipEl.classList.add('selected');
      textarea.focus();
    }

    // Modal 3: Setujui
    function openSetujuiModal(item) {
      currentActiveItem = item;
      document.getElementById('setujuiKodeTrx').textContent = item.kode_peminjaman || '-';
      document.getElementById('setujuiTglPinjam').textContent = item.jadwal_lengkap || ((item.tgl_pinjam ? item.tgl_pinjam.replace('T', ' ') : '-') + ' WITA');
      document.getElementById('setujuiNamaMhs').textContent = (item.user ? item.user.name : 'Mahasiswa') + ' (' + (item.user ? item.user.nomor_induk : '-') + ')';
      document.getElementById('setujuiDosenPj').textContent = item.dosen_penanggung_jawab || '-';
      document.getElementById('setujuiNamaSarpras').textContent = (item.sarpras ? item.sarpras.nama_sarpras : 'Sarpras') + ' (' + (item.jumlah || 1) + ' Unit)';
      
      const lokasiRuang = (item.sarpras && item.sarpras.ruangan) ? item.sarpras.ruangan.nama_ruangan : 'Laboratorium';
      document.getElementById('setujuiNamaRuang').textContent = lokasiRuang;

      const lokasiDisplay = document.getElementById('setujuiLokasiDisplay');
      if (lokasiDisplay) lokasiDisplay.textContent = lokasiRuang;
      const lokasiHidden = document.getElementById('setujuiLokasiHidden');
      if (lokasiHidden) lokasiHidden.value = lokasiRuang;

      // Nama dokumen surat izin & ktm dinamis
      const studentNameSlug = item.user ? item.user.name.toLowerCase().replace(/[^a-z0-9]/g, '_') : 'mahasiswa';
      const docEl = document.getElementById('setujuiDocFileName');
      if (docEl) docEl.textContent = 'berkas_ktm_izin_' + studentNameSlug + '.pdf';

      const form = document.getElementById('formSetujuiPinjaman');
      form.action = '/pengelola/peminjaman/' + item.id + '/setujui';

      document.getElementById('modalSetujui').classList.add('active');
    }

    function closeSetujuiModal() {
      document.getElementById('modalSetujui').classList.remove('active');
    }

    // Modal 4: Pratinjau Dokumen Surat Izin & KTM
    function previewCurrentDoc() {
      if (!currentActiveItem) return;
      const item = currentActiveItem;

      document.getElementById('docPreviewTrx').textContent = item.kode_peminjaman || '-';
      document.getElementById('docPreviewNama').textContent = item.user ? item.user.name : '-';
      document.getElementById('docPreviewNim').textContent = item.user ? item.user.nomor_induk : '-';
      document.getElementById('docPreviewProdi').textContent = (item.user && item.user.jurusan) ? item.user.jurusan : 'Teknik Komputer';
      document.getElementById('docPreviewBarang').textContent = (item.sarpras ? item.sarpras.nama_sarpras : 'Sarpras') + ' (' + (item.jumlah || 1) + ' Unit)';
      document.getElementById('docPreviewWaktu').textContent = item.jadwal_lengkap || ((item.tgl_pinjam ? item.tgl_pinjam.replace('T', ' ') : '-') + ' WITA');
      document.getElementById('docPreviewKeperluan').textContent = item.keperluan || 'Praktikum & perkuliahan jurusan.';
      document.getElementById('docPreviewDosen').textContent = item.dosen_penanggung_jawab || '-';

      // Isi KTM Digital Card
      document.getElementById('ktmCardNama').textContent = item.user ? item.user.name : '-';
      document.getElementById('ktmCardNim').textContent = 'NIM: ' + (item.user ? item.user.nomor_induk : '-');
      document.getElementById('ktmCardProdi').textContent = (item.user && item.user.jurusan) ? item.user.jurusan : 'Teknik Komputer';

      document.getElementById('modalDocPreview').classList.add('active');
    }

    function closeDocPreview() {
      document.getElementById('modalDocPreview').classList.remove('active');
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

    // Event listeners
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.action-dropdown-wrap')) {
        closeAllActionMenus();
      }
      const pengelolaDropdown = document.getElementById('pengelolaDropdown');
      const pengelolaBtn = document.getElementById('pengelolaBtn');
      if (pengelolaDropdown && pengelolaBtn && !pengelolaBtn.contains(e.target) && !pengelolaDropdown.contains(e.target)) {
        pengelolaDropdown.style.display = 'none';
      }
    });

    // Tutup modal dengan ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const previewModal = document.getElementById('modalDocPreview');
        if (previewModal && previewModal.classList.contains('active')) {
          closeDocPreview();
          return;
        }
        closeProfileModal();
        closeChangePasswordModal();
        closeRoomInfoModal();
        closeDetailModal();
        closeTolakModal();
        closeSetujuiModal();
        closeAllActionMenus();
        const pengelolaDropdown = document.getElementById('pengelolaDropdown');
        if (pengelolaDropdown) pengelolaDropdown.style.display = 'none';
      }
    });
  </script>


  @include('partials.ui_feedback')
</body>
</html>
