<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // [
            //     'name' => 'Bintank',
            //     'email' => 'bintank@gmail.com',
            //     'password' => Hash::make('12345678'),
            //     'role' => 'user'
            // ],
            // [
            //     'name' => 'Daniel',
            //     'email' => 'daniel@gmail.com',
            //     'password' => Hash::make('12345678'),
            //     'role' => 'mentor'
            // ],
            // [
            //     'name' => 'Ratih',
            //     'email' => 'ratih@gmail.com',
            //     'password' => Hash::make('12345678'),
            //     'role' => 'mentor'
            // ],
            // [
            //     'name' => 'Mega',
            //     'email' => 'mega@gmail.com',
            //     'password' => Hash::make('12345678'),
            //     'role' => 'mentor'
            // ],
            [
                'name' => 'Gellang',
                'email' => 'gellang@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'mentor'
            ],
        ]);
    }
}
