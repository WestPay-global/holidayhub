<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for the seekers table nick@email.com, client@email.com, freelancer@email.com
        $users = [
            [
                'name' => 'Admin RoomzHub',
                'email' => 'admin@roomzhub.com',
                'has_homeswap' => false,
                'has_nonswap' => false,
                'password' => Hash::make('password'),
                'status' => 'superadmin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Raphael Santos',
                'email' => 'santosralph2022@gmail.com',
                'has_homeswap' => true,
                'has_nonswap' => true,
                'password' => Hash::make('password'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ugo Raphael',
                'email' => 'ralphsunny114@gmail.com',
                'has_homeswap' => false,
                'has_nonswap' => true,
                'password' => Hash::make('password'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nick Dev',
                'email' => 'nick@email.com',
                'has_homeswap' => false,
                'has_nonswap' => false,
                'password' => Hash::make('password'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dreymi',
                'email' => 'dr3ymi@gmail.com',
                'has_homeswap' => false,
                'has_nonswap' => false,
                'password' => Hash::make('Foobarbaz1!'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // [
            //     'name' => 'Test Client',
            //     'email' => 'client@email.com',
            //     // 'is_phone_number_visible' => false,
            //     'password' => Hash::make('password'),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'name' => 'Test Freelancer',
            //     'email' => 'freelancer@email.com',
            //    // 'is_phone_number_visible' => false,
            //     'password' => Hash::make('password'),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // Add more sample data as needed
        ];

        // Insert data into the users table
        DB::table('users')->insert($users);
    }
}
