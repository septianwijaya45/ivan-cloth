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
        Schema::create('m_kain_rolls', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->string('kode_lot',16);
            $table->string('jenis_kain');
            $table->float('berat');
            $table->string('warna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kain_rolls');
    }
};
