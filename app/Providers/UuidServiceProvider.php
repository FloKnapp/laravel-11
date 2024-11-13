<?php

namespace App\Providers;

use App\Models\Episode;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class UuidServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Episode::creating(function (Episode $model) {
            if (empty($model->public_id)) {
                $model->public_id = (string) Str::uuid();
            }
        });
    }
}
