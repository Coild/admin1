<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatbersihsTable extends Migration
{
    public function up()
    {
        Schema::create('catatbersihs', function (Blueprint $table) {

		$table->bigInteger('catatbersih_id',20)->unsigned();
		$table->string('catatbersih_produk',100);
		$table->string('catatbersih_batchnum',100);
		$table->string('catatbersih_prosedurnum',100);
		$table->string('catatbersih_namaruang',100);
		$table->string('catatbersih_carabersih',100);
		$table->string('catatbersih_pelaksana',100);
		$table->string('catatbersih_periksa',100);
		$table->tinyInteger('catatbersih_lantaidinding',1);
		$table->tinyInteger('catatbersih_meja',1);
		$table->tinyInteger('catatbersih_jendela',1);
		$table->tinyInteger('catatbersih_plafon',1);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('catatbersihs');
    }
}