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
        Schema::table('t_spks', function (Blueprint $table) {
            $table->dropColumn('kode_spp');
            $table->dropColumn('kain_potongan_dipakai');
            $table->dropColumn('jumlah_kain');
            $table->dropColumn('satuan');
            $table->dropColumn('gaji');
            $table->dropForeign(['kain_potongan_id']);
            $table->dropColumn('kain_potongan_id');
            $table->dropColumn('karyawan_id');
            $table->dropColumn('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_spks', function (Blueprint $table) {
            //
        });
    }
};
