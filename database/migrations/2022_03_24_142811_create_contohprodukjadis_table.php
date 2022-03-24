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
		$table->integer('no_batch',4,false)->unsigned();
		$table->timestamp('tanggal_ambil')->nullable();
		$table->timestamp('kedaluwarsa')->nullable();
		$table->integer('jumlah_produkbox',11,false);
		$table->integer('jumlah_produk',11,false);
		$table->string('jenis_warnakemasan',200);
		$table->tinyInteger('kesimpulan',1,false)->unsigned();
		$table->integer('user_id',11,false)->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('contohprodukjadis');
    }
}