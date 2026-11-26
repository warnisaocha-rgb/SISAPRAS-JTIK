@if(isset($paginator) && $paginator->hasPages())
  @php
    $currentPage = $paginator->currentPage();
    $lastPage = $paginator->lastPage();
    $firstItem = $paginator->firstItem();
    $lastItem = $paginator->lastItem();
  @endphp
  <div class="sisapras-pagination-bar" style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:12px; margin-top:14px; padding:12px 16px; background:#FFFFFF; border:1px solid #E2E8F0; border-radius:10px; font-family:'Plus Jakarta Sans', sans-serif;">
    <div style="display:flex; flex-wrap:wrap; align-items:center; gap:10px; font-size:12px; color:#475569;">
      <span>
        @if($firstItem === $lastItem)
          Menampilkan <strong style="color:#0F172A;">{{ $firstItem }}</strong> dari <strong style="color:#0F172A;">{{ $paginator->total() }}</strong> data
        @else
          Menampilkan <strong style="color:#0F172A;">{{ $firstItem }}–{{ $lastItem }}</strong> dari <strong style="color:#0F172A;">{{ $paginator->total() }}</strong> data
        @endif
      </span>
    </div>

    <nav aria-label="Navigasi Halaman" style="display:flex; align-items:center; gap:4px; flex-wrap:wrap;">
      @if($paginator->onFirstPage())
        <span style="display:inline-flex; align-items:center; justify-content:center; min-width:30px; height:30px; padding:0 9px; border-radius:6px; border:1px solid #E2E8F0; background:#F8FAFC; color:#94A3B8; font-size:12px; font-weight:600;">&lsaquo;</span>
      @else
        <a href="{{ $paginator->previousPageUrl() }}" aria-label="Halaman sebelumnya" style="display:inline-flex; align-items:center; justify-content:center; min-width:30px; height:30px; padding:0 9px; border-radius:6px; border:1px solid #CBD5E1; background:#FFFFFF; color:#08296E; font-size:12px; font-weight:700; text-decoration:none;">&lsaquo;</a>
      @endif

      <span title="Halaman {{ $currentPage }} dari {{ $lastPage }}" aria-current="page" style="display:inline-flex; align-items:center; justify-content:center; min-width:30px; height:30px; padding:0 9px; border-radius:6px; border:1px solid #08296E; background:#08296E; color:#FFFFFF; font-size:12px; font-weight:700;">{{ $currentPage }}</span>

      @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" aria-label="Halaman berikutnya" style="display:inline-flex; align-items:center; justify-content:center; min-width:30px; height:30px; padding:0 9px; border-radius:6px; border:1px solid #CBD5E1; background:#FFFFFF; color:#08296E; font-size:12px; font-weight:700; text-decoration:none;">&rsaquo;</a>
      @endif
    </nav>
  </div>
@endif
