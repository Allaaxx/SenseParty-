<?php

use App\Http\Controllers\FacebookAuthController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\pesquisaProdController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Seller\CartController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/search', [pesquisaProdController::class, 'pesquisa'])->name('product.search');
    Route::get('/search-error', [pesquisaProdController::class, 'pesquisa'])->name('product.search-error');
    Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
    Route::get('auth/google/call-back', [GoogleAuthController::class, 'callBackGoogle']);
    Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook-auth');
    Route::get('auth/facebook/callback', [FacebookAuthController::class, 'callBackFacebook'])->name('facebook-callback');
});

// Rotas para o ProductController
Route::resource('products', ProductController::class);

// Middleware para rotas protegidas
Route::middleware(['auth:seller'])->group(function () {
    // Rotas para os Pedidos (OrderController)
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

    // Rotas para avaliações (ReviewController)
    Route::post('products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Rotas para o StripeController
    Route::prefix('seller')->group(function () {
        Route::get('checkout', [StripeController::class, 'session'])->name('checkout');
        Route::get('success', [StripeController::class, 'success'])->name('success');
        Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');
    });
});

// Rotas para páginas de exemplo
Route::view('/example-page', 'example-page');
Route::view('/example-auth', 'example-auth');
Route::view('/example-frontend', 'example-frontend');


