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
		$table->integer('pob',0)->unsigned();
		$table->date('tanggal')->nullable();
		$table->string('nama_alat',200);
		$table->string('tipe_merek',200);
		$table->string('ruang',200);
		$table->date('mulai')->nullable();
		$table->date('selesai')->nullable();
		$table->string('oleh',200);
		$table->string('ket',200);
		$table->integer('user_id',0)->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('pengoprasianalats');
    }
};