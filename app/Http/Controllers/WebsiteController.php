<?php

namespace App\Http\Controllers;

use App\Enum\EpisodeStateType;
use App\Models\Episode;
use Illuminate\Contracts\View\View;

class WebsiteController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $episodes = Episode::where('state', EpisodeStateType::PUBLISHED->value)
            ->where('public_id', '!=', null)
            ->orderBy('id', 'desc')
            ->get();

        // Calendar events
        $events = [];

        foreach ($episodes as $episode) {
            $events[] = [
                'title' => __($episode->types()->first()->name),
                'start' => $episode->created_at,
                'url' => route('episode.show', $episode->public_id),
                'end' => $episode->created_at->addSeconds($episode->duration),
            ];
        }

        // Only show the last 3 episodes
        $episodes = collect($episodes)->slice(0,3);

        return view('index', compact('events', 'episodes'));
    }
}
