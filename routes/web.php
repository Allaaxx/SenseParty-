<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Seller\CartController;
use App\Http\Controllers\Seller\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'homePage')->name('home-page');
    Route::get('/shop', 'shopPage')->name('shop-page');
    Route::get('/single-product/{id}', 'singleProduct')->name('single-product');
    Route::get('/contact', 'contactPage')->name('contact-page');
});

Route::resource('products', ProductController::class);

Route::prefix('seller')->group(function() {
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('seller/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');



    Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('success', [CartController::class, 'success'])->name('success');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cancel');
});

Route::view('/example-page', 'example-page');
Route::view('/example-auth', 'example-auth');
Route::view('example-frontend', 'example-frontend');
