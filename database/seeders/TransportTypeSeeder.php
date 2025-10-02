<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransportType;

class TransportTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Автобус', 'Трамвай', 'Тролейбус', 'Метро'];

        foreach ($types as $type) {
            TransportType::firstOrCreate(['name' => $type]);
        }
    }
}
