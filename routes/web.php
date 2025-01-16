<?php

use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Social\PostController;
use App\Http\Controllers\Social\LikeController;
use App\Http\Controllers\NotificationController;
// Guest routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'registerview'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    Route::get('/login', [SessionController::class, 'loginview'])->name('login');
    Route::post('/login', [SessionController::class, 'login'])->name('login.post');
});

// Authenticated routes
Route::group(['middleware' => 'auth'], function () {
    Route::post('/post', [PostController::class, 'store'])->name('post.store');

    Route::post('/like/{post}', [LikeController::class, 'post_like'])->name('like.post');
    Route::post('/like/{comment}', [LikeController::class, 'comment_like'])->name('like.comment');
    Route::delete('/logout', [SessionController::class, 'logout'])->name('logout');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
