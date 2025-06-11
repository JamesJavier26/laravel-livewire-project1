<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'javier.james2601@gmail.com'],
            [
                'name' => 'James',
                'password' => Hash::make('test12345'),
                'email_verified_at' => now(),
                'role' => UserRole::ADMIN,
            ]
        );
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => UserRole::USER,
            ]
        );
    }
}
