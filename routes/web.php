<?php
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActualiteController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\RealisationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TemoignageController;

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
Route::get('/realisations/{id}', [PageController::class, 'realisationShow'])->name('realisations.public.show');
Route::get('/fiche-technique', [PageController::class, 'ficheTechnique'])->name('fiche-technique');
Route::get('/temoignages',  [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/actualites',   [PageController::class, 'actualites'])->name('actualites.public.index');
Route::get('/actualites/{slug}', [PageController::class, 'actualiteShow'])->name('actualites.public.show');
Route::get('/distributeurs',[PageController::class, 'distributors'])->name('distributors');
Route::get('/contact',      [PageController::class, 'contact'])->name('contact');
Route::post('/contact',     [ContactController::class, 'submit'])->name('contact.submit');
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
        Route::post('produits/{produit}/publish-facebook', [ProduitController::class, 'publishToFacebook'])
            ->name('produits.publish-facebook');

        // Réalisations – CRUD complet
        Route::resource('realisations', RealisationController::class);
        Route::patch('realisations/{realisation}/toggle', [RealisationController::class, 'toggleActif'])
            ->name('realisations.toggle');

        // Témoignages – CRUD complet
        Route::resource('temoignages', TemoignageController::class);
        Route::patch('temoignages/{temoignage}/toggle', [TemoignageController::class, 'togglePublish'])
            ->name('temoignages.toggle');
        Route::post('temoignages/update-order', [TemoignageController::class, 'updateOrder'])
            ->name('temoignages.update-order');

        // Users, Roles, Permissions – Gestion des utilisateurs et permissions
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });
});
