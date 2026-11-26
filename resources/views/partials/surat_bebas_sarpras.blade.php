@once
<style>
  .surat-draft-banner {
    background: #FEF3C7;
    border: 1px dashed #F59E0B;
    border-radius: 6px;
    padding: 9px 14px;
    margin-bottom: 14px;
    text-align: center;
    font-family: 'Plus Jakarta Sans', Arial, sans-serif;
  }
  .surat-draft-title {
    font-size: 11.5px;
    font-weight: 800;
    color: #B45309;
  }
  .surat-draft-sub {
    font-size: 10.5px;
    color: #92400E;
    margin-top: 2px;
  }
  .surat-verified-banner {
    background: #DCFCE7;
    border: 1px solid #86EFAC;
    border-radius: 6px;
    padding: 9px 14px;
    margin-bottom: 14px;
    text-align: center;
    font-family: 'Plus Jakarta Sans', Arial, sans-serif;
  }
  .official-letter {
    background: #FFFFFF;
    padding: 28px 36px;
    color: #000000;
    font-family: 'Times New Roman', Times, serif;
    line-height: 1.45;
    border: 1px solid #CBD5E1;
    border-radius: 6px;
    text-align: left;
  }
  .official-letterhead {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .official-letterhead-logo {
    width: 82px;
    height: 82px;
    object-fit: contain;
    flex-shrink: 0;
  }
  .official-letterhead-text {
    flex: 1;
    text-align: center;
    color: #000000;
  }
  .official-letterhead-text .kop-ministry,
  .official-letterhead-text .kop-univ,
  .official-letterhead-text .kop-fakultas {
    font-size: 11.5pt;
    font-weight: normal;
    line-height: 1.22;
    margin: 0;
    text-transform: uppercase;
  }
  .official-letterhead-text .kop-jurusan {
    font-size: 12pt;
    font-weight: bold;
    line-height: 1.25;
    margin: 1px 0 2px 0;
    text-transform: uppercase;
  }
  .official-letterhead-text .kop-addr {
    font-size: 8.5pt;
    font-weight: normal;
    line-height: 1.25;
    margin: 0;
  }
  .official-letterhead-text .kop-contact {
    font-size: 8pt;
    font-weight: normal;
    line-height: 1.25;
    margin: 0;
  }
  .official-letterhead-rule {
    border-top: 2px solid #000000;
    border-bottom: 1px solid #000000;
    height: 2px;
    margin: 7px 0 14px 0;
  }
  .official-letter-title-wrap {
    text-align: center;
    margin: 10px 0 14px 0;
  }
  .official-letter-title {
    font-size: 12pt;
    font-weight: bold;
    text-decoration: underline;
    text-underline-offset: 2px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }
  .official-letter-nomor {
    font-size: 10.5pt;
    margin-top: 2px;
  }
  .official-letter-body {
    font-size: 10.5pt;
    line-height: 1.45;
    text-align: left;
  }
  .official-letter-body p {
    margin: 0 0 8px 0;
    text-align: left;
  }
  .official-meta-table {
    width: 100%;
    border-collapse: collapse;
    margin: 8px 0 12px 18px;
    font-size: 10.5pt;
    text-align: left;
  }
  .official-meta-table td {
    padding: 2px 0;
    vertical-align: top;
    text-align: left;
  }
  .official-meta-table td.meta-label {
    width: 130px;
    white-space: nowrap;
  }
  .official-meta-table td.meta-colon {
    width: 14px;
    text-align: center;
  }
  .official-unit-table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0 14px 0;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
  }
  .official-unit-table th,
  .official-unit-table td {
    border: 1px solid #000000;
    padding: 5px 8px;
    text-align: left;
    vertical-align: middle;
  }
  .official-unit-table th {
    background: #F3F4F6;
    font-weight: bold;
  }
  .official-signature-wrap {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
    font-size: 10.5pt;
    line-height: 1.38;
  }
  .official-signature-box {
    width: 260px;
    text-align: left;
  }
  .official-signature-qr {
    margin: 8px 0 6px 0;
  }
  .official-signature-draft {
    margin: 10px 0 8px 0;
    padding: 10px 12px;
    border: 1px dashed #CBD5E1;
    border-radius: 4px;
    font-family: 'Plus Jakarta Sans', Arial, sans-serif;
    font-size: 9px;
    font-weight: 700;
    color: #94A3B8;
    text-align: center;
    width: 170px;
  }
  @media screen and (max-width: 600px) {
    .official-letter {
      padding: 16px 12px;
      font-size: 9.5pt;
    }
    .official-letterhead {
      flex-direction: column;
      text-align: center;
      gap: 6px;
    }
    .official-letterhead-logo {
      width: 56px;
      height: 56px;
    }
    .official-letterhead-text .kop-ministry,
    .official-letterhead-text .kop-univ,
    .official-letterhead-text .kop-fakultas {
      font-size: 9.5pt;
    }
    .official-letterhead-text .kop-jurusan {
      font-size: 10pt;
    }
    .official-letterhead-text .kop-addr,
    .official-letterhead-text .kop-contact {
      font-size: 7.5pt;
    }
    .official-letter-title {
      font-size: 10.5pt;
    }
    .official-letter-nomor,
    .official-letter-body,
    .official-meta-table,
    .official-signature-wrap {
      font-size: 9.5pt;
    }
    .official-meta-table {
      margin-left: 0;
      width: 100%;
    }
    .official-meta-table td {
      word-break: break-word;
    }
    .official-meta-table td.meta-label {
      width: 88px;
    }
    .official-signature-wrap {
      justify-content: flex-start;
    }
    .official-signature-box {
      width: 100%;
    }
  }
  @media print {
    .no-print {
      display: none !important;
    }
    .official-letter {
      border: none !important;
      border-radius: 0 !important;
      padding: 0 !important;
    }
  }
</style>
@endonce

@php
  $stLabKomputer = $bebasPinjam->status_lab_komputer ?? 'belum_cek';
  $stLabJaringan = $bebasPinjam->status_lab_jaringan ?? 'belum_cek';
  $stRuangInv = $bebasPinjam->status_ruang_inventaris ?? 'belum_cek';
  $isAllBebas = ($stLabKomputer === 'bebas' && $stLabJaringan === 'bebas' && $stRuangInv === 'bebas');
  $kodePengajuan = $bebasPinjam->kode_pengajuan ?? ('BP-' . date('Y') . '-0001');
  $tahunSurat = date('Y');
  $tglSuratIndo = \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y');
  $keperluanSurat = $bebasPinjam->keperluan ?? 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM';
  $namaMahasiswa = Auth::user()->name ?? '-';
  $nimMahasiswa = Auth::user()->nomor_induk ?? '-';
  $prodiText = Auth::user()->program_studi ?? '-';
  $kelasText = Auth::user()->nama_kelas ?? '';
@endphp

@if($isAllBebas)
  <div class="surat-verified-banner no-print">
    <div style="font-size: 11.5px; font-weight: 800; color: #15803D;">TERVERIFIKASI BEBAS TANGGUNGAN LENGKAP (3/3 UNIT)</div>
    <div style="font-size: 10.5px; color: #166534; margin-top: 2px;">Surat resmi di bawah ini siap dicetak atau disimpan sebagai PDF.</div>
  </div>
@else
  <div class="surat-draft-banner no-print">
    <div class="surat-draft-title">PRATINJAU DRAFT SURAT — VERIFIKASI UNIT BELUM LENGKAP</div>
    <div class="surat-draft-sub">Surat resmi baru dapat dicetak dan disahkan setelah seluruh unit (Laboratorium, Administrasi, dan Bengkel IT) menyatakan <strong>BEBAS</strong>.</div>
  </div>
@endif

<div class="official-letter">
  <div class="official-letterhead">
    <img src="{{ asset('images/logo-unm-black.png') }}" onerror="this.src='{{ asset('images/logo-unm-white.png') }}'" alt="Logo UNM" class="official-letterhead-logo">
    <div class="official-letterhead-text">
      <div class="kop-ministry">KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</div>
      <div class="kop-univ">UNIVERSITAS NEGERI MAKASSAR</div>
      <div class="kop-fakultas">FAKULTAS TEKNIK</div>
      <div class="kop-jurusan">JURUSAN TEKNIK INFORMATIKA DAN KOMPUTER</div>
      <div class="kop-addr">Alamat: JL. Daeng Tata Raya Parangtambung Makassar - 90224</div>
      <div class="kop-contact">Telp. 0411-864935, Fax. 0411 - 861507, HP. 0853-1122-4040, Email: jtik@unm.ac.id | Laman tik.ft.unm.ac.id</div>
    </div>
  </div>
  <div class="official-letterhead-rule"></div>

  <div class="official-letter-title-wrap">
    <div class="official-letter-title">SURAT KETERANGAN BEBAS SARANA PRASARANA</div>
    <div class="official-letter-nomor">Nomor: {{ $kodePengajuan }}/UN36.2/JTIK/{{ $tahunSurat }}</div>
  </div>

  <div class="official-letter-body">
    <p>Ketua Jurusan Teknik Informatika dan Komputer Fakultas Teknik Universitas Negeri Makassar menerangkan bahwa:</p>

    <table class="official-meta-table">
      <tr>
        <td class="meta-label">Nama</td>
        <td class="meta-colon">:</td>
        <td><strong>{{ $namaMahasiswa }}</strong></td>
      </tr>
      <tr>
        <td class="meta-label">NIM</td>
        <td class="meta-colon">:</td>
        <td>{{ $nimMahasiswa }}</td>
      </tr>
      <tr>
        <td class="meta-label">Program Studi</td>
        <td class="meta-colon">:</td>
        <td>{{ $prodiText }}{{ $kelasText !== '' ? ' (' . $kelasText . ')' : '' }}</td>
      </tr>
      <tr>
        <td class="meta-label">Keperluan</td>
        <td class="meta-colon">:</td>
        <td>{{ $keperluanSurat }}</td>
      </tr>
    </table>

    @if($isAllBebas)
      <p>Berdasarkan hasil pemeriksaan layanan sarana prasarana jurusan, mahasiswa tersebut di atas telah dinyatakan <strong>BEBAS TANGGUNGAN</strong> peminjaman alat, komponen, dan modul praktikum pada unit-unit berikut:</p>
    @else
      <p>Berdasarkan data layanan sarana prasarana jurusan, mahasiswa tersebut di atas saat ini masih berada dalam proses pengecekan tanggungan peminjaman alat, komponen, dan modul praktikum pada unit-unit berikut:</p>
    @endif

    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
    <table class="official-unit-table">
      <thead>
        <tr>
          <th style="width: 36px; text-align: center;">No.</th>
          <th>Unit Laboratorium / Fasilitas</th>
          <th style="width: 115px; text-align: center;">Status</th>
          <th style="width: 175px;">Pemeriksa</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align: center;">1.</td>
          <td>Laboratorium</td>
          <td style="text-align: center; font-weight: bold;">
            @if($stLabKomputer === 'bebas')
              <span style="color: #15803D;">Bebas</span>
            @elseif($stLabKomputer === 'tertahan')
              <span style="color: #DC2626;">Tertahan</span>
            @else
              <span style="color: #B45309;">Belum Dicek</span>
            @endif
          </td>
          <td>
            @if($stLabKomputer === 'bebas')
              {{ $bebasPinjam->petugas_lab_komputer ?? 'Laboran' }}
            @elseif($stLabKomputer === 'tertahan')
              <span style="color: #DC2626;">{{ $bebasPinjam->petugas_lab_komputer ?? 'Laboran' }} (Ada Tanggungan)</span>
            @else
              <span style="color: #64748B; font-style: italic;">Menunggu pemeriksaan</span>
            @endif
          </td>
        </tr>
        <tr>
          <td style="text-align: center;">2.</td>
          <td>Administrasi</td>
          <td style="text-align: center; font-weight: bold;">
            @if($stLabJaringan === 'bebas')
              <span style="color: #15803D;">Bebas</span>
            @elseif($stLabJaringan === 'tertahan')
              <span style="color: #DC2626;">Tertahan</span>
            @else
              <span style="color: #B45309;">Belum Dicek</span>
            @endif
          </td>
          <td>
            @if($stLabJaringan === 'bebas')
              {{ $bebasPinjam->petugas_lab_jaringan ?? 'Administrasi' }}
            @elseif($stLabJaringan === 'tertahan')
              <span style="color: #DC2626;">{{ $bebasPinjam->petugas_lab_jaringan ?? 'Administrasi' }} (Ada Tanggungan)</span>
            @else
              <span style="color: #64748B; font-style: italic;">Menunggu pemeriksaan</span>
            @endif
          </td>
        </tr>
        <tr>
          <td style="text-align: center;">3.</td>
          <td>Bengkel IT</td>
          <td style="text-align: center; font-weight: bold;">
            @if($stRuangInv === 'bebas')
              <span style="color: #15803D;">Bebas</span>
            @elseif($stRuangInv === 'tertahan')
              <span style="color: #DC2626;">Tertahan</span>
            @else
              <span style="color: #B45309;">Belum Dicek</span>
            @endif
          </td>
          <td>
            @if($stRuangInv === 'bebas')
              {{ $bebasPinjam->petugas_ruang_inventaris ?? 'Kepala Bengkel IT' }}
            @elseif($stRuangInv === 'tertahan')
              <span style="color: #DC2626;">{{ $bebasPinjam->petugas_ruang_inventaris ?? 'Kepala Bengkel IT' }} (Ada Tanggungan)</span>
            @else
              <span style="color: #64748B; font-style: italic;">Menunggu pemeriksaan</span>
            @endif
          </td>
        </tr>
      </tbody>
    </table>
    </div>

    <p>Demikian surat keterangan ini diberikan untuk dipergunakan sebagaimana mestinya.</p>
  </div>

  <div class="official-signature-wrap">
    <div class="official-signature-box">
      <div>Makassar, {{ $tglSuratIndo }}</div>
      <div>Ketua Jurusan,</div>
      <div>Teknik Informatika dan Komputer</div>

      @if($isAllBebas)
        <div class="official-signature-qr">
          {!! \App\Models\BebasPinjam::makeQrSvg("SAH|{$kodePengajuan}|{$nimMahasiswa}|JTIK-UNM", 74) !!}
        </div>
      @else
        <div class="official-signature-draft">Menunggu Pengesahan Lengkap</div>
      @endif

      <div style="font-weight: bold;">Dr. Ir. Mustari S. Lamada, S.Pd. M.T.</div>
      <div>NIP 19750505 200501 1 001</div>
    </div>
  </div>
</div>
