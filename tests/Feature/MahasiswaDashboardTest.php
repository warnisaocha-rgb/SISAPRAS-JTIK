<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\Sarpras;
use App\Models\Peminjaman;
use App\Models\BebasPinjam;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MahasiswaDashboardTest extends TestCase
{
    use RefreshDatabase;

    private function createMahasiswa(): User
    {
        return User::create([
            'nomor_induk' => '220209501012',
            'name' => 'Asyifa Nur Cahya Savitri',
            'email' => 'asyifa.mhs@unm.ac.id',
            'password' => Hash::make('Maba2022ft!'),
            'role' => 'mahasiswa',
            'jurusan' => 'Pendidikan Teknik Informatika',
            'status_akun' => 'aktif',
        ]);
    }

    private function createSarprasAlat(Ruangan $ruangan, Kategori $kategori): Sarpras
    {
        return Sarpras::create([
            'kode_sarpras' => 'ALT-001',
            'nama_sarpras' => 'Osiloskop Digital GW Instek',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangan->id,
            'lokasi_rak' => 'RAK-ELK-01',
            'jumlah_total' => 10,
            'jumlah_tersedia' => 8,
            'maks_pinjam' => 2,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);
    }

    public function test_mahasiswa_can_view_dashboard_with_consistent_sidebar_and_header()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->get(route('mahasiswa.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('DASHBOARD MAHASISWA');
        $response->assertSee('MENU PEMINJAMAN');
        $response->assertSee('Alat dan Bahan');
        $response->assertSee('Sarana Ruangan');
        $response->assertSee('badge-role-pill');
        $response->assertSee('cart-btn-header');
        $response->assertSee('user-dropdown-menu');
        $response->assertSee('modalPinjamAlat');
        $response->assertSee('modalRelokasiRuang');
        $response->assertSee('modalPengembalian');
        $response->assertSee('modalBebasPinjam');
        $response->assertSee('modalDetailTransaksi');
        $response->assertSee('modalKeranjang');
        $response->assertSee('FORMULIR PENGAJUAN PINJAM');
        $response->assertSee('KIRIM PENGAJUAN PINJAM');
        $response->assertSee('figmaCartItemsContainer');
        $response->assertDontSee('KERANJANG PEMINJAMAN SARPRAS');
        $response->assertDontSee('Proses Pengajuan Peminjaman');
        $response->assertSee('modalProfile');
        $response->assertSee('modalChangePassword');
        $response->assertSee('Keluar (Logout)');
    }

    public function test_mahasiswa_can_submit_peminjaman_alat_dan_bahan()
    {
        $user = $this->createMahasiswa();
        $ruangan = Ruangan::create([
            'kode_ruangan' => 'LAB-01',
            'nama_ruangan' => 'Laboratorium Elektronika',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create([
            'nama_kategori' => 'Alat Ukur & Instrumen',
        ]);
        $sarpras = $this->createSarprasAlat($ruangan, $kategori);

        $response = $this->actingAs($user)->post(route('mahasiswa.peminjaman.store'), [
            'sarpras_id' => $sarpras->id,
            'jumlah' => 1,
            'tgl_pinjam' => now()->toDateString(),
            'tgl_kembali_rencana' => now()->addDays(1)->toDateString(),
            'waktu_keterangan' => '08:00 - 12:00 WITA',
            'dosen_penanggung_jawab' => 'Dr. Ramly, M.Pd.',
            'keperluan' => 'Praktikum Elektronika Dasar Modul 4',
        ]);

        $response->assertRedirect(route('mahasiswa.status-pinjam'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('peminjamans', [
            'user_id' => $user->id,
            'sarpras_id' => $sarpras->id,
            'jumlah' => 1,
            'status' => 'menunggu_verifikasi',
            'dosen_penanggung_jawab' => 'Dr. Ramly, M.Pd.',
        ]);
    }

    public function test_mahasiswa_can_submit_relokasi_ruang()
    {
        $user = $this->createMahasiswa();
        $ruangAsal = Ruangan::create([
            'kode_ruangan' => 'R101',
            'nama_ruangan' => 'Ruang Teori 101',
            'jenis_ruangan' => 'sarana_ruangan',
            'kondisi' => 'tersedia',
        ]);
        $ruangTujuan = Ruangan::create([
            'kode_ruangan' => 'R204',
            'nama_ruangan' => 'Ruang Seminar 204',
            'jenis_ruangan' => 'sarana_ruangan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create(['nama_kategori' => 'Mebelair']);
        $perabot = Sarpras::create([
            'kode_sarpras' => 'MBL-001',
            'nama_sarpras' => 'Kursi Kuliah Lipat Chitose',
            'jenis_sarpras' => 'sarana_ruangan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangAsal->id,
            'jumlah_total' => 50,
            'jumlah_tersedia' => 40,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $response = $this->actingAs($user)->post(route('mahasiswa.relokasi.store'), [
            'sarpras_id' => $perabot->id,
            'ruangan_asal_id' => $ruangAsal->id,
            'ruangan_tujuan_id' => $ruangTujuan->id,
            'jumlah' => 10,
            'tgl_pinjam' => now()->toDateString(),
            'tgl_kembali_rencana' => now()->addDays(1)->toDateString(),
            'waktu_keterangan' => '09:00 - 15:00 WITA',
            'dosen_penanggung_jawab' => 'Koordinator Ruang Kuliah',
            'keperluan' => 'Penambahan kursi seminar proposal skripsi mahasiswa',
        ]);

        $response->assertRedirect(route('mahasiswa.status-pinjam'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('peminjamans', [
            'user_id' => $user->id,
            'sarpras_id' => $perabot->id,
            'jumlah' => 10,
            'status' => 'menunggu_verifikasi',
        ]);
    }

    public function test_mahasiswa_can_confirm_pengembalian_fisik()
    {
        $user = $this->createMahasiswa();
        $ruangan = Ruangan::create([
            'kode_ruangan' => 'LAB-02',
            'nama_ruangan' => 'Lab Jaringan',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create(['nama_kategori' => 'Jaringan']);
        $sarpras = $this->createSarprasAlat($ruangan, $kategori);

        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-TEST',
            'user_id' => $user->id,
            'sarpras_id' => $sarpras->id,
            'jumlah' => 1,
            'tgl_pinjam' => now()->subDays(2),
            'tgl_kembali_rencana' => now()->addDays(1),
            'status' => 'sedang_dipinjam',
        ]);

        $response = $this->actingAs($user)->post(route('mahasiswa.pengembalian.store'), [
            'peminjaman_id' => $peminjaman->id,
            'catatan_kondisi_kembali' => 'Barang lengkap, bersih dan berfungsi normal.',
        ]);

        $response->assertRedirect(route('mahasiswa.pengembalian'));
        $response->assertSessionHas('success');

        $peminjaman->refresh();
        $this->assertEquals('menunggu_cek_fisik', $peminjaman->status_pengembalian);
        $this->assertEquals('Barang lengkap, bersih dan berfungsi normal.', $peminjaman->catatan_kondisi_kembali);

        // Setelah diajukan pengembalian, tiket hilang dari dropdown pilihan dan pindah ke section menunggu cek fisik
        $pageResponse = $this->actingAs($user)->get(route('mahasiswa.pengembalian'));
        $pageResponse->assertStatus(200);
        $pageResponse->assertSee('PENGEMBALIAN SEDANG MENUNGGU PEMERIKSAAN FISIK OLEH LABORAN');
        $pageResponse->assertDontSee('<option value="' . $peminjaman->id . '"', false);
    }

    public function test_mahasiswa_can_cancel_pending_peminjaman()
    {
        $user = $this->createMahasiswa();
        $ruangan = Ruangan::create([
            'kode_ruangan' => 'LAB-03',
            'nama_ruangan' => 'Lab Multimedia',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create(['nama_kategori' => 'Multimedia']);
        $sarpras = $this->createSarprasAlat($ruangan, $kategori);

        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-BATAL',
            'user_id' => $user->id,
            'sarpras_id' => $sarpras->id,
            'jumlah' => 1,
            'tgl_pinjam' => now(),
            'tgl_kembali_rencana' => now()->addDays(1),
            'status' => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($user)->delete(route('mahasiswa.peminjaman.batal', $peminjaman->id));

        $response->assertRedirect(route('mahasiswa.status-pinjam'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('peminjamans', [
            'id' => $peminjaman->id,
        ]);
    }

    public function test_mahasiswa_can_cancel_peminjaman_with_status_menunggu()
    {
        $user = $this->createMahasiswa();
        $ruangan = Ruangan::create([
            'kode_ruangan' => 'LAB-02',
            'nama_ruangan' => 'Laboratorium Jaringan',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create(['nama_kategori' => 'Jaringan Komputer']);
        $sarpras = $this->createSarprasAlat($ruangan, $kategori);

        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-ACC',
            'user_id' => $user->id,
            'sarpras_id' => $sarpras->id,
            'jumlah' => 1,
            'tgl_pinjam' => now(),
            'tgl_kembali_rencana' => now()->addDays(1),
            'status' => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($user)->delete(route('mahasiswa.peminjaman.batal', $peminjaman->id));

        $response->assertRedirect(route('mahasiswa.status-pinjam'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('peminjamans', [
            'id' => $peminjaman->id,
        ]);
    }

    public function test_mahasiswa_can_submit_bebas_pinjam()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->post(route('mahasiswa.bebas-pinjam.store'), [
            'keperluan' => 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM',
        ]);

        $response->assertRedirect(route('mahasiswa.bebas-sarpras'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bebas_pinjams', [
            'user_id' => $user->id,
            'status_final' => 'belum_cek',
        ]);
    }

    public function test_mahasiswa_can_view_peminjaman_catalog()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->get(route('mahasiswa.peminjaman'));

        $response->assertStatus(200);
        $response->assertSee('KATALOG ALAT &amp; BAHAN', false);
    }

    public function test_mahasiswa_can_view_peminjaman_alat_page()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->get(route('mahasiswa.peminjaman.alat'));

        $response->assertStatus(200);
        $response->assertSee('KATALOG ALAT &amp; BAHAN', false);
        $response->assertSee('Alat dan Bahan');
        $response->assertSee('Sarana Ruangan');
    }

    public function test_mahasiswa_can_view_peminjaman_ruangan_page()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->get(route('mahasiswa.peminjaman.ruangan'));

        $response->assertStatus(200);
        $response->assertSee('SARANA RUANGAN', false);
        $response->assertSee('PENGAJUAN RELOKASI SARANA RUANGAN', false);
        $response->assertSee('Alat dan Bahan');
        $response->assertSee('Sarana Ruangan');
    }

    public function test_mahasiswa_can_view_pengembalian_page()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->get(route('mahasiswa.pengembalian'));

        $response->assertStatus(200);
        $response->assertSee('PENGEMBALIAN FISIK SARPRAS', false);
    }

    public function test_mahasiswa_can_view_status_pinjam_page()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->get(route('mahasiswa.status-pinjam'));

        $response->assertStatus(200);
        $response->assertSee('STATUS PINJAM &amp; RIWAYAT TIKET', false);
    }

    public function test_mahasiswa_can_view_bebas_sarpras_page()
    {
        $user = $this->createMahasiswa();

        $response = $this->actingAs($user)->get(route('mahasiswa.bebas-sarpras'));

        $response->assertStatus(200);
        $response->assertSee('BEBAS SARANA &amp; PRASARANA', false);
    }

    public function test_mahasiswa_can_submit_batch_checkout_with_multiple_items_and_clears_cart()
    {
        $user = $this->createMahasiswa();
        $ruangan = Ruangan::create([
            'kode_ruangan' => 'LAB-IT-01',
            'nama_ruangan' => 'Bengkel IT',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create([
            'nama_kategori' => 'Mikrokontroler & IoT',
        ]);

        $item1 = Sarpras::create([
            'kode_sarpras' => 'ARD-UNO-KIT',
            'nama_sarpras' => 'Arduino Uno R3 Starter Kit',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangan->id,
            'jumlah_total' => 10,
            'jumlah_tersedia' => 8,
            'maks_pinjam' => 2,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $item2 = Sarpras::create([
            'kode_sarpras' => 'SP-002',
            'nama_sarpras' => 'ESP32',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangan->id,
            'jumlah_total' => 10,
            'jumlah_tersedia' => 9,
            'maks_pinjam' => 2,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $cartData = [
            [
                'id' => $item1->id,
                'nama' => $item1->nama_sarpras . ' (' . $item1->kode_sarpras . ')',
                'ruangan' => 'Bengkel IT',
                'jumlah' => 2,
            ],
            [
                'id' => $item2->id,
                'nama' => $item2->nama_sarpras . ' (' . $item2->kode_sarpras . ')',
                'ruangan' => 'Bengkel IT',
                'jumlah' => 1,
            ],
        ];

        $response = $this->actingAs($user)->post(route('mahasiswa.peminjaman.batch'), [
            'cart_items' => json_encode($cartData),
            'has_relokasi' => '0',
            'jadwal_penggunaan' => '18/11/2026 (08:00 - 15:00 WITA)',
            'keperluan' => 'Praktikum persiapan UTS...',
            'kelas' => 'Teknik komputer',
        ]);

        $response->assertRedirect(route('mahasiswa.status-pinjam'));
        $response->assertSessionHas('success');
        $response->assertSessionHas('clear_cart', true);

        // Check that both items were saved with the EXACT same kode_peminjaman
        $peminjaman1 = Peminjaman::where('sarpras_id', $item1->id)->where('user_id', $user->id)->first();
        $peminjaman2 = Peminjaman::where('sarpras_id', $item2->id)->where('user_id', $user->id)->first();

        $this->assertNotNull($peminjaman1);
        $this->assertNotNull($peminjaman2);
        $this->assertEquals(2, $peminjaman1->jumlah);
        $this->assertEquals(1, $peminjaman2->jumlah);
        $this->assertEquals($peminjaman1->kode_peminjaman, $peminjaman2->kode_peminjaman);

        // Check user class updated
        $this->assertEquals('Teknik komputer', $user->fresh()->jurusan);

        // Follow redirect to status-pinjam and assert clear_cart is handled
        $statusPage = $this->actingAs($user)->get(route('mahasiswa.status-pinjam'));
        $statusPage->assertStatus(200);
        $statusPage->assertSee('localStorage.removeItem(\'sisapras_cart\')', false);
    }

    public function test_bebas_sarpras_modal_shows_belum_cek_when_units_not_verified()
    {
        $user = $this->createMahasiswa();
        BebasPinjam::create([
            'kode_pengajuan' => 'BP-2026-0003',
            'user_id' => $user->id,
            'keperluan' => 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM',
            'tgl_pengajuan' => now(),
            'status_lab_komputer' => 'belum_cek',
            'status_lab_jaringan' => 'belum_cek',
            'status_ruang_inventaris' => 'belum_cek',
            'status_final' => 'belum_cek',
        ]);

        $response = $this->actingAs($user)->get(route('mahasiswa.bebas-sarpras'));

        $response->assertStatus(200);
        $response->assertSee('BELUM CEK');
        $response->assertSee('PRATINJAU FORMAT SURAT');
        $response->assertSee('MENUNGGU PENGESAHAN LENGKAP');
        $response->assertSee('Belum Dapat Dicetak (Menunggu Verifikasi 3 Unit)');
    }

    public function test_bebas_sarpras_modal_shows_bebas_when_all_units_verified()
    {
        $user = $this->createMahasiswa();
        BebasPinjam::create([
            'kode_pengajuan' => 'BP-2026-0004',
            'user_id' => $user->id,
            'keperluan' => 'Pemberkasan Yudisium & Wisuda Sarjana FT UNM',
            'tgl_pengajuan' => now(),
            'status_lab_komputer' => 'bebas',
            'petugas_lab_komputer' => 'Sukirman, S.T.',
            'status_lab_jaringan' => 'bebas',
            'petugas_lab_jaringan' => 'Ahmad Dahlan, S.Kom.',
            'status_ruang_inventaris' => 'bebas',
            'petugas_ruang_inventaris' => 'Fahrul, S.Pd., M.T.',
            'status_final' => 'bebas',
        ]);

        $response = $this->actingAs($user)->get(route('mahasiswa.bebas-sarpras'));

        $response->assertStatus(200);
        $response->assertSee('TELAH BEBAS DARI SEGALA TANGGUNGAN PINJAMAN SARPRAS');
        $response->assertSee('DIGITAL SIGNATURE VERIFIED');
        $response->assertSee('Cetak Surat (Print / PDF)');
    }
}
