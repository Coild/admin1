<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelulusanproduksTable extends Migration
{
    public function up()
    {
        Schema::create('pelulusanproduks', function (Blueprint $table) {

		$table->integer('id_pelulusan',11);
		$table->string('nama_bahan',200);
		$table->integer('no_batch',11);
		$table->timestamp('kedaluwarsa')->nullable()->default('NULL');
		$table->string('nama_pemasok',200);
		$table->timestamp('tanggal')->nullable()->default('NULL');
		$table->string('warna',30);
		$table->string('bau',30);
		$table->string('ph',5);
		$table->string('berat_jenis',20);
		$table->tinyInteger('kesimpulan',1);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->integer('updated_at',11)->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('pelulusanproduks');
    }
}