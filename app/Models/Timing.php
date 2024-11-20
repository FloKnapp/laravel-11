<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Timing
 * @package App\Models
 * @author  Florian Knapp <office@florianknapp.de>
 *
 * @mixin Builder
 */
class Timing extends Model
{

    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function symptoms() {
        return $this->hasMany(SymptomTiming::class);
    }
}
