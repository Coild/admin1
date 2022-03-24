<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContohkemasansTable extends Migration
{
    public function up()
    {
        Schema::create('contohkemasans', function (Blueprint $table) {

		$table->integer('id_kemasan',11);
		$table->string('nama_kemasan',200);
		$table->integer('no_batch',11);
		$table->timestamp('tanggal_ambil')->nullable()->default('NULL');
		$table->timestamp('kedaluwarsa')->nullable()->default('NULL');
		$table->integer('jumlah_kemasanbox',11);
		$table->integer('jumlah_produk',11);
		$table->string('jenis_warnakemasan',200);
		$table->tinyInteger('kesimpulan',1);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('contohkemasans');
    }
}