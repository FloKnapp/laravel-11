<?php

namespace Tests\Feature;
use App\Models\Episode;
use App\Models\EpisodeSymptom;
use App\Models\EpisodeTrigger;
use App\Models\EpisodeType;
use App\Models\Symptom;
use App\Models\SymptomTiming;
use App\Models\Timing;
use Tests\TestCase;

class EpisodeTest extends TestCase
{

    public function test_episode_can_be_created()
    {
        $data = ['user_id' => null, 'intensity' => 5, 'duration' => 120, 'state' => 'published'];
        Episode::create($data);
        $this->assertDatabaseHas('episodes', $data);
    }

    public function test_episode_can_be_deleted()
    {
        Episode::find(1)->delete();
        $this->assertDatabaseCount('episodes', 0);
    }

    public function test_episode_can_be_created_fully()
    {
        $data = ['intensity' => 5, 'duration' => 120, 'state' => 'published'];
        $episode = Episode::create($data);

        $type = EpisodeType::firstOrCreate(['name' => 'TestType']);
        $trigger = EpisodeTrigger::firstOrCreate(['name' => 'TestTrigger']);

        $episode->types()->attach($type);
        $episode->triggers()->attach($trigger);

        $episode->save();

        $this->assertDatabaseHas('episodes', $data);
        $this->assertDatabaseHas('episode_types', ['name' => 'TestType']);
        $this->assertDatabaseHas('episode_triggers', ['name' => 'TestTrigger']);
    }

    public function test_episode_can_be_read_fully()
    {
        $data = ['intensity' => 5, 'duration' => 120, 'state' => 'published'];
        $episode = Episode::create($data);

        $type = EpisodeType::firstOrCreate(['name' => 'TestType']);
        $symptom = Symptom::firstOrCreate(['name' => 'TestSymptom']);
        EpisodeSymptom::firstOrCreate(['episode_id' => $episode->id, 'symptom_id' => $symptom->id]);

        $timing = Timing::firstOrCreate(['name' => 'pre']);
        SymptomTiming::firstOrCreate(['symptom_id' => $symptom->id, 'timing_id' => $timing->id]);

        $trigger = EpisodeTrigger::firstOrCreate(['name' => 'TestTrigger']);

        $episode->types()->attach($type);
        $episode->triggers()->attach($trigger);

        $episode->save();

        $this->assertSame('TestType', $episode->types()->first()->name);
        $this->assertSame('TestTrigger', $episode->triggers()->first()->name);

        $this->assertContains($episode->id, array_column($type->episodes()->get()->toArray(), 'id'));
        $this->assertContains($episode->id, array_column($trigger->episodes()->get()->toArray(), 'id'));
        //$this->assertContains($episode->id, array_column($timing->symptoms()->first()->symptom()->episodes()->get()->toArray(), 'id'));

    }

}
