<?php

use App\Http\Controllers\Admin\Privacy\PrivacyHeadController;
use App\Http\Controllers\Admin\Privacy\PrivacyMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Privacy Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/privacy', [PrivacyHeadController::class, 'index']);

Route::post('header/privacy/image/store', [PrivacyHeadController::class, 'store']);

Route::get('header/privacy/image/edit/{id}', [PrivacyHeadController::class, 'edit']);

Route::put('header/privacy/image/update/{id}', [PrivacyHeadController::class, 'update']);

Route::patch('header/privacy/image/visible', [PrivacyHeadController::class, 'visible']);

Route::patch('header/privacy/image/update/up/{id}', [PrivacyHeadController::class, 'up']);

Route::patch('header/privacy/image/update/down/{id}', [PrivacyHeadController::class, 'down']);

Route::get('header/privacy/image/delete/{id}', [PrivacyHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Privacy Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/privacy', [PrivacyMainController::class, 'index']);
