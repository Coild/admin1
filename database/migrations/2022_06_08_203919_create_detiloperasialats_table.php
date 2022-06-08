<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetiloperasialatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detiloperasialats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_induk');
            $table->dateTime('mulai_pemakaian')->nullable();
            $table->dateTime('selesai_pemakaian')->nullable();
            $table->string('produksi')->nullable();
            $table->string('no_batch')->nullable();
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
        Schema::dropIfExists('detiloperasialats');
    }
}
