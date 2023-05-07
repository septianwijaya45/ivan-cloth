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
        Schema::create('m_kain_tersablons', function (Blueprint $table) {
            $table->string('uuid', 32);
            $table->id();
            $table->foreignId('kain_potongan_id')
                ->references('id')
                ->on('m_kain_potongans');
            $table->integer('stok');
            $table->string('ukuran', 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kain_tersablons');
    }
};
