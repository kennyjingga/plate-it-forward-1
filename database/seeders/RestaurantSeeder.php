<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurants')->insert([
            'name' => 'Example Restaurant',
            'email' => 'restaurant@example.com',
            'password' => Hash::make('password123'),
            'address' => 'Jl. Contoh No. 123',
            'city' => 'Jakarta',
            'contact' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
