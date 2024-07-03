<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'name' => 'Everald',
                'nim' => '1204210097',
                'email' => 'everald@gmail.com',
                'password' => '12345678',
                'university' => 'Telkom University Surabaya',
                'gender' => 'Laki-laki',
                'city' => 'Surabaya',
                'address' => 'Sukolilo, Surabaya',
                'department_id' => 1,
                'mentor_id' => 2
            ],
        ]);
    }
}
