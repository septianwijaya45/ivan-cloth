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
        Schema::table('t_finishings', function (Blueprint $table) {
            $table->string('artikel')->after('kode_finishing');
            $table->date('tanggal')->after('artikel');
            $table->string('satuan')->after('jumlah_finishing');
            $table->json('karyawan_id')->nullable()->after('satuan');
            $table->json('karyawan')->nullable()->after('karyawan_id');
            $table->integer('gaji')->after('karyawan');
            $table->text('note')->nullable()->after('gaji');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_finishings', function (Blueprint $table) {
            //
        });
    }
};
