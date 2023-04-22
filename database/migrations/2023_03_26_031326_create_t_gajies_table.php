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
        Schema::create('t_gajies', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->string('kode_transaksi');
            $table->foreignId('karyawan_id')
                    ->references('id')
                    ->on('m_karyawans');
            $table->integer('gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_gajies');
    }
};
