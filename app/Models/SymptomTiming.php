<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SymptomTiming
 * @package App\Models
 * @author  Florian Knapp <office@florianknapp.de>
 *
 * @mixin Builder
 */
class SymptomTiming extends Model
{

    protected $fillable = [
        'symptom_id',
        'timing_id'
    ];

    public function symptom()
    {
        return $this->belongsTo(EpisodeSymptom::class);
    }

    public function timing()
    {
        return $this->belongsTo(Timing::class);
    }

}
