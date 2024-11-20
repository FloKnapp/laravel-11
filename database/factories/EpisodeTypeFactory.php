<?php

namespace Database\Factories;

use App\Models\EpisodeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EpisodeType>
 */
class EpisodeTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['absence', 'tonic'])
        ];
    }
}