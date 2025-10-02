<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Card;

class UserWithCardSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Іван',
            'email' => 'ivan@example.com',
            'phone' => '0961234567',
            'password' => bcrypt('secret123'),
        ]);

        Card::create([
            'number' => '1234567890123456',
            'balance' => 100.00,
        ]);
    }
}
