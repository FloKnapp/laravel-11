<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Symptom
 * @package App\Models
 * @author  Florian Knapp <office@florianknapp.de>
 *
 * @mixin Builder
 */
class Symptom extends Model
{

    use HasFactory;

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
