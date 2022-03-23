<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangkeluarsTable extends Migration
{
    public function up()
    {
        Schema::create('barangkeluars', function (Blueprint $table) {

		$table->bigInteger('barangkeluar_id',20)->unsigned();
		$table->date('barangkeluar_tgl');
		$table->string('barangkeluar_utkproduk',25);
		$table->string('barangkeluar_nobatch',100);
		$table->integer('barangkeluar_jumlah',11);
		$table->integer('barangkeluar_sisa',11);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('barangkeluars');
    }
}