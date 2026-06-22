<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActualiteController;
use App\Http\Controllers\Admin\ProduitController;

/*
|--------------------------------------------------------------------------
| Routes publiques du site
|--------------------------------------------------------------------------
*/
Route::get('/',             [PageController::class, 'home'])->name('home');
Route::get('/apropos',      [PageController::class, 'about'])->name('about');
Route::get('/produits',     [PageController::class, 'products'])->name('products');
Route::get('/services',     [PageController::class, 'services'])->name('services');
Route::get('/realisations', [PageController::class, 'realisations'])->name('realisations');
Route::get('/fiche-technique', [PageController::class, 'ficheTechnique'])->name('fiche-technique');
Route::get('/temoignages',  [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/actualites',   [PageController::class, 'actualites'])->name('actualites.public.index');
Route::get('/actualites/{slug}', [PageController::class, 'actualiteShow'])->name('actualites.public.show');
Route::get('/distributeurs',[PageController::class, 'distributors'])->name('distributors');
Route::get('/contact',      [PageController::class, 'contact'])->name('contact');
Route::post('/contact',     [PageController::class, 'contactSubmit'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Authentification (sans middleware)
    Route::get('login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    // Zone protégée par AdminMiddleware
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Publications (Actualités) – CRUD complet
        Route::resource('actualites', ActualiteController::class);
        Route::patch('actualites/{actualite}/toggle', [ActualiteController::class, 'togglePublie'])
            ->name('actualites.toggle');

        // Produits – CRUD complet
        Route::resource('produits', ProduitController::class);
        Route::patch('produits/{produit}/toggle', [ProduitController::class, 'toggleActif'])
            ->name('produits.toggle');
    });
});
