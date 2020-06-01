<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTerjualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_terjual', function (Blueprint $table) {
            $table->bigIncrements('id_produkterjual');
            $table->bigInteger('jumlah_pesan');
            $table->bigInteger('harga');
            $table->bigInteger('total');
            $table->bigInteger('harga_beli');
            $table->bigInteger('total_harga_beli');
            $table->string('id_kios', 14);
            $table->integer('id_produkkios');
            $table->string('id_order', 15);
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
        Schema::dropIfExists('produk_terjual');
    }
}
