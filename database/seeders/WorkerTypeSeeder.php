<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class WorkerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workerTypes = [
            ['name' => 'Tukang Bangunan', 'description' => 'Tukang bangunan adalah tenaga kerja yang memiliki keahlian khusus dan keterampilan teknis dalam bidang konstruksi, berbeda dengan kuli bangunan yang hanya melakukan pekerjaan fisik tanpa keahlian spesifik.'],
            ['name' => 'Tukang Kebun', 'description' => 'Tukang kebun atau dalam bahasa Inggris disebut gardener adalah seseorang yang bertanggung jawab untuk memantau kesehatan tanaman, merawat, dan menjaga penataan taman agar tetap indah dan tertata rapi.'],
        ];

        DB::table('worker_types')->insert($workerTypes);
    }
}
