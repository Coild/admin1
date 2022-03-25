<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimbangproduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timbangproduks', function (Blueprint $table) {
            $table->id("timbang_produk_id", 10);
            $table->date('tanggal')->nullable();
            $table->string("nama_produk_antara", 100);
            $table->integer("no_batch", 0)->unsigned();
            $table->string("asal_produk", 100);
            $table->integer("jumlah_produk", 0)->unsigned();
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
        Schema::dropIfExists('timbangproduks');
    }
}
