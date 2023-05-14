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
        Schema::table('t_spps', function (Blueprint $table) {
            $table->foreignId('kain_roll_id')->nullable()->after('kode_spp')
                ->references('id')
                ->on('m_kain_rolls');

            $table->foreignId('kain_potongan_id')->nullable()->after('kain_roll_id')
                ->references('id')
                ->on('m_kain_potongans');

            $table->dropColumn('berat');
            $table->integer('quantity')->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_spps', function (Blueprint $table) {
            //
        });
    }
};
