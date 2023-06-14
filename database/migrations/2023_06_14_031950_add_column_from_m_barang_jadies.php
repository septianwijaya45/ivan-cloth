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
        Schema::table('m_barang_jadies', function (Blueprint $table) {
            $table->foreignId('finishing_id')->after('id')
                ->references('id')
                ->on('t_finishings');
            $table->date('tanggal')->after('artikel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_barang_jadies', function (Blueprint $table) {
            //
        });
    }
};
