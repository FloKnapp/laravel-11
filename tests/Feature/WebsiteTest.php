<?php

namespace Tests\Feature;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    public function test_detail_page_is_denied_for_unauthorized_user()
    {
        $episode = Episode::first();

        $response = $this->get('/episode/' . $episode->public_id);
        $response->assertStatus(403);
    }

    public function test_episode_can_be_created_through_controller()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/episode/create', [
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

    public function test_detail_page_is_accessible_for_authorized_user()
    {
        $episode = Episode::where('user_id', '!=', null)->first();
        $user = User::findOrFail($episode->user_id);

        $response = $this->actingAs($user)->get('/episode/' . $episode->public_id);
        $response
            ->assertStatus(200)
            ->assertSee('Details');
    }

    public function test_episodes_can_be_shown_through_controller()
    {
        $user = User::firstOrFail();
        $response = $this->actingAs($user)->get('/');
        $response
            ->assertStatus(200)
            ->assertSee('Letzte Einträge');
    }

}
