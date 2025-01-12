<?php

use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;

Route::get('/', [test::class, 'view']);
Route::post('/icon', [test::class, 'icon'])->name('icon');
