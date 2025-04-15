<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('sejarah', function (Blueprint $table) {
            $table->increments('id_sejarah');
            $table->unsignedBigInteger('id')->nullable();
            $table->foreign('id')->references('id')->on('users')->onDelete('restrict');
            $table->longText('tekssejarah');
            $table->longText('tekssejarah2');
            $table->longText('tekssejarah3');
            $table->longText('tekssejarah4');
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
        Schema::dropIfExists('sejarah');
    }
};