<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('welcome');
});
// Route::resource('auth', AuthController::class);
// Route::get('register/', [AuthController::class, 'register'])->name('register');
// Route::post('register/', [AuthController::class, 'register'])->name('register');
Route::match(['get', 'post'], 'register/', [AuthController::class, 'register'])->name('register');
Route::get('login/', [AuthController::class, 'login'])->name('login');
Route::get('dashboard/', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('profile/', [AuthController::class, 'profile'])->name('profile');
Route::get('logout/', [AuthController::class, 'logout'])->name('logout');
