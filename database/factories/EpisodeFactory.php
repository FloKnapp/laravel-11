<?php

namespace Database\Factories;

use App\Models\Episode;
use App\Models\EpisodeSymptom;
use App\Models\EpisodeTrigger;
use App\Models\EpisodeType;
use App\Models\Symptom;
use App\Models\SymptomTiming;
use App\Models\Timing;
use App\Models\User;
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
            'user_id' => User::factory()->create()->id,
            'state' => $this->faker->randomElement(['published', 'draft']),
            'duration' => $this->faker->numberBetween(0, 600),
            'intensity' => $this->faker->numberBetween(0, 10),
            'published_at' => $this->faker->dateTimeBetween('-1 years'),
        ];
    }

    public function configure(): EpisodeFactory|Factory
    {
        return $this->afterCreating(function (Episode $episode) {

            $this->createBaseData();

            // Attach type
            $type = EpisodeType::inRandomOrder()->take(1)->get();
            $episode->types()->attach($type);

             // Attach symptoms
            $symptoms = Symptom::take(2)->get();

            foreach ($symptoms as $symptom) {

                EpisodeSymptom::firstOrCreate([
                    'episode_id' => $episode->id,
                    'symptom_id' => $symptom->id
                ]);

                $timing = Timing::inRandomOrder()->take(1)->get()->first();

                SymptomTiming::firstOrCreate([
                    'symptom_id' => $symptom->id,
                    'timing_id' => $timing->id
                ]);

            }

            // Attach trigger
            $triggers = EpisodeTrigger::inRandomOrder()->take(2)->get();
            $episode->triggers()->attach($triggers);

        });
    }

    /**
     * @return void
     */
    private function createBaseData(): void
    {
        EpisodeType::firstOrCreate(['name' => 'absence']);
        EpisodeType::firstOrCreate(['name' => 'tonic']);

        Symptom::firstOrCreate(['name' => 'aura']);
        Symptom::firstOrCreate(['name' => 'unconsciousness']);

        Timing::firstOrCreate(['name' => 'pre']);
        Timing::firstOrCreate(['name' => 'during']);
        Timing::firstOrCreate(['name' => 'post']);

        EpisodeTrigger::firstOrCreate(['name' => 'menstruation']);
        EpisodeTrigger::firstOrCreate(['name' => 'sleep_deprivation']);
        EpisodeTrigger::firstOrCreate(['name' => 'nothing']);

    }
}
