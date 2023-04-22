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
            $table->string('kode_spp');
            $table->string('ukuran');
            $table->foreignId('kain_roll_id')
                    ->references('id')
                    ->on('m_kain_rolls');
            $table->json('karyawan_id');
            $table->date('tanggal');
            $table->integer('berat');
            $table->integer('hasil_potongan')->nullable();
            $table->json('karyawan');
            $table->integer('gaji');
            $table->string('status');
            $table->text('note')->nullable();
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
