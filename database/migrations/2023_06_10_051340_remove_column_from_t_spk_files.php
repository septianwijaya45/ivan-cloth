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
        Schema::table('t_spk_files', function (Blueprint $table) {
            $table->dropColumn('kode_spk');
            $table->string('artikel', 32)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_spk_files', function (Blueprint $table) {
            //
        });
    }
};
