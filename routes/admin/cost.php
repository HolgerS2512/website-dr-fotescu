<?php

use App\Http\Controllers\Admin\Cost\CostHeadController;
use App\Http\Controllers\Admin\Cost\CostMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Cost Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/cost', [CostHeadController::class, 'index']);

Route::post('header/cost/image/store', [CostHeadController::class, 'store']);

Route::get('header/cost/image/edit/{id}', [CostHeadController::class, 'edit']);

Route::put('header/cost/image/update/{id}', [CostHeadController::class, 'update']);

Route::patch('header/cost/image/visible', [CostHeadController::class, 'visible']);

Route::patch('header/cost/image/update/up/{id}', [CostHeadController::class, 'up']);

Route::patch('header/cost/image/update/down/{id}', [CostHeadController::class, 'down']);

Route::get('header/cost/image/delete/{id}', [CostHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Cost Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/cost', [CostMainController::class, 'index']);
