<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransportType;

class TransportTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Автобус', 'Трамвай', 'Тролейбус', 'Метро'] as $name) {
            TransportType::firstOrCreate(['name' => $name]);
        }
    }
}
