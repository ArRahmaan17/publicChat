<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicChatController;
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

// Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
// Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
// Route::get('/two-factor-authentication', [AuthController::class, 'doTwoFactoryAuth'])->name('auth.doTwoFactoryAuth');
// Route::get('/create-pin-authentication', [AuthController::class, 'createPinAuth'])->name('auth.createPinAuthentication');
// Route::post('/authentication', [AuthController::class, 'authentication'])->name('auth.authentication');
// Route::post('/registration', [AuthController::class, 'registration'])->name('auth.registration');
Route::get('/', [PublicChatController::class, 'index'])->name('chat.index');
Route::post('/', [PublicChatController::class, 'store'])->name('chat.store');
