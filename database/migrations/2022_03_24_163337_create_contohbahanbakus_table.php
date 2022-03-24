<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContohbahanbakusTable extends Migration
{
    public function up()
    {
        Schema::create('contohbahanbakus', function (Blueprint $table) {

            $table->string('id_bahanbaku', 11);
            $table->string('nama_bahanbaku', 200);
            $table->integer('no_batch', 11);
            $table->date('tanggal_ambil')->nullable();
            $table->date('kedaluwarsa')->nullable();
            $table->integer('jumlah_bahanbakubox')->unsigned();
            $table->integer('jumlah_produk')->unsigned();
            $table->string('jenis_warnakemasan', 200);
            $table->tinyInteger('kesimpulan')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contohbahanbakus');
    }
}
