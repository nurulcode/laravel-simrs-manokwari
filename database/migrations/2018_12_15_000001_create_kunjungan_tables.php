<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKunjunganTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('waktu_masuk');
            $table->datetime('waktu_keluar')->nullable();
            $table->string('nomor_kunjungan')->nullable();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedInteger('kasus_id')->nullable();
            $table->unsignedInteger('penyakit_id')->nullable();
            $table->unsignedInteger('jenis_rujukan_id')->nullable();
            $table->string('rujukan_asal')->nullable();
            $table->string('rujukan_nomor')->nullable();
            $table->date('rujukan_tanggal')->nullable();
            $table->string('pj_nama')->nullable();
            $table->string('pj_telepon')->nullable();
            $table->unsignedInteger('cara_pembayaran_id')->nullable();
            $table->string('sjp_nomor')->nullable();
            $table->date('sjp_tanggal')->nullable();
            $table->timestamps();

            $table->foreign('pasien_id')
                ->references('id')
                ->on('pasiens')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('kasus_id')
                ->references('id')
                ->on('kasuses')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('penyakit_id')
                ->references('id')
                ->on('penyakits')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('jenis_rujukan_id')
                ->references('id')
                ->on('jenis_rujukans')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('cara_pembayaran_id')
                ->references('id')
                ->on('cara_pembayarans')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::create('registrasis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kunjungan_id');
            $table->unsignedInteger('jenis_registrasi_id')->nullable();
            $table->unsignedInteger('perawatan_id')->nullable();
            $table->string('perawatan_type')->nullable();
            $table->text('tarif')->nullable();
            $table->timestamps();

            $table->foreign('jenis_registrasi_id')
                ->references('id')
                ->on('jenis_registrasis')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('kunjungan_id')
                ->references('id')
                ->on('kunjungans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrasis');

        Schema::dropIfExists('kunjungans');
    }
}
