<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PengelolaMenuTest extends TestCase
{
    use RefreshDatabase;

    private function createPengelola(): User
    {
        $ruangan = Ruangan::firstOrCreate(
            ['nama_ruangan' => 'Laboratorium'],
            ['kode_ruangan' => 'RNG-01', 'jenis_ruangan' => 'alat_bahan', 'kondisi' => 'tersedia']
        );

        return User::create([
            'nomor_induk' => '199002022015041002',
            'name' => 'Sulaeman, S.T.',
            'email' => 'pengelola.lab@unm.ac.id',
            'password' => Hash::make('Pengelola123!'),
            'role' => 'pengelola',
            'ruangan_id' => $ruangan->id,
            'status_akun' => 'aktif',
        ]);
    }

    public function test_pengelola_can_view_dashboard_with_menu()
    {
        $user = $this->createPengelola();

        $response = $this->actingAs($user)->get(route('pengelola.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('btn-header-room');
        $response->assertSee('modalProfile');
        $response->assertSee('modalChangePassword');
        $response->assertSee('modalRoomInfo');
        $response->assertSee('Profil Saya');
        $response->assertSee('Ganti Kata Sandi');
        $response->assertSee('Keluar (Logout)');
    }

    public function test_all_pengelola_pages_have_functional_menu()
    {
        $user = $this->createPengelola();

        $routes = [
            'pengelola.dashboard',
            'pengelola.riwayat',
            'pengelola.pengembalian',
            'pengelola.bebas-pinjam',
        ];

        foreach ($routes as $routeName) {
            $res = $this->actingAs($user)->get(route($routeName));
            $res->assertStatus(200);
            $res->assertSee('btn-header-room');
            $res->assertSee('modalProfile');
            $res->assertSee('modalChangePassword');
            $res->assertSee('modalRoomInfo');
        }
    }

    public function test_pengelola_can_update_profile()
    {
        $user = $this->createPengelola();

        $response = $this->actingAs($user)->post(route('profile.update'), [
            'name' => 'Sulaeman, S.T., M.Kom.',
            'email' => $user->email,
            'nomor_induk' => $user->nomor_induk,
            'jabatan' => 'Kepala Lab Terpadu',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Sulaeman, S.T., M.Kom.',
            'jabatan' => 'Kepala Lab Terpadu',
        ]);
    }

    public function test_pengelola_can_update_password()
    {
        $user = $this->createPengelola();
        $user->update(['password' => Hash::make('OldSecret123!')]);

        $response = $this->actingAs($user)->post(route('profile.password'), [
            'current_password' => 'OldSecret123!',
            'password' => 'NewSecret456!',
            'password_confirmation' => 'NewSecret456!',
        ]);

        $response->assertRedirect();
        $user->refresh();
        $this->assertTrue(Hash::check('NewSecret456!', $user->password));
    }

    public function test_pengelola_password_update_fails_with_wrong_current_password()
    {
        $user = $this->createPengelola();

        $response = $this->actingAs($user)->post(route('profile.password'), [
            'current_password' => 'WrongPassword!',
            'password' => 'NewSecret456!',
            'password_confirmation' => 'NewSecret456!',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_pengelola_can_approve_peminjaman_and_decrements_stock()
    {
        $pengelola = $this->createPengelola();
        $kategori = \App\Models\Kategori::create(['nama_kategori' => 'Alat Lab']);
        $sarpras = \App\Models\Sarpras::create([
            'kode_sarpras' => 'ALT-LAB-01',
            'nama_sarpras' => 'Mikroskop Digital',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $pengelola->ruangan_id,
            'jumlah_total' => 10,
            'jumlah_tersedia' => 10,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $mhs = User::create([
            'nomor_induk' => '220209501999',
            'name' => 'Budi Santoso',
            'email' => 'budi.mhs@unm.ac.id',
            'password' => Hash::make('Maba22ft!'),
            'role' => 'mahasiswa',
            'status_akun' => 'aktif',
        ]);

        $peminjaman = \App\Models\Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-9991',
            'user_id' => $mhs->id,
            'sarpras_id' => $sarpras->id,
            'jumlah' => 2,
            'tgl_pinjam' => now()->toDateString(),
            'tgl_kembali_rencana' => now()->addDays(2)->toDateString(),
            'keperluan' => 'Praktikum Biologi Komputasi',
            'status' => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($pengelola)->post(route('pengelola.peminjaman.setujui', $peminjaman->id), [
            'lokasi_pengambilan' => 'Loket Lab Terpadu',
            'syarat_jaminan' => 'KTM Asli',
            'catatan_pengelola' => 'Jaga kebersihan lensa mikroskop',
        ]);

        $response->assertRedirect();
        $peminjaman->refresh();
        $this->assertEquals('disetujui', $peminjaman->status);
        $this->assertEquals(8, $sarpras->fresh()->jumlah_tersedia);
    }

    public function test_pengelola_can_verify_pengembalian_and_restores_stock()
    {
        $pengelola = $this->createPengelola();
        $kategori = \App\Models\Kategori::create(['nama_kategori' => 'Alat Lab 2']);
        $sarpras = \App\Models\Sarpras::create([
            'kode_sarpras' => 'ALT-LAB-02',
            'nama_sarpras' => 'Multitester Lab',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $pengelola->ruangan_id,
            'jumlah_total' => 10,
            'jumlah_tersedia' => 8,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $mhs = User::create([
            'nomor_induk' => '220209501998',
            'name' => 'Citra Lestari',
            'email' => 'citra.mhs@unm.ac.id',
            'password' => Hash::make('Maba22ft!'),
            'role' => 'mahasiswa',
            'status_akun' => 'aktif',
        ]);

        $peminjaman = \App\Models\Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-9992',
            'user_id' => $mhs->id,
            'sarpras_id' => $sarpras->id,
            'jumlah' => 2,
            'tgl_pinjam' => now()->subDays(2)->toDateString(),
            'tgl_kembali_rencana' => now()->toDateString(),
            'keperluan' => 'Praktikum Elektronika',
            'status' => 'sedang_dipinjam',
            'status_pengembalian' => 'menunggu_cek_fisik',
        ]);

        $response = $this->actingAs($pengelola)->post(route('pengelola.pengembalian.verifikasi', $peminjaman->id), [
            'catatan_laboran' => 'Barang lengkap dan normal',
            'lokasi_simpan' => 'RAK-01',
        ]);

        $response->assertRedirect();
        $peminjaman->refresh();
        $this->assertEquals('selesai', $peminjaman->status);
        $this->assertEquals('selesai_diterima', $peminjaman->status_pengembalian);
        $this->assertEquals(10, $sarpras->fresh()->jumlah_tersedia);
    }

    public function test_pengelola_sees_one_ticket_for_multi_item_checkout_and_only_approves_own_room()
    {
        $ruangBengkel = Ruangan::create([
            'kode_ruangan' => 'RNG-BENGKEL',
            'nama_ruangan' => 'Bengkel IT',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $ruangLab = Ruangan::create([
            'kode_ruangan' => 'RNG-LAB',
            'nama_ruangan' => 'Laboratorium Komputer',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);

        $pengelolaBengkel = User::create([
            'nomor_induk' => '199103032018041003',
            'name' => 'Pak Bengkel',
            'email' => 'bengkel@unm.ac.id',
            'password' => Hash::make('Bengkel123!'),
            'role' => 'pengelola',
            'ruangan_id' => $ruangBengkel->id,
            'status_akun' => 'aktif',
        ]);

        $mhs = User::create([
            'nomor_induk' => '220209501001',
            'name' => 'Warnisyah Armin',
            'email' => 'warnisyah@unm.ac.id',
            'password' => Hash::make('Mhs123!'),
            'role' => 'mahasiswa',
            'status_akun' => 'aktif',
        ]);

        $kategori = \App\Models\Kategori::firstOrCreate(['nama_kategori' => 'Alat']);

        // 2 items in Bengkel IT
        $sarprasB1 = \App\Models\Sarpras::create([
            'kode_sarpras' => 'ARD-UNO-01',
            'nama_sarpras' => 'Arduino Uno R3 Starter Kit',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangBengkel->id,
            'jumlah_total' => 10,
            'jumlah_tersedia' => 10,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);
        $sarprasB2 = \App\Models\Sarpras::create([
            'kode_sarpras' => 'ESP-002',
            'nama_sarpras' => 'ESP32 NodeMCU',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangBengkel->id,
            'jumlah_total' => 10,
            'jumlah_tersedia' => 10,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        // 1 item in Laboratorium
        $sarprasL1 = \App\Models\Sarpras::create([
            'kode_sarpras' => 'OSC-003',
            'nama_sarpras' => 'Osiloskop Digital Lab',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangLab->id,
            'jumlah_total' => 5,
            'jumlah_tersedia' => 5,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $kodeTiket = 'TRX-2026-MULTI1';

        $p1 = \App\Models\Peminjaman::create([
            'kode_peminjaman' => $kodeTiket,
            'user_id' => $mhs->id,
            'sarpras_id' => $sarprasB1->id,
            'jumlah' => 2,
            'tgl_pinjam' => now()->toDateString(),
            'tgl_kembali_rencana' => now()->addDays(2)->toDateString(),
            'keperluan' => 'Praktikum IoT dan Mikrokontroler',
            'status' => 'menunggu_verifikasi',
        ]);
        $p2 = \App\Models\Peminjaman::create([
            'kode_peminjaman' => $kodeTiket,
            'user_id' => $mhs->id,
            'sarpras_id' => $sarprasB2->id,
            'jumlah' => 1,
            'tgl_pinjam' => now()->toDateString(),
            'tgl_kembali_rencana' => now()->addDays(2)->toDateString(),
            'keperluan' => 'Praktikum IoT dan Mikrokontroler',
            'status' => 'menunggu_verifikasi',
        ]);
        $p3 = \App\Models\Peminjaman::create([
            'kode_peminjaman' => $kodeTiket,
            'user_id' => $mhs->id,
            'sarpras_id' => $sarprasL1->id,
            'jumlah' => 1,
            'tgl_pinjam' => now()->toDateString(),
            'tgl_kembali_rencana' => now()->addDays(2)->toDateString(),
            'keperluan' => 'Praktikum IoT dan Mikrokontroler',
            'status' => 'menunggu_verifikasi',
        ]);

        // 1. Dashboard Pengelola Bengkel harus menampilkan hanya 1 baris untuk tiket ini
        $dashRes = $this->actingAs($pengelolaBengkel)->get(route('pengelola.dashboard'));
        $dashRes->assertStatus(200);
        $dashRes->assertSee($kodeTiket);
        $dashRes->assertSee('1 Tiket (3 Barang)');
        $dashRes->assertSee('Arduino Uno R3 Starter Kit');
        $dashRes->assertSee('ESP32 NodeMCU');
        $dashRes->assertSee('Osiloskop Digital Lab');
        $dashRes->assertSee('Otoritas Laboratorium');

        // Pastikan kode tiket hanya muncul 1 kali dalam kolom TRX ID
        $content = $dashRes->getContent();
        $this->assertEquals(1, substr_count($content, '<span class="trx-id">' . $kodeTiket . '</span>'));

        // 2. Pengelola Bengkel tidak boleh dapat menyetujui barang milik Laboratorium
        $rejectCrossRoom = $this->actingAs($pengelolaBengkel)->post(route('pengelola.peminjaman.setujui', $p3->id));
        $rejectCrossRoom->assertRedirect();
        $rejectCrossRoom->assertSessionHas('error');
        $p3->refresh();
        $this->assertEquals('menunggu_verifikasi', $p3->status);

        // 3. Batch approve tiket oleh Pengelola Bengkel: hanya menyetujui 2 barang milik Bengkel IT
        $batchApproveRes = $this->actingAs($pengelolaBengkel)->post(route('pengelola.peminjaman.setujui-tiket', $kodeTiket));
        $batchApproveRes->assertRedirect();
        $batchApproveRes->assertSessionHas('success');

        $p1->refresh();
        $p2->refresh();
        $p3->refresh();

        $this->assertEquals('disetujui', $p1->status);
        $this->assertEquals('disetujui', $p2->status);
        // Barang Lab tetap menunggu verifikasi (tidak ikut disetujui oleh pengelola bengkel)
        $this->assertEquals('menunggu_verifikasi', $p3->status);

        // Stok Bengkel berkurang sesuai barang yang disetujui
        $this->assertEquals(8, $sarprasB1->fresh()->jumlah_tersedia);
        $this->assertEquals(9, $sarprasB2->fresh()->jumlah_tersedia);
        $this->assertEquals(5, $sarprasL1->fresh()->jumlah_tersedia);
    }
}
