<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mentors')->insert([
            [
                'name' => 'Daniel',
                'phone' => '081723987784',
                'user_id' => 2
            ],
            [
                'name' => 'Ratih Fibrina',
                'phone' => '081709172893',
                'user_id' => 3
            ],
            [
                'name' => 'Lasniar Megawati',
                'phone' => '081846570923',
                'user_id' => 4
            ],
        ]);
    }
}
