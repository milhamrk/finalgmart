<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kios', function (Blueprint $table) {
            $table->bigIncrements('id_kios');
            $table->string('nama_pemilik');
            $table->string('nama_kios');
            $table->string('email')->unique();
            $table->string('no_hp')->unique();
            $table->string('password');
            $table->string('alamat');
            $table->boolean('status_buka')->default(false);
            $table->double('rating', 5, 0);
            $table->rememberToken();
            $table->float('longitude');
            $table->float('latitude');
            $table->string('token')->nullable();
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
        Schema::dropIfExists('kios');
    }
}
