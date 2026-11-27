<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkerType;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workerTypeIds = WorkerType::query()->pluck('id');

        if ($workerTypeIds->isEmpty()) {
            $this->call(WorkerTypeSeeder::class);
            $workerTypeIds = WorkerType::query()->pluck('id');
        }

        $faker = fake('id_ID');

        for ($index = 0; $index < 100; $index++) {
            $role = $index % 2 === 0 ? 'pelanggan' : 'tukang';

            $user = User::factory()->create([
                'name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'role' => $role,
            ]);

            if ($role === 'tukang') {
                $user->worker()->create([
                    'worker_type_id' => $workerTypeIds->random(),
                    'service_area' => $faker->city(),
                    'experience_years' => $faker->numberBetween(1, 20),
                    'description' => $faker->sentence(),
                ]);
            }
        }
    }
}
