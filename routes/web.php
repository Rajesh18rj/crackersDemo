<?php

use App\Livewire\CheckoutPage;
use App\Livewire\QuickPurchase;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::get('/shop', \App\Livewire\Shop::class)->name('shop');

Route::get('/quick-purchase', QuickPurchase::class);

Route::get('/checkout', CheckoutPage::class)->name('checkout');

Route::get('/checkout-success/{order}', [\App\Http\Controllers\OrderSuccessController::class, 'success'])->name('checkout-success');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});
