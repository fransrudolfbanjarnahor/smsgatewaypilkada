<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smsdata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomorhp')->nullable()->default(null);
            $table->string('pesan')->nullable()->default(null);
            $table->string('statuspesan')->nullable()->default(null);
            $table->boolean('state')->nullable()->default(null);
            $table->string('tps')->nullable()->default(null);
            $table->integer('nourut')->nullable()->default(null);
            $table->integer('jumlah')->nullable()->default(null);
            $table->string('username')->nullable()->default(null);
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
        Schema::dropIfExists('smsdata');
    }
}
