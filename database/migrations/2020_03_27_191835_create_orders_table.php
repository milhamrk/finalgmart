<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->string('id_order', 15)->primary();
            $table->bigInteger('subtotal_harga');
            $table->bigInteger('subtotal_harga_beli');
            $table->char('status', 1)->comment('1 menunggu, 2 proses, 3 diantar, 4 selesai');
            $table->integer('id_pembayaran');
            $table->integer('id_pengiriman');
            $table->integer('id_kios');
            $table->integer('id_konsumen');
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
        Schema::dropIfExists('order');
    }
}
