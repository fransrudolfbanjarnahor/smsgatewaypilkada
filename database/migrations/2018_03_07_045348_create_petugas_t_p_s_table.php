<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetugasTPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petugastps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomorhp');
            $table->string('nama');
            $table->integer('lokasitps_id')->unsigned();
            $table->foreign('lokasitps_id')->references('id')->on('lokasitps');
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
        Schema::dropIfExists('petugastps');
    }
}
