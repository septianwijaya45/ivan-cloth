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
            $table->string('artikel')->after('kain_potongan_id');
            $table->json('karyawan')->after('karyawan_id');
            $table->string('satuan')->after('jumlah_kain');
            $table->string('ukuran')->after('satuan');
            $table->integer('gaji')->after('ukuran');
            $table->text('note')->after('gaji');
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
