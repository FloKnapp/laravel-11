<?php

namespace App\View\Components;

use App\Models\Episode;
use Illuminate\View\Component;

class EpisodeItem extends Component
{

    private Episode $episode;

    public function __construct(Episode $episode)
    {
        $this->episode = $episode;
    }

    public function render()
    {
        return view('partials.episode-item', ['episode' => $this->episode]);
    }
}
