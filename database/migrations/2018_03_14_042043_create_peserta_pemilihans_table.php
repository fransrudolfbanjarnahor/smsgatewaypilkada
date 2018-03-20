<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaPemilihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertapemilihan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namacalon')->nullable()->default(null);
            $table->binary('photocalon')->nullable()->default(null);
            $table->string('inisialcalon')->nullable()->default(null);
            $table->string('namawakilcalon')->nullable()->default(null);
            $table->binary('photowakilcalon')->nullable()->default(null);
            $table->string('inisialwakilcalon')->nullable()->default(null);
            $table->string('inisialpaslon')->nullable()->default(null);
            $table->integer('nourut')->nullable()->default(null);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('pesertapemilihan');
    }
}
