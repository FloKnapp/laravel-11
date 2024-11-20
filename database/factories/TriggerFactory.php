<?php

namespace Database\Factories;

use App\Models\EpisodeTrigger;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EpisodeTrigger>
 */
class TriggerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['menstruation', 'sleep_deprivation']),
        ];
    }
}
