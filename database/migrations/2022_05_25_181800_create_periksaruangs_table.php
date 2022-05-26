<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaruangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksaruangs', function (Blueprint $table) {
            $table->id('id_periksaruang');
            $table->string('nomer_prosedur');
            $table->dateTime('tanggal_prosedur')->nullable();
            $table->string('nama_ruangan');
            $table->integer('pabrik');
            $table->integer('status')->nullable();
            $table->integer('user_id', 0)->unsigned();
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
        Schema::dropIfExists('periksaruangs');
    }
}
