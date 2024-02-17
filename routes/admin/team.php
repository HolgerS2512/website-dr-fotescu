<?php

use App\Http\Controllers\Admin\Team\TeamHeadController;
use App\Http\Controllers\Admin\Team\TeamMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Home Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/team/header', [TeamHeadController::class, 'index'])
  ->name('team.header');

Route::post('/slider/team/store', [TeamHeadController::class, 'store'])
  ->name('store.team.slide');

Route::get('/slider/team/edit/{id}', [TeamHeadController::class, 'edit']);

Route::put('slider/team/update/{id}', [TeamHeadController::class, 'update']);

Route::patch('slider/team/visible', [TeamHeadController::class, 'visible']);

Route::patch('slider/team/update/up/{id}', [TeamHeadController::class, 'up']);

Route::patch('slider/team/update/down/{id}', [TeamHeadController::class, 'down']);

Route::get('slider/team/delete/{id}', [TeamHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Home Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/team/content', [TeamMainController::class, 'index'])
  ->name('team.content');





