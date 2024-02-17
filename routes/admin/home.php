<?php

use App\Http\Controllers\Admin\Home\HomeHeadController;
use App\Http\Controllers\Admin\Home\HomeMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Home Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/home/header', [HomeHeadController::class, 'index'])
  ->name('home.header');

Route::post('/slider/home/store', [HomeHeadController::class, 'store'])
  ->name('store.home.slide');

Route::get('/slider/home/edit/{id}', [HomeHeadController::class, 'edit']);

Route::put('slider/home/update/{id}', [HomeHeadController::class, 'update']);

Route::patch('slider/home/visible', [HomeHeadController::class, 'visible']);

Route::patch('slider/home/update/up/{id}', [HomeHeadController::class, 'up']);

Route::patch('slider/home/update/down/{id}', [HomeHeadController::class, 'down']);

Route::get('slider/home/delete/{id}', [HomeHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Home Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/home/content', [HomeMainController::class, 'index'])
  ->name('home.content');



