<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TransportTypeSeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => 'admin@citycard.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('29951778'),
                'is_admin' => 1,
            ]
        );
    }
}
