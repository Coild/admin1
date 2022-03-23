<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangmasuksTable extends Migration
{
    public function up()
    {
        Schema::create('barangmasuks', function (Blueprint $table) {

		$table->bigInteger('barangmasuk_id',20)->unsigned();
		$table->date('barangmasuk_tgl');
		$table->string('barangmasuk_noloth',25);
		$table->string('barangmasuk_pemasok',100);
		$table->integer('barangmasuk_jumlah',11);
		$table->string('barangmasuk_nokontrol',25);
		$table->date('barangmasuk_kadaluarsa');
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('barangmasuks');
    }
}