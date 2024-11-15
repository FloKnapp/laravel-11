<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timing extends Model
{
    protected $fillable = [
        'name'
    ];

    public function symptoms() {
        return $this->hasMany(SymptomTiming::class);
    }
}
