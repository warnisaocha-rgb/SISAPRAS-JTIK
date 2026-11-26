<style>
  /* Sticky sidebar (overflow-x: clip menjaga sticky tetap aktif) */
  .app-body, .portal-layout {
    overflow-x: clip !important;
  }
  .sidebar {
    position: sticky !important;
    top: 0;
    height: 100vh;
    max-height: 100vh;
    overflow-y: auto;
    align-self: start;
  }
  .sidebar::-webkit-scrollbar {
    width: 4px;
  }
  .sidebar::-webkit-scrollbar-thumb {
    background: rgba(148, 163, 184, 0.25);
    border-radius: 4px;
  }
  .workspace, .main-workspace {
    min-height: 100vh;
  }

  /* Row hover lembut pada seluruh tabel data */
  table tbody tr td {
    transition: background-color 0.12s ease;
  }
  table tbody tr:hover td {
    background-color: #F8FAFC;
  }

  /* Transisi halus saat flash alert auto-dismiss */
  .alert-banner, .alert-success-banner, .alert-danger-banner {
    transition: opacity 0.25s ease, transform 0.25s ease;
  }
  .alert-dismissing {
    opacity: 0 !important;
    transform: translateY(-4px);
    pointer-events: none;
  }

  /* Toast Notifikasi Formal (Non-AI: datar, crisp, tema UNM) */
  .sisapras-toast-stack {
    position: fixed;
    top: 20px;
    right: 24px;
    z-index: 12000;
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 380px;
    width: calc(100vw - 32px);
    pointer-events: none;
  }
  .sisapras-toast {
    pointer-events: auto;
    background: #FFFFFF;
    border: 1px solid #CBD5E1;
    border-radius: 8px;
    padding: 12px 14px;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.10);
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 12.5px;
    line-height: 1.45;
    color: #0F172A;
    opacity: 0;
    transform: translateY(-6px);
    transition: opacity 0.18s ease, transform 0.18s ease;
  }
  .sisapras-toast.visible {
    opacity: 1;
    transform: translateY(0);
  }
  .sisapras-toast.toast-success { border-color: #BBF7D0; }
  .sisapras-toast.toast-error { border-color: #FECACA; }
  .sisapras-toast.toast-warning { border-color: #FED7AA; }
  .sisapras-toast-icon {
    flex-shrink: 0;
    margin-top: 1px;
    display: inline-flex;
  }
  .sisapras-toast-body {
    flex: 1;
    font-weight: 500;
  }
  .sisapras-toast-close {
    background: none;
    border: none;
    color: #64748B;
    cursor: pointer;
    padding: 0 2px;
    line-height: 1;
    display: inline-flex;
    align-items: center;
  }
  .sisapras-toast-close:hover {
    color: #0F172A;
  }

  /* Modal Konfirmasi Formal (Selaras modal UNM) */
  .sisapras-confirm-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.50);
    z-index: 12500;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }
  .sisapras-confirm-overlay.open {
    display: flex;
  }
  .sisapras-confirm-box {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 14px 30px rgba(15, 23, 42, 0.16);
    overflow: hidden;
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
  }
  .sisapras-confirm-head {
    padding: 16px 20px 12px 20px;
    border-bottom: 1px solid #F1F5F9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
  }
  .sisapras-confirm-title {
    font-size: 14.5px;
    font-weight: 700;
    color: #0F172A;
    margin: 0;
  }
  .sisapras-confirm-msg {
    padding: 14px 20px 18px 20px;
    font-size: 13px;
    line-height: 1.55;
    color: #475569;
    margin: 0;
  }
  .sisapras-confirm-foot {
    padding: 12px 20px;
    background: #F8FAFC;
    border-top: 1px solid #E2E8F0;
    display: flex;
    justify-content: flex-end;
    gap: 8px;
  }
  .sisapras-confirm-cancel {
    background: #FFFFFF;
    color: #334155;
    border: 1px solid #CBD5E1;
    border-radius: 7px;
    padding: 8px 15px;
    font-family: inherit;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
  }
  .sisapras-confirm-cancel:hover {
    background: #F1F5F9;
    color: #0F172A;
  }
  .sisapras-confirm-ok {
    background: #08296E;
    color: #FFFFFF;
    border: 1px solid #08296E;
    border-radius: 7px;
    padding: 8px 16px;
    font-family: inherit;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
  }
  .sisapras-confirm-ok:hover {
    background: #061E52;
  }
  .sisapras-confirm-ok.danger {
    background: #DC2626;
    border-color: #DC2626;
  }
  .sisapras-confirm-ok.danger:hover {
    background: #B91C1C;
  }

  /* ===================================================================== */
  /* DUKUNGAN VERSI MOBILE & TABLET (BOTTOM NAV + KARTU TABEL + SENTUHAN)  */
  /* ===================================================================== */
  .sisapras-mobile-menu-btn,
  .sisapras-mobile-close-btn,
  .sisapras-mobile-backdrop,
  .sisapras-bottom-nav {
    display: none;
  }

  .page-header-row > div:last-child > div,
  .header-actions > div,
  .header-right > div {
    display: inline-flex;
    align-items: center;
  }

  @media screen and (max-width: 960px) {
    body:not(.intro-active) {
      display: block !important;
      overflow-x: clip !important;
      overflow-y: visible !important;
      height: auto !important;
    }

    .portal-layout,
    .app-body {
      display: block !important;
      grid-template-columns: 1fr !important;
      width: 100% !important;
      min-width: 0 !important;
      overflow: visible !important;
      height: auto !important;
    }

    .workspace,
    .main-workspace {
      width: 100% !important;
      min-width: 0 !important;
      max-width: 100% !important;
      padding: 0 12px calc(84px + env(safe-area-inset-bottom, 0px)) 12px !important;
      gap: 12px !important;
      overflow-x: clip !important;
      overflow-y: visible !important;
      height: auto !important;
    }

    .sidebar {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      bottom: 0 !important;
      width: 265px !important;
      min-width: 265px !important;
      max-width: 82vw !important;
      height: 100vh !important;
      max-height: 100vh !important;
      z-index: 10500 !important;
      transform: translateX(-105%);
      transition: transform 0.22s ease;
      box-shadow: 0 14px 36px rgba(15, 23, 42, 0.35);
    }

    body.sisapras-sidebar-open {
      overflow: hidden;
    }

    body.sisapras-sidebar-open .sidebar {
      transform: translateX(0);
    }

    .sisapras-mobile-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.5);
      z-index: 10490;
    }

    body.sisapras-sidebar-open .sisapras-mobile-backdrop {
      display: block;
    }

    .sisapras-mobile-menu-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 8px;
      border: 1px solid #CBD5E1;
      background: #FFFFFF;
      color: #08296E;
      cursor: pointer;
      flex-shrink: 0;
      padding: 0;
      -webkit-tap-highlight-color: transparent;
    }

    .sisapras-mobile-menu-btn:hover {
      background: #F8FAFC;
    }

    .sidebar-brand {
      justify-content: space-between;
      gap: 8px;
    }

    .sisapras-mobile-close-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      border-radius: 7px;
      border: 1px solid rgba(255, 255, 255, 0.16);
      background: rgba(255, 255, 255, 0.08);
      color: #FFFFFF;
      font-size: 19px;
      line-height: 1;
      cursor: pointer;
      flex-shrink: 0;
    }

    .page-header-row,
    .page-header {
      position: sticky !important;
      top: 0 !important;
      z-index: 90 !important;
      background: #FFFFFF !important;
      border-bottom: 1px solid #CBD5E1 !important;
      margin: 0 -12px 2px -12px !important;
      padding: 8px 14px !important;
      flex-wrap: nowrap !important;
      align-items: center !important;
      gap: 8px !important;
    }

    .page-header-row > div:first-child,
    .page-header .header-left {
      display: flex !important;
      align-items: center !important;
      flex-wrap: nowrap !important;
      gap: 8px !important;
      flex: 1 1 auto !important;
      min-width: 0 !important;
    }

    .page-title {
      font-size: 14.5px !important;
      white-space: normal !important;
      line-height: 1.2 !important;
    }

    .header-divider,
    .header-divider ~ span,
    .page-subtitle {
      display: none !important;
    }

    .header-actions,
    .header-right,
    .page-header-row > div:last-child,
    .page-header > div:last-child {
      display: flex !important;
      align-items: center !important;
      flex-shrink: 0 !important;
      gap: 6px !important;
    }

    .cart-btn-header,
    .btn-header-room,
    .btn-header-mahasiswa,
    .btn-header-pengelola,
    .btn-header-admin {
      height: 34px !important;
      min-height: 34px !important;
      padding: 0 11px !important;
      font-size: 11px !important;
      font-weight: 600 !important;
      line-height: 1 !important;
      white-space: nowrap !important;
      box-sizing: border-box !important;
      display: inline-flex !important;
      align-items: center !important;
    }

    .user-dropdown-panel,
    .user-dropdown-menu {
      max-width: calc(100vw - 24px) !important;
      right: 0 !important;
    }

    .sisapras-bottom-nav {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 900;
      display: flex;
      align-items: stretch;
      justify-content: space-around;
      gap: 2px;
      background: #FFFFFF;
      border-top: 1px solid #CBD5E1;
      box-shadow: 0 -4px 16px rgba(15, 23, 42, 0.06);
      padding: 5px 6px calc(6px + env(safe-area-inset-bottom, 0px)) 6px;
    }

    .sisapras-bottom-nav-item {
      position: relative;
      flex: 1 1 0;
      min-width: 0;
      min-height: 48px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 3px;
      padding: 5px 3px;
      border-radius: 8px;
      text-decoration: none;
      color: #64748B;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10px;
      font-weight: 600;
      line-height: 1.15;
      text-align: center;
      transition: background 0.15s ease, color 0.15s ease;
      -webkit-tap-highlight-color: transparent;
    }

    .sisapras-bottom-nav-item svg {
      width: 19px;
      height: 19px;
      flex-shrink: 0;
    }

    .sisapras-bottom-nav-label {
      display: block;
      max-width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .sisapras-bottom-nav-item.active {
      color: #08296E;
      background: #EFF4FF;
      font-weight: 700;
    }

    .sisapras-bottom-nav-badge {
      position: absolute;
      top: 2px;
      right: calc(50% - 19px);
      min-width: 16px;
      height: 16px;
      padding: 0 4px;
      border-radius: 999px;
      background: #ED7411;
      color: #FFFFFF;
      font-size: 9px;
      font-weight: 800;
      line-height: 13px;
      text-align: center;
      border: 1.5px solid #FFFFFF;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .sisapras-bottom-nav-badge.badge-bebas {
      background: #15803D;
    }

    .sisapras-toast-stack {
      bottom: calc(74px + env(safe-area-inset-bottom, 0px)) !important;
      right: 12px !important;
      left: 12px !important;
      max-width: none !important;
    }

    .metrics-grid,
    .quick-grid {
      grid-template-columns: repeat(2, 1fr) !important;
      gap: 10px !important;
    }

    .welcome-banner {
      padding: 16px 18px !important;
      min-height: auto !important;
    }
  }

  @media screen and (max-width: 768px) {
    .toolbar-row,
    .toolbar-left,
    .controls-left,
    .catalog-toolbar-panel,
    .status-toolbar-panel,
    .toolbar-card,
    .filter-controls-row {
      flex-direction: column !important;
      align-items: stretch !important;
      gap: 10px !important;
    }

    .catalog-toolbar-panel,
    .status-toolbar-panel,
    .toolbar-card,
    .filter-controls-row {
      padding: 12px 14px !important;
    }

    .toolbar-right {
      width: 100%;
      flex-direction: column;
      align-items: stretch !important;
    }

    .toolbar-meta-badge {
      text-align: center;
    }

    .toolbar-search-form,
    .catalog-search-box,
    .status-search-box {
      max-width: 100% !important;
      width: 100% !important;
      flex: 1 1 100% !important;
    }

    .search-input-box input,
    .catalog-search-input,
    .status-search-input {
      min-height: 40px !important;
      font-size: 13px !important;
    }

    .pill-select-wrap,
    .pill-filter-select,
    .select-pill {
      width: 100% !important;
      min-height: 40px !important;
      font-size: 12.5px !important;
    }

    .unit-pills-group,
    .status-filter-pills,
    .filter-btn-group,
    .table-filter-group {
      width: 100%;
      flex-wrap: wrap !important;
      gap: 6px !important;
    }

    .filter-btn,
    .unit-pill-btn,
    .tab-pill,
    .tbl-filter-btn {
      min-height: 36px;
      padding: 6px 12px !important;
      font-size: 11.5px !important;
    }

    .btn-add-primary,
    .btn-search-action {
      min-height: 40px !important;
      font-size: 12.5px !important;
    }

    .btn-add-primary {
      width: 100%;
      justify-content: center !important;
    }

    .table-header-bar,
    .table-caption-bar {
      padding: 12px 14px !important;
      gap: 8px !important;
      flex-wrap: wrap !important;
    }

    .table-header-bar a[style*="margin-left:auto"],
    .table-header-bar a[style*="margin-left: auto"] {
      margin-left: 0 !important;
      flex-basis: 100%;
    }

    /* UBAH TABEL DATA PORTAL MENJADI KARTU RAPI DI HP */
    .table-card,
    .table-section,
    .table-container-card,
    .table-section > div,
    .table-container-card > div,
    .table-card > div[style*="overflow-x"] {
      overflow: visible !important;
    }

    table.sisapras-card-table {
      display: block !important;
      width: 100% !important;
      min-width: 0 !important;
      border-collapse: separate !important;
    }

    table.sisapras-card-table thead {
      display: none !important;
    }

    table.sisapras-card-table tbody {
      display: flex !important;
      flex-direction: column !important;
      gap: 8px !important;
      padding: 8px !important;
      background: #F8FAFC !important;
    }

    table.sisapras-card-table tbody tr {
      display: grid !important;
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      gap: 8px 10px !important;
      background: #FFFFFF !important;
      border: 1px solid #CBD5E1 !important;
      border-radius: 10px !important;
      padding: 11px 13px !important;
      box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04) !important;
    }

    table.sisapras-card-table tbody tr.row-striped td {
      background: transparent !important;
    }

    table.sisapras-card-table tbody tr.sisapras-mobile-empty-row {
      display: block !important;
    }

    table.sisapras-card-table tbody td {
      display: block !important;
      width: auto !important;
      min-width: 0 !important;
      padding: 0 !important;
      border: none !important;
      background: transparent !important;
      text-align: left !important;
      font-size: 12.5px !important;
      overflow-wrap: anywhere;
    }

    table.sisapras-card-table tbody td[data-label]::before {
      content: attr(data-label);
      display: block;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 10.5px;
      font-weight: 700;
      color: #64748B;
      text-transform: none;
      letter-spacing: 0.1px;
      margin-bottom: 3px;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-empty-cell {
      text-align: center !important;
      padding: 18px 8px !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-empty-cell::before {
      display: none !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-wide-cell {
      grid-column: 1 / -1 !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-status-cell > div,
    table.sisapras-card-table .stock-stack {
      align-items: flex-start !important;
      text-align: left !important;
      white-space: normal !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell {
      grid-column: 1 / -1 !important;
      padding-top: 10px !important;
      margin-top: 2px !important;
      border-top: 1px dashed #E2E8F0 !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell::before {
      display: none !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .btn-action-dots {
      display: none !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .action-dropdown-wrap {
      width: 100%;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .action-dropdown-menu {
      position: static !important;
      display: flex !important;
      flex-direction: row !important;
      flex-wrap: wrap !important;
      gap: 6px !important;
      width: 100% !important;
      min-width: 0 !important;
      border: none !important;
      box-shadow: none !important;
      background: transparent !important;
      padding: 0 !important;
      animation: none !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .action-menu-divider {
      display: none !important;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .action-dropdown-menu > form {
      flex: 1 1 130px;
      display: flex;
      margin: 0;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .action-menu-item {
      flex: 1 1 115px;
      justify-content: center;
      border: 1px solid #CBD5E1;
      border-radius: 7px;
      min-height: 36px;
      padding: 6px 10px;
      font-size: 11.5px;
      font-weight: 600;
      background: #F8FAFC;
      color: #0F172A;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .action-menu-item.action-menu-success {
      background: #F0FDF4;
      border-color: #BBF7D0;
      color: #15803D;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .action-menu-item.action-menu-danger {
      background: #FEF2F2;
      border-color: #FECACA;
      color: #DC2626;
    }

    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .btn-detail,
    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .btn-verify-action,
    table.sisapras-card-table tbody td.sisapras-mobile-actions-cell .btn-cancel-item {
      min-height: 38px;
      padding: 7px 14px;
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
  }

  @media screen and (max-width: 640px) {
    .compare-photo-row {
      grid-template-columns: 1fr !important;
      gap: 10px !important;
    }

    .card-panel {
      padding: 14px !important;
    }

    #selectedItemBox [style*="grid-template-columns: 1fr 1fr"] {
      grid-template-columns: 1fr !important;
    }

    .modal-overlay {
      padding: 0 !important;
      align-items: flex-end !important;
    }

    .modal-dialog,
    .modal-card {
      width: 100% !important;
      max-width: 100% !important;
      max-height: 92vh !important;
      border-radius: 14px 14px 0 0 !important;
      margin: 0 !important;
    }

    .modal-header,
    .modal-body,
    .modal-footer,
    .modal-foot {
      padding: 12px 14px !important;
    }

    .modal-footer,
    .modal-foot {
      flex-wrap: wrap !important;
      gap: 8px !important;
    }

    .modal-footer > button,
    .modal-footer > a,
    .modal-foot > button,
    .modal-foot > a {
      flex: 1 1 auto;
      min-height: 40px;
      justify-content: center;
    }

    .detail-grid,
    .detail-info-grid,
    .form-row,
    .form-row-2col,
    .modal-grid-top,
    .modal-form-grid,
    .modal-overlay [style*="grid-template-columns: 1fr 1fr"],
    .modal-overlay [style*="grid-template-columns: repeat(3"] {
      grid-template-columns: 1fr !important;
      gap: 8px !important;
    }

    .modal-overlay [style*="grid-template-columns: repeat(4"] {
      grid-template-columns: repeat(2, 1fr) !important;
      gap: 8px !important;
    }

    #modalRoomInfo .modal-body > div:last-child > div:first-child {
      flex-wrap: wrap !important;
      gap: 8px !important;
    }

    #stokSearchInput {
      width: 100% !important;
      min-height: 38px !important;
    }

    .sisapras-stok-wrap {
      overflow: visible !important;
      border: none !important;
      background: transparent !important;
    }

    .btn-green-pinjam,
    .btn-submit-return,
    .btn-action-bebas {
      min-height: 42px;
      font-size: 12.5px !important;
    }

    .cart-figma-item {
      flex-wrap: wrap !important;
      gap: 8px !important;
    }

    .sisapras-pagination-bar {
      justify-content: center !important;
      padding: 10px 12px !important;
      gap: 8px !important;
    }

    .bebas-progress-card,
    .final-status-card {
      padding: 16px 14px !important;
    }
  }

  @media screen and (max-width: 520px) {
    .quick-grid {
      grid-template-columns: 1fr !important;
    }

    .condition-options-group {
      grid-template-columns: 1fr !important;
      gap: 8px !important;
    }

    .condition-radio-label {
      flex-direction: row !important;
      justify-content: flex-start !important;
      text-align: left !important;
      min-height: 44px;
      padding: 10px 12px !important;
      font-size: 12px !important;
      gap: 10px !important;
    }

    .metric-card {
      padding: 14px 10px !important;
    }

    .m-num {
      font-size: 26px !important;
    }

    .sisapras-confirm-foot {
      flex-wrap: wrap;
    }

    .sisapras-confirm-cancel,
    .sisapras-confirm-ok {
      flex: 1 1 auto;
      text-align: center;
    }
  }

  /* =========================================================================
     TAB RIWAYAT LOGIN SAYA DI DALAM MODAL PROFIL (#modalProfile)
     ========================================================================= */
  .sisapras-profile-tabs {
    display: flex;
    gap: 6px;
    padding: 10px 20px 0 20px;
    background: #F8FAFC;
    border-bottom: 1px solid #E2E8F0;
  }

  .sisapras-profile-tab-btn {
    appearance: none;
    border: 1px solid transparent;
    border-bottom: none;
    background: transparent;
    color: #64748B;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px;
    font-weight: 700;
    padding: 8px 14px;
    border-radius: 6px 6px 0 0;
    cursor: pointer;
    position: relative;
    bottom: -1px;
    transition: all 0.15s ease;
  }

  .sisapras-profile-tab-btn:hover {
    color: #08296E;
    background: #EFF6FF;
  }

  .sisapras-profile-tab-btn.active {
    background: #FFFFFF;
    color: #08296E;
    border-color: #E2E8F0;
    border-bottom-color: #FFFFFF;
  }

  .sisapras-lh-pane {
    display: none;
    padding: 16px 20px;
    max-height: 400px;
    overflow-y: auto;
    background: #FFFFFF;
  }

  .sisapras-lh-pane.active {
    display: block;
  }

  .sisapras-lh-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 12px;
    flex-wrap: wrap;
  }

  .sisapras-lh-note {
    font-size: 11.5px;
    color: #64748B;
    line-height: 1.45;
  }

  .sisapras-lh-refresh {
    border: 1px solid #CBD5E1;
    background: #F8FAFC;
    color: #08296E;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11.5px;
    font-weight: 700;
    padding: 5px 10px;
    border-radius: 6px;
    cursor: pointer;
  }

  .sisapras-lh-refresh:hover {
    background: #EFF6FF;
    border-color: #93C5FD;
  }

  .sisapras-lh-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .sisapras-lh-card {
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    padding: 10px 12px;
    background: #F8FAFC;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .sisapras-lh-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    flex-wrap: wrap;
  }

  .sisapras-lh-time {
    font-size: 12px;
    font-weight: 700;
    color: #0F172A;
  }

  .sisapras-lh-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 5px;
    font-size: 10.5px;
    font-weight: 700;
    border: 1px solid transparent;
  }

  .sisapras-lh-badge.st-berhasil { background: #ECFDF5; color: #065F46; border-color: #A7F3D0; }
  .sisapras-lh-badge.st-gagal { background: #FEF2F2; color: #B91C1C; border-color: #FECACA; }
  .sisapras-lh-badge.st-terkunci { background: #FFF1F2; color: #9F1239; border-color: #FECDD3; }
  .sisapras-lh-badge.st-menunggu_acc { background: #FFFBEB; color: #92400E; border-color: #FDE68A; }
  .sisapras-lh-badge.st-nonaktif,
  .sisapras-lh-badge.st-ditolak { background: #F1F5F9; color: #475569; border-color: #CBD5E1; }

  .sisapras-lh-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 6px 14px;
    font-size: 11.5px;
    color: #475569;
  }

  .sisapras-lh-sub {
    font-size: 11px;
    color: #64748B;
  }

  .sisapras-lh-empty {
    text-align: center;
    padding: 26px 14px;
    border: 1px dashed #CBD5E1;
    border-radius: 8px;
    color: #64748B;
    font-size: 12px;
  }

  .sisapras-lh-footer {
    display: none;
    justify-content: flex-end;
    padding: 12px 20px;
    background: #F8FAFC;
    border-top: 1px solid #E2E8F0;
  }

  .sisapras-lh-footer.active {
    display: flex;
  }

  @media screen and (max-width: 640px) {
    .sisapras-profile-tabs {
      padding: 8px 14px 0 14px;
    }
    .sisapras-lh-pane {
      padding: 12px 14px;
      max-height: 60vh;
    }
    .sisapras-lh-footer {
      padding: 10px 14px;
    }
  }

  /* ===================================================================== */
  /* PENYELARASAN ANGKA TENGAH, NORMALISASI KAPITAL, & FEEDBACK LOADING    */
  /* ===================================================================== */
  .input-counter,
  .stepper-val,
  .btn-counter,
  .btn-stepper {
    font-variant-numeric: tabular-nums;
    text-align: center !important;
    box-sizing: border-box;
  }
  .input-counter {
    appearance: textfield;
    -moz-appearance: textfield;
    padding: 0 !important;
    line-height: 26px;
  }
  .input-counter::-webkit-outer-spin-button,
  .input-counter::-webkit-inner-spin-button,
  .qty-counter-row input[type="number"]::-webkit-outer-spin-button,
  .qty-counter-row input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  .btn-counter,
  .btn-stepper {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    line-height: 1 !important;
    padding: 0 !important;
    transition: transform 0.1s ease, background-color 0.15s ease, opacity 0.15s ease;
  }
  .btn-counter:active:not(:disabled),
  .btn-stepper:active:not(:disabled) {
    transform: scale(0.94);
  }
  .stepper-val {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 30px;
    height: 26px;
    padding: 0 4px !important;
    line-height: 1 !important;
  }
  .nav-badge-count,
  .unit-pill-count,
  .filter-pill-count,
  .cart-qty-badge,
  .badge-sidebar {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    font-variant-numeric: tabular-nums;
    line-height: 1 !important;
  }

  .nav-header-label,
  .portal-role-tag,
  .reg-tag,
  .status-tag,
  .cart-figma-box-title,
  .verified-user-title,
  .table-caption,
  .table-caption-title,
  .card-col-title,
  .note-bubble-title,
  .eval-section-title,
  .laboran-report-title,
  .badge-status-box,
  .badge-lab-status,
  .rack-label-tag,
  .condition-badge,
  .role-badge,
  .modal-title-text,
  .detail-card-title,
  .form-label-sm,
  .approval-table th,
  .data-table thead th,
  .btn-orange-pinjam,
  .btn-green-pinjam,
  .btn-submit-figma-orange,
  .btn-submit-main,
  .btn-submit {
    text-transform: none !important;
  }

  .sisapras-top-loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    z-index: 20000;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.15s ease;
    background: rgba(8, 41, 110, 0.12);
    overflow: hidden;
  }
  .sisapras-top-loader.active {
    opacity: 1;
  }
  .sisapras-top-loader-bar {
    height: 100%;
    width: 40%;
    background: linear-gradient(90deg, #08296E, #ED7411);
    border-radius: 0 3px 3px 0;
    animation: sisaprasProgressSlide 1.05s ease-in-out infinite;
  }
  @keyframes sisaprasProgressSlide {
    0% { transform: translateX(-110%); }
    100% { transform: translateX(320%); }
  }
  @keyframes sisaprasSpin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
  .sisapras-btn-spinner {
    width: 14px;
    height: 14px;
    border: 2px solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
    animation: sisaprasSpin 0.65s linear infinite;
    flex-shrink: 0;
  }
  .sisapras-btn-loading {
    opacity: 0.88 !important;
    cursor: wait !important;
    pointer-events: none !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 7px !important;
  }
  .sisapras-region-loading {
    opacity: 0.6;
    transition: opacity 0.15s ease;
    pointer-events: none;
  }
  .sisapras-search-spinner {
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -6.5px;
    width: 13px;
    height: 13px;
    border: 2px solid #94A3B8;
    border-right-color: transparent;
    border-radius: 50%;
    animation: sisaprasSpin 0.65s linear infinite;
    pointer-events: none;
    display: none;
    z-index: 4;
  }
  .sisapras-searching .sisapras-search-spinner {
    display: inline-block;
  }
</style>

<div id="sisaprasTopLoader" class="sisapras-top-loader" aria-hidden="true"><div class="sisapras-top-loader-bar"></div></div>

<div id="sisaprasMobileBackdrop" class="sisapras-mobile-backdrop" aria-hidden="true"></div>

<div id="sisaprasToastStack" class="sisapras-toast-stack" aria-live="polite"></div>

<div id="sisaprasConfirmModal" class="sisapras-confirm-overlay" role="dialog" aria-modal="true">
  <div class="sisapras-confirm-box">
    <div class="sisapras-confirm-head">
      <h3 id="sisaprasConfirmTitle" class="sisapras-confirm-title">Konfirmasi Tindakan</h3>
      <button type="button" class="sisapras-toast-close" onclick="closeConfirmDialog()" aria-label="Tutup">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <p id="sisaprasConfirmMsg" class="sisapras-confirm-msg"></p>
    <div class="sisapras-confirm-foot">
      <button type="button" class="sisapras-confirm-cancel" onclick="closeConfirmDialog()">Batal</button>
      <button type="button" id="sisaprasConfirmOkBtn" class="sisapras-confirm-ok">Ya, Lanjutkan</button>
    </div>
  </div>
</div>

<script>
  (function() {
    let pendingConfirmAction = null;
    const loadingButtons = [];
    let activeProgressCount = 0;

    window.sisaprasStartProgress = function() {
      activeProgressCount++;
      const bar = document.getElementById('sisaprasTopLoader');
      if (bar) bar.classList.add('active');
    };

    window.sisaprasStopProgress = function(force) {
      activeProgressCount = force ? 0 : Math.max(0, activeProgressCount - 1);
      if (activeProgressCount === 0) {
        const bar = document.getElementById('sisaprasTopLoader');
        if (bar) bar.classList.remove('active');
      }
    };

    window.sisaprasSetButtonLoading = function(btn, label) {
      if (!btn || btn.dataset.sisaprasLoading === '1') return;
      if (btn.tagName === 'INPUT') {
        btn.dataset.origVal = btn.value;
        btn.value = label || 'Memproses...';
      } else {
        btn.dataset.origHtml = btn.innerHTML;
        const textSpan = document.createElement('span');
        textSpan.textContent = label || 'Memproses...';
        btn.innerHTML = '<span class="sisapras-btn-spinner" aria-hidden="true"></span>';
        btn.appendChild(textSpan);
      }
      btn.dataset.sisaprasLoading = '1';
      btn.dataset.origDisabled = btn.disabled ? '1' : '0';
      btn.disabled = true;
      btn.classList.add('sisapras-btn-loading');
      loadingButtons.push(btn);
    };

    window.sisaprasResetButtons = function() {
      while (loadingButtons.length) {
        const btn = loadingButtons.pop();
        if (!btn) continue;
        if (btn.tagName === 'INPUT') {
          if (btn.dataset.origVal !== undefined) btn.value = btn.dataset.origVal;
        } else if (btn.dataset.origHtml !== undefined) {
          btn.innerHTML = btn.dataset.origHtml;
        }
        btn.disabled = btn.dataset.origDisabled === '1';
        btn.classList.remove('sisapras-btn-loading');
        delete btn.dataset.sisaprasLoading;
      }
      document.querySelectorAll('form[data-submitting="1"]').forEach(function(f) {
        delete f.dataset.submitting;
      });
      document.querySelectorAll('[style*="opacity: 0.72"]').forEach(function(a) {
        a.style.opacity = '';
      });
    };

    window.addEventListener('pageshow', function() {
      window.sisaprasStopProgress(true);
      window.sisaprasResetButtons();
    });

    window.showSystemToast = function(message, type) {
      type = type || 'info';
      const stack = document.getElementById('sisaprasToastStack');
      if (!stack) return;

      const iconMap = {
        success: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#15803D" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        error: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
        warning: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ED7411" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        info: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08296E" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
      };

      const toast = document.createElement('div');
      toast.className = 'sisapras-toast toast-' + type;
      toast.innerHTML =
        '<span class="sisapras-toast-icon">' + (iconMap[type] || iconMap.info) + '</span>' +
        '<span class="sisapras-toast-body"></span>' +
        '<button type="button" class="sisapras-toast-close" aria-label="Tutup">' +
          '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>' +
        '</button>';
      toast.querySelector('.sisapras-toast-body').textContent = message;

      const removeToast = function() {
        toast.classList.remove('visible');
        setTimeout(function() { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 200);
      };
      toast.querySelector('.sisapras-toast-close').addEventListener('click', removeToast);

      stack.appendChild(toast);
      requestAnimationFrame(function() { toast.classList.add('visible'); });
      setTimeout(removeToast, 4500);
    };

    window.openConfirmDialog = function(opts) {
      const overlay = document.getElementById('sisaprasConfirmModal');
      const titleEl = document.getElementById('sisaprasConfirmTitle');
      const msgEl = document.getElementById('sisaprasConfirmMsg');
      const okBtn = document.getElementById('sisaprasConfirmOkBtn');
      if (!overlay) return;

      okBtn.disabled = false;
      okBtn.classList.remove('sisapras-btn-loading');
      delete okBtn.dataset.sisaprasLoading;
      titleEl.textContent = (opts && opts.title) ? opts.title : 'Konfirmasi Tindakan';
      msgEl.textContent = (opts && opts.message) ? opts.message : 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
      okBtn.textContent = (opts && opts.confirmText) ? opts.confirmText : 'Ya, Lanjutkan';
      okBtn.className = 'sisapras-confirm-ok' + (opts && opts.danger ? ' danger' : '');

      pendingConfirmAction = (opts && typeof opts.onConfirm === 'function') ? opts.onConfirm : null;
      overlay.classList.add('open');
    };

    window.closeConfirmDialog = function() {
      const overlay = document.getElementById('sisaprasConfirmModal');
      if (overlay) overlay.classList.remove('open');
      pendingConfirmAction = null;
    };

    window.confirmFormSubmit = function(event, form, title, message, confirmText, isDanger) {
      if (form.dataset.confirmed === '1') {
        form.dataset.confirmed = '';
        return true;
      }
      if (event) event.preventDefault();
      window.openConfirmDialog({
        title: title || 'Konfirmasi Tindakan',
        message: message || 'Apakah Anda yakin ingin melanjutkan?',
        confirmText: confirmText || 'Ya, Lanjutkan',
        danger: isDanger !== false,
        onConfirm: function() {
          form.dataset.confirmed = '1';
          const submitBtn = form.querySelector('button[type="submit"]:not(:disabled), input[type="submit"]:not(:disabled)');
          if (submitBtn) window.sisaprasSetButtonLoading(submitBtn, 'Memproses...');
          window.sisaprasStartProgress();
          form.submit();
        }
      });
      return false;
    };

    document.addEventListener('DOMContentLoaded', function() {
      const okBtn = document.getElementById('sisaprasConfirmOkBtn');
      const overlay = document.getElementById('sisaprasConfirmModal');

      if (okBtn) {
        okBtn.addEventListener('click', function() {
          const action = pendingConfirmAction;
          window.closeConfirmDialog();
          if (action) action();
        });
      }
      if (overlay) {
        overlay.addEventListener('click', function(e) {
          if (e.target === overlay) window.closeConfirmDialog();
        });
      }
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay && overlay.classList.contains('open')) {
          window.closeConfirmDialog();
        }
      });

      // Umpan balik loading otomatis saat pengiriman formulir & navigasi tautan
      document.addEventListener('submit', function(e) {
        if (e.defaultPrevented) return;
        const form = e.target;
        if (!form || form.tagName !== 'FORM') return;
        const method = (form.getAttribute('method') || 'GET').toUpperCase();
        if (method === 'GET' || form.dataset.noLoading === '1') return;
        if (form.dataset.submitting === '1') {
          e.preventDefault();
          return;
        }
        form.dataset.submitting = '1';

        const submitBtn = e.submitter || form.querySelector('button[type="submit"]:not(:disabled), button:not([type]):not(:disabled), input[type="submit"]:not(:disabled)');
        if (submitBtn) {
          const customLabel = submitBtn.getAttribute('data-loading-text');
          const rawText = (submitBtn.textContent || submitBtn.value || '').trim().toLowerCase();
          let loadingLabel = customLabel || 'Memproses...';
          if (!customLabel) {
            if (rawText.indexOf('masuk') !== -1) loadingLabel = 'Memeriksa akun...';
            else if (rawText.indexOf('kirim') !== -1) loadingLabel = 'Mengirim...';
            else if (rawText.indexOf('simpan') !== -1 || rawText.indexOf('perbarui') !== -1) loadingLabel = 'Menyimpan...';
            else if (rawText.indexOf('ajukan') !== -1 || rawText.indexOf('daftar') !== -1) loadingLabel = 'Mengajukan...';
            else if (rawText.indexOf('hapus') !== -1) loadingLabel = 'Menghapus...';
            else if (rawText.indexOf('keluar') !== -1) loadingLabel = 'Keluar...';
          }
          window.sisaprasSetButtonLoading(submitBtn, loadingLabel);
        }
        window.sisaprasStartProgress();
      });

      document.addEventListener('click', function(e) {
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        const link = e.target && typeof e.target.closest === 'function' ? e.target.closest('a[href]') : null;
        if (!link) return;
        const href = link.getAttribute('href') || '';
        if (!href || href.startsWith('#') || href.startsWith('javascript:') || link.hasAttribute('download') || link.getAttribute('target') === '_blank') return;
        if (link.closest('.intro-stage') || link.classList.contains('nav-brand')) return;
        if (link.matches('.nav-item, .unit-pill-btn, .filter-pill-btn, .tab-pill, .filter-btn, .sisapras-pagination-bar a, .nav-portal-link, .btn-register-outline')) {
          link.style.opacity = '0.72';
          window.sisaprasStartProgress();
        }
      });

      // Auto-dismiss flash alerts setelah 5 detik (kecuali validasi list panjang)
      document.querySelectorAll('.alert-banner, .alert-success-banner, .alert-danger-banner').forEach(function(el) {
        if (el.querySelector('ul')) return; // Biarkan daftar error validasi tetap terbaca
        setTimeout(function() {
          if (!el || !el.parentNode) return;
          el.classList.add('alert-dismissing');
          setTimeout(function() {
            if (el && el.parentNode) el.parentNode.removeChild(el);
          }, 260);
        }, 5000);
      });

      @if(isset($errors) && $errors->any())
        if (!document.querySelector('.alert-danger-banner ul') && window.showSystemToast) {
          window.showSystemToast(@json($errors->first()), 'error');
        }
      @endif

      // Live search otomatis saat mengetik (dengan indikator loading)
      (function initLiveSearch() {
        const searchInputs = document.querySelectorAll('form[method="GET"] input[name="search"], form[method="get"] input[name="search"]');
        if (!searchInputs.length || typeof window.fetch !== 'function' || typeof window.DOMParser !== 'function') {
          return;
        }

        searchInputs.forEach(function(input) {
          const form = input.closest('form');
          if (!form) return;

          const wrap = input.parentElement;
          let searchSpinner = null;
          if (wrap) {
            if (window.getComputedStyle(wrap).position === 'static') {
              wrap.style.position = 'relative';
            }
            searchSpinner = wrap.querySelector('.sisapras-search-spinner');
            if (!searchSpinner) {
              searchSpinner = document.createElement('span');
              searchSpinner.className = 'sisapras-search-spinner';
              searchSpinner.setAttribute('aria-hidden', 'true');
              if (wrap.querySelector('.btn-clear-search, a[title*="Hapus"]')) {
                searchSpinner.style.right = '34px';
              }
              wrap.appendChild(searchSpinner);
            }
          }

          let debounceTimer = null;
          let activeController = null;
          let lastQueryUrl = null;

          function setSearchLoading(isLoading) {
            if (wrap) wrap.classList.toggle('sisapras-searching', isLoading);
            document.querySelectorAll('.table-card, .cards-grid, .table-container-card').forEach(function(region) {
              region.classList.toggle('sisapras-region-loading', isLoading);
            });
          }

          function syncFilterLinks(searchVal) {
            document.querySelectorAll('.unit-pill-btn, .filter-pill-btn, .tab-pill, .filter-btn').forEach(function(link) {
              if (!link.href) return;
              try {
                const u = new URL(link.href, window.location.origin);
                if (searchVal.trim() !== '') {
                  u.searchParams.set('search', searchVal);
                } else {
                  u.searchParams.delete('search');
                }
                u.searchParams.delete('page');
                link.href = u.toString();
              } catch (err) {}
            });
          }

          function buildTargetUrl() {
            const action = form.getAttribute('action') || window.location.pathname;
            const url = new URL(action, window.location.origin);
            const fd = new FormData(form);
            fd.forEach(function(val, key) {
              const str = String(val);
              if (key === 'search' && str.trim() === '') return;
              url.searchParams.set(key, str);
            });
            url.searchParams.delete('page');
            return url.toString();
          }

          function swapFragment(selector, newDoc) {
            const curEl = document.querySelector(selector);
            const nextEl = newDoc.querySelector(selector);
            if (curEl && nextEl) {
              curEl.replaceWith(document.importNode(nextEl, true));
              return true;
            }
            return false;
          }

          function runLiveFetch() {
            const targetUrl = buildTargetUrl();
            if (targetUrl === lastQueryUrl) return;
            lastQueryUrl = targetUrl;

            if (activeController) {
              activeController.abort();
            }
            const thisController = new AbortController();
            activeController = thisController;

            setSearchLoading(true);
            window.sisaprasStartProgress();

            fetch(targetUrl, {
              headers: { 'X-Requested-With': 'XMLHttpRequest' },
              signal: thisController.signal
            })
              .then(function(res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.text();
              })
              .then(function(html) {
                const doc = new DOMParser().parseFromString(html, 'text/html');

                swapFragment('.table-card', doc);
                swapFragment('.cards-grid', doc);
                swapFragment('.table-container-card', doc);
                swapFragment('.toolbar-meta-badge', doc);

                const oldPager = document.querySelector('.sisapras-pagination-bar');
                const nextPager = doc.querySelector('.sisapras-pagination-bar');
                if (oldPager && nextPager) {
                  oldPager.replaceWith(document.importNode(nextPager, true));
                } else if (oldPager && !nextPager) {
                  oldPager.remove();
                } else if (!oldPager && nextPager) {
                  const anchor = document.querySelector('.table-card, .cards-grid, .table-container-card');
                  if (anchor && anchor.parentNode) {
                    anchor.parentNode.insertBefore(document.importNode(nextPager, true), anchor.nextSibling);
                  }
                }

                syncFilterLinks(input.value);
                if (typeof window.sisaprasEnhanceMobileTables === 'function') {
                  window.sisaprasEnhanceMobileTables();
                }
                window.history.replaceState({}, '', targetUrl);
              })
              .catch(function(err) {
                if (err && err.name === 'AbortError') return;
                lastQueryUrl = null;
              })
              .finally(function() {
                window.sisaprasStopProgress();
                if (activeController === thisController) {
                  activeController = null;
                  setSearchLoading(false);
                }
              });
          }

          input.addEventListener('input', function(e) {
            if (e && e.isComposing) return;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(runLiveFetch, 200);
          });

          form.addEventListener('submit', function(e) {
            e.preventDefault();
            clearTimeout(debounceTimer);
            runLiveFetch();
          });

          const clearBtn = form.querySelector('.btn-clear-search, a[title*="Hapus"]');
          if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
              e.preventDefault();
              input.value = '';
              clearTimeout(debounceTimer);
              runLiveFetch();
              input.focus();
            });
          }
        });
      })();

      // Navigasi drawer mobile otomatis di seluruh halaman portal
      (function initMobileSidebarDrawer() {
        const sidebar = document.querySelector('.sidebar');
        const headerContainer = document.querySelector('.page-header-row > div:first-child, .page-header .header-left');
        const backdrop = document.getElementById('sisaprasMobileBackdrop');
        if (!sidebar || !headerContainer) return;

        let menuBtn = headerContainer.querySelector('.sisapras-mobile-menu-btn');

        function syncExpanded() {
          if (menuBtn) {
            menuBtn.setAttribute('aria-expanded', document.body.classList.contains('sisapras-sidebar-open') ? 'true' : 'false');
          }
        }

        function closeDrawer() {
          document.body.classList.remove('sisapras-sidebar-open');
          syncExpanded();
        }

        function toggleDrawer(e) {
          if (e) e.stopPropagation();
          document.body.classList.toggle('sisapras-sidebar-open');
          syncExpanded();
        }

        if (!menuBtn) {
          menuBtn = document.createElement('button');
          menuBtn.type = 'button';
          menuBtn.className = 'sisapras-mobile-menu-btn';
          menuBtn.setAttribute('aria-label', 'Buka Menu Navigasi');
          menuBtn.setAttribute('aria-expanded', 'false');
          menuBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>';
          menuBtn.addEventListener('click', toggleDrawer);
          headerContainer.insertBefore(menuBtn, headerContainer.firstChild);
        }

        const brand = sidebar.querySelector('.sidebar-brand');
        if (brand && !brand.querySelector('.sisapras-mobile-close-btn')) {
          const closeBtn = document.createElement('button');
          closeBtn.type = 'button';
          closeBtn.className = 'sisapras-mobile-close-btn';
          closeBtn.setAttribute('aria-label', 'Tutup Menu');
          closeBtn.textContent = '×';
          closeBtn.addEventListener('click', closeDrawer);
          brand.appendChild(closeBtn);
        }

        if (backdrop) {
          backdrop.addEventListener('click', closeDrawer);
        }

        sidebar.querySelectorAll('a[href]').forEach(function(link) {
          link.addEventListener('click', function() {
            if (window.innerWidth <= 960) closeDrawer();
          });
        });

        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape' && document.body.classList.contains('sisapras-sidebar-open')) {
            closeDrawer();
          }
        });

        window.addEventListener('resize', function() {
          if (window.innerWidth > 960 && document.body.classList.contains('sisapras-sidebar-open')) {
            closeDrawer();
          }
        });
      })();

      // Konversi tabel data menjadi kartu rapi saat tampilan mobile (<= 768px)
      window.sisaprasEnhanceMobileTables = function() {
        document.querySelectorAll('table.custom-table, table.approval-table, table.data-table, table#stokTable').forEach(function(table) {
          if (typeof table.closest === 'function' && table.closest('.modal-overlay') && table.id !== 'stokTable') return;
          if (table.classList.contains('official-meta-table') || table.classList.contains('official-unit-table')) return;

          if (table.id === 'stokTable' && table.parentElement) {
            table.parentElement.classList.add('sisapras-stok-wrap');
          }

          table.classList.add('sisapras-card-table');

          const headers = [];
          table.querySelectorAll('thead th').forEach(function(th) {
            headers.push(String(th.textContent || '').replace(/\s+/g, ' ').trim());
          });

          const rows = table.querySelectorAll('tbody tr');
          rows.forEach(function(tr) {
            const cells = tr.querySelectorAll('td');
            if (!cells.length) return;

            let hasColspan = false;
            cells.forEach(function(td) {
              if (td.getAttribute && td.getAttribute('colspan')) {
                hasColspan = true;
                td.classList.add('sisapras-mobile-empty-cell');
              }
            });
            if (hasColspan) {
              tr.classList.add('sisapras-mobile-empty-row');
              return;
            }

            cells.forEach(function(td, idx) {
              const label = headers[idx] || '';
              if (label && !td.getAttribute('data-label')) {
                td.setAttribute('data-label', label);
              }

              const lower = label.toLowerCase();
              const isActionCol =
                lower.indexOf('tindakan') !== -1 ||
                lower.indexOf('aksi') !== -1 ||
                Boolean(td.querySelector('.action-dropdown-wrap, .btn-detail, .btn-verify-action, .btn-cancel-item'));

              if (isActionCol) {
                td.classList.add('sisapras-mobile-actions-cell');
                return;
              }

              const isStatusCol =
                lower.indexOf('status') !== -1 ||
                lower.indexOf('kondisi') !== -1;

              if (isStatusCol) {
                td.classList.add('sisapras-mobile-status-cell');
              }

              const isWideCol =
                lower.indexOf('barang') !== -1 ||
                lower.indexOf('fasilitas') !== -1 ||
                lower.indexOf('sarpras') !== -1 ||
                lower.indexOf('identitas') !== -1 ||
                lower.indexOf('mahasiswa') !== -1 ||
                lower.indexOf('status 3 ruangan') !== -1 ||
                lower.indexOf('dosen') !== -1 ||
                lower.indexOf('penanggung jawab') !== -1 ||
                lower.indexOf('lokasi') !== -1 ||
                lower.indexOf('catatan') !== -1 ||
                lower.indexOf('nama lengkap') !== -1 ||
                Boolean(td.querySelector('.room-status-stack, .mhs-name'));

              if (isWideCol) {
                td.classList.add('sisapras-mobile-wide-cell');
              }
            });
          });
        });
      };
      window.sisaprasEnhanceMobileTables();

      // Navigasi bawah (bottom navigation bar) versi mobile untuk seluruh peran
      (function initMobileBottomNav() {
        const sidebar = document.querySelector('.sidebar');
        if (!sidebar || document.getElementById('sisaprasBottomNav')) return;

        const navLinks = sidebar.querySelectorAll('.sidebar-nav a.nav-item');
        if (!navLinks.length) return;

        const shortLabelMap = {
          'Dashboard': 'Beranda',
          'Peminjaman': 'Pinjam',
          'Pengembalian': 'Kembali',
          'Status Pinjam': 'Status',
          'Bebas Sarpras': 'Bebas',
          'Persetujuan Pinjam': 'Setujui',
          'Riwayat Keputusan': 'Riwayat',
          'Verifikasi Pengembalian': 'Kembali',
          'Verifikasi Bebas Pinjam': 'Bebas',
          'Cek Stok': 'Stok',
          'Alat dan Bahan': 'Sarpras',
          'Data Ruang & Lokasi': 'Ruangan',
          'Akun & Monitoring': 'Akun',
          'Manajemen Akun User': 'Akun'
        };

        const bottomNav = document.createElement('nav');
        bottomNav.id = 'sisaprasBottomNav';
        bottomNav.className = 'sisapras-bottom-nav';
        bottomNav.setAttribute('aria-label', 'Navigasi Mobile');

        let count = 0;
        navLinks.forEach(function(origLink) {
          if (count >= 5) return;
          count++;

          const href = origLink.getAttribute('href') || '#';
          const spanEl = origLink.querySelector('.nav-left-part span, span');
          const rawLabel = spanEl ? String(spanEl.textContent || '').replace(/\s+/g, ' ').trim() : 'Menu';
          const shortLabel = shortLabelMap[rawLabel] || rawLabel;

          const tab = document.createElement('a');
          tab.className = 'sisapras-bottom-nav-item' + (origLink.classList.contains('active') ? ' active' : '');
          tab.setAttribute('href', href);
          tab.setAttribute('title', rawLabel);
          if (origLink.classList.contains('active')) {
            tab.setAttribute('aria-current', 'page');
          }

          const origSvg = origLink.querySelector('svg');
          if (origSvg && typeof origSvg.cloneNode === 'function') {
            const svgClone = origSvg.cloneNode(true);
            svgClone.removeAttribute('style');
            tab.appendChild(svgClone);
          }

          const badgeEl = origLink.querySelector('.nav-badge-count');
          if (badgeEl) {
            const badgeText = String(badgeEl.textContent || '').trim();
            if (badgeText !== '') {
              const badge = document.createElement('span');
              badge.className = 'sisapras-bottom-nav-badge' + (badgeText.toLowerCase() === 'bebas' ? ' badge-bebas' : '');
              badge.textContent = badgeText.toLowerCase() === 'bebas' ? '✓' : badgeText;
              tab.appendChild(badge);
            }
          }

          const lbl = document.createElement('span');
          lbl.className = 'sisapras-bottom-nav-label';
          lbl.textContent = shortLabel;
          tab.appendChild(lbl);

          if (href.indexOf('javascript:') === 0 || href === '#') {
            tab.addEventListener('click', function(e) {
              e.preventDefault();
              origLink.click();
            });
          }

          bottomNav.appendChild(tab);
        });

        document.body.appendChild(bottomNav);
      })();

      // Monitoring Riwayat Login Mandiri di dalam Modal Kelola Akun (#modalProfile)
      (function initProfileLoginHistoryTabs() {
        const modal = document.getElementById('modalProfile');
        if (!modal || modal.dataset.lhInit === '1') return;

        const container = modal.querySelector('.modal-dialog, .modal-card');
        const header = container ? container.querySelector('.modal-header') : null;
        const form = container ? container.querySelector('form') : null;
        if (!container || !header || !form) return;

        modal.dataset.lhInit = '1';

        const tabBar = document.createElement('div');
        tabBar.className = 'sisapras-profile-tabs';
        tabBar.setAttribute('role', 'tablist');

        const tabProfilBtn = document.createElement('button');
        tabProfilBtn.type = 'button';
        tabProfilBtn.className = 'sisapras-profile-tab-btn active';
        tabProfilBtn.textContent = 'Data Profil';
        tabProfilBtn.setAttribute('data-profile-tab', 'profil');

        const tabHistoryBtn = document.createElement('button');
        tabHistoryBtn.type = 'button';
        tabHistoryBtn.className = 'sisapras-profile-tab-btn';
        tabHistoryBtn.textContent = 'Riwayat Login Saya';
        tabHistoryBtn.setAttribute('data-profile-tab', 'history');

        tabBar.appendChild(tabProfilBtn);
        tabBar.appendChild(tabHistoryBtn);

        const historyPane = document.createElement('div');
        historyPane.id = 'sisaprasLoginHistoryPane';
        historyPane.className = 'sisapras-lh-pane';
        historyPane.innerHTML =
          '<div class="sisapras-lh-toolbar">' +
            '<div class="sisapras-lh-note" id="sisaprasLhNote">Riwayat aktivitas masuk akun Anda.</div>' +
            '<button type="button" class="sisapras-lh-refresh" id="sisaprasLhRefreshBtn">Muat Ulang</button>' +
          '</div>' +
          '<div id="sisaprasLhList" class="sisapras-lh-list"><div class="sisapras-lh-empty">Memuat riwayat login...</div></div>';

        const historyFooter = document.createElement('div');
        historyFooter.className = 'sisapras-lh-footer';
        const closeHistoryBtn = document.createElement('button');
        closeHistoryBtn.type = 'button';
        closeHistoryBtn.className = 'sisapras-lh-refresh';
        closeHistoryBtn.style.padding = '8px 16px';
        closeHistoryBtn.textContent = 'Tutup';
        closeHistoryBtn.addEventListener('click', function() {
          if (typeof window.closeProfileModal === 'function') {
            window.closeProfileModal();
          } else if (typeof window.closeModal === 'function') {
            window.closeModal('modalProfile');
          } else {
            modal.classList.remove('active');
          }
        });
        historyFooter.appendChild(closeHistoryBtn);

        header.insertAdjacentElement('afterend', tabBar);
        form.insertAdjacentElement('afterend', historyPane);
        historyPane.insertAdjacentElement('afterend', historyFooter);

        let loadedOnce = false;

        function renderHistoryItems(items) {
          const listEl = document.getElementById('sisaprasLhList');
          const noteEl = document.getElementById('sisaprasLhNote');
          if (!listEl) return;
          listEl.innerHTML = '';

          if (!items || !items.length) {
            if (noteEl) noteEl.textContent = 'Belum ada aktivitas login tercatat.';
            const empty = document.createElement('div');
            empty.className = 'sisapras-lh-empty';
            empty.textContent = 'Belum ada catatan riwayat login pada akun Anda.';
            listEl.appendChild(empty);
            return;
          }

          if (noteEl) {
            noteEl.textContent = 'Menampilkan ' + items.length + ' aktivitas login terakhir.';
          }

          items.forEach(function(item) {
            const card = document.createElement('div');
            card.className = 'sisapras-lh-card';

            const top = document.createElement('div');
            top.className = 'sisapras-lh-top';

            const timeEl = document.createElement('div');
            timeEl.className = 'sisapras-lh-time';
            timeEl.textContent = item.logged_in_at || '-';

            const badge = document.createElement('span');
            badge.className = 'sisapras-lh-badge st-' + String(item.status || 'nonaktif').replace(/[^a-z0-9_]/gi, '');
            badge.textContent = item.status_label || item.status || '-';

            top.appendChild(timeEl);
            top.appendChild(badge);
            card.appendChild(top);

            const meta = document.createElement('div');
            meta.className = 'sisapras-lh-meta';

            const devSpan = document.createElement('span');
            devSpan.textContent = 'Perangkat: ' + (item.device_label || '-');

            const ipSpan = document.createElement('span');
            ipSpan.textContent = 'IP: ' + (item.ip_address || '-');

            const portalSpan = document.createElement('span');
            portalSpan.textContent = item.portal_label || '';

            meta.appendChild(devSpan);
            meta.appendChild(ipSpan);
            if (item.portal_label) meta.appendChild(portalSpan);
            card.appendChild(meta);

            if (item.notes) {
              const sub = document.createElement('div');
              sub.className = 'sisapras-lh-sub';
              sub.textContent = item.notes;
              card.appendChild(sub);
            }

            listEl.appendChild(card);
          });
        }

        function fetchMyLoginHistory() {
          const listEl = document.getElementById('sisaprasLhList');
          if (listEl) {
            listEl.innerHTML = '<div class="sisapras-lh-empty">Memuat riwayat login...</div>';
          }

          fetch('/account/login-history', {
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
          })
          .then(function(res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
          })
          .then(function(data) {
            loadedOnce = true;
            renderHistoryItems(data && data.items ? data.items : []);
          })
          .catch(function() {
            if (listEl) {
              listEl.innerHTML = '<div class="sisapras-lh-empty">Gagal memuat riwayat login. Klik Muat Ulang untuk mencoba lagi.</div>';
            }
          });
        }

        function switchProfileTab(tabName) {
          const isHistory = tabName === 'history';
          tabProfilBtn.classList.toggle('active', !isHistory);
          tabHistoryBtn.classList.toggle('active', isHistory);
          form.style.display = isHistory ? 'none' : '';
          historyPane.classList.toggle('active', isHistory);
          historyFooter.classList.toggle('active', isHistory);

          if (isHistory && !loadedOnce) {
            fetchMyLoginHistory();
          }
        }

        tabProfilBtn.addEventListener('click', function() {
          switchProfileTab('profil');
        });

        tabHistoryBtn.addEventListener('click', function() {
          switchProfileTab('history');
        });

        const refreshBtn = document.getElementById('sisaprasLhRefreshBtn');
        if (refreshBtn) {
          refreshBtn.addEventListener('click', fetchMyLoginHistory);
        }

        window.openMyLoginHistoryModal = function() {
          const dd = document.getElementById('userDropdown');
          if (dd) {
            dd.style.display = 'none';
            dd.classList.remove('active');
          }
          if (typeof window.openProfileModal === 'function') {
            window.openProfileModal();
          } else if (typeof window.openModal === 'function') {
            window.openModal('modalProfile');
          } else {
            modal.classList.add('active');
          }
          switchProfileTab('history');
          fetchMyLoginHistory();
        };

        // Tambahkan tombol pintas "Riwayat Login Saya" pada dropdown Kelola Akun
        const dropdownLinks = document.querySelector('#userDropdown .user-dropdown-links');
        if (dropdownLinks && !dropdownLinks.querySelector('[data-lh-shortcut="1"]')) {
          const firstBtn = dropdownLinks.querySelector('button.user-dropdown-btn');
          const shortcutBtn = document.createElement('button');
          shortcutBtn.type = 'button';
          shortcutBtn.className = 'user-dropdown-btn';
          shortcutBtn.setAttribute('data-lh-shortcut', '1');
          shortcutBtn.innerHTML =
            '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>' +
            '<span>Riwayat Login Saya</span>';
          shortcutBtn.addEventListener('click', function() {
            window.openMyLoginHistoryModal();
          });

          if (firstBtn && firstBtn.nextSibling) {
            dropdownLinks.insertBefore(shortcutBtn, firstBtn.nextSibling);
          } else {
            dropdownLinks.appendChild(shortcutBtn);
          }
        }
      })();
    });
  })();
</script>
