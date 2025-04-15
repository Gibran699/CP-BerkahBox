<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMapsUrlColumnInKontakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->text('maps_url')->change(); // Ubah tipe menjadi TEXT
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->string('maps_url', 255)->change(); // Kembali ke VARCHAR(255) jika rollback
        });
    }
};

