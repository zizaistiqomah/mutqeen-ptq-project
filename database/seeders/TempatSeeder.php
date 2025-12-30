<?php

namespace Database\Seeders;

use App\Models\Tempat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tempats = [
            ['name' => 'Masjid Ulul Azmi Unair'],
            ['name' => 'Masjid An-Nahl PENS'],
            ['name' => 'Masjid Manarul Ilmi ITS'],
        ];

        foreach ($tempats as $tempat) {
            Tempat::create($tempat);
        }
    }
}
