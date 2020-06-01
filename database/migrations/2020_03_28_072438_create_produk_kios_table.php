<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukKiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_kios', function (Blueprint $table) {
            $table->bigIncrements('id_produkkios');
            $table->bigInteger('harga');
            $table->integer('stok');
            $table->string('id_produkkoperasi');
            $table->integer('id_kios');
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
        Schema::dropIfExists('produk_kios');
    }
}
