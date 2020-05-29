<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_pemeriksaans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perawatan_id');
            $table->string('perawatan_type');
            $table->unsignedInteger('pemeriksaan_umum_id');
            $table->string('hasil');
            $table->dateTime('waktu');
            $table->unsignedInteger('petugas_id');
            $table->timestamps();

            $table->foreign('pemeriksaan_umum_id')
                ->references('id')
                ->on('pemeriksaan_umums')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('petugas_id')
                ->references('id')
                ->on('pegawais')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanan_pemeriksaans');
    }
}
