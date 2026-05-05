<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home route
Route::get('/', [AuthController::class, 'index'])->name('home');

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::get('sign-in', [AuthController::class, 'signIn'])->name('auth.sign-in');
    Route::get('callback', [AuthController::class, 'callback'])->name('auth.callback');
    Route::get('sign-out', [AuthController::class, 'signOut'])->name('auth.sign-out');
    Route::get('userinfo', [AuthController::class, 'userInfo'])->name('auth.userinfo');
});
