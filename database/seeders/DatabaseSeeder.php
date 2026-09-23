<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'staff'],
            [
                'name' => 'Staff User',
                'email' => 'staff@koyonzofamilycare.com',
                'password' => 'password',
                'role' => 'staff',
            ]
        );

        User::updateOrCreate(
            ['username' => 'doctor'],
            [
                'name' => 'Doctor User',
                'email' => 'doctor@koyonzofamilycare.com',
                'password' => 'password',
                'role' => 'doctor',
            ]
        );
    }
}
