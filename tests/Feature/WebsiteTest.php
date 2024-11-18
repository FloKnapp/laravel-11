<?php

namespace Tests\Feature;
use Tests\TestCase;

class WebsiteTest extends TestCase
{

    public function test_homepage_is_rendered_successfully()
    {
        $response = $this->get('/');
        $response
            ->assertStatus(200)
            ->assertSee('Epilepsie-Tracker');
    }

    public function test_episode_can_be_created_through_controller()
    {
        $response = $this->post('/episode', [
            'type' => 'absence',
            'symptoms' => [
                'aura' => ['timing' => 'before'],
            ],
            'triggers' => [
                'nothing' => 'nothing',
            ],
            'intensity' => 5,
            'duration' => 120
        ]);

        $this->assertDatabaseHas('episodes', ['intensity' => 5, 'duration' => 120]);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
    }

    public function test_episodes_can_be_shown_through_controller()
    {
        $response = $this->get('/');
        $response
            ->assertStatus(200)
            ->assertSee('Letzte Einträge');
    }

}
