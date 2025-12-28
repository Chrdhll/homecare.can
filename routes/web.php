<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/layanan/{service}', [PageController::class, 'showService'])->name('services.show');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', function () {
        return view('pages.profile', [
            'user' => Auth::user(),
        ]);
    })->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pesan/{service}', [OrderController::class, 'create'])->name('orders.create');

    Route::post('/pesan/{service}', [OrderController::class, 'store'])->name('orders.store');


    Route::get('/riwayat-pesanan', [MyOrderController::class, 'index'])->name('my-orders.index');

    // Route Simpan Review
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');


    Route::post('/orders/{order}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');

    Route::put('/orders/{order}/reviews', [ReviewController::class, 'update'])
        ->name('reviews.update');



    Route::get('/notification/{id}/read', [NotificationController::class, 'markAsRead'])->name('notification.read');
    Route::get('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notification.read.all');


    Route::get('/invoice/{order}', [InvoiceController::class, 'generate'])->name('invoice.download');

    Route::get('/detail-pesanan/{order}', [OrderController::class, 'show'])->name('my-orders.show');


});



Route::middleware('web')->group(function () {
    Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])
        ->name('auth.google.redirect');

    Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
        ->name('auth.google.callback');
});

Route::post('/kontak-submit', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/search', [SearchController::class, 'index'])
    ->name('search');

require __DIR__.'/auth.php';
