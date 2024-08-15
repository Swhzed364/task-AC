<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::patch('/update/{id}', 'update')->name('update');
    Route::delete('/destroy/{id}', 'delete')->name('destroy');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/password-reset', 'passwordReset');
});

Route::controller(PostController::class)->prefix('post')->name('post')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::patch('/update/{id}', 'update')->name('update');
    Route::delete('/destroy/{id}', 'delete')->name('destroy');
});