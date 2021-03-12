<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');


Route::middleware('guest')->group(function () {
    Route::post('/',
        [\App\Http\Controllers\AuthController::class, 'handleLogin'])
        ->name('handle.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout',
        [\App\Http\Controllers\AuthController::class, 'logout'])
        ->name('logout');
    Route::get('/edit', [\App\Http\Controllers\AdController::class, 'create'])
        ->name('create');
    Route::post('/edit', [\App\Http\Controllers\AdController::class, 'store'])
        ->name('store');
    Route::get('/delete/{ad}',
        [\App\Http\Controllers\AdController::class, 'destroy'])->name('delete');
    Route::get('/edit/{ad}',
        [\App\Http\Controllers\AdController::class, 'edit'])
        ->name('edit');
    Route::post('/edit/{ad}',
        [\App\Http\Controllers\AdController::class, 'update'])->name('update');
});

Route::get('/{ad}', [\App\Http\Controllers\AdController::class, 'read'])
    ->name('read');
