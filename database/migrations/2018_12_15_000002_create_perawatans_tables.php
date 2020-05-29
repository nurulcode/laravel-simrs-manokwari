<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerawatansTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_jalans', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('waktu_masuk');
            $table->datetime('waktu_keluar')->nullable();
            $table->unsignedTinyInteger('kondisi_akhir')->nullable();
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('poliklinik_id');
            $table->timestamps();

            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('kegiatans')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('poliklinik_id')
                ->references('id')
                ->on('polikliniks')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('rawat_darurats', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('waktu_masuk');
            $table->datetime('waktu_keluar')->nullable();
            $table->unsignedTinyInteger('kondisi_akhir')->nullable();
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('poliklinik_id');
            $table->timestamps();

            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('kegiatans')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('poliklinik_id')
                ->references('id')
                ->on('polikliniks')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('rawat_inaps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ranjang_id');
            $table->datetime('waktu_masuk');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedTinyInteger('cara_penerimaan');
            $table->unsignedTinyInteger('aktifitas');
            $table->timestamps();

            $table->foreign('ranjang_id')
                ->references('id')
                ->on('ranjangs')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('kegiatans')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('rawat_inap_pulangs', function (Blueprint $table) {
            $table->unsignedInteger('rawat_inap_id');
            $table->datetime('waktu_keluar');
            $table->unsignedTinyInteger('keadaan_keluar');
            $table->unsignedTinyInteger('cara_keluar');
            $table->string('rujukan')->nullable();
            $table->string('rs_tujuan')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->primary('rawat_inap_id');

            $table->foreign('rawat_inap_id')
                ->references('id')
                ->on('rawat_inaps')
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
        Schema::dropIfExists('rawat_inap_pulangs');

        Schema::dropIfExists('rawat_inaps');

        Schema::dropIfExists('rawat_darurats');

        Schema::dropIfExists('rawat_jalans');
    }
}
