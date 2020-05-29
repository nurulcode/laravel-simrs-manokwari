<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('tanggal_registrasi')->nullable();
            $table->string('no_rekam_medis')->unique()->nullable();
            $table->unsignedInteger('jenis_identitas_id')->nullable();
            $table->string('nomor_identitas')->nullable();
            $table->string('nama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->unsignedTinyInteger('golongan_darah')->nullable();

            $table->unsignedInteger('agama_id')->nullable();
            $table->unsignedInteger('suku_id')->nullable();
            $table->unsignedInteger('pendidikan_id')->nullable();
            $table->unsignedInteger('pekerjaan_id')->nullable();

            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->string('telepon')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->unsignedTinyInteger('status_pernikahan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('alamat_keluarga')->nullable();
            $table->string('telepon_keluarga')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jenis_identitas_id')
                ->references('id')
                ->on('jenis_identitas')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('agama_id')
                ->references('id')
                ->on('agamas')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('suku_id')
                ->references('id')
                ->on('sukus')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('pendidikan_id')
                ->references('id')
                ->on('pendidikans')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('pekerjaan_id')
                ->references('id')
                ->on('pekerjaans')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('kelurahan_id')
                ->references('id')
                ->on('kelurahans')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
}
