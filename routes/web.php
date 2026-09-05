<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesmanController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;

Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::controller(UserController::class)
        ->prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create'); // show form create user
            Route::post('/', 'store')->name('store'); // submit new user
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::get('/{user}', 'show')->name('show');
            Route::put('/{user}', 'update')->name('update');
            Route::delete('/{user}', 'delete')->name('delete');
        });

    Route::controller(ShopController::class)
        ->prefix('shop')
        ->name('shop.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::controller(SalesmanController::class)
        ->prefix('salesman')
        ->name('salesman.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::controller(SalesController::class)
        ->prefix('sales')
        ->name('sales.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});
