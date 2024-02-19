<?php

use App\Http\Controllers\Admin\Imprint\ImprintHeadController;
use App\Http\Controllers\Admin\Imprint\ImprintMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Imprint Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/imprint', [ImprintHeadController::class, 'index']);

Route::post('header/imprint/image/store', [ImprintHeadController::class, 'store']);

Route::get('header/imprint/image/edit/{id}', [ImprintHeadController::class, 'edit']);

Route::put('header/imprint/image/update/{id}', [ImprintHeadController::class, 'update']);

Route::patch('header/imprint/image/visible', [ImprintHeadController::class, 'visible']);

Route::patch('header/imprint/image/update/up/{id}', [ImprintHeadController::class, 'up']);

Route::patch('header/imprint/image/update/down/{id}', [ImprintHeadController::class, 'down']);

Route::get('header/imprint/image/delete/{id}', [ImprintHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Imprint Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/imprint', [ImprintMainController::class, 'index']);
