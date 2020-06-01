<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukKoperasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_koperasi', function (Blueprint $table) {
            $table->string('id_produkkoperasi')->primary();
            $table->string('nama_produk');
            $table->string('merk');
            $table->bigInteger('harga_koperasi');
            $table->string('gambar');
            $table->integer('id_kategori');
            $table->integer('id_admin');
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
        Schema::dropIfExists('produk_koperasi');
    }
}
