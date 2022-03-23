<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanbakusTable extends Migration
{
    public function up()
    {
        Schema::create('bahanbakus', function (Blueprint $table) {

		$table->bigInteger('bahanbaku_id',20)->unsigned();
		$table->string('bahanbaku_nama',100);
		$table->string('bahanbaku_kode',25);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('bahanbakus');
    }
}