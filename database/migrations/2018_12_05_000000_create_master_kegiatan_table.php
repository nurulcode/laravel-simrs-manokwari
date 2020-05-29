<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_kegiatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uraian');
            $table->timestamps();
        });

        Schema::create('kegiatans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('uraian');
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('kegiatans')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });

        Schema::create('kategori_kegiatan_kegiatan', function (Blueprint $table) {
            $table->unsignedInteger('kategori_kegiatan_id');
            $table->unsignedInteger('kegiatan_id');
            $table->string('kode');

            $table->primary([
                'kategori_kegiatan_id', 'kegiatan_id'],
                'kegiatan_id_kategori_kegiatan_id_primary'
            );

            $table->foreign('kategori_kegiatan_id')
                ->references('id')
                ->on('kategori_kegiatans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('kegiatans')
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
        Schema::dropIfExists('kategori_kegiatan_kegiatan');

        Schema::dropIfExists('kegiatans');

        Schema::dropIfExists('kategori_kegiatans');
    }
}
