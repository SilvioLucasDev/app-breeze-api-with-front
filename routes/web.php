<?php

use App\Http\Controllers\Site\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('web.home'); // OK
Route::get('/login', [HomeController::class, 'login'])->name('web.login'); // OK
Route::get('/register', [HomeController::class, 'register'])->name('web.register'); // OK

Route::get('/email/verify', [HomeController::class, 'verify_email'])->name('web.email.verify');

Route::get('/password/email', [HomeController::class, 'password_email'])->name('web.password.email'); // OK
Route::get('/password/reset', [HomeController::class, 'password_reset'])->name('web.password.reset'); // OK
