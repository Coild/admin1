<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenanganankeluhansTable extends Migration
{
    public function up()
    {
        Schema::create('penanganankeluhans', function (Blueprint $table) {
            $table->id('id_penanganankeluhan', 20);
            $table->integer('protap')->unsigned();
            $table->string('kode_keluhan', 20);
            $table->string('nama_customer', 200);
            $table->date('tanggal_keluhan')->nullable();
            $table->string('keluhan', 200);
            $table->date('tanggal_ditanggapi')->nullable();
            $table->string('produk_yang_digunakan', 200);
            $table->string('penanganan_keluhan', 200);
            $table->string('tindak_lanjut', 200);
            $table->integer('status', 0)->unsigned();
            $table->integer('pabrik', false);
            $table->integer("user_id", false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penanganankeluhans');
    }
}
