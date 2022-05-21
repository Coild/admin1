<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logadmins', function (Blueprint $table) {
            $table->id("logadmin_id");
            $table->integer('id_pabrik')->unsigned();
            $table->string("log_pabrik", 255);
            $table->string("log_isi", 255);
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
        Schema::dropIfExists('logadmins');
    }
}
