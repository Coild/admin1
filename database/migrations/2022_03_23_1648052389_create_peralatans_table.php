<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeralatansTable extends Migration
{
    public function up()
    {
        Schema::create('peralatans', function (Blueprint $table) {

		$table->string('peralatan_id',50);
		$table->string('peralatan_nama',100);
		$table->string('nomor_batch',100);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('peralatans');
    }
}