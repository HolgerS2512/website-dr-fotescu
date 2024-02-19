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

Route::get('home/header', [HomeHeadController::class, 'index']);

Route::post('home/header/image/store', [HomeHeadController::class, 'store']);

Route::get('home/header/image/edit/{id}', [HomeHeadController::class, 'edit']);

Route::put('home/header/image/update/{id}', [HomeHeadController::class, 'update']);

Route::patch('home/header/image/visible', [HomeHeadController::class, 'visible']);

Route::patch('home/header/image/update/up/{id}', [HomeHeadController::class, 'up']);

Route::patch('home/header/image/update/down/{id}', [HomeHeadController::class, 'down']);

Route::get('home/header/image/delete/{id}', [HomeHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Home Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('home/content', [HomeMainController::class, 'index']);
