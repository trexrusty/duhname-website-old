<?php

use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;

Route::get('/', [test::class, 'view'])->name('home');
Route::post('/icon', [test::class, 'icon'])->name('icon');

Route::get('/register', [RegisterController::class, 'registerview'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [SessionController::class, 'loginview'])->name('login');
Route::post('/login', [SessionController::class, 'login'])->name('login.post');
Route::delete('/logout', [SessionController::class, 'logout'])->name('logout');

Route::post('/save-icon', [test::class, 'saveIconToS3'])->name('saveIcon');
