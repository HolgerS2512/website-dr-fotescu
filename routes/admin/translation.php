<?php

use App\Http\Controllers\Admin\TitleController;
use App\Http\Controllers\Admin\WordController;
use Illuminate\Support\Facades\Route;


/*
|
|##########################################################################
|--------------------------------------------------------------------------
| Translation Routes
|--------------------------------------------------------------------------
|##########################################################################
|
*/


/*
|
|--------------------------------------------------------------------------
| Translation Title Routes
|--------------------------------------------------------------------------
|
*/
Route::get('translation/title', [TitleController::class, 'index']);

Route::any('translation/title/update/{id}', [TitleController::class, 'update']);

/*
|
|--------------------------------------------------------------------------
| Translation Word Routes
|--------------------------------------------------------------------------
|
*/
Route::get('translation/words', [WordController::class, 'index']);

Route::any('translation/words/update/{id}', [WordController::class, 'update']);
