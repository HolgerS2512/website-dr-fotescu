<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/{pageID}', [HeadController::class, 'index']);

Route::post('content/{pageID}/image/store', [HeadController::class, 'store']);

Route::get('content/{pageID}/image/edit/{id}', [HeadController::class, 'edit']);

Route::put('content/{pageID}/image/update/{id}', [HeadController::class, 'update']);

Route::patch('content/{pageID}/image/visible', [HeadController::class, 'visible']);

Route::patch('content/{pageID}/image/update/up/{id}', [HeadController::class, 'up']);

Route::patch('content/{pageID}/image/update/down/{id}', [HeadController::class, 'down']);

Route::get('content/{pageID}/image/delete/{id}', [HeadController::class, 'destroy']);
