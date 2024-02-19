<?php

use App\Http\Controllers\Admin\Blog\BlogHeadController;
use App\Http\Controllers\Admin\Blog\BlogMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Blog Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/blog', [BlogHeadController::class, 'index']);

Route::post('header/blog/image/store', [BlogHeadController::class, 'store']);

Route::get('header/blog/image/edit/{id}', [BlogHeadController::class, 'edit']);

Route::put('header/blog/image/update/{id}', [BlogHeadController::class, 'update']);

Route::patch('header/blog/image/visible', [BlogHeadController::class, 'visible']);

Route::patch('header/blog/image/update/up/{id}', [BlogHeadController::class, 'up']);

Route::patch('header/blog/image/update/down/{id}', [BlogHeadController::class, 'down']);

Route::get('header/blog/image/delete/{id}', [BlogHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Blog Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/blog', [BlogMainController::class, 'index']);
