<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_gajis')->insert([
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'gaji'          => 500,
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'gaji'          => 1000,
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'gaji'          => 1500,
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'gaji'          => 2000,
            ],
            [
                'uuid'          => Uuid::uuid4()->getHex(),
                'gaji'          => 2500,
            ],
        ]);
    }
}
