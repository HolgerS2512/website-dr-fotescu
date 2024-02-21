<?php

use App\Http\Controllers\Admin\TitleController;
use App\Http\Controllers\Admin\WordController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Translation Routes
|--------------------------------------------------------------------------
|
*/

Route::get('translation/title', [TitleController::class, 'index']);

Route::post('translation/title/store/{id}', [TitleController::class, 'store']);

Route::get('translation/words', [WordController::class, 'index']);

Route::put('translation/words/store/{id}', [WordController::class, 'update']);