<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/layanan/{service}', [PageController::class, 'showService'])->name('services.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('auth.google.callback');


Route::post('/kontak-submit', [ContactController::class, 'submitForm'])->name('contact.submit');

require __DIR__.'/auth.php';
