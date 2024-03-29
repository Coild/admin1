<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetiltimbangproduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detiltimbangproduks', function (Blueprint $table) {
            $table->id("id_detiltimbangproduk");
            $table->date("tanggal");
            $table->string("nama_produk_antara", 200);
            $table->string("asal_produk", 200);
            $table->string("jumlah_produk", 200);
            $table->string("hasil_penimbangan", 200);
            $table->string("untuk_produk", 200);
            $table->integer("induk",0);
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
        Schema::dropIfExists('detiltimbangproduks');
    }
}
