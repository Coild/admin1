<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetiltimbanghasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detiltimbanghasils', function (Blueprint $table) {
            $table->id("id_detiltimbanghasil");
            $table->date("tanggal");
            $table->string("no_loth", 20);
            $table->string("jumlah_permintaan", 200);
            $table->string("hasil_penimbangan", 200);
            $table->string("sisa_bahan", 200);
            $table->string("untuk_produk", 200);
            $table->integer("induk",0);
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
        Schema::dropIfExists('detiltimbanghasils');
    }
}
