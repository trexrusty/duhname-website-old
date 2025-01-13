<?php

use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
Route::get('/', [test::class, 'view']);
Route::post('/icon', [test::class, 'icon'])->name('icon');

Route::get('/register', function () {
    return view('auth.create');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/save-icon', [test::class, 'saveIconToS3'])->name('saveIcon');
