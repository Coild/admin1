<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelulusanproduksTable extends Migration
{
	public function up()
	{
		Schema::create('pelulusanproduks', function (Blueprint $table) {

			$table->integer('id_pelulusan', 11);
			$table->string('nama_bahan', 200);
			$table->string('no_batch', 20);
			$table->date('kedaluwarsa')->nullable();
			$table->string('nama_pemasok', 200);
			$table->date('tanggal')->nullable();
			$table->string('warna', 200);
			$table->string('bau', 200);
			$table->string('ph', 200);
			$table->string('berat_jenis', 200);
			$table->tinyInteger('protap', 0)->unsigned();
			$table->integer('pabrik', false);
			$table->tinyInteger('status', 0)->unsigned();
			$table->integer("user_id", false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('pelulusanproduks');
	}
}
