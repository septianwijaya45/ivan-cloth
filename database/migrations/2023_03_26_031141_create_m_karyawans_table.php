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
        Schema::create('m_karyawans', function (Blueprint $table) {
            $table->string('uuid',32);
            $table->id();
            $table->string('nama');
            $table->string('jenis_kelamin',1);
            $table->string('nik',16);
            $table->string('no_telepon',16);
            $table->string('npwp',16);
            $table->string('posisi');
            $table->string('status_karyawan');
            $table->integer('gaji_pokok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_karyawans');
    }
};
