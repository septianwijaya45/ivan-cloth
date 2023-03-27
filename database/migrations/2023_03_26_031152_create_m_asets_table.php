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
        Schema::create('m_asets', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->string('nama');
            $table->string('kode',16);
            $table->string('status');
            $table->integer('total_stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_asets');
    }
};
