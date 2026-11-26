<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-SAPRAS JTIK FT UNM - Verifikasi Pengembalian</title>

  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-navy: #0F172A;
      --sidebar-navy: #0A101D;
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
      --sidebar-width: 215px;
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

    /* FULLPAGE PORTAL LAYOUT (KONSISTEN DENGAN PERSETUJUAN & RIWAYAT) */
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

    /* ========================================================
       MAIN WORKSPACE
       ======================================================== */
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

    /* TOOLBAR ROW */
    .toolbar-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 2px;
      flex-wrap: wrap;
    }

    .toolbar-left {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      min-width: 0;
    }

    /* SEGMENTED FILTER BUTTON GROUP */
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

    /* SEARCH INPUT FORM */
    .toolbar-search-form {
      flex: 1;
      max-width: 320px;
      min-width: 200px;
    }

    .search-input-box {
      display: flex;
      align-items: center;
      background: #FFFFFF;
      border: 1.2px solid #CBD5E1;
      border-radius: 6px;
      padding: 0 12px;
      height: 36px;
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

    .toolbar-right {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .toolbar-meta-badge {
      font-size: 11px;
      color: #64748B;
      font-weight: 500;
    }

    /* ========================================================
       TABLE CARD
       ======================================================== */
    .table-card {
      background: var(--bg-card);
      border-radius: 8px;
      border: 1px solid var(--border-color);
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
      overflow: hidden;
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

    .table-caption-meta {
      font-size: 11px;
      color: #64748B;
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
      padding: 14px 16px;
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

    /* TYPOGRAPHY KOLOM 1: TIKET & WAKTU */
    .trx-id {
      font-size: 12px;
      font-weight: 800;
      color: var(--primary-navy);
      display: block;
      line-height: 1.25;
      letter-spacing: -0.2px;
    }

    .trx-meta-row {
      font-size: 10.5px;
      color: #64748B;
      display: block;
      margin-top: 3px;
    }

    .trx-time-badge {
      display: inline-block;
      font-size: 9.5px;
      font-weight: 700;
      color: #0F172A;
      background: #F1F5F9;
      padding: 2px 7px;
      border-radius: 4px;
      margin-top: 4px;
    }

    /* TYPOGRAPHY KOLOM 2: MAHASISWA */
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

    .mhs-phone {
      font-size: 10px;
      color: var(--accent-blue);
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      margin-top: 2px;
    }

    .mhs-phone:hover {
      text-decoration: underline;
    }

    /* TYPOGRAPHY KOLOM 3: SARPRAS */
    .item-name {
      font-size: 12px;
      font-weight: 700;
      color: var(--primary-navy);
      display: block;
      line-height: 1.25;
    }

    .item-qty {
      font-size: 10.5px;
      font-weight: 600;
      color: #334155;
      display: inline-block;
      margin-top: 2px;
    }

    .item-code {
      font-size: 9.5px;
      color: #64748B;
      display: block;
      margin-top: 2px;
      font-family: monospace;
    }

    .item-rack {
      font-size: 9.5px;
      color: #047857;
      background: #ECFDF5;
      display: inline-block;
      padding: 1px 6px;
      border-radius: 3px;
      margin-top: 3px;
      font-weight: 500;
    }

    /* TYPOGRAPHY KOLOM 4: BUKTI FOTO AFTER */
    .proof-thumb-box {
      width: 110px;
      height: 70px;
      border-radius: 6px;
      border: 1px solid #CBD5E1;
      background: #F8FAFC;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 1px 2px rgba(0,0,0,0.05);
      transition: all 0.2s ease;
    }

    .proof-thumb-box:hover {
      transform: scale(1.04);
      border-color: var(--accent-blue);
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    .proof-thumb-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    /* KOLOM 5: TINDAKAN BUTTON */
    .btn-verify-action {
      background: var(--primary-navy);
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      padding: 8px 18px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: all 0.15s ease;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.15);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      text-decoration: none;
    }

    .btn-verify-action:hover {
      background: #1E293B;
      transform: translateY(-1px);
      box-shadow: 0 3px 6px rgba(15, 23, 42, 0.2);
    }

    .btn-verify-action.done {
      background: #F1F5F9;
      color: #334155;
      border: 1px solid #CBD5E1;
      box-shadow: none;
    }

    .btn-verify-action.done:hover {
      background: #E2E8F0;
      color: #0F172A;
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

    /* ========================================================
       MODAL VERIFIKASI PENGEMBALIAN & BUKTI BEFORE-AFTER
       ======================================================== */
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
      max-width: 680px;
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
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .modal-title-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .modal-title {
      font-size: 13px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.2px;
      text-transform: uppercase;
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
      gap: 16px;
    }

    /* SUMMARY STRIP AT TOP OF MODAL */
    .summary-strip {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 10.5px;
      line-height: 1.6;
    }

    .summary-strip strong {
      color: var(--primary-navy);
    }

    /* 2-COLUMN BEFORE-AFTER GRID */
    .before-after-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    @media (max-width: 640px) {
      .before-after-grid {
        grid-template-columns: 1fr;
      }
    }

    .comparison-card {
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 12px;
      background: #FFFFFF;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .card-col-title {
      font-size: 11px;
      font-weight: 800;
      color: var(--primary-navy);
      letter-spacing: -0.1px;
      text-transform: uppercase;
    }

    .comparison-img-box {
      width: 100%;
      height: 145px;
      border-radius: 6px;
      background: #F1F5F9;
      border: 1px solid #CBD5E1;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .comparison-img-box img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      background: #F8FAFC;
    }

    .meta-line {
      font-size: 10px;
      color: #475569;
      line-height: 1.4;
    }

    .meta-line strong {
      color: var(--primary-navy);
    }

    .note-bubble {
      background: #F0F9FF;
      border: 1px solid #BAE6FD;
      border-radius: 6px;
      padding: 9px 11px;
      font-size: 10px;
      color: #0369A1;
      line-height: 1.45;
    }

    .note-bubble-title {
      font-size: 9px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      color: #0284C7;
      margin-bottom: 3px;
      display: block;
    }

    .note-bubble-author {
      margin-top: 5px;
      font-size: 9px;
      color: #0284C7;
      font-weight: 600;
      display: block;
    }

    /* SECTION EVALUASI FISIK */
    .eval-section {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 14px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .eval-section-title {
      font-size: 11px;
      font-weight: 800;
      color: var(--primary-navy);
      text-transform: uppercase;
      letter-spacing: 0.2px;
    }

    .checklist-wrap {
      display: flex;
      flex-direction: column;
      gap: 7px;
    }

    .checkbox-label {
      display: flex;
      align-items: flex-start;
      gap: 9px;
      font-size: 11px;
      color: #334155;
      font-weight: 500;
      cursor: pointer;
    }

    .checkbox-label input[type="checkbox"] {
      width: 16px;
      height: 16px;
      accent-color: #0091FF;
      cursor: pointer;
      margin-top: 1.5px;
    }

    .laboran-report-box {
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
      border-radius: 6px;
      padding: 10px 12px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .laboran-report-title {
      font-size: 9.5px;
      font-weight: 700;
      color: #166534;
      text-transform: uppercase;
    }

    .laboran-report-input {
      width: 100%;
      border: 1px solid #86EFAC;
      border-radius: 5px;
      padding: 8px 10px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10.5px;
      color: #14532D;
      background: #FFFFFF;
      outline: none;
      resize: vertical;
      min-height: 48px;
    }

    .laboran-report-meta {
      font-size: 9.5px;
      color: #15803D;
      font-weight: 500;
    }

    /* MODAL FOOTER */
    .modal-footer {
      padding: 14px 20px;
      border-top: 1px solid #E2E8F0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
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

    .footer-actions-right {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .btn-damage {
      padding: 8.5px 18px;
      border-radius: 6px;
      border: none;
      background: var(--danger-red);
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.15s;
    }

    .btn-damage:hover {
      background: #B91C1C;
    }

    .btn-approve-return {
      padding: 8.5px 20px;
      border-radius: 6px;
      border: none;
      background: var(--success-green);
      color: #FFFFFF;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.15s;
      box-shadow: 0 1px 3px rgba(22, 163, 74, 0.3);
    }

    .btn-approve-return:hover {
      background: #15803D;
    }

    /* SUB-MODAL TOLAK / KERUSAKAN */
    .damage-modal-dialog {
      background: #FFFFFF;
      border-radius: 10px;
      width: 100%;
      max-width: 460px;
      padding: 20px;
      box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);
      border: 1px solid #E2E8F0;
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
        <h1 class="page-title">Verifikasi Pengembalian</h1>
        <span class="header-divider">|</span>
        <span style="font-size: 11px; color: #64748B;">Pemeriksaan kondisi fisik barang &amp; pengesahan serah terima</span>
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

    <!-- TOOLBAR ROW: SEGMENTED BUTTONS + SEARCH INPUT (SEJAJAR DI KIRI) -->
    <div class="toolbar-row">
      <div class="toolbar-left">
        <!-- Segmented Button Group Filter Pengembalian -->
        <div class="filter-btn-group">
          <a href="{{ route('pengelola.pengembalian', array_filter(['status' => 'semua', 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? 'semua') === 'semua' ? 'active' : '' }}"
             title="Tampilkan seluruh pengembalian">
            <span>Semua Pengembalian</span>
            <span class="btn-badge">{{ $semuaCount ?? 0 }}</span>
          </a>

          <a href="{{ route('pengelola.pengembalian', array_filter(['status' => 'menunggu_cek_fisik', 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? '') === 'menunggu_cek_fisik' ? 'active' : '' }}"
             title="Menunggu pemeriksaan kondisi fisik barang">
            <span>Menunggu Cek Fisik</span>
            <span class="btn-badge">{{ $menungguCekCount ?? 0 }}</span>
          </a>

          <a href="{{ route('pengelola.pengembalian', array_filter(['status' => 'selesai_diterima', 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? '') === 'selesai_diterima' ? 'active' : '' }}"
             title="Pengembalian yang telah disetujui & ditutup">
            <span>Selesai Diterima</span>
            <span class="btn-badge">{{ $selesaiDiterimaCount ?? 0 }}</span>
          </a>

          <a href="{{ route('pengelola.pengembalian', array_filter(['status' => 'kendala_kerusakan', 'search' => $search])) }}"
             class="filter-btn {{ ($statusFilter ?? '') === 'kendala_kerusakan' ? 'active' : '' }}"
             title="Pengembalian yang ditolak">
            <span>Ditolak</span>
            <span class="btn-badge">{{ $kendalaCount ?? 0 }}</span>
          </a>
        </div>

        <!-- Search Form (Nempel Langsung di Samping Button Group) -->
        <form method="GET" action="{{ route('pengelola.pengembalian') }}" class="toolbar-search-form">
          <input type="hidden" name="status" value="{{ $statusFilter ?? 'semua' }}">
          <div class="search-input-box">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama peminjam, NIM, alat...">
            @if(!empty($search))
              <a href="{{ route('pengelola.pengembalian', ['status' => $statusFilter ?? 'semua']) }}" title="Hapus pencarian" style="position: absolute; right: 10px; color: #94A3B8; text-decoration: none; font-size: 14px; font-weight: 700; line-height: 1;">×</a>
            @endif
          </div>
        </form>
      </div>

      <div class="toolbar-right">
        <div class="toolbar-meta-badge">
          Menampilkan <strong>{{ $pengembalian->count() }}</strong> Antrean
        </div>
      </div>
    </div>

    <!-- ANTREAN VERIFIKASI PENGEMBALIAN SARPRAS TABLE CARD -->
    <div class="table-card">
      <div class="table-caption-bar">
        <span class="table-caption-title">Antrean Verifikasi Pengembalian Sarpras</span>
        <span class="table-caption-meta">Menampilkan {{ $pengembalian->count() }} Data Pengembalian</span>
      </div>

      <table class="approval-table">
        <thead>
          <tr>
            <th style="width: 18%;">No. Tiket &amp; Waktu Kembali</th>
            <th style="width: 28%;">Identitas Mahasiswa</th>
            <th style="width: 25%;">Sarpras &amp; Ruangan</th>
            <th style="width: 14%; text-align: center;">Stok (Kembali/Total)</th>
            <th style="width: 15%; text-align: center;">Tindakan</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pengembalian as $item)
          <tr class="{{ $loop->iteration % 2 === 0 ? 'row-striped' : '' }}">
            <!-- KOLOM 1: TIKET & WAKTU KEMBALI -->
            <td>
              <span class="trx-id">{{ $item->kode_peminjaman }}</span>
              <span class="trx-meta-row">Tanggal : {{ \Carbon\Carbon::parse($item->tgl_kembali_aktual ?? $item->tgl_pinjam)->translatedFormat('d/m/Y') }}</span>
              <span class="trx-time-badge">pukul : {{ \Carbon\Carbon::parse($item->tgl_kembali_aktual ?? $item->tgl_pinjam)->format('H:i') }} WITA</span>
            </td>

            <!-- KOLOM 2: IDENTITAS MAHASISWA -->
            <td>
              <span class="mhs-name">{{ $item->user->name ?? 'Mahasiswa' }}</span>
              <span class="mhs-nim">NIM: {{ $item->user->nomor_induk ?? '-' }}</span>
              <span class="mhs-class">{{ $item->user->jurusan ?? 'PTIK A 2022' }}</span>
              @if(!empty($item->user->no_hp))
                <a href="tel:{{ $item->user->no_hp }}" class="mhs-phone">{{ $item->user->no_hp }}</a>
              @else
                <span class="mhs-phone">0852-9989-3344</span>
              @endif
            </td>

            <!-- KOLOM 3: SARPRAS & LOKASI -->
            <td>
              <div class="asset-name-title">{{ $item->sarpras->nama_sarpras ?? 'Sarpras Laboratorium' }}</div>
              <div style="margin-top: 3px; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                <span class="badge-asset-code" style="font-size: 12px;">{{ $item->sarpras->kode_sarpras ?? 'LAB-CAB-03' }}</span>
                @if(optional($item->sarpras)->ruangan)
                  <span style="background: #F1F5F9; color: #08296E; font-size: 11.5px; font-weight: 700; padding: 1.5px 6px; border-radius: 4px; border: 1px solid #CBD5E1; letter-spacing: 0.2px;">
                    {{ $item->sarpras->ruangan->nama_ruangan }}
                  </span>
                @endif
                @if(!empty($item->foto_sesudah))
                  <span style="background: #ECFDF5; color: #047857; font-size: 11.5px; font-weight: 700; padding: 1px 6px; border-radius: 4px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 3px;" title="Mahasiswa telah melampirkan foto bukti kondisi fisik barang">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    <span>Foto Bukti Ada</span>
                  </span>
                @endif
              </div>
            </td>

            <!-- KOLOM 4: STOK (KEMBALI/TOTAL) -->
            <td style="text-align: center; vertical-align: middle;">
              <div class="stock-stack">
                <span class="stock-box-total">Kembali: {{ $item->jumlah }} Unit</span>
                <span class="stock-box-ready">Total: {{ $item->sarpras->jumlah_total ?? 0 }} Unit</span>
              </div>
            </td>

            <!-- KOLOM 5: TINDAKAN -->
            <td style="text-align: center; vertical-align: middle;">
              @if($item->status === 'selesai' || $item->status_pengembalian === 'selesai_diterima' || $item->status_pengembalian === 'kendala_kerusakan')
                <button type="button" class="btn-verify-action done" onclick='openReturnModal({!! htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") !!})' title="Lihat Rekam Jejak Pemeriksaan Fisik">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                  <span>Cek Fisik &amp; Bukti</span>
                </button>
              @else
                <button type="button" class="btn-verify-action" onclick='openReturnModal({!! htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") !!})' title="Periksa kondisi fisik barang &amp; sahkan serah terima">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/></svg>
                  <span>Verifikasi</span>
                </button>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" style="text-align: center; padding: 40px 16px; color: #64748B;">
              <div style="font-weight: 700; font-size: 13px; color: #0F172A; margin-bottom: 4px;">Tidak Ada Antrean Verifikasi Pengembalian</div>
              <div style="font-size: 11px;">Semua serah terima sarpras di {{ $namaRuangan ?? 'Laboratorium' }} telah diverifikasi dan tertutup rapi.</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </main>
  </div>

  <!-- ========================================================
       MODAL VERIFIKASI PENGEMBALIAN & BUKTI BEFORE-AFTER
       ======================================================== -->
  <div id="modalReturn" class="modal-overlay">
    <div class="modal-dialog">
      <!-- HEADER -->
      <div class="modal-header">
        <div class="modal-title-wrap">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="var(--primary-navy)" stroke-width="2.5"><polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/></svg>
          <h2 class="modal-title">Verifikasi Pengembalian &amp; Bukti Before-After</h2>
        </div>
        <button type="button" class="btn-close-modal" onclick="closeReturnModal()" title="Tutup">×</button>
      </div>

      <!-- BODY -->
      <div class="modal-body">
        
        <!-- BANNER STATUS KENDALA / KERUSAKAN (MUNCUL JIKA DITOLAK/RUSAK) -->
        <div id="modalDamageNotice" style="display:none; background:#FEF2F2; border:1.5px solid #FCA5A5; border-radius:8px; padding:12px 14px; margin-bottom: 2px;">
          <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span style="font-size:11.5px; font-weight:800; color:#991B1B; letter-spacing:0.3px;">Status: Pengembalian Ditolak / Kendala Kerusakan Fisik</span>
          </div>
          <div style="font-size:11px; color:#B91C1C; line-height:1.5;">
            <strong>Catatan Petugas / Laboran:</strong>
            <span id="modalDamageText" style="display:block; margin-top:3px; background:#FFFFFF; padding:8px 10px; border-radius:6px; border:1px solid #FECACA; font-weight:500;">-</span>
          </div>
        </div>

        <!-- SUMMARY STRIP -->
        <div class="summary-strip">
          <div><strong>No. Tiket:</strong> <span id="mTiket" style="color:var(--primary-navy); font-weight:700;">TRX-2026-0040</span> | <strong>Sarpras:</strong> <span id="mSarpras">Kabel HDMI 15M &amp; Splitter</span> (<span id="mJumlah">1 Unit</span>)</div>
          <div style="margin-top: 2px;"><strong>Peminjam:</strong> <span id="mMhs">Fadillah Nur Annisa</span> | <strong>Dosen PJ:</strong> <span id="mDosen">Prof. Dr. Hendra Jaya, M.T.</span> | <strong>Ruangan:</strong> <span id="mRuangan">Bengkel IT</span></div>
        </div>

        <!-- 2-COLUMN BEFORE-AFTER GRID -->
        <div class="before-after-grid">
          <!-- CARD 1: SEBELUM DIPAKAI (BEFORE) -->
          <div class="comparison-card">
            <div class="card-col-title">1. Sebelum Dipakai</div>
            <div class="comparison-img-box">
              <img id="mImgBefore" src="{{ asset('images/sarpras/hdmi_bundle.svg') }}" alt="Foto Sebelum Dipakai">
            </div>
            <div class="meta-line">
              <strong>Waktu Ambil :</strong> <span id="mWaktuAmbil">20/06/2026 (10:15 WITA)</span>
            </div>
            <div class="meta-line">
              <strong>Status Cek Awal:</strong> <span style="color:#16A34A; font-weight:700;">Normal &amp; Lengkap</span>
            </div>
            <div class="note-bubble">
              <span class="note-bubble-title">Catatan Kondisi Awal:</span>
              <span id="mCatatanAwal">"Kabel HDMI 15M vent-on dan splitter HDMI 1-in-2 utuh, pin konektor bersih tanpa cacat saat serah terima awal."</span>
              <span class="note-bubble-author">Laboran: <span id="mLaboranAwal">Sukirman, S.T.</span></span>
            </div>
          </div>

          <!-- CARD 2: BUKTI SETELAH DIKEMBALIKAN (AFTER) -->
          <div class="comparison-card">
            <div class="card-col-title">2. Bukti Setelah Dikembalikan</div>
            <div class="comparison-img-box">
              <img id="mImgAfter" src="{{ asset('images/sarpras/hdmi_bundle.svg') }}" alt="Foto Setelah Dikembalikan">
            </div>
            <div class="meta-line">
              <strong>Berkas:</strong> <span id="mBerkas" style="color:var(--accent-blue); font-weight:600;">bukti_kabel_hdmi.jpg</span>
            </div>
            <div class="meta-line">
              <strong>Waktu Kembali :</strong> <span id="mWaktuKembali">20/06/2026, 14:45 WITA</span>
            </div>
            <div class="note-bubble">
              <span class="note-bubble-title">Catatan Kondisi:</span>
              <span id="mCatatanKembali">"Kabel digulung rapi dengan strap, pin HDMI utuh tanpa bengkok, splitter berfungsi normal saat seminar selesai."</span>
              <span class="note-bubble-author">Pengunggah: Mhs <span id="mPengunggah">Fadillah Nur Annisa</span></span>
            </div>
          </div>
        </div>

        <!-- SECTION EVALUASI KONDISI FISIK OLEH PENGELOLA RUANGAN -->
        <div class="eval-section">
          <div class="eval-section-title">Evaluasi Kondisi Fisik oleh Pengelola Ruangan</div>
          
          <div class="checklist-wrap">
            <label class="checkbox-label">
              <input type="checkbox" id="chkCacat" checked>
              <span>Kondisi fisik barang utuh dan tidak ada cacat / goresan baru</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" id="chkKelengkapan" checked>
              <span>Kelengkapan kabel, adaptor, dan aksesori lengkap sesuai serah terima</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" id="chkSimpan" checked>
              <span>Barang telah disimpan kembali ke lemari / rak alat ruangan</span>
            </label>
          </div>

          <!-- CATATAN HASIL PEMERIKSAAN LABORAN -->
          <div class="laboran-report-box">
            <div style="display: flex; align-items: center; gap: 6px;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="laboran-report-title">Catatan Hasil Pemeriksaan Laboran:</span>
            </div>
            <textarea id="mCatatanLaboranInput" class="laboran-report-input" rows="2">Pengecekan fisik selesai, kabel dan splitter diuji display tampil normal, siap dipinjamkan kembali.</textarea>
            <div class="laboran-report-meta">
              Lokasi Simpan: <strong id="mLokasiSimpan">Ruang Inventaris</strong> | Laboran: {{ Auth::user()->name ?? 'Sukirman, S.T.' }} ({{ now()->translatedFormat('d M Y, H:i') }} WITA)
            </div>
          </div>
        </div>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="closeReturnModal()">Batal</button>
        
        <div class="footer-actions-right">
          <!-- Button Tolak / Kendala -->
          <button type="button" class="btn-damage" onclick="openDamageModal()">Tolak / Ada Kerusakan</button>
          
          <!-- Form Setujui Pengembalian -->
          <form id="formApproveReturn" method="POST" action="" style="margin:0;">
            @csrf
            <input type="hidden" name="catatan_laboran" id="inputCatatanLaboran">
            <input type="hidden" name="lokasi_simpan" id="inputLokasiSimpan">
            <button type="submit" class="btn-approve-return">Setujui Pengembalian &amp; Tutup Tiket</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================================
       SUB-MODAL TOLAK / ADA KERUSAKAN
       ======================================================== -->
  <div id="modalDamage" class="modal-overlay" style="z-index: 10000;">
    <div class="damage-modal-dialog">
      <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <h3 style="font-size: 13px; font-weight: 800; color: #991B1B;">Catatan Kendala / Kerusakan Barang</h3>
      </div>
      <p style="font-size: 11px; color: #475569; margin-bottom: 12px; line-height: 1.5;">
        Tuliskan rincian bagian barang yang rusak, cacat, atau aksesori yang hilang untuk dipertanggungjawabkan mahasiswa peminjam.
      </p>
      <form id="formRejectDamage" method="POST" action="">
        @csrf
        <textarea name="alasan_kendala" rows="3" required placeholder="Contoh: Pin port HDMI bengkok / adaptor tidak dikembalikan / kabel lecet..." style="width: 100%; border: 1.2px solid #CBD5E1; border-radius: 6px; padding: 10px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; outline: none; margin-bottom: 16px;"></textarea>
        
        <div style="display: flex; justify-content: flex-end; gap: 8px;">
          <button type="button" class="btn-cancel" onclick="document.getElementById('modalDamage').classList.remove('active')">Batal</button>
          <button type="submit" class="btn-damage">Simpan &amp; Laporkan Kendala</button>
        </div>
      </form>
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
                  <td colspan="4" style="padding: 24px; text-align: center; color: #64748B;">Belum ada sarpras yang terdaftar pada ruangan ini.</td>
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
    let activeItemData = null;

    function openReturnModal(item) {
      activeItemData = item;

      // Summary Strip
      document.getElementById('mTiket').innerText = item.kode_peminjaman || '-';
      document.getElementById('mSarpras').innerText = (item.sarpras ? item.sarpras.nama_sarpras : 'Sarpras');
      document.getElementById('mJumlah').innerText = (item.jumlah || 1) + ' Unit';
      document.getElementById('mMhs').innerText = (item.user ? item.user.name : 'Mahasiswa');
      document.getElementById('mDosen').innerText = item.dosen_penanggung_jawab || 'Prof. Dr. Hendra Jaya, M.T.';
      document.getElementById('mRuangan').innerText = (item.sarpras && item.sarpras.ruangan ? item.sarpras.ruangan.nama_ruangan : 'Bengkel IT');

      // Images Resolution (Membaca file asli yang diunggah mahasiswa / foto sarpras)
      let imgBeforeUrl = '{{ asset("images/sarpras/hdmi_bundle.svg") }}';
      if (item.foto_sebelum) {
        imgBeforeUrl = (item.foto_sebelum.startsWith('http') || item.foto_sebelum.startsWith('/'))
          ? item.foto_sebelum
          : '/storage/' + item.foto_sebelum;
      } else if (item.sarpras && item.sarpras.foto) {
        imgBeforeUrl = (item.sarpras.foto.startsWith('http') || item.sarpras.foto.startsWith('/'))
          ? item.sarpras.foto
          : '/storage/' + item.sarpras.foto;
      } else if (item.sarpras && item.sarpras.nama_sarpras) {
        let name = item.sarpras.nama_sarpras.toLowerCase();
        if (name.includes('mikrotik') || name.includes('router')) {
          imgBeforeUrl = '{{ asset("images/sarpras/mikrotik_router.svg") }}';
        } else if (name.includes('tester') || name.includes('lan')) {
          imgBeforeUrl = '{{ asset("images/sarpras/lan_tester.svg") }}';
        }
      }

      let imgAfterUrl = imgBeforeUrl;
      let berkasName = 'Tidak ada lampiran foto fisik';
      if (item.foto_sesudah) {
        imgAfterUrl = (item.foto_sesudah.startsWith('http') || item.foto_sesudah.startsWith('/'))
          ? item.foto_sesudah
          : '/storage/' + item.foto_sesudah;
        berkasName = item.foto_sesudah.split('/').pop();
      }

      const elImgBefore = document.getElementById('mImgBefore');
      const elImgAfter = document.getElementById('mImgAfter');
      elImgBefore.src = imgBeforeUrl;
      elImgAfter.src = imgAfterUrl;
      elImgBefore.style.cursor = 'pointer';
      elImgBefore.onclick = () => window.open(imgBeforeUrl, '_blank');
      elImgAfter.style.cursor = 'pointer';
      elImgAfter.onclick = () => window.open(imgAfterUrl, '_blank');
      document.getElementById('mBerkas').innerText = berkasName;

      // Card 1 Before
      document.getElementById('mWaktuAmbil').innerText = item.tgl_pinjam ? formatTglWita(item.tgl_pinjam) : '20/06/2026 (10:15 WITA)';
      document.getElementById('mCatatanAwal').innerText = '"' + (item.catatan_kondisi_awal || 'Kondisi barang utuh dan lengkap saat serah terima awal.') + '"';
      document.getElementById('mLaboranAwal').innerText = 'Sukirman, S.T.';

      // Card 2 After
      document.getElementById('mWaktuKembali').innerText = item.tgl_kembali_aktual ? formatTglWita(item.tgl_kembali_aktual) : '20/06/2026, 14:45 WITA';
      document.getElementById('mCatatanKembali').innerText = '"' + (item.catatan_kondisi_kembali || 'Barang telah digunakan dan dikembalikan dalam kondisi baik.') + '"';
      document.getElementById('mPengunggah').innerText = (item.user ? item.user.name : 'Mahasiswa');

      // Evaluasi & Catatan
      let defaultCatatan = 'Pengecekan fisik selesai, ' + (item.sarpras ? item.sarpras.nama_sarpras : 'barang') + ' diuji display/fungsi normal, siap dipinjamkan kembali.';
      document.getElementById('mCatatanLaboranInput').value = defaultCatatan;
      let lokasiSimpan = (item.sarpras && item.sarpras.ruangan && item.sarpras.ruangan.nama_ruangan) ? item.sarpras.ruangan.nama_ruangan : 'Ruang Inventaris';
      document.getElementById('mLokasiSimpan').innerText = lokasiSimpan;

      // Status Kendala Kerusakan Banner & Tombol
      const isDamage = (item.status_pengembalian === 'kendala_kerusakan');
      const noticeBox = document.getElementById('modalDamageNotice');
      if (noticeBox) {
        if (isDamage) {
          noticeBox.style.display = 'block';
          document.getElementById('modalDamageText').innerText = item.catatan_pengelola || 'Terdapat kendala fisik atau kekurangan kelengkapan barang saat pengembalian.';
        } else {
          noticeBox.style.display = 'none';
        }
      }

      // Contextual Button Labels in Modal Footer
      const btnDamage = document.querySelector('.btn-damage');
      const btnApprove = document.querySelector('.btn-approve-return');
      if (btnDamage) {
        btnDamage.innerText = isDamage ? 'Perbarui Catatan Kendala' : 'Tolak / Ada Kerusakan';
      }
      if (btnApprove) {
        btnApprove.innerText = isDamage ? 'Selesaikan Kendala & Sahkan' : 'Setujui Pengembalian & Tutup Tiket';
      }

      // Setup Form Actions
      document.getElementById('formApproveReturn').action = '/pengelola/pengembalian/' + item.id + '/verifikasi';
      document.getElementById('formRejectDamage').action = '/pengelola/pengembalian/' + item.id + '/tolak';

      // Show Modal
      document.getElementById('modalReturn').classList.add('active');
    }

    function closeReturnModal() {
      document.getElementById('modalReturn').classList.remove('active');
    }

    function openDamageModal() {
      if (activeItemData && activeItemData.status_pengembalian === 'kendala_kerusakan' && activeItemData.catatan_pengelola) {
        let raw = activeItemData.catatan_pengelola.replace(/^KENDALA\/KERUSAKAN:\s*/i, '');
        let cleanReason = raw.split('(Pemeriksa:')[0].trim();
        const textarea = document.querySelector('#modalDamage textarea[name="alasan_kendala"]');
        if (textarea) textarea.value = cleanReason;
      }
      document.getElementById('modalDamage').classList.add('active');
    }

    // Helper format tanggal WITA
    function formatTglWita(dateStr) {
      try {
        const d = new Date(dateStr);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        const hours = String(d.getHours()).padStart(2, '0');
        const mins = String(d.getMinutes()).padStart(2, '0');
        return `${day}/${month}/${year}, ${hours}:${mins} WITA`;
      } catch (e) {
        return dateStr;
      }
    }

    // Pass inputs before submit
    document.getElementById('formApproveReturn').addEventListener('submit', function() {
      document.getElementById('inputCatatanLaboran').value = document.getElementById('mCatatanLaboranInput').value;
      document.getElementById('inputLokasiSimpan').value = document.getElementById('mLokasiSimpan').innerText;
    });

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

    // Close on escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeReturnModal();
        closeProfileModal();
        closeChangePasswordModal();
        closeRoomInfoModal();
        const dmg = document.getElementById('modalDamage');
        if (dmg) dmg.classList.remove('active');
        const dropdown = document.getElementById('pengelolaDropdown');
        if (dropdown) dropdown.style.display = 'none';
      }
    });

    // Close dropdown on outside click
    document.addEventListener('click', function(event) {
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
