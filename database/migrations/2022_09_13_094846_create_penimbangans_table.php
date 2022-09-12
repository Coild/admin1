<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenimbangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penimbangans', function (Blueprint $table) {
            $table->id("penimbangan_id", 10);
            $table->string("penimbangan_kodebahan", 200);
            $table->string("penimbangan_namabahan", 200);
            $table->string("penimbangan_loth", 200);
            $table->string("penimbangan_jumlahbutuh");
            $table->string("penimbangan_jumlahtimbang");
            $table->string("penimbangan_timbangoleh", 200);
            $table->string("penimbangan_periksaoleh", 200);
            $table->string("nomor_batch",200);
            $table->integer("user_id",false);
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
        Schema::dropIfExists('penimbangans');
    }
}
