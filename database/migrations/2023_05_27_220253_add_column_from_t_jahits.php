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
        Schema::table('t_jahits', function (Blueprint $table) {
            $table->foreignId('kain_potongan_id')
                ->references('id')
                ->on('m_kain_potongans')->after('kode_jahit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_jahits', function (Blueprint $table) {
            //
        });
    }
};
