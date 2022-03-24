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
		$table->integer('no_batch',0)->unsigned();
		$table->date('kedaluwarsa')->nullable();
		$table->string('nama_pemasok',200);
		$table->date('tanggal')->nullable();
		$table->string('warna',30);
		$table->string('bau',30);
		$table->string('ph',5);
		$table->string('berat_jenis',20);
		$table->tinyInteger('kesimpulan',0)->unsigned();
		$table->integer('user_id',0)->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->integer('updated_at',0)->nullable()->unsigned();

        });
    }

    public function down()
    {
        Schema::dropIfExists('pelulusanproduks');
    }
}