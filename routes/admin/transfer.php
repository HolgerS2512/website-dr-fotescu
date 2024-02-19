<?php

use App\Http\Controllers\Admin\Transfer\TransferHeadController;
use App\Http\Controllers\Admin\Transfer\TransferMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Transfer Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/transfer', [TransferHeadController::class, 'index']);

Route::post('header/transfer/image/store', [TransferHeadController::class, 'store']);

Route::get('header/transfer/image/edit/{id}', [TransferHeadController::class, 'edit']);

Route::put('header/transfer/image/update/{id}', [TransferHeadController::class, 'update']);

Route::patch('header/transfer/image/visible', [TransferHeadController::class, 'visible']);

Route::patch('header/transfer/image/update/up/{id}', [TransferHeadController::class, 'up']);

Route::patch('header/transfer/image/update/down/{id}', [TransferHeadController::class, 'down']);

Route::get('header/transfer/image/delete/{id}', [TransferHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Transfer Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/transfer', [TransferMainController::class, 'index']);
