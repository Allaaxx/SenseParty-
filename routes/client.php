<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Auth\Events\Login;

Route::prefix('client')->name('client.')->group(function(){

    Route::middleware([])->group(function(){
        Route::controller(ClientController::class)->group(function(){
            Route::get('/login-register', 'loginRegister')->name('login-register');
        });
    });
    

    Route::middleware([])->group(function(){
        Route::controller(ClientController::class)->group(function(){
            Route::get('/home','home')->name('home');     
        });
    });
    

}); 