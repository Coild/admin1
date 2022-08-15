<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengolahanbatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengolahanbatches', function (Blueprint $table) {
            $table->id("batch");
            $table->string("pob", 200);
            $table->string("kode_produk", 200);
            $table->string("nama_produk", 200);
            $table->string("nomor_batch", 200);
            $table->string("besar_batch", 200);
            $table->string("bentuk_sedia", 200);
            $table->string("kategori", 200);
            $table->string("kemasan", 200);
            $table->integer('pabrik', false);
            $table->integer("status", false);
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
        Schema::dropIfExists('pengolahanbatches');
    }
}
