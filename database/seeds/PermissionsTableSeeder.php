<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Permission::truncate();

        Permission::create([
            'name'        => 'do_anything',
            'description' => 'One Permission to Rule Them All'
        ]);

        Permission::create([
            'name'        => 'manage_apotek',
            'description' => 'Mengelola apotek'
        ]);

        Permission::create([
            'name'        => 'manage_fasilitas',
            'description' => 'Mengelola fasilitas'
        ]);

        Permission::create([
            'name'        => 'manage_insenerator',
            'description' => 'Mengelola layanan insenerator'
        ]);

        Permission::create([
            'name'        => 'manage_kamar_jenazah',
            'description' => 'Mengelola layanan kamar jenazah'
        ]);

        Permission::create([
            'name'        => 'manage_kepegawaian',
            'description' => 'Mengelola kepegawaian'
        ]);

        Permission::create([
            'name'        => 'manage_kunjungan',
            'description' => 'Mengelola kunjungan dan pembayaran'
        ]);

        Permission::create([
            'name'        => 'manage_laboratorium',
            'description' => 'Mengelola layanan laboratorium'
        ]);

        Permission::create([
            'name'        => 'manage_layanan',
            'description' => 'Mengelola layanan penunjang'
        ]);

        Permission::create([
            'name'        => 'manage_layanan_resep',
            'description' => 'Mengelola layanan resep'
        ]);

        Permission::create([
            'name'        => 'manage_logistik',
            'description' => 'Mengelola farmasi dan logistik'
        ]);

        Permission::create([
            'name'        => 'manage_master_data',
            'description' => 'Mengelola master data'
        ]);

        Permission::create([
            'name'        => 'manage_operasi',
            'description' => 'Mengelola layanan operasi'
        ]);

        Permission::create([
            'name'        => 'manage_pasien',
            'description' => 'Mengelola pasien'
        ]);

        Permission::create([
            'name'        => 'manage_permission',
            'description' => 'Mengelola permission'
        ]);

        Permission::create([
            'name'        => 'manage_radiologi',
            'description' => 'Mengelola layanan radiologi'
        ]);

        Permission::create([
            'name'        => 'manage_rawat_darurat',
            'description' => 'Mengelola data rawat darurat'
        ]);

        Permission::create([
            'name'        => 'manage_rawat_inap',
            'description' => 'Mengelola data rawat darurat'
        ]);

        Permission::create([
            'name'        => 'manage_rawat_jalan',
            'description' => 'Mengelola data rawat jalan'
        ]);

        Permission::create([
            'name'        => 'manage_registrasi',
            'description' => 'Mengelola registrasi'
        ]);

        Permission::create([
            'name'        => 'manage_rehabilitasi_medik',
            'description' => 'Mengelola layanan rehabilitasi medik'
        ]);

        Permission::create([
            'name'        => 'manage_role',
            'description' => 'Mengelola role'
        ]);

        Permission::create([
            'name'        => 'manage_tarif',
            'description' => 'Mengelola tarif'
        ]);

        Permission::create([
            'name'        => 'manage_user',
            'description' => 'Mengelola user'
        ]);

        Permission::create([
            'name'        => 'manage_utdrs',
            'description' => 'Mengelola layanan UTDRS'
        ]);

        Permission::create([
            'name'        => 'registrasi_pasien',
            'description' => 'Registrasi Pasien'
        ]);

        Permission::create([
            'name'        => 'view_activities_page',
            'description' => 'Akses halaman daftar aktifitas pengguna'
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
