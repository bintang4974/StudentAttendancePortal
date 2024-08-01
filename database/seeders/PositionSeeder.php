<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'name' => 'Pendamping UMKM Industri Rumahan'
            ],
            [
                'name' => 'Pendamping Toko Kelontong'
            ],
            [
                'name' => 'Pendamping Pasar'
            ],
            [
                'name' => 'Pengolah Data'
            ],
            [
                'name' => 'Media Sosial Crew'
            ],
            [
                'name' => 'Digitalisasi dan Penataan Arsip'
            ],
        ]);
    }
}
