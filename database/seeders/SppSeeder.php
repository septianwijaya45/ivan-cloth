<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_spps')->insert([
            'uuid'          => Uuid::uuid4()->getHex(),
            'kain_roll_id'  => 1,
            'kode_spp'      => 'SPP01012000-0001',
            'karyawan_id'   => '[12,30,44,21]',
            'jumlah_roll'   => 10,
            'hasil_potongan'=> 50,
            'status'        => 'Selesai'
        ]);
    }
}
