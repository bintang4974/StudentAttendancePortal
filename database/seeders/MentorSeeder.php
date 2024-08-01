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
                'name' => 'Bintang Ramadhan',
                'phone' => '081723987784'
            ],
            [
                'name' => 'Ratih Fibrina',
                'phone' => '081709172893'
            ],
            [
                'name' => 'Lasniar Megawati',
                'phone' => '081846570923'
            ],
        ]);
    }
}
