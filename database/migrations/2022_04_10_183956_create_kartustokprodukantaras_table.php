<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartustokprodukantarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartustokprodukantaras', function (Blueprint $table) {
            $table->id('id_kartustokprodukantara', 20);
            $table->string('kode_kartu', 20);
            $table->date('tanggal')->nullable();
            $table->string('id_batch', 20);
            $table->string('jumlah', 30);
            $table->string('nama_distributor', 100);
            $table->integer('pabrik', false);
            $table->integer("status", false);
            $table->integer('user_id', 0)->unsigned();
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
        Schema::dropIfExists('kartustokprodukantaras');
    }
}
