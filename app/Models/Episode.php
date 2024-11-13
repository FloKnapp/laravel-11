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
        'duration'
    ];

    public function types()
    {
        return $this->belongsToMany(EpisodeType::class, 'episodes_episode_types')->withTimestamps();
    }

    public function symptoms()
    {
        return $this->belongsToMany(EpisodeSymptom::class, 'episodes_episode_symptoms')->withPivot('timing')->withTimestamps();
    }

    public function triggers()
    {
        return $this->belongsToMany(EpisodeTrigger::class, 'episodes_episode_triggers')->withTimestamps();
    }
}
