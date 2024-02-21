<?php

use App\Http\Controllers\Admin\HeadController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Head Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/{link}', [HeadController::class, 'index']);

Route::post('header/{link}/image/store', [HeadController::class, 'store']);

Route::get('header/{link}/image/edit/{id}', [HeadController::class, 'edit']);

Route::put('header/{link}/image/update/{id}', [HeadController::class, 'update']);

Route::patch('header/{link}/image/visible', [HeadController::class, 'visible']);

Route::patch('header/{link}/image/update/up/{id}', [HeadController::class, 'up']);

Route::patch('header/{link}/image/update/down/{id}', [HeadController::class, 'down']);

Route::get('header/{link}/image/delete/{id}', [HeadController::class, 'destroy']);
