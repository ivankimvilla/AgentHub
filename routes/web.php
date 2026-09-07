<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/get-started', 'pages.auth')->name('get-started');
Route::post('/get-started', [AuthController::class, 'register'])->name('get-started.submit');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/auth-login/{platform}/redirect', [SocialAuthController::class, 'loginRedirect'])->name('social.login.redirect');
Route::get('/auth-login/{platform}/callback', [SocialAuthController::class, 'loginCallback'])->name('social.login.callback');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms-of-service', 'pages.terms')->name('terms');
Route::get('/dashboard', DashboardController::class)->middleware('auth')->name('dashboard');
Route::post('/content', [ContentController::class, 'store'])->name('content.store');
Route::patch('/content/{content}', [ContentController::class, 'update'])->name('content.update');
Route::post('/content/{content}/approve', [ContentController::class, 'approve'])->name('content.approve');
Route::get('/auth/{platform}/redirect', [SocialAuthController::class, 'redirect'])->middleware('auth')->name('social.redirect');
Route::get('/auth/{platform}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
Route::delete('/connections/{account}', [SocialAuthController::class, 'disconnect'])->name('social.disconnect');
