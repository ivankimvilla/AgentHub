<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms-of-service', 'pages.terms')->name('terms');
Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::post('/content', [ContentController::class, 'store'])->name('content.store');
Route::patch('/content/{content}', [ContentController::class, 'update'])->name('content.update');
Route::post('/content/{content}/approve', [ContentController::class, 'approve'])->name('content.approve');
Route::get('/auth/{platform}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{platform}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
Route::delete('/connections/{account}', [SocialAuthController::class, 'disconnect'])->name('social.disconnect');
