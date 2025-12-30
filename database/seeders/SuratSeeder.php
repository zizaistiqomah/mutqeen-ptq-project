<?php

namespace Database\Seeders;

use App\Models\Surat;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $client = new Client();
        $response = $client->get('https://equran.id/api/v2/surat');
        $suratData = json_decode($response->getBody()->getContents(), true);

        foreach ($suratData['data'] as $s) {
            Surat::create([
                'name' => $s['namaLatin']
            ]);
        }
    }
}
