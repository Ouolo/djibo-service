<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TrackVisits;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Enregistrer le middleware (optionnel, on utilise maintenant AJAX)
        Route::aliasMiddleware('track.visits', TrackVisits::class);
        
        // Désactivé car bloqué par le cache serveur en production (remplacé par AJAX)
        // Route::pushMiddlewareToGroup('web', TrackVisits::class);
    }
}