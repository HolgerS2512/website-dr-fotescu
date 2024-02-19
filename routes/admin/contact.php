<?php

use App\Http\Controllers\Admin\Contact\ContactHeadController;
use App\Http\Controllers\Admin\Contact\ContactMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Contact Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/contact', [ContactHeadController::class, 'index']);

Route::post('header/contact/image/store', [ContactHeadController::class, 'store']);

Route::get('header/contact/image/edit/{id}', [ContactHeadController::class, 'edit']);

Route::put('header/contact/image/update/{id}', [ContactHeadController::class, 'update']);

Route::patch('header/contact/image/visible', [ContactHeadController::class, 'visible']);

Route::patch('header/contact/image/update/up/{id}', [ContactHeadController::class, 'up']);

Route::patch('header/contact/image/update/down/{id}', [ContactHeadController::class, 'down']);

Route::get('header/contact/image/delete/{id}', [ContactHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Contact Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/contact', [ContactMainController::class, 'index']);
