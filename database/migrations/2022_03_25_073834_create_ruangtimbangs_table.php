<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangtimbangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangtimbangs', function (Blueprint $table) {
            $table->id("id_ruangtimbang", 10);
            $table->string("kode_ruangtimbang", 10);
            $table->date('tanggal')->nullable();
            $table->string("nama_bahan_baku", 100);
            $table->string("no_loth", 20);
            $table->string("jumlah_bahan_baku", 100);
            $table->string("jumlah_permintaan", 20);
            $table->string("hasil_penimbangan", 20);
            $table->string("untuk_produk", 100);
            $table->integer('status', 0)->unsigned();
            $table->integer('pabrik', false);
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
        Schema::dropIfExists('ruangtimbangs');
    }
}