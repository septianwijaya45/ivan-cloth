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
        Schema::create('m_film_sablons', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->foreignId('spp_id')
                    ->references('id')
                    ->on('t_spps');
            $table->string('file');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_film_sablons');
    }
};
