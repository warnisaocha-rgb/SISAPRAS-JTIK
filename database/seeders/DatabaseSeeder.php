<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\Sarpras;
use App\Models\Peminjaman;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::ensureSeeded();

        // =========================================================================
        // 1. MASTER 3 UNIT ALAT & BAHAN (Unit Operasional: Laboratorium, Bengkel IT, Admin)
        // =========================================================================
        $ruangLab = Ruangan::updateOrCreate(
            ['kode_ruangan' => 'RNG-LJT-01'],
            [
                'nama_ruangan' => 'Laboratorium',
                'jenis_ruangan' => 'alat_bahan',
                'lokasi_gedung' => 'Lantai 2 - Gedung A (Lab Terpadu JTIK)',
                'pj_ruangan' => 'Sulaeman, S.T.',
                'nip_pj' => 'NIP. 19900202 201504 1 002',
                'role_pj' => 'Laboran Laboratorium',
                'kondisi' => 'tersedia',
            ]
        );

        $ruangBengkel = Ruangan::updateOrCreate(
            ['kode_ruangan' => 'RNG-BAV-03'],
            [
                'nama_ruangan' => 'Bengkel IT',
                'jenis_ruangan' => 'alat_bahan',
                'lokasi_gedung' => 'Lantai 1 - Gedung B (Bengkel IT)',
                'pj_ruangan' => 'Fahrul, S.Pd., M.T.',
                'nip_pj' => 'NIP. 19920303 201803 1 003',
                'role_pj' => 'Kepala Unit Bengkel IT',
                'kondisi' => 'tersedia',
            ]
        );

        $ruangAdmin = Ruangan::updateOrCreate(
            ['kode_ruangan' => 'RNG-LJT-02'],
            [
                'nama_ruangan' => 'Administrasi',
                'jenis_ruangan' => 'alat_bahan',
                'lokasi_gedung' => 'Lantai 3 - Gedung A',
                'pj_ruangan' => 'Ahmad Dahlan, S.Kom.',
                'nip_pj' => 'NIP. 19790612 201304 1 002',
                'role_pj' => 'Staf Unit Administrasi',
                'kondisi' => 'tersedia',
            ]
        );

        // =========================================================================
        // 1B. MASTER 16 RUANGAN SARANA (Monitoring Kursi & Meja: AE 101 - 110, AE 209, & LAB)
        // =========================================================================
        $saranaRoomsData = [
            ['kode_ruangan' => 'AE 101', 'nama_ruangan' => 'AE 101', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 102', 'nama_ruangan' => 'AE 102', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 103', 'nama_ruangan' => 'AE 103', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 104', 'nama_ruangan' => 'AE 104', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 105', 'nama_ruangan' => 'AE 105', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 106', 'nama_ruangan' => 'AE 106', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 107', 'nama_ruangan' => 'AE 107', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 108', 'nama_ruangan' => 'AE 108', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 109', 'nama_ruangan' => 'AE 109', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 110', 'nama_ruangan' => 'AE 110', 'lokasi_gedung' => 'Lantai 1 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'AE 209', 'nama_ruangan' => 'AE 209', 'lokasi_gedung' => 'Lantai 2 - Gedung AE', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'LAB JARINGAN', 'nama_ruangan' => 'LAB JARINGAN', 'lokasi_gedung' => 'Lantai 2 - Gedung Lab Komputer', 'pj_ruangan' => 'Ahmad Dahlan, S.Kom.'],
            ['kode_ruangan' => 'LAB EMBEDDED', 'nama_ruangan' => 'LAB EMBEDDED', 'lokasi_gedung' => 'Lantai 2 - Gedung Lab Komputer', 'pj_ruangan' => 'Fahrul, S.Pd., M.T.'],
            ['kode_ruangan' => 'LAB ANIMASI', 'nama_ruangan' => 'LAB ANIMASI', 'lokasi_gedung' => 'Lantai 3 - Gedung Lab Komputer', 'pj_ruangan' => 'Sulaeman, S.T.'],
            ['kode_ruangan' => 'LAB SISTEM CERDAS', 'nama_ruangan' => 'LAB SISTEM CERDAS', 'lokasi_gedung' => 'Lantai 3 - Gedung Lab Komputer', 'pj_ruangan' => 'Ahmad Dahlan, S.Kom.'],
            ['kode_ruangan' => 'LAB PEMROGRAMAN', 'nama_ruangan' => 'LAB PEMROGRAMAN', 'lokasi_gedung' => 'Lantai 2 - Gedung Lab Komputer', 'pj_ruangan' => 'Sulaeman, S.T.'],
        ];

        $saranaRooms = [];
        foreach ($saranaRoomsData as $srd) {
            $saranaRooms[$srd['nama_ruangan']] = Ruangan::updateOrCreate(
                ['nama_ruangan' => $srd['nama_ruangan']],
                [
                    'kode_ruangan' => $srd['kode_ruangan'],
                    'jenis_ruangan' => 'sarana_ruangan',
                    'lokasi_gedung' => $srd['lokasi_gedung'],
                    'pj_ruangan' => $srd['pj_ruangan'],
                    'kondisi' => 'tersedia',
                ]
            );
        }

        // =========================================================================
        // 2. AKUN OTORITAS MASING-MASING RUANGAN & MAHASISWA
        // =========================================================================

        // A. Admin Sarpras (Pusat / Ruang Admin)
        $adminSarpras = User::firstOrCreate(
            ['email' => 'admin.sarpras@unm.ac.id'],
            [
                'nomor_induk' => '198501012010121001',
                'name' => 'Dr. H. Administrator, M.T.',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
                'ruangan_id' => $ruangAdmin->id,
                'status_akun' => 'aktif',
            ]
        );

        // B. Pengelola Ruang Laboratorium
        $pengelolaLab = User::firstOrCreate(
            ['email' => 'pengelola.lab@unm.ac.id'],
            [
                'nomor_induk' => '199002022015041002',
                'name' => 'Sulaeman, S.T.',
                'password' => Hash::make('Pengelola123!'),
                'role' => 'pengelola',
                'ruangan_id' => $ruangLab->id,
                'status_akun' => 'aktif',
            ]
        );

        // C. Pengelola Ruang Bengkel IT
        $pengelolaBengkel = User::firstOrCreate(
            ['email' => 'pengelola.bengkel@unm.ac.id'],
            [
                'nomor_induk' => '199203032018031003',
                'name' => 'Fahrul, S.Pd., M.T.',
                'password' => Hash::make('Pengelola123!'),
                'role' => 'pengelola',
                'ruangan_id' => $ruangBengkel->id,
                'status_akun' => 'aktif',
            ]
        );

        // C2. Pengelola Unit Administrasi
        $pengelolaAdmin = User::firstOrCreate(
            ['email' => 'ahmad.dahlan@unm.ac.id'],
            [
                'nomor_induk' => '197906122013041002',
                'name' => 'Ahmad Dahlan, S.Kom.',
                'password' => Hash::make('Pengelola123!'),
                'role' => 'pengelola',
                'ruangan_id' => $ruangAdmin->id,
                'status_akun' => 'aktif',
            ]
        );

        // D. Akun Mahasiswa Terdaftar
        $mhs1 = User::firstOrCreate(
            ['nomor_induk' => '250210500034'],
            [
                'email' => '250210500034@mhs.unm.ac.id',
                'name' => 'Warnisyah Armin',
                'password' => Hash::make('Mahasiswa123!'),
                'role' => 'mahasiswa',
                'status_akun' => 'aktif',
                'jurusan' => 'TEKOM C 25',
            ]
        );

        $mhs2 = User::firstOrCreate(
            ['nomor_induk' => '220209501012'],
            [
                'email' => '220209501012@mhs.unm.ac.id',
                'name' => 'Asyifa Nur Cahya Savitri',
                'password' => Hash::make('Mahasiswa123!'),
                'role' => 'mahasiswa',
                'status_akun' => 'aktif',
                'jurusan' => 'PTIK A 24',
            ]
        );

        $mhs3 = User::firstOrCreate(
            ['nomor_induk' => '230209501045'],
            [
                'email' => '230209501045@mhs.unm.ac.id',
                'name' => 'Didi Naufal Nur Auliah',
                'password' => Hash::make('Mahasiswa123!'),
                'role' => 'mahasiswa',
                'status_akun' => 'aktif',
                'jurusan' => 'PTIK A 24',
            ]
        );

        $mhs4 = User::firstOrCreate(
            ['nomor_induk' => '220209502011'],
            [
                'email' => '220209502011@mhs.unm.ac.id',
                'name' => 'Ahmad Fauzan R.',
                'password' => Hash::make('Mahasiswa123!'),
                'role' => 'mahasiswa',
                'status_akun' => 'aktif',
                'jurusan' => 'TEKOM B 24',
            ]
        );

        // =========================================================================
        // =========================================================================

        // =========================================================================
        // 4. MASTER SARPRAS SESUAI RUANGAN TANGGUNG JAWAB
        // =========================================================================

        // --- A. SARPRAS LABORATORIUM ---
        $sarprasLab1 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'PRJ-014-01'],
            [
                'nama_sarpras' => 'Proyektor Epson EB-X400',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 10,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Lampu: Normal, Port: HDMI & VGA, Resolusi XGA',
                'foto' => 'sarpras/proyektor.jpg',
            ]
        );

        $sarprasLab2 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'PC-LAB-01'],
            [
                'nama_sarpras' => 'PC Desktop Lab Core i7',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 30,
                'jumlah_tersedia' => 26,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Intel Core i7-10700, RAM 16GB DDR4, SSD 512GB NVMe',
            ]
        );

        $sarprasLab3 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'SWT-DLK-24'],
            [
                'nama_sarpras' => 'Switch D-Link 24 Port Gigabit',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 8,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => '24-Port 10/100/1000 Mbps Unmanaged Switch DGS-1024D',
            ]
        );

        // --- B. SARPRAS BENGKEL ---
        $sarprasBkl1 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'TRX-FBR-01'],
            [
                'nama_sarpras' => 'Transceiver Fiber Optic Kit',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 6,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Optical SFP 1.25G 1310nm Single Mode 20km',
            ]
        );

        $sarprasBkl2 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'ARD-UNO-KIT'],
            [
                'nama_sarpras' => 'Arduino Uno R3 Starter Kit',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 20,
                'jumlah_tersedia' => 17,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'ATmega328P DIP, Paket Sensor Lengkap, Jumper & Breadboard',
                'foto' => 'sarpras/arduino-uno.jpg',
            ]
        );

        $sarprasBkl3 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'OSC-GW-01'],
            [
                'nama_sarpras' => 'Osiloskop Digital GW Instek',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 4,
                'jumlah_tersedia' => 3,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Dual Channel 100MHz, Layar TFT LCD 7 Inci, Probe Lengkap',
            ]
        );

        // --- C. SARPRAS RUANG ADMINISTRASI / ADMIN ---
        $sarprasAdm1 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'SRV-LAB-01'],
            [
                'nama_sarpras' => 'PC Server Dell PowerEdge',
                'ruangan_id' => $ruangAdmin->id,
                'jumlah_total' => 2,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'RAM 64GB, Intel Xeon, Ruang Server Lt. 2',
            ]
        );

        $sarprasAdm2 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'KBL-LAN-50'],
            [
                'nama_sarpras' => 'Kabel LAN Roll 50m Belden',
                'ruangan_id' => $ruangAdmin->id,
                'jumlah_total' => 10,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Cat6 UTP Belden Pure Copper 50 Meter Siap Pakai',
            ]
        );

        // --- D. SARPRAS SARANA RUANGAN (Kursi, Meja, Whiteboard, Proyektor Screen) ---
        $sarprasKrs101 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'KRS-AE101-01'],
            [
                'nama_sarpras' => 'Kursi Kuliah Lipat Chitose',
                'ruangan_id' => $saranaRooms['AE 101']->id ?? $ruangAdmin->id,
                'jenis_sarpras' => 'sarana_ruangan',
                'jumlah_total' => 45,
                'jumlah_tersedia' => 35,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Kursi Kuliah Kulit Sintetis Hitam dengan Meja Lipat Chitose Cosmo',
            ]
        );

        $sarprasScr104 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'SCR-AE104-01'],
            [
                'nama_sarpras' => 'Screen Proyektor Motorized 84 Inch',
                'ruangan_id' => $saranaRooms['AE 104']->id ?? $ruangAdmin->id,
                'jenis_sarpras' => 'sarana_ruangan',
                'jumlah_total' => 2,
                'jumlah_tersedia' => 1,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Screen Motorized Remote Control 84 inch Wall Mounted',
            ]
        );

        $sarprasMeja106 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'MJA-AE106-01'],
            [
                'nama_sarpras' => 'Meja Komputer Praktikum',
                'ruangan_id' => $saranaRooms['AE 106']->id ?? $ruangAdmin->id,
                'jenis_sarpras' => 'sarana_ruangan',
                'jumlah_total' => 30,
                'jumlah_tersedia' => 26,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Meja Partisi Komputer Kayu Lapis Finishing Duco',
            ]
        );

        $sarprasWb106 = Sarpras::updateOrCreate(
            ['kode_sarpras' => 'WBD-AE106-01'],
            [
                'nama_sarpras' => 'Papan Tulis Whiteboard Magnetik 120x240',
                'ruangan_id' => $saranaRooms['AE 106']->id ?? $ruangAdmin->id,
                'jenis_sarpras' => 'sarana_ruangan',
                'jumlah_total' => 2,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
                'status' => 'tersedia',
                'spesifikasi' => 'Whiteboard Gantung Magnetic Double Sided',
            ]
        );

        // =========================================================================
        // 5. TRANSAKSI PEMINJAMAN (Terdistribusi Sesuai Ruangan)
        // =========================================================================

        // Antrean Laboratorium 1: Proyektor EB-X400 (Persis Referensi TIK-2024-0010)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-2024-0010'],
            [
                'user_id' => $mhs2->id,
                'sarpras_id' => $sarprasLab1->id,
                'jumlah' => 1,
                'tgl_pinjam' => '2024-10-26 08:00:00',
                'tgl_kembali_rencana' => '2024-10-26 12:00:00',
                'keperluan' => 'Kuliah Mandiri Pemrograman Web',
                'dosen_penanggung_jawab' => 'Al-Muhajir, M.T.',
                'status' => 'menunggu_verifikasi',
            ]
        );

        // Antrean Laboratorium 2: PC Desktop Lab
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-2024-0012'],
            [
                'user_id' => $mhs1->id,
                'sarpras_id' => $sarprasLab2->id,
                'jumlah' => 1,
                'tgl_pinjam' => '2024-10-24 09:00:00',
                'tgl_kembali_rencana' => '2024-10-24 16:00:00',
                'keperluan' => 'Praktikum Komputasi Jaringan Lab',
                'dosen_penanggung_jawab' => 'Ir. Umar, M.T.',
                'status' => 'disetujui',
            ]
        );

        // Antrean Bengkel 1: Transceiver (Persis Referensi TIK-2024-0045)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-2024-0045'],
            [
                'user_id' => $mhs3->id,
                'sarpras_id' => $sarprasBkl1->id,
                'jumlah' => 1,
                'tgl_pinjam' => now()->format('Y-m-d 09:00:00'),
                'tgl_kembali_rencana' => now()->format('Y-m-d 15:00:00'),
                'keperluan' => 'Ujian Praktik Jaringan Bengkel IT',
                'dosen_penanggung_jawab' => 'Prof. Dr. Hendra Jaya, M.T.',
                'status' => 'menunggu_verifikasi',
            ]
        );

        // Antrean Bengkel 2: Arduino Kit (Persis Referensi TIK-2024-1101-001)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-2024-1101-001'],
            [
                'user_id' => $mhs4->id,
                'sarpras_id' => $sarprasBkl2->id,
                'jumlah' => 1,
                'tgl_pinjam' => now()->format('Y-m-d 08:00:00'),
                'tgl_kembali_rencana' => now()->format('Y-m-d 17:00:00'),
                'keperluan' => 'Bimbingan Skripsi Sistem Tertanam',
                'dosen_penanggung_jawab' => 'Dr. Hendra Suwarsono S.Kom, M.T.',
                'status' => 'menunggu_verifikasi',
            ]
        );

        // Transaksi Mahasiswa Login Utama (Kelompok 2 - 230209501003)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TRX-2024-001'],
            [
                'user_id' => $mhs1->id,
                'sarpras_id' => $sarprasLab2->id,
                'jumlah' => 1,
                'tgl_pinjam' => '2024-10-24 08:30:00',
                'tgl_kembali_rencana' => '2024-10-24 12:00:00',
                'keperluan' => 'Praktikum Mandiri JTIK',
                'dosen_penanggung_jawab' => 'Al-Muhajir, M.T.',
                'status' => 'menunggu_verifikasi',
            ]
        );

        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TRX-2024-002'],
            [
                'user_id' => $mhs1->id,
                'sarpras_id' => $sarprasAdm1->id,
                'jumlah' => 1,
                'tgl_pinjam' => '2024-10-25 10:00:00',
                'tgl_kembali_rencana' => '2024-10-25 15:00:00',
                'keperluan' => 'Seminar Proposal Sarpras',
                'dosen_penanggung_jawab' => 'Dr. H. Administrator, M.T.',
                'status' => 'disetujui',
            ]
        );

        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TRX-2024-003'],
            [
                'user_id' => $mhs1->id,
                'sarpras_id' => $sarprasBkl3->id,
                'jumlah' => 1,
                'tgl_pinjam' => '2024-10-25 13:00:00',
                'tgl_kembali_rencana' => '2024-10-25 17:00:00',
                'keperluan' => 'Pemeriksaan Sinyal IoT',
                'dosen_penanggung_jawab' => 'Fahrul, S.Pd., M.T.',
                'status' => 'sedang_dipinjam',
            ]
        );

        // =========================================================================
        // 6. TRANSAKSI ADMIN JTIK & SARANA RUANGAN (AE 101, AE 104, AE 106, DLL)
        // =========================================================================
        // Antrean Admin JTIK & Sarana Ruangan 1: Kursi Chitose AE 101
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-ADM-2401'],
            [
                'user_id' => $mhs2->id,
                'sarpras_id' => $sarprasKrs101->id,
                'jumlah' => 10,
                'tgl_pinjam' => now()->format('Y-m-d 08:30:00'),
                'tgl_kembali_rencana' => now()->format('Y-m-d 16:30:00'),
                'keperluan' => 'Kegiatan Kuliah Tamu & Himpunan Mahasiswa JTIK',
                'dosen_penanggung_jawab' => 'Dr. Hendra Suwarsono S.Kom, M.T.',
                'status' => 'menunggu_verifikasi',
            ]
        );

        // Antrean Admin JTIK & Sarana Ruangan 2: Screen Proyektor AE 104
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-ADM-2402'],
            [
                'user_id' => $mhs3->id,
                'sarpras_id' => $sarprasScr104->id,
                'jumlah' => 1,
                'tgl_pinjam' => now()->format('Y-m-d 09:00:00'),
                'tgl_kembali_rencana' => now()->format('Y-m-d 13:00:00'),
                'keperluan' => 'Presentasi Sidang Tugas Akhir Mahasiswa',
                'dosen_penanggung_jawab' => 'Prof. Dr. Hendra Jaya, M.T.',
                'status' => 'menunggu_verifikasi',
            ]
        );

        // Antrean Admin JTIK & Sarana Ruangan 3: Kabel LAN Roll Belden (Admin JTIK)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-ADM-2403'],
            [
                'user_id' => $mhs1->id,
                'sarpras_id' => $sarprasAdm2->id,
                'jumlah' => 1,
                'tgl_pinjam' => now()->format('Y-m-d 10:00:00'),
                'tgl_kembali_rencana' => now()->format('Y-m-d 17:00:00'),
                'keperluan' => 'Konfigurasi Jaringan Acara Jurusan',
                'dosen_penanggung_jawab' => 'Al-Muhajir, M.T.',
                'status' => 'menunggu_verifikasi',
            ]
        );

        // Riwayat Keputusan: Meja Komputer AE 106 (Disetujui)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-ADM-2404'],
            [
                'user_id' => $mhs4->id,
                'sarpras_id' => $sarprasMeja106->id,
                'jumlah' => 4,
                'tgl_pinjam' => now()->subDay()->format('Y-m-d 08:00:00'),
                'tgl_kembali_rencana' => now()->addDay()->format('Y-m-d 16:00:00'),
                'keperluan' => 'Workshop Jaringan Komputer',
                'dosen_penanggung_jawab' => 'Fahrul, S.Pd., M.T.',
                'status' => 'disetujui',
                'catatan_pengelola' => 'Disetujui untuk kegiatan workshop. Pastikan posisi meja dikembalikan rapi.',
            ]
        );

        // Riwayat Keputusan: Whiteboard AE 106 (Ditolak)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-ADM-2406'],
            [
                'user_id' => $mhs2->id,
                'sarpras_id' => $sarprasWb106->id,
                'jumlah' => 1,
                'tgl_pinjam' => now()->subDays(2)->format('Y-m-d 09:00:00'),
                'tgl_kembali_rencana' => now()->subDays(2)->format('Y-m-d 12:00:00'),
                'keperluan' => 'Peminjaman Papan Tulis ke Luar Gedung',
                'dosen_penanggung_jawab' => 'Al-Muhajir, M.T.',
                'status' => 'ditolak',
                'catatan_pengelola' => 'Whiteboard ruangan AE 106 bersifat fixed/permanen di dinding dan tidak dapat dipindahkan keluar ruangan.',
            ]
        );

        // Pengembalian: Server Dell PowerEdge (Admin JTIK)
        Peminjaman::updateOrCreate(
            ['kode_peminjaman' => 'TIK-ADM-2405'],
            [
                'user_id' => $mhs1->id,
                'sarpras_id' => $sarprasAdm1->id,
                'jumlah' => 1,
                'tgl_pinjam' => now()->subDays(3)->format('Y-m-d 08:00:00'),
                'tgl_kembali_rencana' => now()->format('Y-m-d 10:00:00'),
                'tgl_kembali_aktual' => now()->format('Y-m-d 09:45:00'),
                'keperluan' => 'Deploy Server Proyek Akhir Cloud',
                'dosen_penanggung_jawab' => 'Prof. Dr. Hendra Jaya, M.T.',
                'status' => 'sedang_dipinjam',
                'status_pengembalian' => 'menunggu_cek_fisik',
            ]
        );
    }
}
