<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EpisodeTrigger
 * @package App\Models
 * @author  Florian Knapp <office@florianknapp.de>
 *
 * @mixin Builder
 */
class Episode extends Model
{
    protected $fillable = [
        'public_id',
        'intensity',
        'duration',
        'published_at'
    ];

    public function types()
    {
        return $this->belongsToMany(EpisodeType::class, 'episodes_episode_types')->withTimestamps();
    }

    public function symptoms()
    {
        return $this->belongsToMany(SymptomTiming::class, 'episodes_symptom_timings')->withTimestamps();
    }

    public function triggers()
    {
        return $this->belongsToMany(EpisodeTrigger::class, 'episodes_episode_triggers')->withTimestamps();
    }
}
