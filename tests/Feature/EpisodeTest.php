<?php

namespace Tests\Feature;
use App\Models\Episode;
use App\Models\EpisodeTrigger;
use App\Models\EpisodeType;
use Tests\TestCase;

class EpisodeTest extends TestCase
{

    public function test_episode_can_be_created()
    {
        $data = ['user_id' => null, 'intensity' => 5, 'duration' => 120];
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
        $data = ['intensity' => 5, 'duration' => 120];
        $episode = Episode::create($data);

        $type = EpisodeType::create(['name' => 'TestType']);
        $trigger = EpisodeTrigger::create(['name' => 'TestTrigger']);

        $episode->types()->attach($type);
        $episode->triggers()->attach($trigger);

        $episode->save();

        $this->assertDatabaseHas('episodes', $data);
        $this->assertDatabaseHas('episode_types', ['name' => 'TestType']);
        $this->assertDatabaseHas('episode_triggers', ['name' => 'TestTrigger']);
    }

}
