<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donasi_jemput', function (Blueprint $table) {
            $table->increments('id_donasi_jemput');
            $table->unsignedBigInteger('id')->nullable();
            $table->foreign('id')->references('id')->on('users')->onDelete('restrict');
            $table->unsignedInteger('id_program_donasi');
            $table->foreign('id_program_donasi')->references('id_program_donasi')->on('program_donasi')->onDelete('restrict');
            $table->string('nama_donatur');
            $table->text('no_hp');
            $table->text('barang_donasi');
            $table->text('foto_pengambilan');
            $table->text('foto_penyerahan')->nullable();
            $table->string('status')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_jemput');
    }
};
