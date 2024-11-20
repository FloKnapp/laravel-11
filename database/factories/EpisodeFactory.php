<?php

namespace Database\Factories;

use App\Models\Episode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Episode>
 */
class EpisodeFactory extends Factory
{

    protected $model = Episode::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'public_id' => $this->faker->uuid(),
            'user_id' => $this->faker->numberBetween(1, 255),
            'state' => $this->faker->randomElement(['published', 'draft']),
            'duration' => $this->faker->numberBetween(0, 600),
            'intensity' => $this->faker->numberBetween(0, 10),
            'published_at' => $this->faker->dateTimeBetween('-1 years'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Episode $episode) {
             // Attach symptoms

            // Attach trigger
        });
    }
}
