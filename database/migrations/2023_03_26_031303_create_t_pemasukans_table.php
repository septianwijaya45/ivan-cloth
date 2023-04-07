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
        Schema::create('t_pemasukans', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->string('kode_pemasukan');
            $table->string('jenis_penjualan');
            $table->integer('total_uang');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pemasukans');
    }
};
