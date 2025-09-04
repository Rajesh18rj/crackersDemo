<?php

namespace Database\Seeders;

use App\Models\SuperUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuperUser::create([
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
