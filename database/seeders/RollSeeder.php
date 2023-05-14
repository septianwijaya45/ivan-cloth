<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kain_rolls')->insert([
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_lot'      => 'LOT-0001',
                'jenis_kain'    => 'Katun',
                'stok_roll'     => 100,
                'berat'         => 25,
                'warna'         => 'Black',
            ], [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_lot'      => 'LOT-0002',
                'jenis_kain'    => 'Katun',
                'stok_roll'     => 200,
                'berat'         => 20,
                'warna'         => 'White',
            ], [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_lot'      => 'LOT-0003',
                'jenis_kain'    => 'Katun',
                'stok_roll'     => 50,
                'berat'         => 23,
                'warna'         => 'Green',
            ]
        ]);
    }
}
