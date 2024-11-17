<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\Api\EpisodeController as ApiEpisodeController;
use App\Http\Controllers\Api\EpisodeDraftController as ApiEpisodeDraftController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::post('/episode', [EpisodeController::class, 'store'])->name('episode.store');
Route::get('/episode/{publicId}', [EpisodeController::class, 'show'])->name('episode.show');

// Api
Route::prefix('/api/v1')->group(function() {
    Route::post('/episode/draft', [ApiEpisodeDraftController::class, 'store'])->name('episode.draft');
    Route::resource('episode', ApiEpisodeController::class);
});

// Admin
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
