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

Route::get('administration/header/{link}', [HeadController::class, 'index']);

Route::post('administration/header/{link}/image/store', [HeadController::class, 'store']);

Route::get('administration/header/{link}/image/edit/{id}', [HeadController::class, 'edit']);

Route::put('administration/header/{link}/image/update/{id}', [HeadController::class, 'update']);

Route::patch('administration/header/{link}/image/visible', [HeadController::class, 'visible']);

Route::patch('administration/header/{link}/image/update/ranking/{id}', [HeadController::class, 'changeRanking']);

Route::get('administration/header/{link}/image/delete/{id}', [HeadController::class, 'destroy']);
