<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemusnahanproduksTable extends Migration
{
    public function up()
    {
        Schema::create('pemusnahanproduks', function (Blueprint $table) {

		$table->id('id_produk_pemusnahan',20);
		$table->date('tanggal_pemusnahan')->nullable();
		$table->string('nama_produk_jadi',100);
		$table->string('id_batch',20);
		$table->string('asal_produk_jadi',20);
		$table->integer('jumlah_produk_jadi',0)->unsigned();
		$table->string('alasan_pemusnahan',100);
		$table->string('cara_pemunsnahan',100);
		$table->string('nama_petugas',100);
		$table->integer('user_id',0)->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('pemusnahanproduks');
    }
}