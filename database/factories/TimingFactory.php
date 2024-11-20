<?php

namespace Database\Factories;

use App\Models\Timing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Timing>
 */
class TimingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['pre', 'during', 'post']),
        ];
    }
}
