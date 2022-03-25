<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimbangbahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timbangbahans', function (Blueprint $table) {
            $table->id("timbang_bahan_id", 10);
            $table->date('tanggal')->nullable();
            $table->string("nama_bahan", 100);
            $table->integer("no_loth", 0)->unsigned();
            $table->string("nama_suplier", 100);
            $table->integer("jumlah_bahan", 0)->unsigned();
            $table->integer("hasil_penimbangan", 0)->unsigned();
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
        Schema::dropIfExists('timbangbahans');
    }
}
