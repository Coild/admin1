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
            $table->string("kode_timbang", 20);
            $table->date('tanggal')->nullable();
            $table->string("nama_produk_antara", 100);
            $table->string("no_batch", 20);
            $table->string("asal_produk", 100);
            $table->string("jumlah_produk", 20);
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
        Schema::dropIfExists('timbangproduks');
    }
}
