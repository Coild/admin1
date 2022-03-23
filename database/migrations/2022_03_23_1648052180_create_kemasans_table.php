<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKemasansTable extends Migration
{
    public function up()
    {
        Schema::create('kemasans', function (Blueprint $table) {

		$table->bigInteger('kemasan_id',20)->unsigned();
		$table->string('kemasan_nama',100);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('kemasans');
    }
}