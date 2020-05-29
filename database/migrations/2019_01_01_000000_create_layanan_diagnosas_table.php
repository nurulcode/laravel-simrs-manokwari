<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananDiagnosasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_diagnosas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perawatan_id');
            $table->string('perawatan_type');
            $table->unsignedInteger('penyakit_id');
            $table->string('lama_menderita')->nullable();
            $table->unsignedTinyInteger('kasus');
            $table->unsignedInteger('tipe_diagnosa_id');
            $table->dateTime('waktu');
            $table->unsignedInteger('petugas_id');
            $table->timestamps();

            $table->foreign('penyakit_id')
                ->references('id')
                ->on('penyakits')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('tipe_diagnosa_id')
                ->references('id')
                ->on('tipe_diagnosas')
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
        Schema::dropIfExists('layanan_diagnosas');
    }
}
