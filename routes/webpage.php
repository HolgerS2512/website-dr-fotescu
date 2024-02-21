<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Webpage Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/behandlungen', fn () => view('pages.home'));

Route::get('/blog', fn () => view('pages.home'));

Route::get('/kosten', fn () => view('pages.home'));

Route::get('/praxis_&_team', [TeamController::class, 'index']);

Route::get('/ueberweisung', fn () => view('pages.home'));

Route::get('/kontakt', [ContactController::class, 'index']);

Route::get('/datenschutz', fn () => view('pages.home'));

Route::get('/impressum', fn () => view('pages.home'));

/*
|
|--------------------------------------------------------------------------
| Contact Route
|--------------------------------------------------------------------------
|
*/

Route::post('/kontakt', [ContactController::class, 'store'])->name('contact');

/*
|
|--------------------------------------------------------------------------
| Subpage Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/behandlungen/notfallversorgung', fn () => view('pages.home'));

Route::get('/behandlungen/familientermine', fn () => view('pages.home'));

Route::get('/behandlungen/prophylaxe', fn () => view('pages.home'));

Route::get('/behandlungen/allgemeine_zahnheilkunde', fn () => view('pages.home'));

Route::get('/behandlungen/parodontologie', fn () => view('pages.home'));

Route::get('/behandlungen/bleaching', fn () => view('pages.home'));

Route::get('/behandlungen/restaurative_zahnheilkunde', fn () => view('pages.home'));

Route::get('/behandlungen/implantate', fn () => view('pages.home'));

Route::get('/behandlungen/zahnersatz', fn () => view('pages.home'));