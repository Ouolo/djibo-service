<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/apropos', [PageController::class, 'about'])->name('about');
Route::get('/produits', [PageController::class, 'products'])->name('products');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/realisations', [PageController::class, 'realisations'])->name('realisations');
Route::get('/temoignages', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/distributeurs', [PageController::class, 'distributors'])->name('distributors');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
