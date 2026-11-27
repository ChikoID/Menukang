<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            [
                'name' => 'Binawidya',
                'latitude' => 0.4951181,
                'longitude' => 101.3841317,
            ],
            [
                'name' => 'Bukit Raya',
                'latitude' => 0.4671932,
                'longitude' => 101.4637654,
            ],
            [
                'name' => 'Kulim',
                'latitude' => 0.4741946,
                'longitude' => 101.5368579,
            ],
            [
                'name' => 'Limapuluh',
                'latitude' => 0.5407022,
                'longitude' => 101.4580543,
            ],
            [
                'name' => 'Marpoyan Damai',
                'latitude' => 0.4671487,
                'longitude' => 101.4368989,
            ],
            [
                'name' => 'Payung Sekaki',
                'latitude' => 0.5284633,
                'longitude' => 101.3988299,
            ],
            [
                'name' => 'Pekanbaru Kota',
                'latitude' => 0.5203804,
                'longitude' => 101.4479099,
            ],
            [
                'name' => 'Rumbai',
                'latitude' => 0.5806779,
                'longitude' => 101.3911025,
            ],
            [
                'name' => 'Rumbai Barat',
                'latitude' => 0.6341427,
                'longitude' => 101.3941201,
            ],
            [
                'name' => 'Rumbai Timur',
                'latitude' => 0.6184836,
                'longitude' => 101.5197503,
            ],
            [
                'name' => 'Sail',
                'latitude' => 0.5134728,
                'longitude' => 101.4599822,
            ],
            [
                'name' => 'Senapelan',
                'latitude' => 0.5365356,
                'longitude' => 101.4378374,
            ],
            [
                'name' => 'Sukajadi',
                'latitude' => 0.5166603,
                'longitude' => 101.4385566,
            ],
            [
                'name' => 'Tenayan Raya',
                'latitude' => 0.5400639,
                'longitude' => 101.5362932,
            ],
            [
                'name' => 'Tuahmadani',
                'latitude' => 0.4608992,
                'longitude' => 101.3813585,
            ],
        ];

        foreach ($districts as $district) {
            District::updateOrCreate(
                ['name' => $district['name']],
                $district
            );
        }
    }
}
