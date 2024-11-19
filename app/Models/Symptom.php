<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'name',
    ];

    public function episodes()
    {
        return $this->hasMany(EpisodeSymptom::class);
    }

    public function timings()
    {
        return $this->hasMany(SymptomTiming::class);
    }
}
