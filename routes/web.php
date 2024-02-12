<?php

use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

# =====> Main Routes (GET METHODS) <===== #

Route::get('/', [HomeController::class, 'index']);

Route::get('/behandlungen', fn () => view('pages.home'));

Route::get('/blog', fn () => view('pages.home'));

Route::get('/kosten', fn () => view('pages.home'));

Route::get('/praxis_&_team', fn () => view('pages.home'));

Route::get('/ueberweisung', fn () => view('pages.home'));

Route::get('/privacy_policy', fn () => view('pages.home'));

Route::get('/imprint', fn () => view('pages.home'));



# =====> Subpage Routes (GET METHODS) <===== #

Route::get('/behandlungen/notfallversorgung', fn () => view('pages.home'));

Route::get('/behandlungen/familientermine', fn () => view('pages.home'));

Route::get('/behandlungen/prophylaxe', fn () => view('pages.home'));

Route::get('/behandlungen/allgemeine_zahnheilkunde', fn () => view('pages.home'));

Route::get('/behandlungen/parodontologie', fn () => view('pages.home'));

Route::get('/behandlungen/bleaching', fn () => view('pages.home'));

Route::get('/behandlungen/restaurative_zahnheilkunde', fn () => view('pages.home'));

Route::get('/behandlungen/implantate', fn () => view('pages.home'));

Route::get('/behandlungen/zahnersatz', fn () => view('pages.home'));



# =====> Contact Routes (POST & GET METHOD) <===== #

Route::get('/kontakt', [ContactController::class, 'index']);

Route::post('/kontakt', [ContactController::class, 'store'])
  ->name('contact');


# =====> Admin Routes (POST & GET METHOD) <===== #

Auth::routes();

Route::get('/dashboard', [AdminController::class, 'index'])
  ->name('dashboard');

Route::post('/slider/home/store', [HomeSliderController::class, 'store'])
  ->name('store.home.slider.image');
