<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Head Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/{pageID}', [HeadController::class, 'index']);

Route::post('header/{pageID}/image/store', [HeadController::class, 'store']);

Route::get('header/{pageID}/image/edit/{id}', [HeadController::class, 'edit']);

Route::put('header/{pageID}/image/update/{id}', [HeadController::class, 'update']);

Route::patch('header/{pageID}/image/visible', [HeadController::class, 'visible']);

Route::patch('header/{pageID}/image/update/up/{id}', [HeadController::class, 'up']);

Route::patch('header/{pageID}/image/update/down/{id}', [HeadController::class, 'down']);

Route::get('header/{pageID}/image/delete/{id}', [HeadController::class, 'destroy']);
