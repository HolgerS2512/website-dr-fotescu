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

Route::get('header/team', [TeamHeadController::class, 'index']);

Route::post('header/team/image/store', [TeamHeadController::class, 'store']);

Route::get('header/team/image/edit/{id}', [TeamHeadController::class, 'edit']);

Route::put('header/team/image/update/{id}', [TeamHeadController::class, 'update']);

Route::patch('header/team/image/visible', [TeamHeadController::class, 'visible']);

Route::patch('header/team/image/update/up/{id}', [TeamHeadController::class, 'up']);

Route::patch('header/team/image/update/down/{id}', [TeamHeadController::class, 'down']);

Route::get('header/team/image/delete/{id}', [TeamHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Team Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/team', [TeamMainController::class, 'index']);





