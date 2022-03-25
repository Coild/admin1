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
            $table->date('tanggal')->nullable();
            $table->string("nama_bahan_baku", 100);
            $table->integer("no_loth", 0)->unsigned();
            $table->string("jumlah_bahan_baku", 100);
            $table->integer("jumlah_permintaan", 0)->unsigned();
            $table->integer("hasil_penimbangan", 0)->unsigned();
            $table->string("untuk_produk", 100);
            $table->tinyInteger('pjt', 0)->unsigned();
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
