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
            $table->json('karyawan_id')->nullable()->after('satuan');
            $table->json('karyawan')->nullable()->after('karyawan_id');
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
