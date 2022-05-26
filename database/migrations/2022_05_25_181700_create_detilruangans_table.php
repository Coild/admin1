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
            $table->string('lantai', 5)->nullable();
            $table->string('meja', 5)->nullable();
            $table->string('jendela', 5)->nullable();
            $table->string('langit', 5)->nullable();
            $table->string('diperiksa_oleh')->nullable();
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
