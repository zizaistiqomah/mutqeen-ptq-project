<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            ['name' => 'S1 Kebidanan', 'faculty_id' => 1],
            ['name' => 'S1 Kedokteran', 'faculty_id' => 1],
            ['name' => 'S1 Kedokteran Gigi', 'faculty_id' => 2],
            ['name' => 'S1 Ilmu Hukum', 'faculty_id' => 3],
            ['name' => 'S1 Akuntansi', 'faculty_id' => 4],
            ['name' => 'S1 Manajemen', 'faculty_id' => 4],
            ['name' => 'S1 Ekonomi Pembangunan', 'faculty_id' => 4],
            ['name' => 'S1 Ekonomi Islam', 'faculty_id' => 4],
            ['name' => 'S1 Farmasi', 'faculty_id' => 5],
            ['name' => 'S1 Kedokteran Hewan', 'faculty_id' => 6],
            ['name' => 'S1 Administrasi Publik', 'faculty_id' => 7],
            ['name' => 'S1 Ilmu Hubungan Internasional', 'faculty_id' => 7],
            ['name' => 'S1 Ilmu Politik', 'faculty_id' => 7],
            ['name' => 'S1 Sosiologi', 'faculty_id' => 7],
            ['name' => 'S1 Ilmu Komunikasi', 'faculty_id' => 7],
            ['name' => 'S1 Ilmu Informasi dan Perpustakaan', 'faculty_id' => 7],
            ['name' => 'S1 Antropologi', 'faculty_id' => 7],
            ['name' => 'S1 Matematika', 'faculty_id' => 8],
            ['name' => 'S1 Sistem Informasi', 'faculty_id' => 8],
            ['name' => 'S1 Statistika', 'faculty_id' => 8],
            ['name' => 'S1 Kimia', 'faculty_id' => 8],
            ['name' => 'S1 Biologi', 'faculty_id' => 8],
            ['name' => 'S1 Teknik Lingkungan', 'faculty_id' => 8],
            ['name' => 'S1 Fisika', 'faculty_id' => 8],
            ['name' => 'S1 Teknik Biomedis', 'faculty_id' => 8],
            ['name' => 'S1 Kesehatan Masyarakat', 'faculty_id' => 9],
            ['name' => 'S1 Gizi', 'faculty_id' => 9],
            ['name' => 'S1 Psikologi', 'faculty_id' => 10],
            ['name' => 'S1 Bahasa dan Sastra Indonesia', 'faculty_id' => 11],
            ['name' => 'S1 Bahasa dan Sastra Inggris', 'faculty_id' => 11],
            ['name' => 'S1 Ilmu Sejarah', 'faculty_id' => 11],
            ['name' => 'S1 Bahasa dan Sastra Jepang', 'faculty_id' => 11],
            ['name' => 'S1 Keperawatan', 'faculty_id' => 12],
            ['name' => 'S1 Akuakultur', 'faculty_id' => 13],
            ['name' => 'S1 Teknologi Hasil Perikanan', 'faculty_id' => 13],
            ['name' => 'S1 Teknik Industri', 'faculty_id' => 16],
            ['name' => 'S1 Teknik Elektro', 'faculty_id' => 16],
            ['name' => 'S1 Rekayasa Nanoteknologi', 'faculty_id' => 16],
            ['name' => 'S1 Teknik Robotika dan Kecerdasan Buatan', 'faculty_id' => 16],
            ['name' => 'S1 Teknologi Sains Data', 'faculty_id' => 16],
            ['name' => 'S1 Kedokteran Hewan (FIKKIA Banyuwangi)', 'faculty_id' => 17],
            ['name' => 'S1 Kesehatan Masyarakat (FIKKIA Banyuwangi)', 'faculty_id' => 17],
            ['name' => 'S1 Akuakultur (FIKKIA Banyuwangi)', 'faculty_id' => 17],
            // D3 Programs
            ['name' => 'D3 Keperawatan', 'faculty_id' => 14],
            ['name' => 'D3 Manajemen Pemasaran', 'faculty_id' => 14],
            ['name' => 'D3 Akuntansi', 'faculty_id' => 14],
            ['name' => 'D3 Perpajakan', 'faculty_id' => 14],
            ['name' => 'D3 Bahasa Inggris', 'faculty_id' => 14],
            // Sarjana Terapan Programs
            ['name' => 'Sarjana Terapan Sistem Informasi', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Fisioterapi', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Radiologi', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Keperawatan Anestesiologi', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Akuntansi Perpajakan', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Manajemen Pemasaran', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Keselamatan dan Kesehatan Kerja', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Teknologi Laboratorium Medis', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Teknologi Rekayasa Kimia Industri', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Manajemen Perbankan', 'faculty_id' => 14],
            ['name' => 'Sarjana Terapan Logistik Perdagangan Internasional', 'faculty_id' => 14]
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }
    }
}
