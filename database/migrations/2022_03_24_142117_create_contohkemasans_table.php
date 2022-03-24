<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContohkemasansTable extends Migration
{
    public function up()
    {
        Schema::create('contohkemasans', function (Blueprint $table) {

		$table->id('id_kemasan');
		$table->string('nama_kemasan',200);
		$table->integer('no_batch',0)->unsigned();
		$table->date('tanggal_ambil')->nullable();
		$table->date('kedaluwarsa')->nullable();
		$table->integer('jumlah_kemasanbox',0)->unsigned();
		$table->integer('jumlah_produk',0)->unsigned();
		$table->string('jenis_warnakemasan',200);
		$table->tinyInteger('kesimpulan',0)->unsigned();
		$table->integer('user_id',0)->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('contohkemasans');
    }
}