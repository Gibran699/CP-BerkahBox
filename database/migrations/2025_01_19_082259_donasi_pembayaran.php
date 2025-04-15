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
        Schema::create('donasi_pembayaran', function (Blueprint $table) {
            $table->increments('id_donasi_pembayaran');
            $table->unsignedBigInteger('id')->nullable();
            $table->string('order_id')->nullable();
            $table->foreign('id')->references('id')->on('users')->onDelete('restrict');
            $table->unsignedInteger('id_program_donasi');
            $table->foreign('id_program_donasi')->references('id_program_donasi')->on('program_donasi')->onDelete('restrict');
            
            $table->string('nama_donatur');
            $table->string('email');
            $table->string('no_telp');
            $table->string('nominal');
            $table->string('status')->default('');
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_pembayaran');
    }
};
