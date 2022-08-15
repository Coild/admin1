<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukantarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkantaras', function (Blueprint $table) {
            $table->id("produkantara_id");
            $table->string("produkantara_nama", 200);
            $table->string("produkantara_kode", 205);
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
        Schema::dropIfExists('produkantaras');
    }
}
