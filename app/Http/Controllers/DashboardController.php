<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Sarpras;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\BebasPinjam;
use App\Models\LoginHistory;

class DashboardController extends Controller
{
    private function normalizeSearchText(string $text): string
    {
        return strtr(mb_strtolower($text, 'UTF-8'), [
            'c' => 'k',
            'q' => 'k',
            'v' => 'f',
            'z' => 's',
        ]);
    }

    private function isSubsequenceInWord(string $needle, string $haystack): bool
    {
        $nLen = strlen($needle);
        $hLen = strlen($haystack);
        if ($nLen < 2 || $hLen < $nLen || $needle[0] !== $haystack[0]) {
            return false;
        }
        $i = 0;
        for ($j = 0; $j < $hLen && $i < $nLen; $j++) {
            if ($haystack[$j] === $needle[$i]) {
                $i++;
            }
        }
        return $i === $nLen;
    }

    private function matchesAllSearchTokens(string $haystack, array $tokens): bool
    {
        $normHaystack = $this->normalizeSearchText($haystack);
        $normWords = preg_split('/[^a-z0-9]+/', $normHaystack, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        foreach ($tokens as $rawToken) {
            $token = $this->normalizeSearchText($rawToken);
            if ($token === '') {
                continue;
            }
            if (str_contains($normHaystack, $token)) {
                continue;
            }

            $tokenMatched = false;
            $tLen = strlen($token);
            $maxDist = $tLen <= 6 ? 1 : 2;

            foreach ($normWords as $word) {
                $wLen = strlen($word);
                if (str_contains($word, $token)) {
                    $tokenMatched = true;
                    break;
                }
                if ($tLen >= 3 && $wLen <= max(6, $tLen * 3) && $this->isSubsequenceInWord($token, $word)) {
                    $tokenMatched = true;
                    break;
                }
                if ($tLen >= 4 && $wLen >= 3 && $tLen <= 255 && $wLen <= 255 && abs($tLen - $wLen) <= $maxDist && levenshtein($token, $word) <= $maxDist) {
                    $tokenMatched = true;
                    break;
                }
            }

            if (!$tokenMatched) {
                return false;
            }
        }

        return true;
    }

    private function applyFlexibleSearch($query, ?string $search, array $columns, array $relations = []): void
    {
        $search = trim((string) $search);
        if ($search === '') {
            return;
        }

        $tokens = preg_split('/\s+/u', $search, -1, PREG_SPLIT_NO_EMPTY);
        if (empty($tokens)) {
            return;
        }

        $applyTokenSql = function ($targetQuery) use ($tokens, $columns, $relations) {
            foreach ($tokens as $token) {
                $escaped = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $token);
                $like = '%' . $escaped . '%';
                $targetQuery->where(function ($q) use ($like, $columns, $relations) {
                    foreach ($columns as $col) {
                        $q->orWhere($col, 'like', $like);
                    }
                    foreach ($relations as $rel => $relCols) {
                        $q->orWhereHas($rel, function ($rq) use ($like, $relCols) {
                            $rq->where(function ($sub) use ($like, $relCols) {
                                foreach ($relCols as $rCol) {
                                    $sub->orWhere($rCol, 'like', $like);
                                }
                            });
                        });
                    }
                });
            }
        };

        $strictQuery = clone $query;
        $applyTokenSql($strictQuery);

        if ((clone $strictQuery)->exists()) {
            $applyTokenSql($query);
            return;
        }

        $candidates = !empty($relations)
            ? (clone $query)->with(array_keys($relations))->get()
            : (clone $query)->get();

        $matchedIds = [];
        foreach ($candidates as $row) {
            $parts = [];
            foreach ($columns as $col) {
                $val = $row->{$col} ?? '';
                if ($val !== '' && $val !== null) {
                    $parts[] = (string) $val;
                }
            }
            foreach ($relations as $rel => $relCols) {
                $relModel = data_get($row, $rel);
                if ($relModel) {
                    foreach ($relCols as $rCol) {
                        $val = data_get($relModel, $rCol, '');
                        if ($val !== '' && $val !== null) {
                            $parts[] = (string) $val;
                        }
                    }
                }
            }

            if ($this->matchesAllSearchTokens(implode(' ', $parts), $tokens)) {
                $matchedIds[] = $row->id;
            }
        }

        $query->whereIn($query->getModel()->qualifyColumn('id'), !empty($matchedIds) ? $matchedIds : [-1]);
    }

    // 1. Dashboard Mahasiswa (Tampilan Sesuai Gambar Referensi 1)
    public function mahasiswa()
    {
        $user = Auth::user();

        // 4 Statistik Utama (khusus Alat & Bahan)
        $alatBase = Sarpras::where(function ($q) {
            $q->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
        });
        $totalBarang = (int) (clone $alatBase)->sum('jumlah_total');
        $tersedia = (int) (clone $alatBase)->sum('jumlah_tersedia');
        $dipinjam = (int) Peminjaman::whereHas('sarpras', function ($sq) {
            $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
        })->whereIn('status', ['sedang_dipinjam', 'disetujui'])->sum('jumlah');
        // Unit dalam perbaikan / rusak dihitung dari selisih atau kondisi
        $rusak = max(0, $totalBarang - $tersedia - $dipinjam);

        // Transaksi / Aktivitas Terakhir Mahasiswa yang sedang login
        $rawPeminjamans = Peminjaman::with(['sarpras.ruangan'])
            ->where('user_id', $user->id)
            ->whereHas('sarpras', function ($sq) {
                $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            })
            ->where(function ($q) {
                $q->whereNull('keperluan')->orWhere('keperluan', 'not like', '%[Relokasi:%');
            })
            ->latest()
            ->get();

        // Fallback untuk akun baru agar tabel tetap menampilkan contoh aktivitas
        if ($rawPeminjamans->isEmpty()) {
            $rawPeminjamans = Peminjaman::with(['sarpras.ruangan'])
                ->whereHas('sarpras', function ($sq) {
                    $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
                })
                ->where(function ($q) {
                    $q->whereNull('keperluan')->orWhere('keperluan', 'not like', '%[Relokasi:%');
                })
                ->latest()
                ->take(5)
                ->get();
        }

        $peminjamans = $this->groupMahasiswaTickets($rawPeminjamans);

        // Sarpras untuk formulir peminjaman alat & bahan (stok tersedia > 0)
        $sarprasAlatBahan = Sarpras::with(['ruangan'])
            ->where(function ($q) {
                $q->where('jenis_sarpras', 'alat_bahan')
                  ->orWhereNull('jenis_sarpras');
            })
            ->where('kondisi', '!=', 'rusak')
            ->orderBy('nama_sarpras')
            ->get();

        // Daftar ruangan operasional alat & bahan
        $daftarRuangan = Ruangan::where('jenis_ruangan', 'alat_bahan')->orderBy('nama_ruangan')->get();

        // Peminjaman aktif mahasiswa yang bisa diajukan pengembalian fisik (yang belum mengajukan pengembalian)
        $pinjamanAktif = Peminjaman::with(['sarpras.ruangan'])
            ->where('user_id', $user->id)
            ->whereHas('sarpras', function ($sq) {
                $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            })
            ->whereIn('status', ['sedang_dipinjam', 'disetujui'])
            ->where(function ($q) {
                $q->whereNull('status_pengembalian')
                  ->orWhereNotIn('status_pengembalian', ['menunggu_cek_fisik', 'selesai_diterima']);
            })
            ->latest()
            ->get();

        // Data status bebas sarpras mahasiswa
        $bebasPinjam = BebasPinjam::where('user_id', $user->id)->latest()->first();

        // Hitungan untuk notifikasi / lencana navigasi
        $pinjamanAktifCount = $pinjamanAktif->count();
        $menungguAccCount = $peminjamans->whereIn('status', ['menunggu_verifikasi', 'diproses_sebagian'])->count();

        return view('dashboard.mahasiswa', compact(
            'user',
            'totalBarang',
            'tersedia',
            'dipinjam',
            'rusak',
            'peminjamans',
            'sarprasAlatBahan',
            'daftarRuangan',
            'pinjamanAktif',
            'bebasPinjam',
            'pinjamanAktifCount',
            'menungguAccCount'
        ));
    }

    /**
     * Simpan Pengajuan Peminjaman Alat & Bahan oleh Mahasiswa
     */
    public function storeMahasiswaPeminjaman(Request $request)
    {
        $request->validate([
            'sarpras_id' => 'required|exists:sarpras,id',
            'jumlah' => 'required|integer|min:1',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali_rencana' => 'required|date|after_or_equal:tgl_pinjam',
            'keperluan' => 'required|string|max:1000',
            'dosen_penanggung_jawab' => 'required|string|max:255',
            'waktu_keterangan' => 'nullable|string|max:255',
        ], [
            'sarpras_id.required' => 'Pilih alat atau bahan yang ingin dipinjam.',
            'jumlah.required' => 'Jumlah barang wajib diisi minimal 1 unit.',
            'tgl_pinjam.required' => 'Tanggal pinjam wajib ditentukan.',
            'tgl_kembali_rencana.required' => 'Tanggal rencana pengembalian wajib diisi.',
            'tgl_kembali_rencana.after_or_equal' => 'Tanggal rencana pengembalian tidak boleh sebelum tanggal pinjam.',
            'keperluan.required' => 'Uraian keperluan peminjaman wajib diisi.',
            'dosen_penanggung_jawab.required' => 'Nama dosen penanggung jawab wajib diisi.',
        ]);

        // Validasi batas maksimal durasi peminjaman: 3 hari dari tanggal pinjam
        $tglPinjamDt = \Carbon\Carbon::parse($request->tgl_pinjam)->startOfDay();
        $tglKembaliDt = \Carbon\Carbon::parse($request->tgl_kembali_rencana)->startOfDay();
        if ($tglPinjamDt->diffInDays($tglKembaliDt, false) > 3) {
            return redirect()->back()
                ->withErrors(['tgl_kembali_rencana' => 'Durasi peminjaman maksimal 3 hari dari tanggal pinjam.'])
                ->with('error', 'Durasi peminjaman maksimal 3 hari dari tanggal pinjam.')
                ->withInput();
        }

        // Update data kelas_id mahasiswa jika diubah pada formulir pinjam langsung
        $selectedClass = $request->input('kelas_id') ?? $request->input('kelas') ?? $request->input('jurusan');
        if (!empty($selectedClass)) {
            $resolvedKelas = \App\Models\Kelas::resolveFromInput($selectedClass);
            if ($resolvedKelas) {
                Auth::user()->update(['kelas_id' => $resolvedKelas->id]);
            }
        }

        $sarpras = Sarpras::findOrFail($request->sarpras_id);

        if ($request->jumlah > $sarpras->jumlah_tersedia) {
            return redirect()->back()->with('error', "Stok sarpras {$sarpras->nama_sarpras} tidak mencukupi (Sisa tersedia: {$sarpras->jumlah_tersedia} Unit).");
        }

        if ($sarpras->maks_pinjam && $request->jumlah > $sarpras->maks_pinjam) {
            return redirect()->back()->with('error', "Jumlah peminjaman melebihi batas maksimal ({$sarpras->maks_pinjam} Unit per mahasiswa).");
        }

        $latestId = Peminjaman::max('id') + 1;
        $kode = 'TRX-' . date('Y') . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);
        while (Peminjaman::where('kode_peminjaman', $kode)->exists()) {
            $latestId++;
            $kode = 'TRX-' . date('Y') . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);
        }

        $waktuKet = trim($request->waktu_keterangan ?? '');
        if (!empty($waktuKet)) {
            if (preg_match('/\((.*?)\)/', $waktuKet, $matches)) {
                $waktuKet = trim($matches[1]);
            } else {
                $waktuKet = trim(preg_replace('/^\d{1,4}[\/\-\.]\d{1,2}[\/\-\.]\d{1,4}\s*/', '', $waktuKet));
            }
        }
        if (empty($waktuKet)) {
            $waktuKet = date('H:i', strtotime($request->tgl_pinjam)) . ' WITA';
        }
        if (!preg_match('/WITA|WIB|WIT/i', $waktuKet)) {
            $waktuKet .= ' WITA';
        }

        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => $kode,
            'user_id' => Auth::id(),
            'sarpras_id' => $sarpras->id,
            'jumlah' => $request->jumlah,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
            'waktu_keterangan' => $waktuKet,
            'keperluan' => $request->keperluan,
            'dosen_penanggung_jawab' => trim($request->dosen_penanggung_jawab),
            'status' => 'menunggu_verifikasi',
        ]);

        return redirect()->route('mahasiswa.status-pinjam')
            ->with('success', "Permohonan pinjam sarpras {$sarpras->nama_sarpras} ({$kode}) berhasil dikirim ke pengelola untuk diverifikasi!");
    }

    /**
     * Simpan Pengajuan Peminjaman Serentak (Batch / Keranjang) oleh Mahasiswa
     * Mendukung peminjaman banyak alat & bahan praktikum sekaligus dalam 1 tiket
     */
    public function storeMahasiswaPeminjamanBatch(Request $request)
    {
        $request->validate([
            'dosen_penanggung_jawab' => 'required|string|max:255',
            'keperluan' => 'required|string|max:1000',
        ], [
            'dosen_penanggung_jawab.required' => 'Nama dosen penanggung jawab wajib diisi.',
            'keperluan.required' => 'Alasan / keperluan peminjaman wajib diisi.',
        ]);

        $user = Auth::user();

        // Update data kelas_id mahasiswa jika disertakan
        $selectedClass = $request->input('kelas_id') ?? $request->input('kelas') ?? $request->input('jurusan');
        if (!empty($selectedClass)) {
            $resolvedKelas = \App\Models\Kelas::resolveFromInput($selectedClass);
            if ($resolvedKelas) {
                $user->update(['kelas_id' => $resolvedKelas->id]);
            }
        }

        $itemsJson = $request->input('cart_items');
        $items = is_array($itemsJson) ? $itemsJson : json_decode($itemsJson, true);
        if (!is_array($items)) {
            $items = [];
        }

        $keperluanAlat = $request->input('keperluan', 'Praktikum dan tugas akhir di lingkungan Jurusan JTIK FT UNM');
        $rawJadwal = trim($request->input('jadwal_penggunaan', '08:00 - 15:00 WITA'));
        if (preg_match('/\((.*?)\)/', $rawJadwal, $m)) {
            $jadwalKeterangan = trim($m[1]);
        } else {
            $jadwalKeterangan = trim(preg_replace('/^\d{1,4}[\/\-\.]\d{1,2}[\/\-\.]\d{1,4}\s*/', '', $rawJadwal));
        }
        if (empty($jadwalKeterangan)) {
            $jadwalKeterangan = '08:00 - 15:00 WITA';
        }
        if (!preg_match('/WITA|WIB|WIT/i', $jadwalKeterangan)) {
            $jadwalKeterangan .= ' WITA';
        }
        $tglPinjam = now()->format('Y-m-d 08:00:00');
        $tglKembali = now()->addDays(1)->format('Y-m-d 16:00:00');

        if (empty($items)) {
            return redirect()->back()->with('error', 'Keranjang peminjaman masih kosong. Pilih alat atau bahan praktikum terlebih dahulu.');
        }

        // 1 CHECKOUT SESSION = TEPAT 1 NOMOR TIKET (KODE PEMINJAMAN)
        $latestId = Peminjaman::max('id') + 1;
        $kodeTiket = 'TRX-' . date('Y') . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);
        while (Peminjaman::where('kode_peminjaman', $kodeTiket)->exists()) {
            $latestId++;
            $kodeTiket = 'TRX-' . date('Y') . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);
        }

        $itemNames = [];

        DB::beginTransaction();
        try {
            // Simpan seluruh item alat & bahan praktikum dengan tiket tunggal
            foreach ($items as $item) {
                $sarprasId = $item['id'] ?? $item['sarpras_id'] ?? null;
                $qty = (int) ($item['jumlah'] ?? 1);
                if (!$sarprasId || $qty < 1) continue;

                $sarpras = Sarpras::find($sarprasId);
                if (!$sarpras) continue;

                Peminjaman::create([
                    'kode_peminjaman' => $kodeTiket,
                    'user_id' => $user->id,
                    'sarpras_id' => $sarpras->id,
                    'jumlah' => $qty,
                    'tgl_pinjam' => $tglPinjam,
                    'tgl_kembali_rencana' => $tglKembali,
                    'waktu_keterangan' => $jadwalKeterangan,
                    'keperluan' => $keperluanAlat ?: 'Praktikum dan tugas akhir di lingkungan Jurusan JTIK FT UNM',
                    'dosen_penanggung_jawab' => trim($request->input('dosen_penanggung_jawab')),
                    'status' => 'menunggu_verifikasi',
                    'status_pengembalian' => 'belum_kembali',
                ]);

                $itemNames[] = $sarpras->nama_sarpras;
            }

            DB::commit();

            return redirect()->route('mahasiswa.status-pinjam')
                ->with('success', "Formulir Pengajuan Pinjam berhasil dikirim untuk diverifikasi! Nomor Tiket: {$kodeTiket} (" . count($itemNames) . " Barang)")
                ->with('clear_cart', true);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pengajuan pinjam: ' . $e->getMessage());
        }
    }

    /**
     * Konfirmasi Pengembalian Fisik Barang oleh Mahasiswa
     */
    public function storeMahasiswaPengembalian(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'catatan_kondisi_kembali' => 'required|string|max:1000',
            'foto_sebelum' => 'nullable|image|max:3072',
            'foto_sesudah' => 'nullable|image|max:3072',
        ], [
            'peminjaman_id.required' => 'Pilih transaksi peminjaman yang ingin dikembalikan.',
            'catatan_kondisi_kembali.required' => 'Catatan kondisi fisik barang saat diserahkan wajib diisi.',
        ]);

        $peminjaman = Peminjaman::where('user_id', Auth::id())
            ->whereIn('status', ['sedang_dipinjam', 'disetujui'])
            ->findOrFail($request->peminjaman_id);

        $fotoSebelumPath = null;
        if ($request->hasFile('foto_sebelum')) {
            $fotoSebelumPath = $request->file('foto_sebelum')->store('pengembalian', 'public');
        }

        $fotoPath = null;
        if ($request->hasFile('foto_sesudah')) {
            $fotoPath = $request->file('foto_sesudah')->store('pengembalian', 'public');
        }

        $updateData = [
            'status_pengembalian' => 'menunggu_cek_fisik',
            'catatan_kondisi_kembali' => $request->catatan_kondisi_kembali,
            'foto_sesudah' => $fotoPath ?? $peminjaman->foto_sesudah,
        ];
        if ($fotoSebelumPath) {
            $updateData['foto_sebelum'] = $fotoSebelumPath;
        }

        $peminjaman->update($updateData);

        return redirect()->route('mahasiswa.pengembalian')
            ->with('success', "Konfirmasi pengembalian tiket {$peminjaman->kode_peminjaman} berhasil dikirim! Silakan bawa barang fisik ke Laboran/Pengelola untuk pemeriksaan akhir.");
    }

    /**
     * Batalkan Permohonan Peminjaman yang Masih Menunggu Verifikasi
     */
    public function batalMahasiswaPeminjaman($id)
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())
            ->whereIn('status', ['menunggu_verifikasi', 'menunggu_acc', 'menunggu'])
            ->findOrFail($id);

        $kode = $peminjaman->kode_peminjaman;
        Peminjaman::where('user_id', Auth::id())
            ->where('kode_peminjaman', $kode)
            ->whereIn('status', ['menunggu_verifikasi', 'menunggu_acc', 'menunggu'])
            ->delete();

        return redirect()->route('mahasiswa.status-pinjam')
            ->with('success', "Permohonan peminjaman tiket {$kode} berhasil dibatalkan.");
    }

    /**
     * Bersihkan catatan pengelola dari placeholder kosong (seperti "Catatan: ,," atau tanda baca saja)
     */
    private function sanitizeManagerNote(?string $rawNote): string
    {
        $raw = trim((string) $rawNote);
        if ($raw === '') {
            return '';
        }

        if (str_contains($raw, '|')) {
            $cleanParts = [];
            foreach (explode('|', $raw) as $part) {
                $part = trim($part);
                if ($part === '') {
                    continue;
                }
                if (preg_match('/^([^:]+):(.*)$/s', $part, $m)) {
                    $label = trim($m[1]);
                    $val = trim($m[2]);
                    if (trim($val, " \t\n\r\0\x0B,-.") === '') {
                        continue;
                    }
                    $cleanParts[] = "{$label}: {$val}";
                } else {
                    if (trim($part, " \t\n\r\0\x0B,-.") === '') {
                        continue;
                    }
                    $cleanParts[] = $part;
                }
            }
            return implode(' | ', $cleanParts);
        }

        if (preg_match('/^Catatan:(.*)$/is', $raw, $m)) {
            $val = trim($m[1]);
            return trim($val, " \t\n\r\0\x0B,-.") === '' ? '' : "Catatan: {$val}";
        }

        return trim($raw, " \t\n\r\0\x0B,-.") === '' ? '' : $raw;
    }

    /**
     * Satukan peminjaman mahasiswa per kode_peminjaman (1 Tiket = 1 Baris di Tabel Mahasiswa)
     */
    private function groupMahasiswaTickets($rawItems)
    {
        return $rawItems->groupBy('kode_peminjaman')->map(function ($items) {
            $items = $items->values();
            foreach ($items as $it) {
                $cleanNote = $this->sanitizeManagerNote($it->catatan_pengelola);
                $it->clean_catatan = $cleanNote;
                $it->catatan_pengelola = $cleanNote !== '' ? $cleanNote : null;
                $it->room_name = optional(optional($it->sarpras)->ruangan)->nama_ruangan ?? 'Laboratorium JTIK';
            }

            $totalCount = $items->count();
            $pendingItems = $items->where('status', 'menunggu_verifikasi');
            $readyApprovedItems = $items->where('status', 'disetujui');
            $borrowedItems = $items->where('status', 'sedang_dipinjam');
            $finishedItems = $items->where('status', 'selesai');
            $rejectedItems = $items->where('status', 'ditolak');
            $activeApprovedItems = $items->whereIn('status', ['disetujui', 'sedang_dipinjam']);
            $nonRejectedApprovedItems = $items->whereIn('status', ['disetujui', 'sedang_dipinjam', 'selesai']);

            $ticket = clone $items->first();
            $ticket->ticket_items = $items;
            $ticket->total_items_count = $totalCount;
            $ticket->total_units_sum = (int) $items->sum('jumlah');
            $ticket->approved_items_count = $nonRejectedApprovedItems->count();
            $ticket->active_approved_items_count = $activeApprovedItems->count();
            $ticket->borrowed_items_count = $borrowedItems->count();
            $ticket->ready_items_count = $readyApprovedItems->count();
            $ticket->finished_items_count = $finishedItems->count();
            $ticket->rejected_items_count = $rejectedItems->count();
            $ticket->pending_items_count = $pendingItems->count();
            $ticket->approved_units_sum = (int) $nonRejectedApprovedItems->sum('jumlah');
            $ticket->active_approved_units_sum = (int) $activeApprovedItems->sum('jumlah');
            $ticket->rejected_units_sum = (int) $rejectedItems->sum('jumlah');
            $ticket->pending_units_sum = (int) $pendingItems->sum('jumlah');
            $ticket->rooms_summary = $items->pluck('room_name')->unique()->values()->implode(', ');

            if ($pendingItems->isNotEmpty()) {
                $ticket->status = ($pendingItems->count() === $totalCount)
                    ? 'menunggu_verifikasi'
                    : 'diproses_sebagian';
            } elseif ($borrowedItems->isNotEmpty()) {
                $ticket->status = $rejectedItems->isNotEmpty()
                    ? 'disetujui_sebagian'
                    : 'sedang_dipinjam';
            } elseif ($readyApprovedItems->isNotEmpty()) {
                $ticket->status = $rejectedItems->isNotEmpty()
                    ? 'disetujui_sebagian'
                    : 'disetujui';
            } elseif ($finishedItems->isNotEmpty()) {
                $ticket->status = 'selesai';
            } elseif ($rejectedItems->isNotEmpty()) {
                $ticket->status = 'ditolak';
            }

            $breakdownParts = [];
            if ($borrowedItems->count() > 0) {
                $breakdownParts[] = $borrowedItems->count() . ' dipinjam';
            }
            if ($readyApprovedItems->count() > 0) {
                $breakdownParts[] = $readyApprovedItems->count() . ' disetujui';
            }
            if ($finishedItems->count() > 0) {
                $breakdownParts[] = $finishedItems->count() . ' selesai';
            }
            if ($pendingItems->count() > 0) {
                $breakdownParts[] = $pendingItems->count() . ' menunggu ACC';
            }
            if ($rejectedItems->count() > 0) {
                $breakdownParts[] = $rejectedItems->count() . ' ditolak';
            }
            $ticket->status_breakdown = ($totalCount > 1 && count($breakdownParts) > 1)
                ? implode(', ', $breakdownParts)
                : null;

            $returnableItems = $items->filter(function ($it) {
                return in_array($it->status, ['disetujui', 'sedang_dipinjam'])
                    && !in_array($it->status_pengembalian, ['menunggu_cek_fisik', 'selesai_diterima']);
            })->values();
            $ticket->returnable_peminjaman_id = optional($returnableItems->first())->id;
            $ticket->returnable_items_count = $returnableItems->count();
            $ticket->cancelable_peminjaman_id = optional($pendingItems->first())->id;

            $ticket->rejected_notes_list = $rejectedItems->map(function ($it) {
                return [
                    'nama' => optional($it->sarpras)->nama_sarpras ?? 'Sarpras',
                    'ruangan' => $it->room_name,
                    'jumlah' => (int) ($it->jumlah ?? 1),
                    'alasan' => $it->clean_catatan !== ''
                        ? $it->clean_catatan
                        : 'Permohonan ditolak oleh pengelola ruangan terkait.',
                ];
            })->values();

            $ticket->approved_notes_list = $nonRejectedApprovedItems->map(function ($it) {
                return [
                    'nama' => optional($it->sarpras)->nama_sarpras ?? 'Sarpras',
                    'ruangan' => $it->room_name,
                    'jumlah' => (int) ($it->jumlah ?? 1),
                    'status' => $it->status,
                    'catatan' => $it->clean_catatan,
                ];
            })->filter(fn ($entry) => $entry['catatan'] !== '')->values();

            $notes = $items->pluck('clean_catatan')
                ->filter(fn ($n) => $n !== '')
                ->unique()
                ->values();
            $ticket->catatan_pengelola = $notes->isNotEmpty() ? $notes->implode(' | ') : null;

            return $ticket;
        })->values();
    }

    /**
     * Ajukan Surat Bebas Sarpras oleh Mahasiswa (khusus mahasiswa tingkat akhir / kebutuhan administrasi)
     */
    public function storeMahasiswaBebasPinjam(Request $request)
    {
        $request->validate([
            'keperluan' => 'required|string|max:255',
        ], [
            'keperluan.required' => 'Keperluan pengajuan surat bebas sarpras wajib diisi.',
        ]);

        $user = Auth::user();

        $existing = BebasPinjam::where('user_id', $user->id)->first();
        if ($existing && $existing->status_final === 'bebas') {
            return redirect()->route('mahasiswa.bebas-sarpras')
                ->with('success', "Anda sudah memiliki Surat Bebas Sarpras resmi yang disahkan.");
        }

        $latestId = BebasPinjam::max('id') + 1;
        $kode = 'BP-' . date('Y') . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);
        while (BebasPinjam::where('kode_pengajuan', $kode)->exists()) {
            $latestId++;
            $kode = 'BP-' . date('Y') . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);
        }

        $keperluan = trim((string) $request->input('keperluan', 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM'));
        if ($keperluan === '') {
            $keperluan = 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM';
        }

        BebasPinjam::updateOrCreate(
            ['user_id' => $user->id],
            [
                'kode_pengajuan' => $kode,
                'keperluan' => $keperluan,
                'tgl_pengajuan' => now(),
                'status_lab_komputer' => 'belum_cek',
                'status_lab_jaringan' => 'belum_cek',
                'status_ruang_inventaris' => 'belum_cek',
                'status_final' => 'belum_cek',
            ]
        );

        return redirect()->route('mahasiswa.bebas-sarpras')
            ->with('success', "Permohonan Bebas Sarpras ({$kode}) berhasil diajukan! Pantau status verifikasi tiap unit secara berkala.");
    }

    /**
     * Ubah / Atur Keperluan Surat Bebas Sarpras sebelum disahkan resmi
     */
    public function updateMahasiswaBebasPinjam(Request $request)
    {
        $request->validate([
            'keperluan' => 'required|string|max:255',
        ], [
            'keperluan.required' => 'Keperluan pengajuan surat bebas sarpras wajib diisi.',
        ]);

        $bebasPinjam = BebasPinjam::where('user_id', Auth::id())->latest()->firstOrFail();
        if ($bebasPinjam->status_final === 'bebas') {
            return redirect()->route('mahasiswa.bebas-sarpras')
                ->with('error', 'Keperluan tidak dapat diubah karena surat bebas sarpras sudah disahkan resmi.');
        }

        $bebasPinjam->keperluan = trim((string) $request->input('keperluan'));
        $bebasPinjam->save();

        return redirect()->route('mahasiswa.bebas-sarpras')
            ->with('success', "Keperluan surat bebas sarpras ({$bebasPinjam->kode_pengajuan}) berhasil diperbarui.");
    }

    /**
     * Batalkan pengajuan Bebas Sarpras sebelum disahkan resmi
     */
    public function batalMahasiswaBebasPinjam()
    {
        $bebasPinjam = BebasPinjam::where('user_id', Auth::id())->latest()->firstOrFail();
        if ($bebasPinjam->status_final === 'bebas') {
            return redirect()->route('mahasiswa.bebas-sarpras')
                ->with('error', 'Surat bebas sarpras yang sudah disahkan resmi tidak dapat dibatalkan.');
        }

        $kode = $bebasPinjam->kode_pengajuan;
        $bebasPinjam->delete();

        return redirect()->route('mahasiswa.bebas-sarpras')
            ->with('success', "Pengajuan Bebas Sarpras ({$kode}) berhasil dibatalkan. Layanan ini hanya perlu diajukan bila Anda sudah membutuhkan surat bebas tanggungan.");
    }

    /**
     * Halaman 2: Layanan & Katalog Peminjaman Sarpras (Alat & Bahan)
     */
    public function mahasiswaPeminjaman(Request $request)
    {
        return $this->mahasiswaPeminjamanAlat($request);
    }

    /**
     * 2.A Katalog Alat & Bahan Laboratorium (Sesuai Figma Sub-menu Alat dan Bahan)
     */
    public function mahasiswaPeminjamanAlat(Request $request)
    {
        $user = Auth::user();
        $unitFilter = $request->query('unit', 'semua');
        $search = $request->query('search');

        $baseQuery = Sarpras::with(['ruangan'])
            ->where(function ($q) {
                $q->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            });

        // Hitung Unit Filter sesuai Figma: Semua Unit, Unit Bengkel, Unit Admin, Unit Laboratorium
        $totalUnitCount = (clone $baseQuery)->count();
        $bengkelCount = (clone $baseQuery)->whereHas('ruangan', function ($rq) {
            $rq->where('nama_ruangan', 'like', '%bengkel%');
        })->count();
        $adminCount = (clone $baseQuery)->whereHas('ruangan', function ($rq) {
            $rq->where('nama_ruangan', 'like', '%admin%');
        })->count();
        $labCount = (clone $baseQuery)->whereHas('ruangan', function ($rq) {
            $rq->where('nama_ruangan', 'like', '%lab%');
        })->count();

        // Terapkan filter unit
        if ($unitFilter === 'bengkel') {
            $baseQuery->whereHas('ruangan', function ($rq) {
                $rq->where('nama_ruangan', 'like', '%bengkel%');
            });
        } elseif ($unitFilter === 'admin') {
            $baseQuery->whereHas('ruangan', function ($rq) {
                $rq->where('nama_ruangan', 'like', '%admin%');
            });
        } elseif ($unitFilter === 'lab') {
            $baseQuery->whereHas('ruangan', function ($rq) {
                $rq->where('nama_ruangan', 'like', '%lab%');
            });
        }

        $this->applyFlexibleSearch($baseQuery, $search, ['nama_sarpras', 'kode_sarpras']);

        $sarpras = $baseQuery->orderBy('nama_sarpras')->paginate(9)->withQueryString();
        $daftarRuangan = Ruangan::orderBy('nama_ruangan')->get();

        $pinjamanAktifCount = Peminjaman::where('user_id', $user->id)
            ->whereIn('status', ['sedang_dipinjam', 'disetujui'])
            ->count();
        $menungguAccCount = Peminjaman::where('user_id', $user->id)
            ->where('status', 'menunggu_verifikasi')
            ->count();
        $bebasPinjam = BebasPinjam::where('user_id', $user->id)->latest()->first();

        return view('dashboard.mahasiswa_peminjaman_alat', compact(
            'user',
            'unitFilter',
            'search',
            'sarpras',
            'daftarRuangan',
            'totalUnitCount',
            'bengkelCount',
            'adminCount',
            'labCount',
            'pinjamanAktifCount',
            'menungguAccCount',
            'bebasPinjam'
        ));
    }

    /**
     * Halaman 3: Layanan Pengembalian Fisik & Bukti Kondisi
     */
    public function mahasiswaPengembalian(Request $request)
    {
        $user = Auth::user();

        // 1. Pinjaman aktif yang siap dikembalikan (belum pernah mengajukan pengembalian, khusus alat & bahan)
        $pinjamanAktif = Peminjaman::with(['sarpras.ruangan'])
            ->where('user_id', $user->id)
            ->whereHas('sarpras', function ($sq) {
                $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            })
            ->where(function ($q) {
                $q->whereNull('keperluan')->orWhere('keperluan', 'not like', '%[Relokasi:%');
            })
            ->whereIn('status', ['sedang_dipinjam', 'disetujui'])
            ->where(function ($q) {
                $q->whereNull('status_pengembalian')
                  ->orWhereNotIn('status_pengembalian', ['menunggu_cek_fisik', 'selesai_diterima']);
            })
            ->latest()
            ->get();

        // 2. Pinjaman yang telah diajukan pengembaliannya dan sedang menunggu verifikasi fisik oleh Laboran/Pengelola
        $pinjamanMenungguCekFisik = Peminjaman::with(['sarpras.ruangan'])
            ->where('user_id', $user->id)
            ->whereHas('sarpras', function ($sq) {
                $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            })
            ->where('status_pengembalian', 'menunggu_cek_fisik')
            ->where('status', '!=', 'selesai')
            ->latest()
            ->get();

        $riwayatSelesai = Peminjaman::with(['sarpras.ruangan'])
            ->where('user_id', $user->id)
            ->whereHas('sarpras', function ($sq) {
                $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            })
            ->where(function($q) {
                $q->where('status', 'selesai')
                  ->orWhere('status_pengembalian', 'selesai_diterima');
            })
            ->latest()
            ->take(10)
            ->get();

        $pinjamanAktifCount = $pinjamanAktif->count();
        $menungguCekFisikCount = $pinjamanMenungguCekFisik->count();
        $menungguAccCount = Peminjaman::where('user_id', $user->id)
            ->where('status', 'menunggu_verifikasi')
            ->count();
        $bebasPinjam = BebasPinjam::where('user_id', $user->id)->latest()->first();
        $daftarRuangan = Ruangan::orderBy('nama_ruangan')->get();

        return view('dashboard.mahasiswa_pengembalian', compact(
            'user',
            'daftarRuangan',
            'pinjamanAktif',
            'pinjamanMenungguCekFisik',
            'riwayatSelesai',
            'pinjamanAktifCount',
            'menungguCekFisikCount',
            'menungguAccCount',
            'bebasPinjam'
        ));
    }

    /**
     * Halaman 4: Layanan Status Pinjam & Riwayat Tiket
     */
    public function mahasiswaStatusPinjam(Request $request)
    {
        $user = Auth::user();
        $statusFilter = $request->query('status', 'semua');
        $search = $request->query('search');

        $baseQuery = Peminjaman::with(['sarpras.ruangan'])
            ->where('user_id', $user->id)
            ->whereHas('sarpras', function ($sq) {
                $sq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            })
            ->where(function ($q) {
                $q->whereNull('keperluan')->orWhere('keperluan', 'not like', '%[Relokasi:%');
            });

        $this->applyFlexibleSearch($baseQuery, $search, ['kode_peminjaman', 'keperluan', 'dosen_penanggung_jawab'], ['sarpras' => ['nama_sarpras', 'kode_sarpras'], 'sarpras.ruangan' => ['nama_ruangan']]);

        $allTiket = $this->groupMahasiswaTickets((clone $baseQuery)->latest()->get());
        $totalCount = $allTiket->count();
        $aktifStatuses = ['sedang_dipinjam', 'disetujui', 'disetujui_sebagian'];
        $menungguStatuses = ['menunggu_verifikasi', 'diproses_sebagian'];

        $aktifCount = $allTiket->whereIn('status', $aktifStatuses)->count();
        $menungguCount = $allTiket->whereIn('status', $menungguStatuses)->count();
        $selesaiCount = $allTiket->where('status', 'selesai')->count();
        $ditolakCount = $allTiket->where('status', 'ditolak')->count();

        if ($statusFilter === 'aktif') {
            $tikets = $allTiket->whereIn('status', $aktifStatuses);
        } elseif ($statusFilter === 'menunggu') {
            $tikets = $allTiket->whereIn('status', $menungguStatuses);
        } elseif ($statusFilter === 'selesai') {
            $tikets = $allTiket->where('status', 'selesai');
        } elseif ($statusFilter === 'ditolak') {
            $tikets = $allTiket->where('status', 'ditolak');
        } else {
            $tikets = $allTiket;
        }

        $pinjamanAktifCount = $aktifCount;
        $menungguAccCount = $menungguCount;
        $bebasPinjam = BebasPinjam::where('user_id', $user->id)->latest()->first();
        $daftarRuangan = Ruangan::orderBy('nama_ruangan')->get();

        return view('dashboard.mahasiswa_status', compact(
            'user',
            'daftarRuangan',
            'statusFilter',
            'search',
            'tikets',
            'totalCount',
            'aktifCount',
            'menungguCount',
            'selesaiCount',
            'ditolakCount',
            'pinjamanAktifCount',
            'menungguAccCount',
            'bebasPinjam'
        ));
    }

    /**
     * Halaman 5: Layanan Bebas Sarpras
     */
    public function mahasiswaBebasSarpras(Request $request)
    {
        $user = Auth::user();

        $bebasPinjam = BebasPinjam::where('user_id', $user->id)->latest()->first();
        $pinjamanAktif = Peminjaman::with('sarpras.ruangan')
            ->where('user_id', $user->id)
            ->whereIn('status', ['sedang_dipinjam', 'disetujui', 'menunggu_verifikasi'])
            ->get();

        $pinjamanAktifCount = $pinjamanAktif->whereIn('status', ['sedang_dipinjam', 'disetujui'])->count();
        $menungguAccCount = $pinjamanAktif->where('status', 'menunggu_verifikasi')->count();
        $daftarRuangan = Ruangan::orderBy('nama_ruangan')->get();

        return view('dashboard.mahasiswa_bebas_sarpras', compact(
            'user',
            'daftarRuangan',
            'bebasPinjam',
            'pinjamanAktif',
            'pinjamanAktifCount',
            'menungguAccCount'
        ));
    }

    /**
     * Resolusi identitas ruangan & otoritas pengelola (Laboratorium / Bengkel / Admin JTIK & Sarana Ruangan)
     */
    private function resolvePengelolaRuangan($user)
    {
        $ruangan = $user->ruangan ?? Ruangan::where('nama_ruangan', 'like', '%Laboratorium%')->first();
        $isAdminJTIK = false;

        if ($ruangan) {
            if (stripos($ruangan->nama_ruangan, 'Lab') !== false || stripos($ruangan->kode_ruangan, 'LAB') !== false) {
                $badgeRuangan = 'Laboratorium';
                $namaRuangan = 'Laboratorium';
            } elseif (stripos($ruangan->nama_ruangan, 'Bengkel') !== false || stripos($ruangan->kode_ruangan, 'BENGKEL') !== false || stripos($ruangan->kode_ruangan, 'BAV') !== false) {
                $badgeRuangan = 'Bengkel IT';
                $namaRuangan = 'Bengkel IT';
            } elseif (stripos($ruangan->nama_ruangan, 'Admin') !== false || stripos($ruangan->nama_ruangan, 'Administrasi') !== false || stripos($ruangan->kode_ruangan, 'ADM') !== false || stripos($ruangan->kode_ruangan, 'LJT-02') !== false) {
                $badgeRuangan = 'Administrasi';
                $namaRuangan = 'Administrasi';
                $isAdminJTIK = true;
            } else {
                $badgeRuangan = $ruangan->nama_ruangan;
                $namaRuangan = $ruangan->nama_ruangan;
            }
        } else {
            $badgeRuangan = 'Laboratorium';
            $namaRuangan = 'Laboratorium';
        }

        return [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK];
    }

    /**
     * Cek apakah pengelola yang sedang login berwenang atas barang peminjaman tertentu
     */
    private function isPengelolaAuthorizedForItem($item, $ruangan, $isAdminJTIK)
    {
        if (!$item || !$item->sarpras) return false;
        $sarpras = $item->sarpras;

        if ($sarpras->jenis_sarpras === 'sarana_ruangan') {
            return false;
        }

        if ($ruangan && $sarpras->ruangan_id == $ruangan->id) {
            return true;
        }

        return false;
    }

    /**
     * Dapatkan nama ruangan penanggung jawab barang sarpras
     */
    private function getItemResponsibleRoomName($item)
    {
        if (!$item || !$item->sarpras) return 'Pengelola Ruangan';
        $sarpras = $item->sarpras;
        if ($sarpras->ruangan) {
            if (stripos($sarpras->ruangan->nama_ruangan, 'Lab') !== false) {
                return 'Laboratorium';
            }
            if (stripos($sarpras->ruangan->nama_ruangan, 'Bengkel') !== false) {
                return 'Bengkel IT';
            }
            if (stripos($sarpras->ruangan->nama_ruangan, 'Admin') !== false || stripos($sarpras->ruangan->nama_ruangan, 'Administrasi') !== false) {
                return 'Administrasi';
            }
            return $sarpras->ruangan->nama_ruangan;
        }
        return 'Pengelola Ruangan';
    }

    /**
     * Terapkan cakupan wewenang persetujuan pengelola pada query peminjaman
     */
    private function applyPengelolaRuanganScope($query, $ruangan, $isAdminJTIK)
    {
        if (!$ruangan) return;

        $query->whereHas('sarpras', function ($sq) use ($ruangan) {
            $sq->where('ruangan_id', $ruangan->id)
               ->where(function ($jq) {
                   $jq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
               });
        });
    }

    /**
     * Dapatkan daftar sarpras untuk modal Cek Stok pengelola
     */
    private function getSarprasRuanganList($ruangan, $isAdminJTIK)
    {
        if (!$ruangan) return collect();

        return $ruangan->sarpras()
            ->with(['ruangan'])
            ->where(function ($jq) {
                $jq->where('jenis_sarpras', 'alat_bahan')->orWhereNull('jenis_sarpras');
            })
            ->get();
    }

    // 2. Dashboard Pengelola (Dinamis Sesuai Ruangan Tanggung Jawab: Laboratorium / Bengkel / Admin JTIK)
    // Mendukung 1 Tiket Checkout Multi-Barang: Pengelola melihat 1 baris per tiket, melihat seluruh isi barang, dan hanya dapat menyetujui barang miliknya sendiri
    public function pengelola(Request $request)
    {
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);

        $statusFilter = $request->query('status', 'menunggu_verifikasi');
        $search = $request->query('search');

        // 1. Dapatkan seluruh nomor tiket yang memiliki setidaknya satu barang di bawah otoritas ruangan pengelola ini
        $ticketCodesQuery = Peminjaman::query();
        $this->applyPengelolaRuanganScope($ticketCodesQuery, $ruangan, $isAdminJTIK);
        $relevantTicketCodes = $ticketCodesQuery->pluck('kode_peminjaman')->unique();

        // 2. Ambil seluruh transaksi peminjaman untuk tiket-tiket tersebut (termasuk barang lintas ruangan)
        $query = Peminjaman::with(['user', 'sarpras.ruangan'])
            ->whereIn('kode_peminjaman', $relevantTicketCodes);

        $this->applyFlexibleSearch($query, $search, ['kode_peminjaman', 'keperluan', 'dosen_penanggung_jawab'], ['user' => ['name', 'nomor_induk', 'email'], 'sarpras' => ['nama_sarpras', 'kode_sarpras']]);

        // 3. Kelompokkan seluruh peminjaman per tiket checkout (1 Tiket = 1 Baris Tabel di Pengelola)
        $allGrouped = $query->latest()->get()->groupBy('kode_peminjaman');

        // Hitung count untuk tab filter berdasarkan tiket (1 tiket dihitung 1)
        $baseTicketsQuery = Peminjaman::with(['sarpras.ruangan'])
            ->whereIn('kode_peminjaman', $relevantTicketCodes)
            ->get()
            ->groupBy('kode_peminjaman');

        $menungguCount = 0;
        $disetujuiCount = 0;
        $ditolakCount = 0;
        $semuaCount = 0;

        foreach ($baseTicketsQuery as $code => $items) {
            $myItems = $items->filter(fn($it) => $this->isPengelolaAuthorizedForItem($it, $ruangan, $isAdminJTIK));
            if ($myItems->isEmpty()) continue;
            
            $semuaCount++;
            if ($myItems->contains('status', 'menunggu_verifikasi')) {
                $menungguCount++;
            } elseif ($myItems->contains(fn($it) => in_array($it->status, ['disetujui', 'sedang_dipinjam']))) {
                $disetujuiCount++;
            } elseif ($myItems->every(fn($it) => $it->status === 'ditolak')) {
                $ditolakCount++;
            }
        }

        $antrian = collect();

        foreach ($allGrouped as $kode => $items) {
            // Tandai wewenang tiap item dalam tiket
            foreach ($items as $it) {
                $it->is_authorized = $this->isPengelolaAuthorizedForItem($it, $ruangan, $isAdminJTIK);
                $it->authorized_room_name = $this->getItemResponsibleRoomName($it);
            }

            $myItems = $items->filter(fn($it) => $it->is_authorized)->values();

            // Hanya tampilkan tiket jika pengelola ini bertanggung jawab atas setidaknya 1 barang di dalamnya
            if ($myItems->isEmpty()) continue;

            // Filter status tab berdasarkan barang milik ruangan ini
            if ($statusFilter === 'menunggu_verifikasi') {
                if (!$myItems->contains('status', 'menunggu_verifikasi')) continue;
            } elseif ($statusFilter === 'disetujui') {
                if (!$myItems->contains(fn($it) => in_array($it->status, ['disetujui', 'sedang_dipinjam']))) continue;
            } elseif ($statusFilter === 'ditolak') {
                if (!$myItems->every(fn($it) => $it->status === 'ditolak')) continue;
            }

            // 1 Tiket Checkout = 1 Baris di Tabel; seluruh barang (ruangan ini dulu, lalu ruangan lain) masuk ke rincian modal
            $sortedItems = $items->sortByDesc(fn($it) => $it->is_authorized ? 1 : 0)->values();
            $ticket = clone $myItems->first();
            $ticket->ticket_items = $sortedItems;
            $ticket->sibling_items = $sortedItems;
            $ticket->my_items_count = $myItems->count();
            $ticket->total_items_count = $sortedItems->count();
            $ticket->my_units_sum = $myItems->sum('jumlah');
            $ticket->total_units_sum = $sortedItems->sum('jumlah');
            $ticket->has_pending_for_me = $myItems->contains('status', 'menunggu_verifikasi');
            $ticket->all_my_approved = $myItems->every(fn($it) => in_array($it->status, ['disetujui', 'sedang_dipinjam', 'selesai']));
            $ticket->all_my_rejected = $myItems->every(fn($it) => $it->status === 'ditolak');

            $antrian->push($ticket);
        }

        // Count verifikasi pengembalian untuk badge sidebar
        $menungguCekCount = Peminjaman::query();
        $this->applyPengelolaRuanganScope($menungguCekCount, $ruangan, $isAdminJTIK);
        $menungguCekCount = $menungguCekCount->where(function($q) {
            $q->where('status_pengembalian', 'menunggu_cek_fisik')
              ->orWhere('status', 'sedang_dipinjam');
        })->where('status', '!=', 'selesai')->count();

        $sarprasRuangan = $this->getSarprasRuanganList($ruangan, $isAdminJTIK);

        return view('dashboard.pengelola', compact(
            'user',
            'ruangan',
            'badgeRuangan',
            'namaRuangan',
            'antrian',
            'statusFilter',
            'search',
            'menungguCount',
            'disetujuiCount',
            'ditolakCount',
            'semuaCount',
            'menungguCekCount',
            'sarprasRuangan'
        ));
    }

    /**
     * 2.B Riwayat Keputusan Peminjaman Pengelola (Arsip Rekam Jejak)
     */
    public function pengelolaRiwayat(Request $request)
    {
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);

        $statusFilter = $request->query('status', 'semua');
        $search = $request->query('search');

        $query = Peminjaman::with(['user', 'sarpras.ruangan']);
        $this->applyPengelolaRuanganScope($query, $ruangan, $isAdminJTIK);

        // Halaman Riwayat Keputusan hanya menampilkan data yang sudah diputuskan
        $historyStatuses = ['disetujui', 'ditolak', 'sedang_dipinjam', 'selesai'];

        if ($statusFilter === 'disetujui') {
            $query->whereIn('status', ['disetujui', 'sedang_dipinjam', 'selesai']);
        } elseif ($statusFilter === 'ditolak') {
            $query->where('status', 'ditolak');
        } else {
            $query->whereIn('status', $historyStatuses);
        }

        $this->applyFlexibleSearch($query, $search, ['kode_peminjaman', 'keperluan', 'catatan_pengelola', 'dosen_penanggung_jawab'], ['user' => ['name', 'nomor_induk', 'email'], 'sarpras' => ['nama_sarpras', 'kode_sarpras']]);

        $riwayat = $query->latest('updated_at')->get();

        // Hitung count untuk filter tab di halaman Riwayat
        $baseCountQuery = Peminjaman::query();
        $this->applyPengelolaRuanganScope($baseCountQuery, $ruangan, $isAdminJTIK);

        $semuaCount = (clone $baseCountQuery)->whereIn('status', $historyStatuses)->count();
        $disetujuiCount = (clone $baseCountQuery)->whereIn('status', ['disetujui', 'sedang_dipinjam', 'selesai'])->count();
        $ditolakCount = (clone $baseCountQuery)->where('status', 'ditolak')->count();

        // Hitung antrean aktif menunggu verifikasi untuk badge menu sidebar
        $menungguCount = (clone $baseCountQuery)->where('status', 'menunggu_verifikasi')->count();
        $menungguCekCount = (clone $baseCountQuery)->where(function($q) {
            $q->where('status_pengembalian', 'menunggu_cek_fisik')
              ->orWhere('status', 'sedang_dipinjam');
        })->where('status', '!=', 'selesai')->count();

        $sarprasRuangan = $this->getSarprasRuanganList($ruangan, $isAdminJTIK);

        return view('dashboard.pengelola_riwayat', compact(
            'user',
            'ruangan',
            'badgeRuangan',
            'namaRuangan',
            'riwayat',
            'statusFilter',
            'search',
            'semuaCount',
            'disetujuiCount',
            'ditolakCount',
            'menungguCount',
            'menungguCekCount',
            'sarprasRuangan'
        ));
    }

    // 2B. Halaman Verifikasi Pengembalian Sarpras oleh Pengelola
    public function pengelolaPengembalian(Request $request)
    {
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);

        $statusFilter = $request->query('status', 'semua');
        $search = $request->query('search');

        $query = Peminjaman::with(['user', 'sarpras.ruangan'])
            ->whereNotIn('status', ['menunggu_verifikasi', 'ditolak']);

        $this->applyPengelolaRuanganScope($query, $ruangan, $isAdminJTIK);

        // Filter status pengembalian
        if ($statusFilter === 'menunggu_cek_fisik') {
            $query->where('status_pengembalian', 'menunggu_cek_fisik')
                  ->where('status', '!=', 'selesai');
        } elseif ($statusFilter === 'selesai_diterima') {
            $query->where(function($q) {
                $q->where('status_pengembalian', 'selesai_diterima')
                  ->orWhere('status', 'selesai');
            });
        } elseif ($statusFilter === 'kendala_kerusakan') {
            $query->where('status_pengembalian', 'kendala_kerusakan');
        } else {
            $query->whereIn('status_pengembalian', ['menunggu_cek_fisik', 'selesai_diterima', 'kendala_kerusakan']);
        }

        $this->applyFlexibleSearch($query, $search, ['kode_peminjaman', 'keperluan', 'catatan_kondisi_kembali'], ['user' => ['name', 'nomor_induk', 'email'], 'sarpras' => ['nama_sarpras', 'kode_sarpras']]);

        $pengembalian = $query->latest('updated_at')->get();

        // Hitung count untuk tab filter
        $baseCountQuery = Peminjaman::query()
            ->whereNotIn('status', ['menunggu_verifikasi', 'ditolak']);
        $this->applyPengelolaRuanganScope($baseCountQuery, $ruangan, $isAdminJTIK);

        $semuaCount = (clone $baseCountQuery)->whereIn('status_pengembalian', ['menunggu_cek_fisik', 'selesai_diterima', 'kendala_kerusakan'])->count();
        $menungguCekCount = (clone $baseCountQuery)->where('status_pengembalian', 'menunggu_cek_fisik')->where('status', '!=', 'selesai')->count();
        $selesaiDiterimaCount = (clone $baseCountQuery)->where(function($q) {
            $q->where('status_pengembalian', 'selesai_diterima')->orWhere('status', 'selesai');
        })->count();
        $kendalaCount = (clone $baseCountQuery)->where('status_pengembalian', 'kendala_kerusakan')->count();

        // Hitung antrean aktif menunggu verifikasi untuk badge menu sidebar
        $menungguQuery = Peminjaman::where('status', 'menunggu_verifikasi');
        $this->applyPengelolaRuanganScope($menungguQuery, $ruangan, $isAdminJTIK);
        $menungguCount = $menungguQuery->count();

        $sarprasRuangan = $this->getSarprasRuanganList($ruangan, $isAdminJTIK);

        return view('dashboard.pengelola_pengembalian', compact(
            'user',
            'ruangan',
            'badgeRuangan',
            'namaRuangan',
            'pengembalian',
            'statusFilter',
            'search',
            'semuaCount',
            'menungguCekCount',
            'selesaiDiterimaCount',
            'kendalaCount',
            'menungguCount',
            'sarprasRuangan'
        ));
    }

    // Setujui Pengembalian & Tutup Tiket
    public function verifikasiPengembalian(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('sarpras.ruangan')->findOrFail($id);

        $catatanLaboran = $request->input('catatan_laboran', 'Pengecekan fisik selesai, barang diuji normal dan siap dipinjamkan kembali.');
        $lokasiSimpan = $request->input('lokasi_simpan', $peminjaman->sarpras?->ruangan?->nama_ruangan ?? 'Ruang Inventaris');
        $namaLaboran = Auth::user()->name ?? 'Laboran';

        $fullNote = $catatanLaboran . " Lokasi Simpan: {$lokasiSimpan} | Laboran: {$namaLaboran} (" . now()->translatedFormat('d M Y, H:i') . " WITA)";

        $peminjaman->update([
            'status' => 'selesai',
            'status_pengembalian' => 'selesai_diterima',
            'tgl_kembali_aktual' => now(),
            'catatan_pengelola' => $fullNote,
        ]);

        // Kembalikan ketersediaan stok fisik sarpras
        if ($peminjaman->sarpras) {
            $peminjaman->sarpras->increment('jumlah_tersedia', $peminjaman->jumlah);
            if ($peminjaman->sarpras->jumlah_tersedia > $peminjaman->sarpras->jumlah_total) {
                $peminjaman->sarpras->update(['jumlah_tersedia' => $peminjaman->sarpras->jumlah_total]);
            }
        }

        return redirect()->route('pengelola.pengembalian')
            ->with('success', "Pengembalian sarpras {$peminjaman->sarpras->nama_sarpras} (Tiket: {$peminjaman->kode_peminjaman}) berhasil disahkan & stok telah dikembalikan ke rak.");
    }

    // Tolak / Laporkan Kerusakan Pengembalian
    public function tolakPengembalian(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('sarpras')->findOrFail($id);

        $alasan = $request->input('alasan_kendala', 'Terdapat kerusakan fisik atau kekurangan kelengkapan saat pengembalian barang.');

        $peminjaman->update([
            'status_pengembalian' => 'kendala_kerusakan',
            'catatan_pengelola' => "KENDALA/KERUSAKAN: " . $alasan . " (Pemeriksa: " . (Auth::user()->name ?? 'Laboran') . " - " . now()->translatedFormat('d M Y, H:i') . " WITA)",
        ]);

        return redirect()->route('pengelola.pengembalian')
            ->with('error', "Peringatan: Pengembalian tiket {$peminjaman->kode_peminjaman} ditandai memiliki kendala/kerusakan.");
    }

    private function resolveBebasUnitColumn(?string $namaRuangan): string
    {
        if ($namaRuangan === 'Bengkel IT') {
            return 'status_ruang_inventaris';
        }
        if ($namaRuangan === 'Administrasi' || $namaRuangan === 'Admin JTIK') {
            return 'status_lab_jaringan';
        }
        return 'status_lab_komputer';
    }

    // 2C. Halaman Verifikasi Bebas Sarpras oleh Pengelola
    public function pengelolaBebasPinjam(Request $request)
    {
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);
        $unitColumn = $this->resolveBebasUnitColumn($namaRuangan);

        $statusFilter = $request->query('status', 'semua');
        $prodiFilter = $request->query('prodi');
        $search = $request->query('search');

        $query = BebasPinjam::with('user');

        // Filter Status Tab
        if ($statusFilter === 'bebas') {
            $query->where('status_final', 'bebas');
        } elseif ($statusFilter === 'tertahan') {
            $query->where(function($q) {
                $q->where('status_lab_komputer', 'tertahan')
                  ->orWhere('status_lab_jaringan', 'tertahan')
                  ->orWhere('status_ruang_inventaris', 'tertahan')
                  ->orWhere('status_final', 'tertahan');
            });
        } elseif ($statusFilter === 'belum_cek') {
            $query->where($unitColumn, 'belum_cek');
        }

        // Filter Prodi
        if (!empty($prodiFilter) && $prodiFilter !== 'all') {
            $query->whereHas('user.kelas', function($kq) use ($prodiFilter) {
                $kq->where('nama_kelas', 'like', "%{$prodiFilter}%")
                   ->orWhereHas('programStudi', function($pq) use ($prodiFilter) {
                       $pq->where('kode_prodi', 'like', "%{$prodiFilter}%")
                          ->orWhere('nama_prodi', 'like', "%{$prodiFilter}%");
                   });
            });
        }

        // Filter Pencarian
        $this->applyFlexibleSearch($query, $search, ['kode_pengajuan', 'keperluan'], ['user' => ['name', 'nomor_induk', 'email']]);

        $pengajuan = $query->latest('tgl_pengajuan')->get();

        // Cek tanggungan fisik aktif di ruangan lab ini untuk tiap mahasiswa
        foreach ($pengajuan as $item) {
            $activeLoansQuery = Peminjaman::with('sarpras')
                ->where('user_id', $item->user_id)
                ->whereIn('status', ['menunggu_verifikasi', 'disetujui', 'sedang_dipinjam']);

            $this->applyPengelolaRuanganScope($activeLoansQuery, $ruangan, $isAdminJTIK);
            $activeLoans = $activeLoansQuery->get();

            $item->active_loans = $activeLoans;
            $item->loan_count = $activeLoans->count();
        }

        // Count untuk filter tab
        $semuaCount = BebasPinjam::count();
        $bebasCount = BebasPinjam::where('status_final', 'bebas')->count();
        $tertahanCount = BebasPinjam::where(function($q) {
            $q->where('status_lab_komputer', 'tertahan')
              ->orWhere('status_lab_jaringan', 'tertahan')
              ->orWhere('status_ruang_inventaris', 'tertahan')
              ->orWhere('status_final', 'tertahan');
        })->count();
        $belumCekCount = BebasPinjam::where($unitColumn, 'belum_cek')->count();

        // Hitung count untuk sidebar
        $baseCountQuery = Peminjaman::query();
        $this->applyPengelolaRuanganScope($baseCountQuery, $ruangan, $isAdminJTIK);

        $menungguCount = (clone $baseCountQuery)->where('status', 'menunggu_verifikasi')->count();
        $menungguCekCount = (clone $baseCountQuery)->where(function($q) {
            $q->where('status_pengembalian', 'menunggu_cek_fisik')
              ->orWhere('status', 'sedang_dipinjam');
        })->where('status', '!=', 'selesai')->count();

        $sarprasRuangan = $this->getSarprasRuanganList($ruangan, $isAdminJTIK);

        return view('dashboard.pengelola_bebas_pinjam', compact(
            'user',
            'ruangan',
            'badgeRuangan',
            'namaRuangan',
            'pengajuan',
            'statusFilter',
            'prodiFilter',
            'search',
            'semuaCount',
            'bebasCount',
            'tertahanCount',
            'belumCekCount',
            'menungguCount',
            'menungguCekCount',
            'sarprasRuangan'
        ));
    }

    // Sahkan Bebas Pinjam di Lab Ini
    public function sahkanBebasPinjam(Request $request, $id)
    {
        $item = BebasPinjam::with('user')->findOrFail($id);
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);
        $namaPetugas = $user->name ?? 'Sukirman, S.T.';

        // Pengelola hanya berwenang mengesahkan unit/ruangannya sendiri (tidak bisa mengesahkan 3 unit sekaligus)
        if ($namaRuangan === 'Bengkel IT') {
            $item->status_ruang_inventaris = 'bebas';
            $item->petugas_ruang_inventaris = $namaPetugas;
            $item->tgl_ruang_inventaris = now();
            $item->catatan_ruang_inventaris = null;
            $pesan = "Mahasiswa {$item->user->name} ({$item->kode_pengajuan}) berhasil disahkan bebas dari tanggungan Bengkel IT.";
        } elseif ($namaRuangan === 'Administrasi' || $namaRuangan === 'Admin JTIK') {
            $item->status_lab_jaringan = 'bebas';
            $item->petugas_lab_jaringan = $namaPetugas;
            $item->tgl_lab_jaringan = now();
            $item->catatan_lab_jaringan = null;
            $pesan = "Mahasiswa {$item->user->name} ({$item->kode_pengajuan}) berhasil disahkan bebas dari tanggungan Administrasi.";
        } else {
            $item->status_lab_komputer = 'bebas';
            $item->petugas_lab_komputer = $namaPetugas;
            $item->tgl_lab_komputer = now();
            $item->catatan_lab_komputer = null;
            $pesan = "Mahasiswa {$item->user->name} ({$item->kode_pengajuan}) berhasil disahkan bebas dari tanggungan Laboratorium.";
        }

        // Cek apakah ketiga ruangan sudah bebas
        if ($item->status_lab_komputer === 'bebas' && $item->status_lab_jaringan === 'bebas' && $item->status_ruang_inventaris === 'bebas') {
            $item->status_final = 'bebas';
            $item->tgl_disahkan_final = now();
        }

        $item->save();

        return redirect()->route('pengelola.bebas-pinjam')->with('success', $pesan);
    }

    // Tahan Pengajuan Bebas Pinjam
    public function tahanBebasPinjam(Request $request, $id)
    {
        $item = BebasPinjam::with('user')->findOrFail($id);
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);
        $namaPetugas = $user->name ?? 'Sukirman, S.T.';
        $alasan = $request->input('alasan_penahanan', 'Terdapat tanggungan fisik alat laboratorium yang belum dikembalikan atau diselesaikan.');

        $unitTarget = $request->input('unit');
        if (!$unitTarget) {
            if ($namaRuangan === 'Bengkel IT') {
                $unitTarget = 'bengkel';
            } elseif ($namaRuangan === 'Administrasi' || $namaRuangan === 'Admin JTIK') {
                $unitTarget = 'admin';
            } else {
                $unitTarget = 'lab';
            }
        }

        if ($unitTarget === 'bengkel') {
            $item->status_ruang_inventaris = 'tertahan';
            $item->petugas_ruang_inventaris = $namaPetugas;
            $item->tgl_ruang_inventaris = now();
            $item->catatan_ruang_inventaris = $alasan;
        } elseif ($unitTarget === 'admin') {
            $item->status_lab_jaringan = 'tertahan';
            $item->petugas_lab_jaringan = $namaPetugas;
            $item->tgl_lab_jaringan = now();
            $item->catatan_lab_jaringan = $alasan;
        } else {
            $item->status_lab_komputer = 'tertahan';
            $item->petugas_lab_komputer = $namaPetugas;
            $item->tgl_lab_komputer = now();
            $item->catatan_lab_komputer = $alasan;
        }

        $item->status_final = 'tertahan';
        $item->save();

        return redirect()->route('pengelola.bebas-pinjam')
            ->with('error', "Pengajuan bebas pinjam {$item->user->name} ({$item->kode_pengajuan}) DITOLAK pada unit {$namaRuangan}. Mahasiswa wajib menyelesaikan tanggungan.");
    }

    // Lepas Tahan Pengajuan Bebas Pinjam
    public function lepasTahanBebasPinjam(Request $request, $id)
    {
        $item = BebasPinjam::with('user')->findOrFail($id);
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);
        $namaPetugas = $user->name ?? 'Pengelola';

        if ($namaRuangan === 'Bengkel IT') {
            $item->status_ruang_inventaris = 'bebas';
            $item->petugas_ruang_inventaris = $namaPetugas;
            $item->tgl_ruang_inventaris = now();
            $item->catatan_ruang_inventaris = 'Tanggungan telah diselesaikan dan diverifikasi oleh pengelola.';
        } elseif ($namaRuangan === 'Administrasi' || $namaRuangan === 'Admin JTIK') {
            $item->status_lab_jaringan = 'bebas';
            $item->petugas_lab_jaringan = $namaPetugas;
            $item->tgl_lab_jaringan = now();
            $item->catatan_lab_jaringan = 'Tanggungan telah diselesaikan dan diverifikasi oleh pengelola.';
        } else {
            $item->status_lab_komputer = 'bebas';
            $item->petugas_lab_komputer = $namaPetugas;
            $item->tgl_lab_komputer = now();
            $item->catatan_lab_komputer = 'Tanggungan telah diselesaikan dan diverifikasi oleh laboran.';
        }

        if ($item->status_lab_komputer === 'bebas' && $item->status_lab_jaringan === 'bebas' && $item->status_ruang_inventaris === 'bebas') {
            $item->status_final = 'bebas';
            $item->tgl_disahkan_final = now();
        } elseif ($item->status_lab_komputer === 'tertahan' || $item->status_lab_jaringan === 'tertahan' || $item->status_ruang_inventaris === 'tertahan') {
            $item->status_final = 'tertahan';
        } else {
            $item->status_final = 'belum_cek';
        }

        $item->save();

        return redirect()->route('pengelola.bebas-pinjam')
            ->with('success', "Penolakan {$item->user->name} ({$item->kode_pengajuan}) pada unit {$namaRuangan} berhasil DIBATALKAN dan disahkan BEBAS.");
    }

    // 3. Dashboard Admin (Tampilan Sesuai Gambar Referensi 3)
    public function admin(Request $request)
    {
        $user = Auth::user();
        $ruanganFilter = $request->query('ruangan');
        $kondisiFilter = $request->query('kondisi');
        $search = $request->query('search');

        $query = Sarpras::with(['ruangan'])->where('jenis_sarpras', 'alat_bahan');

        if (!empty($ruanganFilter) && $ruanganFilter !== 'all') {
            $query->where('ruangan_id', $ruanganFilter);
        }

        if (!empty($kondisiFilter) && $kondisiFilter !== 'all') {
            $query->where('kondisi', $kondisiFilter);
        }

        $this->applyFlexibleSearch($query, $search, ['kode_sarpras', 'nama_sarpras']);

        // Statistik footer rekapitulasi sesuai filter aktif
        $totalKomoditas = (clone $query)->count();
        $totalFisik = (int) (clone $query)->sum('jumlah_total');
        $totalReady = (int) (clone $query)->sum('jumlah_tersedia');

        $sarpras = $query->latest()->paginate(10)->withQueryString();
        $ruangans = Ruangan::where('jenis_ruangan', 'alat_bahan')->get();

        return view('dashboard.admin', compact(
            'user',
            'sarpras',
            'ruangans',
            'ruanganFilter',
            'kondisiFilter',
            'search',
            'totalKomoditas',
            'totalFisik',
            'totalReady'
        ));
    }

    // Simpan Sarpras Baru oleh Admin
    public function storeSarpras(Request $request)
    {
        $messages = [
            'kode_sarpras.required' => 'Kode aset / inventaris wajib diisi.',
            'kode_sarpras.unique' => 'Kode aset sudah digunakan oleh sarpras lain. Silakan gunakan kode unik yang berbeda.',
            'nama_sarpras.required' => 'Nama sarpras wajib diisi.',
            'ruangan_id.required' => 'Ruangan penempatan wajib dipilih.',
            'ruangan_id.exists' => 'Ruangan yang dipilih tidak terdaftar di sistem.',
            'jumlah_total.required' => 'Jumlah total unit fisik wajib diisi.',
            'jumlah_total.min' => 'Jumlah total unit minimal 0.',
            'jumlah_tersedia.required' => 'Jumlah siap dipinjam (ready) wajib diisi.',
            'maks_pinjam.required' => 'Batas maksimal kuota pinjam wajib diisi.',
            'spesifikasi.required' => 'Spesifikasi teknis / keterangan wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format file foto harus JPG, JPEG, PNG, WEBP, atau GIF.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 10 MB.',
            'foto.uploaded' => 'File foto gagal diunggah. Pastikan ukuran file tidak melebihi kapasitas server.',
        ];

        try {
            $validated = $request->validate([
                'kode_sarpras' => 'required|unique:sarpras,kode_sarpras|max:50',
                'nama_sarpras' => 'required|string|max:255',
                'jenis_perabot' => 'nullable|string|max:255',
                'ruangan_id' => 'required|exists:ruangans,id',
                'jumlah_total' => 'required|integer|min:0',
                'jumlah_tersedia' => 'required|integer|min:0',
                'maks_pinjam' => 'required|integer|min:1',
                'kondisi' => 'required|in:baik,rusak,perbaikan',
                'spesifikasi' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            ], $messages);

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('sarpras', 'public');
                $validated['foto'] = $path;
            }

            if (!isset($validated['jumlah_tersedia']) || $validated['jumlah_tersedia'] === null) {
                $validated['jumlah_tersedia'] = $validated['jumlah_total'];
            }

            if (empty($validated['maks_pinjam'])) {
                $validated['maks_pinjam'] = 2;
            }

            $validated['status'] = $validated['jumlah_tersedia'] > 0 ? 'tersedia' : 'habis';
            $validated['jenis_sarpras'] = $request->input('jenis_sarpras', 'alat_bahan');

            Sarpras::create($validated);

            return redirect()->back()->with('success', 'Sarpras baru "' . $validated['nama_sarpras'] . '" berhasil disimpan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan sarpras: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Update Sarpras oleh Admin
    public function updateSarpras(Request $request, $id)
    {
        $sarpras = Sarpras::findOrFail($id);

        $messages = [
            'nama_sarpras.required' => 'Nama sarpras wajib diisi.',
            'ruangan_id.required' => 'Ruangan penempatan wajib dipilih.',
            'jumlah_total.required' => 'Jumlah total unit fisik wajib diisi.',
            'jumlah_tersedia.required' => 'Jumlah siap dipinjam (ready) wajib diisi.',
            'maks_pinjam.required' => 'Batas maksimal kuota pinjam wajib diisi.',
            'spesifikasi.required' => 'Spesifikasi teknis / keterangan wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format file foto harus JPG, JPEG, PNG, WEBP, atau GIF.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 10 MB.',
            'foto.uploaded' => 'File foto gagal diunggah. Pastikan ukuran file tidak melebihi kapasitas server.',
        ];

        try {
            $validated = $request->validate([
                'nama_sarpras' => 'required|string|max:255',
                'jenis_perabot' => 'nullable|string|max:255',
                'ruangan_id' => 'required|exists:ruangans,id',
                'jumlah_total' => 'required|integer|min:0',
                'jumlah_tersedia' => 'required|integer|min:0',
                'maks_pinjam' => 'required|integer|min:1',
                'kondisi' => 'required|in:baik,rusak,perbaikan',
                'spesifikasi' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            ], $messages);

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('sarpras', 'public');
                $validated['foto'] = $path;
            }

            if (!isset($validated['jumlah_tersedia']) || $validated['jumlah_tersedia'] === null) {
                $validated['jumlah_tersedia'] = $validated['jumlah_total'];
            }

            if (empty($validated['maks_pinjam'])) {
                $validated['maks_pinjam'] = 2;
            }

            $validated['status'] = $validated['jumlah_tersedia'] > 0 ? 'tersedia' : 'habis';

            $sarpras->update($validated);

            return redirect()->back()->with('success', 'Data sarpras "' . $sarpras->nama_sarpras . '" berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui sarpras: ' . $e->getMessage());
        }
    }

    // Hapus Sarpras oleh Admin
    public function destroySarpras($id)
    {
        $sarpras = Sarpras::findOrFail($id);
        $nama = $sarpras->nama_sarpras;
        $sarpras->delete();

        return redirect()->back()->with('success', 'Sarpras "' . $nama . '" berhasil dihapus dari sistem!');
    }

    // ==========================================
    // DATA RUANG & LOKASI (MASTER DATA RUANGAN)
    // ==========================================
    public function ruanganIndex(Request $request)
    {
        $user = Auth::user();
        $tipeFilter = $request->query('tipe');
        $search = $request->query('search');

        // Master Data Ruang & Lokasi HANYA untuk unit utama operasional (Laboratorium, Bengkel, Admin JTIK)
        $query = Ruangan::withCount(['sarpras' => function ($q) {
            $q->where('jenis_sarpras', 'alat_bahan');
        }])->where('jenis_ruangan', 'alat_bahan');

        if (!empty($tipeFilter) && $tipeFilter !== 'all') {
            if ($tipeFilter === 'lab') {
                $query->where('nama_ruangan', 'like', '%Lab%');
            } elseif ($tipeFilter === 'bengkel') {
                $query->where('nama_ruangan', 'like', '%Bengkel%');
            } elseif ($tipeFilter === 'admin' || $tipeFilter === 'jtik') {
                $query->where('nama_ruangan', 'like', '%Admin%');
            }
        }

        $this->applyFlexibleSearch($query, $search, ['kode_ruangan', 'nama_ruangan', 'lokasi_gedung', 'pj_ruangan']);

        $ruangans = $query->get();
        $allRuangans = Ruangan::where('jenis_ruangan', 'alat_bahan')->get();

        $totalRuangan = $allRuangans->count();
        $totalLab = $allRuangans->filter(function ($r) {
            return stripos($r->nama_ruangan, 'lab') !== false || stripos($r->kode_ruangan, 'lab') !== false;
        })->count();
        $totalInventaris = max(0, $totalRuangan - $totalLab);

        // Data sarpras untuk modal ekspor rekapitulasi sarpras/ruangan (khusus sarpras alat & bahan)
        $sarpras = Sarpras::with(['ruangan'])
            ->where('jenis_sarpras', 'alat_bahan')
            ->latest()
            ->get();

        return view('dashboard.ruangan', compact(
            'user',
            'ruangans',
            'totalRuangan',
            'totalLab',
            'totalInventaris',
            'sarpras',
            'tipeFilter',
            'search'
        ));
    }

    public function storeRuangan(Request $request)
    {
        $messages = [
            'kode_ruangan.required' => 'Kode ruangan wajib diisi.',
            'kode_ruangan.unique' => 'Kode ruangan sudah digunakan. Gunakan kode unik lain.',
            'nama_ruangan.required' => 'Nama ruangan / laboratorium wajib diisi.',
            'lokasi_gedung.required' => 'Lokasi lantai / gedung wajib diisi.',
            'pj_ruangan.required' => 'Penanggung jawab (laboran) wajib diisi.',
        ];

        try {
            $validated = $request->validate([
                'kode_ruangan' => 'required|string|max:50|unique:ruangans,kode_ruangan',
                'nama_ruangan' => 'required|string|max:255',
                'jenis_ruangan' => 'nullable|string|max:50',
                'lokasi_gedung' => 'required|string|max:255',
                'pj_ruangan' => 'required|string|max:255',
                'nip_pj' => 'nullable|string|max:100',
                'role_pj' => 'nullable|string|max:255',
            ], $messages);

            $validated['kondisi'] = 'tersedia';
            if (empty($validated['jenis_ruangan'])) {
                $validated['jenis_ruangan'] = 'alat_bahan';
            }

            Ruangan::create($validated);

            return redirect()->route('admin.ruangan')->with('success', 'Master ruangan "' . $validated['nama_ruangan'] . '" berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.ruangan')->withErrors($e->validator)->withInput();
        } catch (\Throwable $e) {
            return redirect()->route('admin.ruangan')->with('error', 'Gagal menambahkan ruangan: ' . $e->getMessage())->withInput();
        }
    }

    public function updateRuangan(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $messages = [
            'nama_ruangan.required' => 'Nama ruangan / laboratorium wajib diisi.',
            'lokasi_gedung.required' => 'Lokasi lantai / gedung wajib diisi.',
            'pj_ruangan.required' => 'Penanggung jawab (laboran) wajib diisi.',
        ];

        try {
            $validated = $request->validate([
                'nama_ruangan' => 'required|string|max:255',
                'jenis_ruangan' => 'nullable|string|max:50',
                'lokasi_gedung' => 'required|string|max:255',
                'pj_ruangan' => 'required|string|max:255',
                'nip_pj' => 'nullable|string|max:100',
                'role_pj' => 'nullable|string|max:255',
            ], $messages);

            $ruangan->update($validated);

            return redirect()->route('admin.ruangan')->with('success', 'Data ruangan "' . $ruangan->nama_ruangan . '" berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.ruangan')->withErrors($e->validator)->withInput();
        } catch (\Throwable $e) {
            return redirect()->route('admin.ruangan')->with('error', 'Gagal memperbarui ruangan: ' . $e->getMessage());
        }
    }

    public function destroyRuangan($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $nama = $ruangan->nama_ruangan;

        // Lepaskan relasi sarpras jika ada agar tidak foreign key constraint error
        Sarpras::where('ruangan_id', $id)->update(['ruangan_id' => null]);

        $ruangan->delete();

        return redirect()->route('admin.ruangan')->with('success', 'Ruangan "' . $nama . '" berhasil dihapus dari direktori jurusan!');
    }

    // ==========================================
    // MANAJEMEN AKUN (ACC PENGELOLA) & MONITORING RIWAYAT LOGIN
    // ==========================================
    public function usersIndex(Request $request)
    {
        $user = Auth::user();
        $activeTab = in_array($request->query('tab'), ['akun', 'riwayat'], true)
            ? $request->query('tab')
            : 'akun';

        $roleFilter = $request->query('role', 'all');
        $statusFilter = $request->query('status', 'all');
        $unitFilter = $request->query('unit', 'all');
        $search = $request->query('search');

        // Query akun user (hanya untuk ACC pendaftaran pengelola & aktivasi status — tanpa tambah/edit/reset kredensial)
        $query = User::with(['ruangan', 'approver', 'latestLoginHistory']);

        if (!empty($roleFilter) && $roleFilter !== 'all') {
            $query->where('role', $roleFilter);
        }

        if (!empty($statusFilter) && $statusFilter !== 'all') {
            $query->where('status_akun', $statusFilter);
        }

        if (!empty($unitFilter) && $unitFilter !== 'all') {
            if ($unitFilter === 'lab') {
                $query->whereHas('ruangan', function ($q) {
                    $q->where('nama_ruangan', 'like', '%Lab%');
                });
            } elseif ($unitFilter === 'bengkel') {
                $query->whereHas('ruangan', function ($q) {
                    $q->where('nama_ruangan', 'like', '%Bengkel%');
                });
            } elseif ($unitFilter === 'admin' || $unitFilter === 'jtik') {
                $query->whereHas('ruangan', function ($q) {
                    $q->where('nama_ruangan', 'like', '%Admin%');
                });
            }
        }

        $this->applyFlexibleSearch($query, $search, ['nomor_induk', 'name', 'email', 'role', 'jabatan', 'status_akun'], ['ruangan' => ['nama_ruangan']]);

        $users = $query
            ->orderByRaw("CASE WHEN status_akun = 'menunggu_acc' THEN 0 ELSE 1 END")
            ->latest()
            ->paginate(10, ['*'], 'users_page')
            ->withQueryString();

        $allUsers = User::with('ruangan')->get();
        $totalUsers = $allUsers->count();
        $totalPengelola = $allUsers->where('role', 'pengelola')->count();
        $totalAdmin = $allUsers->where('role', 'admin')->count();
        $totalMahasiswa = $allUsers->where('role', 'mahasiswa')->count();
        $totalLab = $allUsers->filter(function ($u) {
            return $u->role === 'pengelola' && stripos((string) $u->ruangan?->nama_ruangan, 'lab') !== false;
        })->count();
        $totalBengkel = $allUsers->filter(function ($u) {
            return $u->role === 'pengelola' && stripos((string) $u->ruangan?->nama_ruangan, 'bengkel') !== false;
        })->count();

        $pendingPengelolas = User::with('ruangan')
            ->where('role', 'pengelola')
            ->where('status_akun', 'menunggu_acc')
            ->latest()
            ->get();
        $pendingPengelolaCount = $pendingPengelolas->count();

        // Monitoring Riwayat Login Semua User (Khusus Admin)
        $logRole = $request->query('log_role', 'all');
        $logStatus = $request->query('log_status', 'all');
        $logPortal = $request->query('log_portal', 'all');
        $logSearch = trim((string) $request->query('log_search', ''));
        $logUserId = $request->query('user_id');
        $selectedLogUser = $logUserId ? User::find($logUserId) : null;

        $logQuery = LoginHistory::with('user')->latest('logged_in_at');

        if (!empty($logRole) && $logRole !== 'all') {
            $logQuery->where('role', $logRole);
        }

        if (!empty($logStatus) && $logStatus !== 'all') {
            $logQuery->where('status', $logStatus);
        }

        if (!empty($logPortal) && $logPortal !== 'all') {
            $logQuery->where('portal', $logPortal);
        }

        if ($selectedLogUser) {
            $logQuery->where('user_id', $selectedLogUser->id);
        }

        if ($logSearch !== '') {
            $logQuery->where(function ($q) use ($logSearch) {
                $like = '%' . $logSearch . '%';
                $q->where('identifier', 'like', $like)
                  ->orWhere('ip_address', 'like', $like)
                  ->orWhere('device_label', 'like', $like)
                  ->orWhere('notes', 'like', $like)
                  ->orWhereHas('user', function ($uq) use ($like) {
                      $uq->where('name', 'like', $like)
                         ->orWhere('nomor_induk', 'like', $like)
                         ->orWhere('email', 'like', $like);
                  });
            });
        }

        $loginHistories = $logQuery->paginate(15, ['*'], 'logs_page')->withQueryString();
        $totalLogCount = LoginHistory::count();
        $todayLoginCount = LoginHistory::where('status', 'berhasil')
            ->whereDate('logged_in_at', today())
            ->count();
        $failedLoginCount = LoginHistory::whereIn('status', ['gagal', 'terkunci', 'ditolak'])
            ->whereDate('logged_in_at', today())
            ->count();

        return view('dashboard.users', compact(
            'user',
            'activeTab',
            'users',
            'pendingPengelolas',
            'pendingPengelolaCount',
            'totalUsers',
            'totalPengelola',
            'totalAdmin',
            'totalMahasiswa',
            'totalLab',
            'totalBengkel',
            'roleFilter',
            'statusFilter',
            'unitFilter',
            'search',
            'loginHistories',
            'logRole',
            'logStatus',
            'logPortal',
            'logSearch',
            'selectedLogUser',
            'totalLogCount',
            'todayLoginCount',
            'failedLoginCount'
        ));
    }

    /**
     * Setujui (ACC) Pendaftaran Akun Pengelola Baru oleh Admin
     */
    public function approvePengelola($id)
    {
        $targetUser = User::findOrFail($id);

        if ($targetUser->role !== 'pengelola' || $targetUser->status_akun !== 'menunggu_acc') {
            return redirect()->route('admin.users')
                ->with('error', 'Akun tersebut tidak berada dalam antrean persetujuan (Menunggu ACC) Pengelola.');
        }

        $targetUser->update([
            'status_akun' => 'aktif',
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        return redirect()->route('admin.users')
            ->with('success', "Pendaftaran Pengelola '{$targetUser->name}' telah disetujui (ACC). Akun kini aktif dan dapat masuk melalui Portal Petugas.");
    }

    /**
     * Tolak Pendaftaran Akun Pengelola Baru oleh Admin
     */
    public function rejectPengelola($id)
    {
        $targetUser = User::findOrFail($id);

        if ($targetUser->role !== 'pengelola' || $targetUser->status_akun !== 'menunggu_acc') {
            return redirect()->route('admin.users')
                ->with('error', 'Akun tersebut tidak berada dalam antrean persetujuan (Menunggu ACC) Pengelola.');
        }

        $targetUser->update([
            'status_akun' => 'ditolak',
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        return redirect()->route('admin.users')
            ->with('success', "Pendaftaran Pengelola '{$targetUser->name}' telah ditolak.");
    }

    /**
     * Aktifkan / Nonaktifkan Status Akun User (Admin tidak dapat mengubah sandi/kredensial akun user)
     */
    public function toggleUserStatus($id)
    {
        $targetUser = User::findOrFail($id);

        if (Auth::id() == $targetUser->id) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri yang sedang aktif.');
        }

        if ($targetUser->status_akun === 'menunggu_acc') {
            return redirect()->route('admin.users')
                ->with('error', 'Gunakan tombol ACC atau Tolak untuk memproses pendaftaran Pengelola yang masih menunggu persetujuan.');
        }

        $newStatus = $targetUser->status_akun === 'aktif' ? 'nonaktif' : 'aktif';
        $updates = ['status_akun' => $newStatus];
        if ($newStatus === 'aktif' && $targetUser->role === 'pengelola' && !$targetUser->approved_at) {
            $updates['approved_at'] = now();
            $updates['approved_by'] = Auth::id();
        }
        $targetUser->update($updates);

        $label = $newStatus === 'aktif' ? 'diaktifkan kembali' : 'dinonaktifkan';

        return redirect()->route('admin.users')
            ->with('success', "Status akun '{$targetUser->name}' berhasil {$label}.");
    }

    /**
     * Riwayat Login Pribadi untuk Kelola Akun (Terkunci ketat hanya untuk akun yang sedang login)
     */
    public function myLoginHistory(Request $request)
    {
        $user = Auth::user();

        $statusLabels = [
            'berhasil' => 'Berhasil',
            'gagal' => 'Gagal',
            'terkunci' => 'Terkunci',
            'menunggu_acc' => 'Menunggu ACC',
            'nonaktif' => 'Nonaktif',
            'ditolak' => 'Ditolak',
        ];

        $portalLabels = [
            'mahasiswa' => 'Portal Mahasiswa',
            'petugas' => 'Portal Pengelola / Admin',
        ];

        $records = LoginHistory::where('user_id', $user->id)
            ->latest('logged_in_at')
            ->limit(25)
            ->get()
            ->map(function (LoginHistory $log) use ($statusLabels, $portalLabels) {
                $ts = $log->logged_in_at ?? $log->created_at;
                return [
                    'id' => $log->id,
                    'status' => $log->status,
                    'status_label' => $statusLabels[$log->status] ?? ucfirst((string) $log->status),
                    'portal' => $log->portal,
                    'portal_label' => $portalLabels[$log->portal] ?? ucfirst((string) $log->portal),
                    'ip_address' => $log->ip_address ?: '-',
                    'device_label' => $log->device_label ?: 'Perangkat Tidak Dikenal',
                    'notes' => $log->notes ?: '',
                    'logged_in_at' => $ts ? $ts->timezone('Asia/Makassar')->format('d M Y, H:i') . ' WITA' : '-',
                ];
            })
            ->values();

        return response()->json([
            'ok' => true,
            'user' => [
                'name' => $user->name,
                'nomor_induk' => $user->nomor_induk,
                'role' => $user->role,
            ],
            'items' => $records,
        ]);
    }

    /**
     * Persetujuan Peminjaman oleh Pengelola (Laboratorium / Bengkel / Admin JTIK)
     * Hanya dapat menyetujui barang yang berada di bawah wewenang ruangannya sendiri
     */
    public function setujuiPeminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('sarpras.ruangan')->findOrFail($id);

        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);

        if (!$this->isPengelolaAuthorizedForItem($peminjaman, $ruangan, $isAdminJTIK)) {
            $ownerRoom = $this->getItemResponsibleRoomName($peminjaman);
            return redirect()->back()->with('error', "Akses Ditolak: Anda tidak memiliki wewenang untuk menyetujui barang ini. Otoritas persetujuan berada pada Pengelola {$ownerRoom}.");
        }

        $rawCatatan = trim((string) $request->input('catatan_pengelola', ''));
        $catatan = trim($rawCatatan, " \t\n\r\0\x0B,-.") === '' ? '' : $rawCatatan;
        $lokasi = trim((string) $request->input('lokasi_pengambilan', ''));
        $jaminan = trim((string) $request->input('syarat_jaminan', ''));

        $fullCatatan = [];
        if ($lokasi !== '') $fullCatatan[] = "Lokasi: {$lokasi}";
        if ($jaminan !== '') $fullCatatan[] = "Jaminan: {$jaminan}";
        if ($catatan !== '') $fullCatatan[] = "Catatan: {$catatan}";

        $peminjaman->status = 'disetujui';
        if (!empty($fullCatatan)) {
            $peminjaman->catatan_pengelola = implode(" | ", $fullCatatan);
        }
        $peminjaman->save();

        // Kurangi jumlah tersedia pada unit sarpras jika mencukupi
        if ($peminjaman->sarpras && $peminjaman->sarpras->jumlah_tersedia >= $peminjaman->jumlah) {
            $peminjaman->sarpras->decrement('jumlah_tersedia', $peminjaman->jumlah);
        }

        return redirect()->back()->with('success', "Permohonan pinjaman #{$peminjaman->kode_peminjaman} ({$peminjaman->sarpras->nama_sarpras}) berhasil disetujui.");
    }

    /**
     * Penolakan Peminjaman oleh Pengelola (Laboratorium / Bengkel / Admin JTIK)
     * Hanya dapat menolak barang yang berada di bawah wewenang ruangannya sendiri
     */
    public function tolakPeminjaman(Request $request, $id)
    {
        $request->validate([
            'catatan_pengelola' => 'required|string',
        ], [
            'catatan_pengelola.required' => 'Alasan penolakan peminjaman wajib diisi.',
        ]);

        $peminjaman = Peminjaman::with('sarpras.ruangan')->findOrFail($id);

        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);

        if (!$this->isPengelolaAuthorizedForItem($peminjaman, $ruangan, $isAdminJTIK)) {
            $ownerRoom = $this->getItemResponsibleRoomName($peminjaman);
            return redirect()->back()->with('error', "Akses Ditolak: Anda tidak memiliki wewenang untuk menolak barang ini. Otoritas berada pada Pengelola {$ownerRoom}.");
        }

        $peminjaman->status = 'ditolak';
        $peminjaman->catatan_pengelola = $request->input('catatan_pengelola');
        $peminjaman->save();

        return redirect()->back()->with('success', "Permohonan pinjaman #{$peminjaman->kode_peminjaman} ({$peminjaman->sarpras->nama_sarpras}) telah ditolak.");
    }

    /**
     * Setujui seluruh barang dalam satu tiket peminjaman yang berada di bawah wewenang ruangan pengelola ini
     */
    public function setujuiPeminjamanTiket(Request $request, $kode)
    {
        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);

        $items = Peminjaman::with('sarpras.ruangan')
            ->where('kode_peminjaman', $kode)
            ->where('status', 'menunggu_verifikasi')
            ->get();

        $rawCatatan = trim((string) $request->input('catatan_pengelola', 'Disetujui oleh pengelola ' . ($namaRuangan ?? 'ruangan')));
        $catatan = trim($rawCatatan, " \t\n\r\0\x0B,-.") === '' ? '' : $rawCatatan;
        $lokasi = trim((string) $request->input('lokasi_pengambilan', $namaRuangan ?? 'Ruangan'));
        $jaminan = trim((string) $request->input('syarat_jaminan', 'KTM / Kartu Mahasiswa'));

        $fullCatatan = [];
        if ($lokasi !== '') $fullCatatan[] = "Lokasi: {$lokasi}";
        if ($jaminan !== '') $fullCatatan[] = "Jaminan: {$jaminan}";
        if ($catatan !== '') $fullCatatan[] = "Catatan: {$catatan}";
        $catatanStr = !empty($fullCatatan) ? implode(" | ", $fullCatatan) : null;

        $approvedCount = 0;
        foreach ($items as $item) {
            if ($this->isPengelolaAuthorizedForItem($item, $ruangan, $isAdminJTIK)) {
                $item->status = 'disetujui';
                if ($catatanStr) {
                    $item->catatan_pengelola = $catatanStr;
                }
                $item->save();

                if ($item->sarpras && $item->sarpras->jumlah_tersedia >= $item->jumlah) {
                    $item->sarpras->decrement('jumlah_tersedia', $item->jumlah);
                }

                $approvedCount++;
            }
        }

        if ($approvedCount === 0) {
            return redirect()->back()->with('error', "Tidak ada barang dalam tiket #{$kode} yang dapat disetujui oleh otoritas {$namaRuangan}.");
        }

        return redirect()->back()->with('success', "Berhasil menyetujui {$approvedCount} barang milik {$namaRuangan} pada tiket #{$kode}.");
    }

    /**
     * Tolak seluruh barang dalam satu tiket peminjaman yang berada di bawah wewenang ruangan pengelola ini
     */
    public function tolakPeminjamanTiket(Request $request, $kode)
    {
        $request->validate([
            'catatan_pengelola' => 'required|string',
        ], [
            'catatan_pengelola.required' => 'Alasan penolakan peminjaman wajib diisi.',
        ]);

        $user = Auth::user();
        [$ruangan, $badgeRuangan, $namaRuangan, $isAdminJTIK] = $this->resolvePengelolaRuangan($user);

        $items = Peminjaman::with('sarpras.ruangan')
            ->where('kode_peminjaman', $kode)
            ->where('status', 'menunggu_verifikasi')
            ->get();

        $rejectedCount = 0;
        foreach ($items as $item) {
            if ($this->isPengelolaAuthorizedForItem($item, $ruangan, $isAdminJTIK)) {
                $item->status = 'ditolak';
                $item->catatan_pengelola = $request->input('catatan_pengelola');
                $item->save();
                $rejectedCount++;
            }
        }

        if ($rejectedCount === 0) {
            return redirect()->back()->with('error', "Tidak ada barang dalam tiket #{$kode} yang dapat ditolak oleh otoritas {$namaRuangan}.");
        }

        return redirect()->back()->with('success', "Permohonan {$rejectedCount} barang milik {$namaRuangan} pada tiket #{$kode} telah ditolak.");
    }

    /**
     * Perbarui Profil Akun Pengguna yang Sedang Login
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nomor_induk' => 'nullable|string|max:50',
            'kelas_id' => 'nullable',
            'jurusan' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama lengkap akun wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email yang dimasukkan tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
        ]);

        $selectedClass = $request->input('kelas_id') ?? $request->input('kelas') ?? $request->input('jurusan');
        $resolvedKelas = !empty($selectedClass) ? \App\Models\Kelas::resolveFromInput($selectedClass) : null;

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'nomor_induk' => $request->nomor_induk ?? $user->nomor_induk,
            'jabatan' => $request->jabatan ?? $user->jabatan,
        ];

        if ($resolvedKelas) {
            $updateData['kelas_id'] = $resolvedKelas->id;
        }

        $user->update($updateData);

        return redirect()->back()->with('success', 'Profil akun Anda berhasil diperbarui!');
    }

    /**
     * Perbarui Kata Sandi Akun Pengguna yang Sedang Login
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string|max:32',
            'password' => 'required|string|min:8|max:32|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'current_password.max' => 'Kata sandi saat ini maksimal 32 karakter.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.max' => 'Kata sandi baru maksimal 32 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Kata sandi saat ini yang Anda masukkan tidak sesuai.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Kata sandi akun Anda berhasil diperbarui!');
    }
}
