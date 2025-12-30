<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $faculties = [
            'Fakultas Kedokteran',
            'Fakultas Kedokteran Gigi',
            'Fakultas Hukum',
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Farmasi',
            'Fakultas Kedokteran Hewan',
            'Fakultas Ilmu Sosial dan Ilmu Politik',
            'Fakultas Sains dan Teknologi',
            'Fakultas Kesehatan Masyarakat',
            'Fakultas Psikologi',
            'Fakultas Ilmu Budaya',
            'Fakultas Keperawatan',
            'Fakultas Perikanan dan Kelautan',
            'Fakultas Vokasi',
            'Sekolah Pascasarjana',
            'Fakultas Teknologi Maju dan Multidisiplin',
            'Fakultas Ilmu Kesehatan, Kedokteran dan Ilmu Alam'
        ];

        foreach ($faculties as $faculty) {
            Faculty::create([
                'name' => $faculty,
            ]);
        }
    }
}
