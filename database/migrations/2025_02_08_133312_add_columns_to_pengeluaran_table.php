<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPengeluaranTable extends Migration
{
    public function up()
    {
        Schema::table('pengeluaran', function (Blueprint $table) {
            $table->decimal('masukan', 15, 2)->nullable()->after('jumlah');
            $table->decimal('simpanan', 15, 2)->nullable()->after('masukan');
            $table->string('keterangan')->nullable()->after('simpanan');
        });
    }

    public function down()
    {
        Schema::table('pengeluaran', function (Blueprint $table) {
            $table->dropColumn(['masukan', 'simpanan', 'keterangan']);
        });
    }
}
