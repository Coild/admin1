<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrampelatihansTable extends Migration
{
    public function up()
    {
        Schema::create('programpelatihans', function (Blueprint $table) {

		$table->string('id_programpelatihan',20);
		$table->string('materi_pelatihan',100);
		$table->string('peserta_pelatihan',100);
		$table->string('pelatih',100);
		$table->string('metode_pelatihan',100);
		$table->timestamp('jadwal_mulai_pelatihan')->nullable()->default('NULL');
		$table->timestamp('jadwal_berakhir_pelatihan')->nullable()->default('NULL');
		$table->string('metode_penilaian',100);
		$table->integer('user_id',11);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('programpelatihans');
    }
}