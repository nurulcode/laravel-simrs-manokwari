<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTindakanPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan_pemeriksaans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('kode')->unique();
            $table->string('uraian');
            $table->unsignedTinyInteger('jenis');
            $table->unsignedInteger('prosedur_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('tindakan_pemeriksaans')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
            $table->foreign('prosedur_id')
                  ->references('id')
                  ->on('prosedurs')
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
        Schema::dropIfExists('tindakan_pemeriksaans');
    }
}
