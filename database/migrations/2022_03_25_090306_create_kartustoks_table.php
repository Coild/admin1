<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartustoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartustoks', function (Blueprint $table) {
            $table->string('id_kartustok', 20)->primary_key();
            $table->date('tanggal')->nullable();
            $table->string('id_batch', 20);
            $table->integer('jumlah', 0)->unsigned();
            $table->string('nama_distributor', 100);
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
        Schema::dropIfExists('kartustoks');
    }
}
