<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configapps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('propinsi');
            $table->integer('kabupatenkota')->nullable()->default(null);
            $table->integer('kecamatan')->nullable()->default(null);
            $table->integer('kelurahandesa')->nullable()->default(null);
            $table->string('untukpemilihan')->nullable()->default(null);
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
        Schema::dropIfExists('configapps');
    }
}
