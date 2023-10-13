<?php

use App\Site\Http\Controllers\AuthController;
use App\Site\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/login', [AuthController::class, 'login'])->name('web.login');
Route::get('/register', [AuthController::class, 'register'])->name('web.register');

Route::get('/email/verify', [AuthController::class, 'verify_email'])->middleware('auth')->name('web.email.verify');

Route::get('/password/email', [AuthController::class, 'password_email'])->name('web.password.email');
Route::get('/password/reset', [AuthController::class, 'password_reset'])->name('web.password.reset');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('web.home');
