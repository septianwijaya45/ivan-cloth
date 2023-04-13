<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_karyawans')->insert([
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Ahmad Chorul',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '01726826182628',
                'no_telepon'        => '081267254181',
                'npwp'              => '-',
                'posisi'            => 'pemotong',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Juni Syahrul',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '316272518261',
                'no_telepon'        => '08571627251',
                'npwp'              => '-',
                'posisi'            => 'pemotong',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Sablon 1',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '01726826182628',
                'no_telepon'        => '081267254181',
                'npwp'              => '-',
                'posisi'            => 'sablon',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Sablon 2',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '01726826182628',
                'no_telepon'        => '081267254181',
                'npwp'              => '-',
                'posisi'            => 'sablon',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Jahit 1',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '01726826182628',
                'no_telepon'        => '081267254181',
                'npwp'              => '-',
                'posisi'            => 'jahit',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Jahit 2',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '01726826182628',
                'no_telepon'        => '081267254181',
                'npwp'              => '-',
                'posisi'            => 'jahit',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Finishing 1',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '01726826182628',
                'no_telepon'        => '081267254181',
                'npwp'              => '-',
                'posisi'            => 'finishing',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
            [
                'uuid'              => Uuid::uuid4()->getHex(),
                'nama'              => 'Finishing 2',
                'jenis_kelamin'      => 'Laki-Laki',
                'nik'               => '01726826182628',
                'no_telepon'        => '081267254181',
                'npwp'              => '-',
                'posisi'            => 'finishing',
                'status_karyawan'   => 'Aktif',
                'gaji_pokok'        => 0
            ],
        ]);
    }
}
