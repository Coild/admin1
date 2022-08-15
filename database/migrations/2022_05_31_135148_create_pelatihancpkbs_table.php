<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihancpkbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihancpkbs', function (Blueprint $table) {
            $table->integer('id_pelatihancpkb', 11);
            $table->string('kode_pelatihan', 200);
            $table->string('materi_pelatihan', 200);
            $table->string('peserta_pelatihan', 200);
            $table->string('pelatih', 200);
            $table->string('metode_pelatihan', 200);
            $table->date('jadwal_mulai_pelatihan')->nullable();
            $table->date('jadwal_berakhir_pelatihan')->nullable();
            $table->string('metode_penilaian', 200);
            $table->tinyInteger('protap', 0)->unsigned();
            $table->integer('pabrik', false);
            $table->tinyInteger('status', 0)->unsigned();
            $table->integer("user_id", false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelatihancpkbs');
    }
}
