<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananPenunjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_penunjangs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perawatan_id');
            $table->string('perawatan_type');
            $table->unsignedInteger('poliklinik_id');
            $table->dateTime('waktu');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('poliklinik_id')
                ->references('id')
                ->on('polikliniks')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('layanan_penunjang_tindakans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penunjang_id');
            $table->unsignedInteger('tindakan_id');
            $table->string('tindakan_type');
            $table->dateTime('waktu');
            $table->unsignedInteger('jumlah')->default(1);
            $table->string('catatan')->nullable();
            $table->unsignedInteger('petugas_id');

            $table->text('tarif')->nullable();
            $table->timestamps();

            $table->foreign('petugas_id')
                ->references('id')
                ->on('pegawais')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('penunjang_id')
                ->references('id')
                ->on('layanan_penunjangs')
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
        Schema::dropIfExists('layanan_penunjang_tindakans');

        Schema::dropIfExists('layanan_penunjangs');
    }
}
