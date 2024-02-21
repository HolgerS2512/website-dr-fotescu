<?php

use App\Http\Controllers\Admin\HeadController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/{link}', [HeadController::class, 'index']);

Route::post('content/{link}/image/store', [HeadController::class, 'store']);

Route::get('content/{link}/image/edit/{id}', [HeadController::class, 'edit']);

Route::put('content/{link}/image/update/{id}', [HeadController::class, 'update']);

Route::patch('content/{link}/image/visible', [HeadController::class, 'visible']);

Route::patch('content/{link}/image/update/up/{id}', [HeadController::class, 'up']);

Route::patch('content/{link}/image/update/down/{id}', [HeadController::class, 'down']);

Route::get('content/{link}/image/delete/{id}', [HeadController::class, 'destroy']);
