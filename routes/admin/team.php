<?php

use App\Http\Controllers\Admin\Team\TeamHeadController;
use App\Http\Controllers\Admin\Team\TeamMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Team Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('team/header', [TeamHeadController::class, 'index']);

Route::post('team/header/image/store', [TeamHeadController::class, 'store']);

Route::get('team/header/image/edit/{id}', [TeamHeadController::class, 'edit']);

Route::put('team/header/image/update/{id}', [TeamHeadController::class, 'update']);

Route::patch('team/header/image/visible', [TeamHeadController::class, 'visible']);

Route::patch('team/header/image/update/up/{id}', [TeamHeadController::class, 'up']);

Route::patch('team/header/image/update/down/{id}', [TeamHeadController::class, 'down']);

Route::get('team/header/image/delete/{id}', [TeamHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Team Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('team/content', [TeamMainController::class, 'index']);





