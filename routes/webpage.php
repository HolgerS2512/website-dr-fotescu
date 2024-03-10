<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Webpage Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [PageController::class, 'index']);
// Route::get('/{link}/{link2}', [PageController::class, 'index']);
// Route::get('en', [PageController::class, 'index']);
// Route::get('ru', [PageController::class, 'index']);

Route::get('/behandlungen', [PageController::class, 'index']);

Route::get('/blog', [PageController::class, 'index']);

Route::get('/kosten', [PageController::class, 'index']);

Route::get('/praxis_&_team', [PageController::class, 'index']);

Route::get('/ueberweisung', [PageController::class, 'index']);

Route::get('/kontakt', [PageController::class, 'index']);

Route::get('/datenschutz', [PageController::class, 'index']);

Route::get('/impressum', [PageController::class, 'index']);

/*
|
|--------------------------------------------------------------------------
| Contact Route
|--------------------------------------------------------------------------
|
*/

Route::post('/kontakt', [PageController::class, 'contact'])->name('contact');

/*
|
|--------------------------------------------------------------------------
| Subpage Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/behandlungen/notfallversorgung', [PageController::class, 'index']);

Route::get('/behandlungen/familientermine', [PageController::class, 'index']);

Route::get('/behandlungen/prophylaxe', [PageController::class, 'index']);

Route::get('/behandlungen/allgemeine_zahnheilkunde', [PageController::class, 'index']);

Route::get('/behandlungen/parodontologie', [PageController::class, 'index']);

Route::get('/behandlungen/bleaching', [PageController::class, 'index']);

Route::get('/behandlungen/restaurative_zahnheilkunde', [PageController::class, 'index']);

Route::get('/behandlungen/implantate', [PageController::class, 'index']);

Route::get('/behandlungen/zahnersatz', [PageController::class, 'index']);
