<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_ukurans')->insert([

            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_ukuran'  => 'S',
                'ukuran'        => 'Small',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_ukuran'  => 'M',
                'ukuran'        => 'Medium',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_ukuran'  => 'L',
                'ukuran'        => 'Large',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_ukuran'  => 'XL',
                'ukuran'        => 'Extra Large',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_ukuran'  => 'XXL',
                'ukuran'        => 'Extra Extra Large',
            ],
        ]);
    }
}
