<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenanganankeluhansTable extends Migration
{
    public function up()
    {
        Schema::create('penanganankeluhans', function (Blueprint $table) {

		$table->string('id_penanganankeluhan',20);
		$table->string('nama_customer',100);
		$table->timestamp('tanggal_keluhan')->nullable()->default('NULL');
		$table->string('keluhan',100);
		$table->timestamp('tanggal_ditanggapi')->nullable()->default('NULL');
		$table->string('produk_yang_digunakan',100);
		$table->string('penanganan_keluhan',100);
		$table->string('tindak_lanjut',100);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('penanganankeluhans');
    }
}