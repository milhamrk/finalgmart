<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->bigIncrements('id_stockkoperasi');
            $table->string('nama_produk', 70);
            $table->string('merk', 70);
            $table->integer('harga_koperasi');
            $table->integer('stok');
            $table->string('gambar', 70);
            $table->string('id_produkkoperasi', 25);
            $table->string('id_kategori', 12);
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
        Schema::dropIfExists('stok');
    }
}
