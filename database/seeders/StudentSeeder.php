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
            [
                'name' => 'Dimas',
                'nim' => '1204210076',
                'email' => 'dimas@gmail.com',
                'password' => '12345678',
                'university' => 'Telkom University Surabaya',
                'gender' => 'Laki-laki',
                'city' => 'Surabaya',
                'address' => 'Demak, Surabaya',
                'department_id' => 2,
                'mentor_id' => 1
            ],
        ]);
    }
}
