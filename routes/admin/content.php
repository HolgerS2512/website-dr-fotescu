<?php

use App\Http\Controllers\Admin\ContentController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/{link}', [ContentController::class, 'index']);

Route::post('content/{link}/store', [ContentController::class, 'store']);

Route::get('content/{link}/edit/{id}', [ContentController::class, 'edit']);

Route::put('content/{link}/update/{id}', [ContentController::class, 'update']);

Route::patch('content/{link}/visible', [ContentController::class, 'visible']);

Route::patch('content/{link}/update/up/{id}', [ContentController::class, 'up']);

Route::patch('content/{link}/update/down/{id}', [ContentController::class, 'down']);

Route::get('content/{link}/delete/{id}', [ContentController::class, 'destroy']);
