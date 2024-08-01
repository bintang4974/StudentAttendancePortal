<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pass = 12345678;
        DB::table('students')->insert([
            [
                'name' => 'Everald',
                'activity_id' => '9063408',
                'nim' => '1204210097',
                'email' => 'everald@gmail.com',
                'password' => Hash::make($pass),
                'phone' => '08164867329',
                'university' => 'Telkom University Surabaya',
                'gender' => 'Laki-laki',
                'placement' => 'Sukolilo, Surabaya',
                'photo' => null,
                'department_id' => 1,
                'position_id' => 1,
                'mentor_id' => 2
            ],
            [
                'name' => 'Dimas',
                'activity_id' => '8066405',
                'nim' => '1204210076',
                'email' => 'dimas@gmail.com',
                'password' => Hash::make($pass),
                'phone' => '08189340957',
                'university' => 'Telkom University Surabaya',
                'gender' => 'Laki-laki',
                'placement' => 'Demak, Surabaya',
                'photo' => null,
                'department_id' => 2,
                'position_id' => 2,
                'mentor_id' => 1
            ],
            [
                'name' => 'Ivano',
                'activity_id' => '5062400',
                'nim' => '1204210033',
                'email' => 'ivano@gmail.com',
                'password' => Hash::make($pass),
                'phone' => '08180920634',
                'university' => 'Telkom University Surabaya',
                'gender' => 'Laki-laki',
                'placement' => 'Kertajaya, Surabaya',
                'photo' => null,
                'department_id' => 3,
                'position_id' => 6,
                'mentor_id' => 3
            ],
        ]);
    }
}
