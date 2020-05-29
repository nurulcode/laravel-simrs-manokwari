<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepegawaianTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uraian');
            $table->timestamps();
        });

        Schema::create('kategori_kualifikasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('uraian');
            $table->boolean('tenaga_medis')->default(false);
            $table->timestamps();
        });

        Schema::create('kualifikasis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kategori_id');
            $table->string('kode');
            $table->string('uraian');
            $table->unsignedInteger('laki_laki')->default(0);
            $table->unsignedInteger('perempuan')->default(0);
            $table->timestamps();

            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori_kualifikasis')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->unsignedInteger('jabatan_id')->nullable();
            $table->unsignedInteger('kualifikasi_id');
            $table->timestamps();

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatans')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('kualifikasi_id')
                ->references('id')
                ->on('kualifikasis')
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
        Schema::dropIfExists('pegawais');

        Schema::dropIfExists('kualifikasis');

        Schema::dropIfExists('kategori_kualifikasis');

        Schema::dropIfExists('jabatans');
    }
}
