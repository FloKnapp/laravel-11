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
        'episode_id',
        'symptom_id'
    ];

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}
