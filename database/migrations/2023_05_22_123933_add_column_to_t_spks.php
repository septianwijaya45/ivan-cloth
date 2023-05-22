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
            $table->json('kain_potongan_id')->after('ukuran');
            $table->json('quantity')->after('kain_potongan_id');
            $table->json('satuan')->after('quantity');
            $table->json('karyawan_id')->after('satuan');
            $table->json('karyawan')->after('karyawan_id');
            $table->json('gaji')->after('karyawan');
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
