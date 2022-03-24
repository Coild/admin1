<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanproduksTable extends Migration
{
    public function up()
    {
        Schema::create('penarikanproduks', function (Blueprint $table) {

		$table->string('id_produk_penarikan',20);
		$table->timestamp('tanggal_penarikan')->nullable();
		$table->string('nama_distributor',100);
		$table->string('produk_ditarik',20);
		$table->integer('jumlah_produk_ditarik',10,0);
		$table->string('id_batch',20);
		$table->string('alasan_penarikan',100);
		$table->integer('user_id',11,0);
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('penarikanproduks');
    }
}