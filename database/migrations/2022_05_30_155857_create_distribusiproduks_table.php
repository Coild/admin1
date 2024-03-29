<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusiproduksTable extends Migration
{
    public function up()
    {
        Schema::create('distribusiproduks', function (Blueprint $table) {

            $table->id('id_distribusi', 20);
            $table->string('kode_distribusi', 200);
            $table->date('tanggal')->nullable();
            $table->string('id_batch', 200);
            $table->string('jumlah', 200);
            $table->string('nama_distributor', 200);
            $table->tinyInteger('protap', 0)->unsigned();
            $table->integer('pabrik', false);
            $table->tinyInteger('status', 0)->unsigned();
            $table->integer("user_id", false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('distribusiproduks');
    }
}
