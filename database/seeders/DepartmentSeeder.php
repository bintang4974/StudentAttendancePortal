<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'Pemberdayaan Usaha Mikro',
                'head_department' => 'Iqbal',
            ],
            [
                'name' => 'Sekretariat',
                'head_department' => 'Bagas',
            ],
            [
                'name' => 'Distribusi Perdagangan',
                'head_department' => 'Rofi',
            ],
        ]);
    }
}
