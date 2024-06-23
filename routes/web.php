<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\pesquisaProdController;
use App\Http\Controllers\Seller\CartController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\StripeController;
use App\Livewire\SingleProduct;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "web"
| middleware group, which includes middleware like session and CSRF
| protection. Now create something great!
|
*/

// Rotas para o FrontEndController
Route::group(['prefix' => ''], function () {
    Route::get('/', [FrontEndController::class, 'homePage'])->name('home-page');
    Route::get('/shop', [FrontEndController::class, 'shopPage'])->name('shop-page');
    Route::get('/single-product/{id}', [FrontEndController::class, 'singleProduct'])->name('single-product');
    Route::get('/contact', [FrontEndController::class, 'contactPage'])->name('contact-page');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');


});

// Rotas para o ProductController
Route::resource('products', ProductController::class);

Route::get('/search', [pesquisaProdController::class, 'pesquisa'])->name('product.search');
Route::get('/search-error', [pesquisaProdController::class, 'pesquisa'])->name('product.search-error');
// Rotas para o CartController
Route::prefix('seller')->group(function () {
    // Rotas para o StripeController
    Route::get('checkout', [StripeController::class, 'session'])->name('checkout');
    Route::get('success', [StripeController::class, 'success'])->name('success');
    Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');
});

// Rotas para páginas de exemplo
Route::view('/example-page', 'example-page');
Route::view('/example-auth', 'example-auth');
Route::view('/example-frontend', 'example-frontend');
