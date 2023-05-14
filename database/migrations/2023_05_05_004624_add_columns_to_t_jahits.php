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
            $table->dropForeign(['spk_id']);
            $table->dropColumn('spk_id');
            $table->string('kode_spk')->after('id');
            $table->string('artikel')->after('kode_jahit');
            $table->date('tanggal')->after('artikel');
            $table->json('karyawan')->after('karyawan_id');
            $table->integer('kain_tersablon_dipakai')->after('karyawan');
            $table->string('satuan')->after('jumlah_jahit');
            $table->integer('gaji')->after('satuan');
            $table->text('note')->nullable()->after('gaji');
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
