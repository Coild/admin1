<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusiproduksTable extends Migration
{
    public function up()
    {
        Schema::create('distribusiproduks', function (Blueprint $table) {

		$table->string('id_distribusi',20);
		$table->timestamp('tanggal')->nullable()->default('NULL');
		$table->string('id_batch',20);
		$table->integer('jumlah',10);
		$table->string('nama_distributor',100);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('distribusiproduks');
    }
}