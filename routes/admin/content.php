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

Route::get('administration/content/{link}', [ContentController::class, 'index']);

Route::post('administration/content/{link}/store', [ContentController::class, 'store']);

Route::get('administration/content/{link}/edit/{id}', [ContentController::class, 'edit']);

Route::put('administration/content/{link}/update/{id}', [ContentController::class, 'update']);

Route::patch('administration/content/{link}/visible', [ContentController::class, 'visible']);

Route::patch('administration/content/{link}/update/ranking/{id}', [ContentController::class, 'changeRanking']);

Route::get('administration/content/{link}/delete/{id}', [ContentController::class, 'destroy']);
