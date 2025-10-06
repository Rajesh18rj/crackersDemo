<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuickOrderController;
use App\Http\Controllers\SuperUserAuthController;
use App\Http\Controllers\SuperUserDashboardController;
use Illuminate\Support\Facades\Route;

//
Route::get('/', function () {
    return view('welcome');
});

//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::get('/shop', \App\Livewire\Shop::class)->name('shop');

//Route::get('/', function () {
//    return redirect()->away('https://niyaacrackers.com/');
//})->name('welcome');

Route::get('/about', function () {
    return redirect()->away('https://niyaacrackers.com/standard-fireworks-online-about-us/');
})->name('about');

Route::get('/shop', function () {
    return redirect()->away('https://niyaacrackers.com/shop-diwali-fireworks-online/');
})->name('shop');

Route::get('/contact', function () {
    return redirect()->away('https://niyaacrackers.com/fireworks-sellers-contact-us/');
})->name('contact');


//Route::get('/quick-purchase', QuickPurchase::class);

//Route::get('/checkout', CheckoutPage::class)->name('checkout');

Route::get('/quick-order', [QuickOrderController::class, 'index'])->name('quick-order.index');
Route::post('/quick-order/checkout', [QuickOrderController::class, 'checkout'])->name('quick-order.checkout');


Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
//Route::get('/checkout-success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

//Route::get('/checkout-success/{order}', function($order){
//    return view('checkout-success', compact('order'));
//})->name('checkout-success');


//Route::get('/checkout-success/{order}', [\App\Http\Controllers\OrderSuccessController::class, 'success'])->name('checkout-success');


Route::get('superuser/login', [SuperUserAuthController::class, 'showLoginForm'])->name('superuser.login');
Route::post('superuser/login', [SuperUserAuthController::class, 'login'])->name('superuser.login');
//Route::post('superuser/logout', [SuperUserAuthController::class, 'logout'])->name('superuser.logout');


// Protect admin routes with middleware
Route::middleware(['superuser'])->group(function () {

    Route::get('/superuser/dashboard', [SuperUserDashboardController::class, 'index'])->name('superuser.dashboard');
    Route::post('/superuser/logout', [SuperUserAuthController::class, 'logout'])->name('superuser.logout');

    Route::get('admin1', [SuperUserDashboardController::class, 'index'])->name('superuser.dashboard');

    Route::get('admin1/categories', [CategoryController::class, 'index'])->name('admin1.categories.index');

    Route::get('admin1/categories/create', [CategoryController::class, 'create'])->name('admin1.categories.create');

    Route::post('admin1/categories', [CategoryController::class, 'store'])->name('admin1.categories.store');

    Route::get('admin1/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin1.categories.edit');

    Route::put('admin1/categories/{category}', [CategoryController::class, 'update'])->name('admin1.categories.update');

    Route::delete('admin1/categories/{category}', [CategoryController::class, 'destroy'])->name('admin1.categories.destroy');


    Route::get('admin1/products', [ProductController::class, 'index'])->name('admin1.products.index');

    Route::get('admin1/products/create', [ProductController::class, 'create'])->name('admin1.products.create');

    Route::post('admin1/products', [ProductController::class, 'store'])->name('admin1.products.store');

    Route::get('admin1/products/{product}/edit', [ProductController::class, 'edit'])->name('admin1.products.edit');

    Route::put('admin1/products/{product}', [ProductController::class, 'update'])->name('admin1.products.update');

    Route::delete('admin1/products/{product}', [ProductController::class, 'destroy'])->name('admin1.products.destroy');


    Route::get('admin1/orders', [OrderController::class, 'index'])->name('admin1.orders.index');

    Route::get('admin1/orders/{order}', [OrderController::class, 'show'])->name('admin1.orders.show');

    Route::get('admin1/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin1.orders.edit');

    Route::put('admin1/orders/{order}', [OrderController::class, 'update'])->name('admin1.orders.update');

    Route::delete('admin1/orders/{order}', [OrderController::class, 'destroy'])->name('admin1.orders.destroy');

    Route::get('admin1/orders/{order}/print', [OrderController::class, 'print'])->name('admin1.orders.print');

});



//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/', function () {
//        return view('welcome');
//    })->name('welcome');
//});



