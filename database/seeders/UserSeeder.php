<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role_id'       => 1,
                'name'          => 'owner',
                'email'         => 'owner@gmail.com',
                'username'      => 'owner',
                'password'      => bcrypt('owner'),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'role_id'       => 2,
                'name'          => 'admin',
                'email'         => 'admin@gmail.com',
                'username'      => 'admin',
                'password'      => bcrypt('admin'),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'role_id'       => 3,
                'name'          => 'warehouse',
                'email'         => 'warehouse@gmail.com',
                'username'      => 'warehouse',
                'password'      => bcrypt('admin'),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
