<?php

use App\Http\Controllers\Admin\TranslationController;
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

Route::get('administration/translation/{name}', [TranslationController::class, 'index']);

Route::any('administration/translation/{name}/update/{id}', [TranslationController::class, 'update']);