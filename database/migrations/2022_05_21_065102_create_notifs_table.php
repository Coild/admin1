<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifs', function (Blueprint $table) {
            $table->id('notif_id');
            $table->string('notif_isi', 255);
            $table->string('notif_link', 255);
            $table->string('notif_laporan', 255);
            $table->dateTime('notif_waktu');
            $table->integer('status')->unsigned();
            $table->integer('notif_1')->unsigned();
            $table->integer('notif_2')->unsigned();
            $table->integer('notif_3')->unsigned();
            $table->integer('notif_level')->unsigned();
            $table->integer('id_pabrik')->unsigned();
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
        Schema::dropIfExists('notifs');
    }
}
