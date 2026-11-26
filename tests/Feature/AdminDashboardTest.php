<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\Sarpras;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        return User::create([
            'nomor_induk' => '198501012010121001',
            'name' => 'Dr. Mustari S. Lamada, M.T.',
            'email' => 'admin.sarpras@unm.ac.id',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
            'status_akun' => 'aktif',
        ]);
    }

    public function test_admin_can_view_all_admin_pages()
    {
        $admin = $this->createAdmin();
        $ruangan = Ruangan::create([
            'kode_ruangan' => 'RNG-01',
            'nama_ruangan' => 'Laboratorium Komputer',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create([
            'nama_kategori' => 'Alat Praktikum',
        ]);
        Sarpras::create([
            'kode_sarpras' => 'ALT-01',
            'nama_sarpras' => 'Osiloskop',
            'jenis_sarpras' => 'alat_bahan',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangan->id,
            'jumlah_total' => 5,
            'jumlah_tersedia' => 5,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $routes = [
            'admin.dashboard',
            'admin.sarana-ruangan',
            'admin.ruangan',
            'admin.users',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($admin)->get(route($route));
            $response->assertStatus(200);
        }
    }

    public function test_admin_can_create_and_delete_sarpras()
    {
        $admin = $this->createAdmin();
        $ruangan = Ruangan::create([
            'kode_ruangan' => 'RNG-02',
            'nama_ruangan' => 'Bengkel IT',
            'jenis_ruangan' => 'alat_bahan',
            'kondisi' => 'tersedia',
        ]);
        $kategori = Kategori::create([
            'nama_kategori' => 'Elektronika',
        ]);

        $createResponse = $this->actingAs($admin)->post(route('admin.sarpras.store'), [
            'kode_sarpras' => 'SP-TEST-001',
            'nama_sarpras' => 'Multimeter Digital Sanwa',
            'kategori_id' => $kategori->id,
            'ruangan_id' => $ruangan->id,
            'lokasi_rak' => 'RAK-01',
            'jumlah_total' => 10,
            'jumlah_tersedia' => 10,
            'maks_pinjam' => 2,
            'kondisi' => 'baik',
            'spesifikasi' => 'Multimeter digital presisi tinggi',
        ]);

        $createResponse->assertRedirect();
        $this->assertDatabaseHas('sarpras', [
            'kode_sarpras' => 'SP-TEST-001',
            'nama_sarpras' => 'Multimeter Digital Sanwa',
        ]);

        $sarpras = Sarpras::where('kode_sarpras', 'SP-TEST-001')->first();
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.sarpras.destroy', $sarpras->id));
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('sarpras', [
            'id' => $sarpras->id,
        ]);
    }
}
