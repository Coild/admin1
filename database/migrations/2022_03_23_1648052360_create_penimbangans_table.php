<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenimbangansTable extends Migration
{
    public function up()
    {
        Schema::create('penimbangans', function (Blueprint $table) {

		$table->bigInteger('penimbangan_id',20)->unsigned();
		$table->string('penimbangan_kodebahan',100);
		$table->string('penimbangan_namabahan',100);
		$table->string('penimbangan_loth',100);
		$table->integer('penimbangan_jumlahbutuh',11);
		$table->integer('penimbangan_jumlahtimbang',11);
		$table->string('penimbangan_timbangoleh',100);
		$table->string('penimbangan_periksaoleh',100);
		$table->string('nomor_batch',100);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('penimbangans');
    }
}