<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFasilitasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polikliniks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->unsignedInteger('jenis_id');
            $table->timestamps();

            $table->foreign('jenis_id')
                ->references('id')
                ->on('jenis_polikliniks')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('ruangans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('poliklinik_id');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->unsignedTinyInteger('jenis');
            $table->unsignedTinyInteger('kelas');
            $table->timestamps();

            $table->foreign('poliklinik_id')
                ->references('id')
                ->on('polikliniks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('kamars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ruangan_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('ruangan_id')
                ->references('id')
                ->on('ruangans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('ranjangs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kamar_id');
            $table->string('kode');
            $table->timestamps();

            $table->foreign('kamar_id')
                ->references('id')
                ->on('kamars')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('poliklinik_tindakan_pemeriksaan', function (Blueprint $table) {
            $table->unsignedInteger('poliklinik_id');
            $table->unsignedInteger('tindakan_pemeriksaan_id');

            $table->primary(['poliklinik_id', 'tindakan_pemeriksaan_id'],
                'poliklinik_tindakan_pemeriksaan_id_primary'
            );

            $table->foreign('poliklinik_id')
                ->references('id')
                ->on('polikliniks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tindakan_pemeriksaan_id')
                ->references('id')
                ->on('tindakan_pemeriksaans')
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
        Schema::dropIfExists('poliklinik_tindakan_pemeriksaan');

        Schema::dropIfExists('ranjangs');

        Schema::dropIfExists('kamars');

        Schema::dropIfExists('ruangans');

        Schema::dropIfExists('polikliniks');
    }
}
