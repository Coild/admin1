<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanproduksTable extends Migration
{
	public function up()
	{
		Schema::create('penarikanproduks', function (Blueprint $table) {
			$table->id('id_produk_penarikan', 20);
			$table->integer('protap')->unsigned();
			$table->string('kode_penarikan', 200);
			$table->date('tanggal_penarikan')->nullable();
			$table->string('nama_distributor', 200);
			$table->string('produk_ditarik', 200);
			$table->string('jumlah_produk_ditarik', 200);
			$table->string('no_batch', 20);
			$table->string('alasan_penarikan', 200);
			$table->integer('pabrik', false);
			$table->tinyInteger('status', 0)->unsigned();
			$table->integer("user_id", false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('penarikanproduks');
	}
}
