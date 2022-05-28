<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilruangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detilruangans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_induk');
            $table->dateTime('lantai')->nullable();
            $table->dateTime('meja')->nullable();
            $table->dateTime('jendela')->nullable();
            $table->dateTime('langit')->nullable();
            $table->string('diperiksa_oleh')->nullable();
            $table->string('pelaksana')->nullable();
            $table->string('keterangan')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detilruangans');
    }
}
