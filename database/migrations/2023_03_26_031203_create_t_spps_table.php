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
        Schema::create('t_spps', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->foreignId('kain_roll_id')
                    ->references('id')
                    ->on('m_kain_rolls');
            $table->string('kode_spp');
            $table->json('karyawan_id');
            $table->integer('jumlah_roll');
            $table->integer('hasil_potongan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_spps');
    }
};
