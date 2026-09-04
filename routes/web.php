<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
});
