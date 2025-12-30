<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nilai = [
            'Kelancaran',
            'Makhrojil Huruf',
            'Lagu',
            'Adab',
        ];

        foreach ($nilai as $value) {
            \App\Models\Nilai::create([
                'name' => $value,
            ]);
        }
    }
}
