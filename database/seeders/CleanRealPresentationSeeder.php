<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\Sarpras;
use App\Models\Peminjaman;
use App\Models\BebasPinjam;

class CleanRealPresentationSeeder extends Seeder
{
    public function run()
    {
        // 1. Bersihkan transaksi lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Peminjaman::truncate();
        BebasPinjam::truncate();
        
        // 2. Bersihkan user dummy (hapus Endog, Kelompok 2, dummy auto-generated)
        User::whereIn('nomor_induk', [
            '230209502001', // Endog Suroboyo
            '230209501003', // Kelompok 2
            '251210500034',
            '250210500034'
        ])->orWhere('name', 'like', '%Kelompok%')
          ->orWhere('name', 'like', '%Endog%')
          ->delete();

        // 3. Pastikan Akun Utama Presentasi Siap dengan Password Maba'ak'ft dan standar
        // Password Mahasiswa: Maba'ak'ft (atau Maba22ft)
        $mabaPassword = Hash::make("Maba'ak'ft");
        $adminPassword = Hash::make("admin123");
        $pengelolaPassword = Hash::make("pengelola123");

        // A. ADMIN UTAMA
        $admin = User::updateOrCreate(
            ['email' => 'admin.sarpras@unm.ac.id'],
            [
                'nomor_induk' => '198501012010121001',
                'name' => 'Dr. H. Administrator, M.T.',
                'password' => $adminPassword,
                'role' => 'admin',
                'jabatan' => 'Kepala Unit Sarana Prasarana JTIK FT UNM',
                'status_akun' => 'aktif',
            ]
        );

        // B. RUANGAN OPERASIONAL UNIT UTAMA (1. Bengkel IT, 2. Laboratorium, 3. Admin JTIK)
        $ruangLab = Ruangan::updateOrCreate(
            ['kode_ruangan' => 'RNG-LJT-01'],
            [
                'nama_ruangan' => 'Laboratorium',
                'jenis_ruangan' => 'alat_bahan',
                'lokasi_gedung' => 'Gedung A (Lab Terpadu JTIK)',
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
                'lokasi_gedung' => 'Gedung B (Bengkel IT)',
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
                'lokasi_gedung' => 'Gedung A (Gedung Utama JTIK)',
                'pj_ruangan' => 'Ahmad Dahlan, S.Kom.',
                'nip_pj' => 'NIP. 19790612 201304 1 002',
                'role_pj' => 'Staf Unit Administrasi',
                'kondisi' => 'tersedia',
            ]
        );

        // C. 3 PENGELOLA (1. BENGKEL IT, 2. LABORATORIUM, 3. ADMIN JTIK)
        $pengelolaLab = User::updateOrCreate(
            ['email' => 'pengelola.lab@unm.ac.id'],
            [
                'nomor_induk' => '199002022015041002',
                'name' => 'Sulaeman, S.T.',
                'password' => $pengelolaPassword,
                'role' => 'pengelola',
                'jabatan' => 'Laboran Laboratorium',
                'ruangan_id' => $ruangLab->id,
                'status_akun' => 'aktif',
            ]
        );

        $pengelolaBengkel = User::updateOrCreate(
            ['email' => 'pengelola.bengkel@unm.ac.id'],
            [
                'nomor_induk' => '199203032018031003',
                'name' => 'Fahrul, S.Pd., M.T.',
                'password' => $pengelolaPassword,
                'role' => 'pengelola',
                'jabatan' => 'Kepala Unit Bengkel IT',
                'ruangan_id' => $ruangBengkel->id,
                'status_akun' => 'aktif',
            ]
        );

        $pengelolaAdmin = User::updateOrCreate(
            ['email' => 'ahmad.dahlan@unm.ac.id'],
            [
                'nomor_induk' => '197906122013041002',
                'name' => 'Ahmad Dahlan, S.Kom.',
                'password' => $pengelolaPassword,
                'role' => 'pengelola',
                'jabatan' => 'Staf Administrasi & Perlengkapan Gedung',
                'ruangan_id' => $ruangAdmin->id,
                'status_akun' => 'aktif',
            ]
        );

        // D. MAHASISWA UTAMA (Asyifa Nur Cahya Savitri) & MAHASISWA PRESENTASI
        $mhsAsyifa = User::updateOrCreate(
            ['nomor_induk' => '220209501012'],
            [
                'name' => 'Asyifa Nur Cahya Savitri',
                'email' => '220209501012@mhs.unm.ac.id',
                'password' => $mabaPassword,
                'role' => 'mahasiswa',
                'jurusan' => 'Pendidikan Teknik Informatika dan Komputer',
                'status_akun' => 'aktif',
            ]
        );

        $mhsAisyah = User::updateOrCreate(
            ['nomor_induk' => '220209501004'],
            [
                'name' => 'Siti Aisyah Nur Azizah',
                'email' => '220209501004@mhs.unm.ac.id',
                'password' => $mabaPassword,
                'role' => 'mahasiswa',
                'jurusan' => 'Pendidikan Teknik Informatika dan Komputer',
                'status_akun' => 'aktif',
            ]
        );

        $mhsFauzan = User::updateOrCreate(
            ['nomor_induk' => '220209502011'],
            [
                'name' => 'Ahmad Fauzan R.',
                'email' => '220209502011@mhs.unm.ac.id',
                'password' => $mabaPassword,
                'role' => 'mahasiswa',
                'jurusan' => 'Teknik Komputer',
                'status_akun' => 'aktif',
            ]
        );

        $mhsHalizah = User::updateOrCreate(
            ['nomor_induk' => '210209500013'],
            [
                'name' => 'Nur Halizah Putri',
                'email' => '210209500013@mhs.unm.ac.id',
                'password' => $mabaPassword,
                'role' => 'mahasiswa',
                'jurusan' => 'Pendidikan Teknik Informatika dan Komputer',
                'status_akun' => 'aktif',
            ]
        );

        // Update semua password mahasiswa yang tersisa menjadi Maba'ak'ft
        User::where('role', 'mahasiswa')->update(['password' => $mabaPassword]);

        // E. STANDARISASI RUANG KULIAH TEORI GEDUNG AE (Sarana Ruangan Mebelair)
        $ruangTeoriNames = [
            'AE 101' => ['Gedung AE', 40, 20, 10, 10],
            'AE 102' => ['Gedung AE', 40, 20, 10, 10],
            'AE 103' => ['Gedung AE', 40, 20, 10, 10],
            'AE 104' => ['Gedung AE', 40, 20, 10, 10],
            'AE 105' => ['Gedung AE', 40, 20, 10, 10],
            'AE 106' => ['Gedung AE', 40, 20, 10, 10],
            'AE 107' => ['Gedung AE', 40, 20, 10, 10],
            'AE 108' => ['Gedung AE', 40, 20, 10, 10],
            'AE 109' => ['Gedung AE', 40, 20, 10, 10],
            'AE 110' => ['Gedung AE', 40, 20, 10, 10],
            'AE 209' => ['Gedung AE', 40, 20, 10, 10],
            'AE 210' => ['Gedung AE', 40, 20, 10, 10],
        ];

        foreach ($ruangTeoriNames as $code => $data) {
            Ruangan::updateOrCreate(
                ['kode_ruangan' => $code],
                [
                    'nama_ruangan' => $code,
                    'jenis_ruangan' => 'sarana_ruangan',
                    'lokasi_gedung' => $data[0],
                    'pj_ruangan' => 'Sulaeman, S.T.',
                    'kondisi' => 'tersedia',
                    'kapasitas_kursi' => $data[1],
                    'kapasitas_meja' => $data[2],
                    'kuota_maks_kursi' => $data[3],
                    'kuota_maks_meja' => $data[4],
                    'catatan_mebelair' => null,
                ]
            );
        }

        // Hapus sarana_ruangan lama yang tidak relevan dari tabel sarpras
        Sarpras::where('jenis_sarpras', 'sarana_ruangan')->delete();

        // F. MASTER SARPRAS ALAT & BAHAN (ALAT PRAKTIKUM ASLI JTIK UNM)

        // F. MASTER SARPRAS ALAT & BAHAN (16 BARANG RESMI: BENGKEL IT, LABORATORIUM, ADMINISTRASI)
        $alatList = [
            // BENGKEL IT
            [
                'kode_sarpras' => 'RST-KIT-01',
                'nama_sarpras' => 'Resistor',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 50,
                'jumlah_tersedia' => 48,
                'kondisi' => 'baik',
                'spesifikasi' => 'Resistor Metal Film Assorted Kit 1/4W (10Ω - 1MΩ, Toleransi 1%)',
                'maks_pinjam' => 5,
                'foto' => 'sarpras/resistor.jpg',
            ],
            [
                'kode_sarpras' => 'SNS-LDR-01',
                'nama_sarpras' => 'Sensor LDR',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 30,
                'jumlah_tersedia' => 30,
                'kondisi' => 'baik',
                'spesifikasi' => 'Modul Sensor Cahaya Light Dependent Resistor 5mm Photoresistor',
                'maks_pinjam' => 5,
                'foto' => 'sarpras/sensor-ldr.jpg',
            ],
            [
                'kode_sarpras' => 'ARD-UNO-01',
                'nama_sarpras' => 'Arduino UNO',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 20,
                'jumlah_tersedia' => 16,
                'kondisi' => 'baik',
                'spesifikasi' => 'Microcontroller Board ATmega328P R3 DIP dengan Kabel USB Type-A/B',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/arduino-uno.jpg',
            ],
            [
                'kode_sarpras' => 'SLD-ADJ-01',
                'nama_sarpras' => 'Solder',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 15,
                'jumlah_tersedia' => 15,
                'kondisi' => 'baik',
                'spesifikasi' => 'Solder Listrik Adjustable Temperature 60W dengan Stand & Spons Pembersih',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/solder.jpg',
            ],
            [
                'kode_sarpras' => 'MLT-DGT-01',
                'nama_sarpras' => 'Multimeter',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 10,
                'jumlah_tersedia' => 10,
                'kondisi' => 'baik',
                'spesifikasi' => 'Digital Multimeter Digital Auto-Ranging AC/DC Tester Probe & Buzzer',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/multimeter.jpg',
            ],
            [
                'kode_sarpras' => 'TRN-KIT-01',
                'nama_sarpras' => 'Transistor',
                'ruangan_id' => $ruangBengkel->id,
                'jumlah_total' => 40,
                'jumlah_tersedia' => 40,
                'kondisi' => 'baik',
                'spesifikasi' => 'Transistor Bipolar NPN/PNP Assorted Pack (BC547, 2N2222, TIP31C)',
                'maks_pinjam' => 5,
                'foto' => 'sarpras/transistor.jpg',
            ],

            // LABORATORIUM
            [
                'kode_sarpras' => 'NET-MKT-01',
                'nama_sarpras' => 'MikroTik',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 12,
                'jumlah_tersedia' => 11,
                'kondisi' => 'baik',
                'spesifikasi' => 'RouterBOARD MikroTik RB750r2 (hEX lite) 5-Port Fast Ethernet RouterOS L4',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/mikrotik.jpg',
            ],
            [
                'kode_sarpras' => 'NET-AP-01',
                'nama_sarpras' => 'Access Point',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 8,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
                'spesifikasi' => 'Access Point Wireless Dual-Band Gigabit PoE 802.11ac 1200Mbps',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/access-point.jpg',
            ],
            [
                'kode_sarpras' => 'KBL-JMP-01',
                'nama_sarpras' => 'Kabel Jumper',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 25,
                'jumlah_tersedia' => 25,
                'kondisi' => 'baik',
                'spesifikasi' => 'Kabel Jumper Breadboard Male-to-Male / Male-to-Female 40-Pin 20cm',
                'maks_pinjam' => 4,
                'foto' => 'sarpras/kabel-jumper.jpg',
            ],
            [
                'kode_sarpras' => 'TL-CRM-01',
                'nama_sarpras' => 'Tang crimping',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 15,
                'jumlah_tersedia' => 15,
                'kondisi' => 'baik',
                'spesifikasi' => 'Tang Crimping Modular RJ45 Cat5/Cat6 & RJ11 Heavy Duty dengan Pemotong',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/tang-crimping.jpg',
            ],
            [
                'kode_sarpras' => 'TL-CUT-01',
                'nama_sarpras' => 'Pemotong kabel',
                'ruangan_id' => $ruangLab->id,
                'jumlah_total' => 15,
                'jumlah_tersedia' => 15,
                'kondisi' => 'baik',
                'spesifikasi' => 'Mini Wire Stripper & Cable Cutter Portable untuk Kabel UTP/STP/Coaxial',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/pemotong-kabel.jpg',
            ],

            // ADMINISTRASI
            [
                'kode_sarpras' => 'ADM-PRJ-01',
                'nama_sarpras' => 'Proyektor',
                'ruangan_id' => $ruangAdmin->id,
                'jumlah_total' => 6,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
                'spesifikasi' => 'Proyektor LCD Multimedia 3600 Lumens HDMI/VGA Port Presentasi Jurusan',
                'maks_pinjam' => 1,
                'foto' => 'sarpras/proyektor.jpg',
            ],
            [
                'kode_sarpras' => 'ADM-HDMI-01',
                'nama_sarpras' => 'Kabel HDMI',
                'ruangan_id' => $ruangAdmin->id,
                'jumlah_total' => 10,
                'jumlah_tersedia' => 10,
                'kondisi' => 'baik',
                'spesifikasi' => 'Kabel HDMI High Speed 4K Gold-Plated Braided Panjang 10 Meter',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/kabel-hdmi.jpg',
            ],
            [
                'kode_sarpras' => 'ADM-EXT-01',
                'nama_sarpras' => 'Sambungan kabel',
                'ruangan_id' => $ruangAdmin->id,
                'jumlah_total' => 8,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
                'spesifikasi' => 'Kabel Roll / Sambungan Stop Kontak 4 Lubang Panjang 10 Meter dengan Saklar',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/sambungan-kabel.jpg',
            ],
            [
                'kode_sarpras' => 'ADM-CNV-01',
                'nama_sarpras' => 'Konverter',
                'ruangan_id' => $ruangAdmin->id,
                'jumlah_total' => 8,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
                'spesifikasi' => 'Konverter Adapter Multiport Type-C to HDMI, VGA, & USB 3.0',
                'maks_pinjam' => 2,
                'foto' => 'sarpras/konverter.jpg',
            ],
            [
                'kode_sarpras' => 'ADM-INK-01',
                'nama_sarpras' => 'Tinta spidol',
                'ruangan_id' => $ruangAdmin->id,
                'jumlah_total' => 20,
                'jumlah_tersedia' => 20,
                'kondisi' => 'baik',
                'spesifikasi' => 'Tinta Isi Ulang Spidol Whiteboard Refill Ink Hitam & Biru 20ml',
                'maks_pinjam' => 3,
                'foto' => 'sarpras/tinta-spidol.jpg',
            ],
        ];

        $createdAlat = [];
        foreach ($alatList as $item) {
            $createdAlat[$item['kode_sarpras']] = Sarpras::updateOrCreate(
                ['kode_sarpras' => $item['kode_sarpras']],
                array_merge($item, ['jenis_sarpras' => 'alat_bahan'])
            );
        }

        // G. SKENARIO DATA TRANSAKSI PRESENTASI LENGKAP & KREDIBEL
        // Skenario 1: Tiket SEDANG DIPINJAM untuk Asyifa (Bisa didemokan di menu Pengembalian Fisik + Foto Before & After!)
        Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-0040',
            'user_id' => $mhsAsyifa->id,
            'sarpras_id' => $createdAlat['ADM-PRJ-01']->id,
            'jumlah' => 1,
            'tgl_pinjam' => '2026-11-17 08:30:00',
            'tgl_kembali_rencana' => '2026-11-18 16:00:00',
            'waktu_keterangan' => '08:30 - 16:00 WITA',
            'keperluan' => 'Presentasi Ujian Seminar Proposal Tugas Akhir Mahasiswa',
            'dosen_penanggung_jawab' => 'Dr. Ir. Mustari S. Lamada, M.T.',
            'status' => 'sedang_dipinjam',
            'status_pengembalian' => 'belum_kembali',
        ]);

        // Skenario 2: Tiket MENUNGGU ACC / VERIFIKASI untuk Asyifa (Bisa didemokan buka akun Pengelola Lab lalu klik "Setujui"!)
        Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-0042',
            'user_id' => $mhsAsyifa->id,
            'sarpras_id' => $createdAlat['TL-CRM-01']->id,
            'jumlah' => 1,
            'tgl_pinjam' => '2026-11-18 09:00:00',
            'tgl_kembali_rencana' => '2026-11-18 15:30:00',
            'waktu_keterangan' => '09:00 - 15:30 WITA',
            'keperluan' => 'Praktikum Mandiri Jaringan Komputer Topologi Star',
            'dosen_penanggung_jawab' => 'Sulaeman, S.T. (Laboran)',
            'status' => 'menunggu_verifikasi',
            'status_pengembalian' => 'belum_kembali',
        ]);

        // Skenario 3: Tiket RELOKASI RUANGAN untuk Asyifa (Bisa didemokan di menu Sarana Ruangan Admin / Papan Monitoring Relokasi!)
        $ae101 = Ruangan::where('kode_ruangan', 'AE 101')->first();
        $ae102 = Ruangan::where('kode_ruangan', 'AE 102')->first();
        Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-0043',
            'user_id' => $mhsAsyifa->id,
            'sarpras_id' => $createdAlat['ADM-PRJ-01']->id, // proxy sarpras relokasi
            'jumlah' => 8,
            'tgl_pinjam' => '2026-11-18 08:00:00',
            'tgl_kembali_rencana' => '2026-11-18 17:00:00',
            'waktu_keterangan' => '08:00 - 17:00 WITA',
            'keperluan' => '[Relokasi: AE 101 → AE 102 (6 Bangku & 2 Meja)] Tambahan fasilitas belajar perkuliahan gabungan mata kuliah Pemrograman Web',
            'dosen_penanggung_jawab' => 'Dosen Pengampu Mata Kuliah Teori JTIK',
            'status' => 'sedang_dipinjam',
            'status_pengembalian' => 'belum_kembali',
        ]);

        // Skenario 4: Tiket SELESAI & BEBAS SARPRAS untuk Asyifa (Bukti riwayat sukses di dashboard)
        Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-0039',
            'user_id' => $mhsAsyifa->id,
            'sarpras_id' => $createdAlat['ADM-HDMI-01']->id,
            'jumlah' => 1,
            'tgl_pinjam' => '2026-11-15 08:00:00',
            'tgl_kembali_rencana' => '2026-11-15 14:00:00',
            'tgl_kembali_aktual' => '2026-11-15 13:45:00',
            'waktu_keterangan' => '08:00 - 14:00 WITA',
            'keperluan' => 'Presentasi Ujian Tengah Semester Praktikum Basis Data',
            'dosen_penanggung_jawab' => 'Dr. H. Administrator, M.T.',
            'status' => 'selesai',
            'status_pengembalian' => 'sudah_kembali',
            'catatan_kondisi_kembali' => 'Kabel dan splitter dikembalikan lengkap dan berfungsi optimal.',
        ]);

        // Skenario 5: Peminjaman oleh mahasiswa lain (Ahmad Fauzan R.) di Bengkel
        Peminjaman::create([
            'kode_peminjaman' => 'TRX-2026-0038',
            'user_id' => $mhsFauzan->id,
            'sarpras_id' => $createdAlat['MLT-DGT-01']->id,
            'jumlah' => 1,
            'tgl_pinjam' => '2026-11-18 10:00:00',
            'tgl_kembali_rencana' => '2026-11-18 16:00:00',
            'waktu_keterangan' => '10:00 - 16:00 WITA',
            'keperluan' => 'Pengujian Frekuensi Sinyal PWM Proyek Akhir Robotika',
            'dosen_penanggung_jawab' => 'Fahrul, S.Pd., M.T.',
            'status' => 'menunggu_verifikasi',
            'status_pengembalian' => 'belum_kembali',
        ]);

        // H. DATA BEBAS SARPRAS (Yudisium & Wisuda)
        // 1. Pengajuan Asyifa (Dalam Proses Verifikasi - Bisa didemokan proses verifikasi unit lab!)
        BebasPinjam::create([
            'kode_pengajuan' => 'BBS-2026-040',
            'user_id' => $mhsAsyifa->id,
            'keperluan' => 'Persyaratan Berkas Yudisium & Wisuda Sarjana Pendidikan Teknik Informatika dan Komputer FT UNM',
            'tgl_pengajuan' => '2026-11-18 08:00:00',
            'status_lab_komputer' => 'bebas',
            'petugas_lab_komputer' => 'Sulaeman, S.T.',
            'tgl_lab_komputer' => '2026-11-18 08:30:00',
            'catatan_lab_komputer' => 'Tidak ada tanggungan alat praktikum.',
            'status_lab_jaringan' => 'belum_cek',
            'status_ruang_inventaris' => 'bebas',
            'petugas_ruang_inventaris' => 'Ahmad Dahlan, S.Kom.',
            'tgl_ruang_inventaris' => '2026-11-18 08:45:00',
            'status_final' => 'belum_cek',
        ]);

        // 2. Pengajuan Nur Halizah Putri (Sudah Bebas 100% - Bisa didemokan cetak surat keterangan bebas pinjam resmi!)
        BebasPinjam::create([
            'kode_pengajuan' => 'BBS-2026-038',
            'user_id' => $mhsHalizah->id,
            'keperluan' => 'Pemberkasan Yudisium & Wisuda Sarjana Jurusan Pendidikan Teknik Elektro & Informatika',
            'tgl_pengajuan' => '2026-11-15 09:00:00',
            'status_lab_komputer' => 'bebas',
            'petugas_lab_komputer' => 'Sulaeman, S.T.',
            'tgl_lab_komputer' => '2026-11-15 09:30:00',
            'status_lab_jaringan' => 'bebas',
            'petugas_lab_jaringan' => 'Ahmad Syahrir, S.Kom.',
            'tgl_lab_jaringan' => '2026-11-15 10:15:00',
            'status_ruang_inventaris' => 'bebas',
            'petugas_ruang_inventaris' => 'Ahmad Dahlan, S.Kom.',
            'tgl_ruang_inventaris' => '2026-11-15 11:00:00',
            'status_final' => 'bebas',
            'tgl_disahkan_final' => '2026-11-15 11:00:00',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
