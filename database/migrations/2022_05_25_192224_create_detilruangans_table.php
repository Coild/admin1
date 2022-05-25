<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilruangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detilruangans', function (Blueprint $table) {
            $table->id();
            $table->integer('nomer_prosedur');
            $table->dateTime('tanggal_prosedur');
            $table->string('ruangan_prosedur');
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
        Schema::dropIfExists('detilruangans');
    }
}
