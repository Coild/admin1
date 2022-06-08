<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilperiksaalatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detilperiksaalats', function (Blueprint $table) {
            $table->id('id_detilalat');
            $table->integer('id_induk');
            // $table->dateTime('mulai_pemakaian')->nullable();
            // $table->dateTime('selesai_pemakaian')->nullable();
            // $table->string('produksi')->nullable();
            // $table->string('no_batch')->nullable();
            $table->string('diperiksa_oleh')->nullable();
            $table->dateTime('mulai_pembersihan')->nullable();
            $table->dateTime('selesai_pembersihan')->nullable();
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
        Schema::dropIfExists('detilperiksaalats');
    }
}
