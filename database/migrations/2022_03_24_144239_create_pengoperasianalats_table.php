<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengoprasianalatsTable extends Migration
{
    public function up()
    {
        Schema::create('pengoprasianalats', function (Blueprint $table) {

		$table->integer('id_operasi',20);
		$table->integer('pob',11);
		$table->timestamp('tanggal')->nullable()->default('NULL');
		$table->string('nama_alat',200);
		$table->string('tipe_merek',200);
		$table->string('ruang',200);
		$table->timestamp('mulai')->nullable()->default('NULL');
		$table->timestamp('selesai')->nullable()->default('NULL');
		$table->string('oleh',200);
		$table->string('ket',200);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('pengoprasianalats');
    }
}