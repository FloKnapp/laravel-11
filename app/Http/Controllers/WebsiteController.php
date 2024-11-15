<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Contracts\View\View;

class WebsiteController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $episodes = Episode::orderBy('id', 'desc')->get();

        $events = [];

        foreach ($episodes as $episode) {
            $events[] = [
                'title' => __($episode->types()->first()->name),
                'start' => $episode->created_at,
                'url' => route('episode.show', $episode->public_id),
                'end' => $episode->created_at->addSeconds($episode->duration),
            ];
        }

        $episodes = $episodes->slice(0, 3);

        return view('index', compact('events', 'episodes'));
    }
}
