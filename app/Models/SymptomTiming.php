<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
