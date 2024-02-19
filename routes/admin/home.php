<?php

use App\Http\Controllers\Admin\Home\HomeHeadController;
use App\Http\Controllers\Admin\Home\HomeMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Home Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/home', [HomeHeadController::class, 'index']);

Route::post('header/home/image/store', [HomeHeadController::class, 'store']);

Route::get('header/home/image/edit/{id}', [HomeHeadController::class, 'edit']);

Route::put('header/home/image/update/{id}', [HomeHeadController::class, 'update']);

Route::patch('header/home/image/visible', [HomeHeadController::class, 'visible']);

Route::patch('header/home/image/update/up/{id}', [HomeHeadController::class, 'up']);

Route::patch('header/home/image/update/down/{id}', [HomeHeadController::class, 'down']);

Route::get('header/home/image/delete/{id}', [HomeHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Home Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/home', [HomeMainController::class, 'index']);
