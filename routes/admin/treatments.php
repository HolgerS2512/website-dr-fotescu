<?php

use App\Http\Controllers\Admin\Treatments\TreatmentsHeadController;
use App\Http\Controllers\Admin\Treatments\TreatmentsMainController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Treatments Header Routes
|--------------------------------------------------------------------------
|
*/

Route::get('header/treatments', [TreatmentsHeadController::class, 'index']);

Route::post('header/treatments/image/store', [TreatmentsHeadController::class, 'store']);

Route::get('header/treatments/image/edit/{id}', [TreatmentsHeadController::class, 'edit']);

Route::put('header/treatments/image/update/{id}', [TreatmentsHeadController::class, 'update']);

Route::patch('header/treatments/image/visible', [TreatmentsHeadController::class, 'visible']);

Route::patch('header/treatments/image/update/up/{id}', [TreatmentsHeadController::class, 'up']);

Route::patch('header/treatments/image/update/down/{id}', [TreatmentsHeadController::class, 'down']);

Route::get('header/treatments/image/delete/{id}', [TreatmentsHeadController::class, 'destroy']);

/*
|
|--------------------------------------------------------------------------
| Treatments Content Routes
|--------------------------------------------------------------------------
|
*/

Route::get('content/treatments', [TreatmentsMainController::class, 'index']);
