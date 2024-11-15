<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->belongsToMany(Episode::class, 'episodes_episode_symptoms')->withTimestamps();
    }

    public function timings()
    {
        return $this->hasMany(SymptomTiming::class);
    }
}
