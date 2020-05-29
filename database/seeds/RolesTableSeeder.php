<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();

        DB::table('permission_role')->truncate();

        with(Role::create([
                'name'        => 'superadmin',
                'description' => 'Super Administrator'
        ]))->givePermsissionTo('do_anything');

        with(Role::create([
                'name'        => 'administrator',
                'description' => 'Administrator'
        ]))->givePermsissionTo('do_anything');

        with(Role::create([
            'name'        => 'operator_registrasi',
            'description' => 'Operator Registrasi'
        ]))->givePermsissionTo([
            'manage_registrasi',
            'manage_pasien'
        ]);

        with(Role::create([
            'name'        => 'operator_apotek',
            'description' => 'Operator Apotek'
        ]))->givePermsissionTo([
            'manage_apotek',
            'manage_layanan_resep'
        ]);

        with(Role::create([
            'name'        => 'operator_logistik',
            'description' => 'Operator Logistik'
        ]))->givePermsissionTo('manage_logistik');

        with(Role::create([
            'name'        => 'operator_kasir',
            'description' => 'Operator Kasir'
        ]))->givePermsissionTo('manage_kunjungan');

        with(Role::create([
            'name'        => 'operator_laboratorium',
            'description' => 'Operator Laboratorium'
        ]))->givePermsissionTo('manage_laboratorium');

        with(Role::create([
            'name'        => 'operator_radiologi',
            'description' => 'Operator Radiologi'
        ]))->givePermsissionTo('manage_radiologi');

        with(Role::create([
            'name'        => 'operator_operasi',
            'description' => 'Operator Operasi'
        ]))->givePermsissionTo('manage_operasi');

        with(Role::create([
            'name'        => 'operator_insenerator',
            'description' => 'Operator Insenerator'
        ]))->givePermsissionTo('manage_insenerator');

        with(Role::create([
            'name'        => 'operator_utdrs',
            'description' => 'Operator UTDRS'
        ]))->givePermsissionTo('manage_utdrs');

        with(Role::create([
            'name'        => 'operator_kamar_jenazah',
            'description' => 'Operator Kamar Jenazah'
        ]))->givePermsissionTo('manage_kamar_jenazah');

        with(Role::create([
            'name'        => 'operator_rawat_jalan',
            'description' => 'Operator Rawat Jalan'
        ]))->givePermsissionTo([
            'manage_layanan',
            'manage_rawat_jalan'
        ]);

        with(Role::create([
            'name'        => 'operator_rawat_darurat',
            'description' => 'Operator Rawat Darurat'
        ]))->givePermsissionTo([
            'manage_layanan',
            'manage_rawat_darurat'
        ]);

        with(Role::create([
            'name'        => 'operator_rawat_inap',
            'description' => 'Operator Rawat Inap'
        ]))->givePermsissionTo([
            'manage_layanan',
            'manage_rawat_inap'
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
