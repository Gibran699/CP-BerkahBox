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
        Schema::create('pengajuan_donasi', function (Blueprint $table) {
            $table->increments('id_pengajuan_donasi');
            $table->unsignedBigInteger('id')->nullable();
            $table->foreign('id')->references('id')->on('users')->onDelete('restrict');
            $table->unsignedInteger('id_program_donasi');
            $table->foreign('id_program_donasi')->references('id_program_donasi')->on('program_donasi')->onDelete('restrict');
            $table->string('nama_lengkap');
            $table->text('no_telp');
            $table->text('desc_pengajuan');
            $table->text('foto1');
            $table->string('foto2');
            $table->string('status')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_donasi');
    }
};
