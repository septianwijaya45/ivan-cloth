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
            $table->dropConstrainedForeignId('kain_potongan_id');
            $table->foreignId('detail_spk_id')->after('id')
                ->references('id')
                ->on('t_spk_details');
            $table->dropColumn('karyawan_id');
            $table->dropColumn('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_jahits', function (Blueprint $table) {
        });
    }
};
