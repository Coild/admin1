<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePPprodukjadikeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_pprodukjadikeluars', function (Blueprint $table) {
            $table->id("id_ppprodukjadikeluar", 10);
            $table->date('tanggal')->nullable();
            $table->string("nama_produk", 200);
            $table->string("untuk_produk", 200);
            $table->string("no_batch", 0);
            $table->string("jumlah", 200);
            $table->string("sisa", 200);
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
        Schema::dropIfExists('p_pprodukjadikeluars');
    }
}
