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
        Schema::create('t_finishings', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->foreignId('jahit_id')
                    ->references('id')
                    ->on('t_jahits');
            $table->string('kode_finishing');
            $table->json('karyawan_id');
            $table->integer('jumlah_finishing');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_finishings');
    }
};
