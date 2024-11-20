<?php

namespace App\Providers;

use App\Models\Episode;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('show-episode', function (User $user, Episode $episode) {
            return $user->id === $episode->user_id;
        });

        Gate::define('update-episode', function (User $user, Episode $episode) {
            return $user->id === $episode->user_id;
        });

        Gate::define('delete-episode', function (User $user, Episode $episode) {
            return $user->id === $episode->user_id;
        });
    }
}
