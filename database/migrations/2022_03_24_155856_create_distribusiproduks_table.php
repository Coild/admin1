<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusiproduksTable extends Migration
{
    public function up()
    {
        Schema::create('distribusiproduks', function (Blueprint $table) {

		$table->string('id_distribusi',20)->primary_key();
		$table->date('tanggal')->nullable();
		$table->string('id_batch',20);
		$table->integer('jumlah',0)->unsigned();
		$table->string('nama_distributor',100);
		$table->integer('user_id',0)->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('distribusiproduks');
    }
}
