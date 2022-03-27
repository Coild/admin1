<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemusnahanbahanbakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemusnahanbahanbakus', function (Blueprint $table) {
            $table->string('id_pemusnahanbahan', 20)->primary_key();
            $table->date('tanggal_pemusnahan')->nullable();
            $table->string('nama_produk_jadi', 100);
            $table->string('id_batch', 20);
            $table->string('asal_produk_jadi', 20);
            $table->integer('jumlah_produk_jadi', 0)->unsigned();
            $table->string('alasan_pemusnahan', 100);
            $table->string('cara_pemunsnahan', 100);
            $table->string('nama_petugas', 100);
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
        Schema::dropIfExists('pemusnahanbahanbakus');
    }
}
