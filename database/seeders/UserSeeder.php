<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        User::create([
            'name' => 'Demo User',
            'email' => 'demo@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
