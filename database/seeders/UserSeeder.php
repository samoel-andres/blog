<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Gian Garcia',
            'email' => 'gian08@hotmail.com',
            'password' => Hash::make('123456'),
        ])->assignRole('Administrator');

        User::create([
            'full_name' => 'Tony Mendez',
            'email' => 'tonymendez@hotmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Author');

        User::factory(10)->create();
    }
}
