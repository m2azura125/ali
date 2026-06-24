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
        // User Warga 1
        User::updateOrCreate(
            ['username' => 'krisna'],
            [
                'name' => 'Krisna',
                'role' => 'warga',
                'password' => Hash::make('12321'),
            ]
        );

        // User Warga 2
        User::updateOrCreate(
            ['username' => 'siti'],
            [
                'name' => 'Bu Siti',
                'role' => 'warga',
                'password' => Hash::make('12321'),
            ]
        );

        // User Warga 3
        User::updateOrCreate(
            ['username' => 'rahman'],
            [
                'name' => 'Pak Rahman',
                'role' => 'warga',
                'password' => Hash::make('12321'),
            ]
        );

        // User Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'admin',
                'role' => 'rt',
                'password' => Hash::make('12321'),
            ]
        );

        $this->call([
            SensorDataSeeder::class,
        ]);
    }
}
