<?php

use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\IndexController;

// Guest routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'registerview'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    Route::get('/login', [SessionController::class, 'loginview'])->name('login');
    Route::post('/login', [SessionController::class, 'login'])->name('login.post');
});

// Authenticated routes
Route::group(['middleware' => 'auth'], function () {


    Route::delete('/logout', [SessionController::class, 'logout'])->name('logout');

});
Route::get('/', [IndexController::class, 'index'])->name('home');
