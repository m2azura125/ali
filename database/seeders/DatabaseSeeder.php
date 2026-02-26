<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User Warga
        User::create([
            'name' => 'Krisna',
            'username' => 'krisna',
            'role' => 'warga',
            'password' => Hash::make('12321'),
        ]);

        // User Admin
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'role' => 'rt',
            'password' => Hash::make('12321'),
        ]);
    }
}
