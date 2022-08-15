<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePPkemasanmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_pkemasanmasuks', function (Blueprint $table) {
            $table->id("id_kemasanmasuk", 10);
            $table->date('tanggal')->nullable();
            $table->string("nama_kemasan", 200);
            $table->string("no_loth", 200);
            $table->string("pemasok", 200);
            $table->string("jumlah", 200);            
            $table->string("no_kontrol", 200);
            $table->date('kedaluwarsa')->nullable();
            $table->integer('pabrik', false);
            $table->integer('induk', false);
            $table->integer("user_id", false);
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
        Schema::dropIfExists('p_pkemasanmasuks');
    }
}
