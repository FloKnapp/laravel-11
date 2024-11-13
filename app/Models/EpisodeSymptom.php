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
class EpisodeSymptom extends Model
{
    protected $fillable = [
        'name',
    ];

    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'episodes_episode_symptoms')->withPivot('timing')->withTimestamps();
    }
}
