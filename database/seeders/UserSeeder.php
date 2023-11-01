<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'role_id' => 3,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('secret'),
        ]);
    }
}
