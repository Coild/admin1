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
            $table->id('id_pemusnahanbahan', 20);
            $table->integer('protap')->unsigned();
            $table->string('kode_pemusnahan', 200);
            $table->date('tanggal_pemusnahan')->nullable();
            $table->string('nama_bahanbaku', 200);
            $table->string('no_batch', 20);
            $table->string('asal_bahanbaku', 20);
            $table->string('jumlah_bahanbaku', 20);
            $table->string('alasan_pemusnahan', 200);
            $table->string('cara_pemunsnahan', 200);
            $table->string('nama_petugas', 200);
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
