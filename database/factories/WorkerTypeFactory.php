<?php

namespace Database\Factories;

use App\Models\WorkerType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkerType>
 */
class WorkerTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Tukang '.fake()->unique()->word(),
            'description' => fake()->sentence(),
        ];
    }
}
