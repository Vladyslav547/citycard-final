<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transport_types')->insert([
            ['name' => 'Автобус'],
            ['name' => 'Трамвай'],
            ['name' => 'Тролейбус'],
            ['name' => 'Метро'],
        ]);
    }
}
