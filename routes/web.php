<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\ReactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('posts/trash', [PostController::class, 'indexTrash'])->name('posts.indexTrash');
    Route::resource('posts', PostController::class);
    Route::post('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::post('posts/{id}/forceDestroy', [PostController::class, 'forceDestroy'])->name('posts.forceDestroy');
    Route::post('posts/{post}/pinPost', [PostController::class, 'pinPost'])->name('posts.pinPost');
    Route::post('posts/{post}/unpinPost', [PostController::class, 'unpinPost'])->name('posts.unpinPost');

    ///reaction
    Route::post('posts/reaction', [ReactionController::class, 'reaction'])->name('posts.reaction');

});

Route::inertia('login', 'Auth/Login')->name('login');
Route::inertia('register', 'Auth/Register')->name('register');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
