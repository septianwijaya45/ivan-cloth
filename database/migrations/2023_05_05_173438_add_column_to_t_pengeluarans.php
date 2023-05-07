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
        Schema::table('t_pengeluarans', function (Blueprint $table) {
            $table->text('keterangan')->after('total_uang');
            $table->date('tanggal')->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_pengeluarans', function (Blueprint $table) {
            //
        });
    }
};
