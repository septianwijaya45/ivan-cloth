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
        Schema::create('t_spk_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_spk_id')
                ->references('id')
                ->on('t_spks');
            $table->string('kode_spk');
            $table->foreignId('kain_potongan_id')
                ->references('id')
                ->on('m_kain_potongans');
            $table->integer('quantity');
            $table->string('satuan', 32);
            $table->json('karyawan_id');
            $table->json('karyawan');
            $table->integer('gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_spk_details');
    }
};
