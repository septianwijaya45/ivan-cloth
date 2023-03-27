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
        Schema::create('t_spks', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->foreignId('spp_id')
                    ->references('id')
                    ->on('t_spps');
            $table->string('kode_spk');
            $table->foreignId('kain_potongan_id')
                    ->references('id')
                    ->on('m_kain_potongans');
            $table->json('karyawan_id');
            $table->integer('jumlah_kain');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_spks');
    }
};
