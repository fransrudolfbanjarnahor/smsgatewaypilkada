<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLokasiTPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasitps', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('kode');
            $table->string('nama');
            $table->string('lokasi')->nullable()->default(null);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('kelurahandesa_id')->unsigned();
            $table->foreign('kelurahandesa_id')->references('id')->on('kelurahandesa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasitps');
    }
}
