<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    use HasFactory;

    protected $fillable = [
        'user_id',
        'public_id',
        'state',
        'intensity',
        'duration',
        'published_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsToMany(EpisodeType::class, 'episodes_episode_types')->withTimestamps();
    }

    public function symptoms()
    {
        return $this->hasMany(EpisodeSymptom::class);
    }

    public function triggers()
    {
        return $this->belongsToMany(EpisodeTrigger::class, 'episodes_episode_triggers')->withTimestamps();
    }
}
