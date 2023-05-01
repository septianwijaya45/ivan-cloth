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
                'berat'         => 500,
                'warna'         => 'Black',
            ],[
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_lot'      => 'LOT-0002',
                'jenis_kain'    => 'Katun',
                'berat'         => 500,
                'warna'         => 'White',
            ], [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_lot'      => 'LOT-0003',
                'jenis_kain'    => 'Katun',
                'berat'         => 500,
                'warna'         => 'Green',
            ]
        ]);
    }
}
