<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        DB::table('users')->insert([
            'name' => 'Admin User',
            'phone_no' => '0112345678',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Normal User
        DB::table('users')->insert([
            'name' => 'Normal User',
            'phone_no' => '0712345678',
            'password' => Hash::make('password'),
            'role' => 'normal',
        ]);
    }
}
