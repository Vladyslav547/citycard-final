<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@citycard.com'],
            [
                'name' => 'Адмін',
                'phone' => '0000000000',
                'password' => Hash::make('admin123'),
                'is_admin' => true
            ]
        );
    }
}
