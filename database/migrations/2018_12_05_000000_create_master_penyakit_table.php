<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPenyakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasifikasi_penyakits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('uraian');
            $table->timestamps();
        });

        Schema::create('kelompok_penyakits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('klasifikasi_id')->nullable();
            $table->string('kode')->unique();
            $table->string('icd')->unique();
            $table->string('uraian');
            $table->timestamps();

            $table->foreign('klasifikasi_id')
                ->references('id')
                ->on('klasifikasi_penyakits')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('penyakits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kelompok_id')->nullable();
            $table->string('icd')->unique();
            $table->string('uraian');
            $table->timestamps();

            $table->foreign('kelompok_id')
                ->references('id')
                ->on('kelompok_penyakits')
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
        Schema::dropIfExists('penyakits');

        Schema::dropIfExists('kelompok_penyakits');

        Schema::dropIfExists('klasifikasi_penyakits');
    }
}
