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
                'ukuran'        => 'M',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'ukuran'        => 'L',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'ukuran'        => 'XL',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'ukuran'        => 'XXL',
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'ukuran'        => 'XXXL',
            ],
        ]);
    }
}
