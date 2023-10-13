<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// COMO ESTÁ HABILITADO A VERIFICAÇÃO DE E-MAIL ENVIA UM E-MAIL PARA CONFIRMAR O PASSWORD
Route::post('/register', [RegisteredUserController::class, 'store'])->name('auth.register');

// REALIZA LOGIN GERANDO O ACCESS TOKEN
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('auth.login');

// RETORNA UM NOVO ACCESS TOKEN
Route::post('/refresh', [AuthenticatedSessionController::class, 'refresh'])->name('auth.refresh');

// EXIBE DADOS DO USUÁRIO LOGADO
Route::post('/me', [AuthenticatedSessionController::class, 'me'])->middleware('auth:sanctum')->name('auth.me');

// DESTRÓI O TOKEN DE ACESSO
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum')->name('auth.logout');

// ENVIA O E-MAIL PARA RECUPERAR A SENHA
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

// RECEBE OS DADOS QUANDO O USUÁRIO CLICAR EM ALTERAR A SENHA
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.reset');

// RECEBE OS DADOS QUANDO O USUÁRIO CLICAR EM CONFIRMAR E-MAIL E PREENCHE O email_verified_at
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['auth:sanctum', 'signed', 'throttle:6,1'])->name('verification.verify');

// VERIFICA SE O E-MAIL ESTÁ VALIDADO SE NÃO ESTIVER ENVIA OUTRO
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
