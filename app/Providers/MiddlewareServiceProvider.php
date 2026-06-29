<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TrackVisits;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Enregistrer le middleware
        Route::aliasMiddleware('track.visits', TrackVisits::class);
        
        // Ou l'ajouter au groupe web
        Route::pushMiddlewareToGroup('web', TrackVisits::class);
    }
}