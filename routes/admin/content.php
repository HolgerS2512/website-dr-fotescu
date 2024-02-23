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

Route::post('content/{link}/image/store', [ContentController::class, 'store']);

Route::get('content/{link}/image/edit/{id}', [ContentController::class, 'edit']);

Route::put('content/{link}/image/update/{id}', [ContentController::class, 'update']);

Route::patch('content/{link}/image/visible', [ContentController::class, 'visible']);

Route::patch('content/{link}/image/update/up/{id}', [ContentController::class, 'up']);

Route::patch('content/{link}/image/update/down/{id}', [ContentController::class, 'down']);

Route::get('content/{link}/image/delete/{id}', [ContentController::class, 'destroy']);
