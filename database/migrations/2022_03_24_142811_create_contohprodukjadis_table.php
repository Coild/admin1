<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContohprodukjadisTable extends Migration
{
    public function up()
    {
        Schema::create('contohprodukjadis', function (Blueprint $table) {

		$table->id('id_produkjadi',11);
		$table->string('nama_produkjadi',200);
		$table->integer('no_batch',false)->unsigned();
		$table->date('tanggal_ambil')->nullable();
		$table->date('kedaluwarsa')->nullable();
		$table->integer('jumlah_produkbox',false);
		$table->integer('jumlah_produk',false);
		$table->string('jenis_warnakemasan',200);
		$table->tinyInteger('kesimpulan',false)->unsigned();
		$table->integer('user_id',false)->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('contohprodukjadis');
    }
}