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
            ['name' => 'Tukang Bangunan'],
            ['name' => 'Tukang Kebun'],
        ];

        DB::table('worker_types')->insert($workerTypes);
    }
}
