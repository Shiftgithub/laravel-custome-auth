<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;


// Route::resource('auth', AuthController::class);
// Route::get('profile/', [AuthController::class, 'profile'])->name('profile');

Route::group([
    "middleware" => ["guest"]
], function () {
    // Register
    Route::match(['get', 'post'], 'register/', [AuthController::class, 'register'])->name('register');
    // Login
    Route::match(['get', 'post'], '/', [AuthController::class, 'login'])->name('login');
});
Route::group([
    "middleware" => ["auth"]
], function () {
    // Profile
    Route::match(['get', 'post'], 'profile/', [AuthController::class, 'profile'])->name('profile');
    // Dashboard
    Route::get('dashboard/', [AuthController::class, 'dashboard'])->name('dashboard');
    // Logout
    Route::get('logout/', [AuthController::class, 'logout'])->name('logout');
});
