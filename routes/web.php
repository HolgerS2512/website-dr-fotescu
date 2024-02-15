<?php

use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\TeamSliderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Route::get('/praxis_&_team', [TeamController::class, 'index']);

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



# =====> Contact Routes (POST & GET METHODS) <===== #

Route::get('/kontakt', [ContactController::class, 'index']);

Route::post('/kontakt', [ContactController::class, 'store'])
  ->name('contact');


/**
 *
 * # =====> Admin Routes (POST & GET METHOD) <===== #
 *
 */
Auth::routes();

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

Route::get('/home/header', [HomeSliderController::class, 'index'])->name('home.header');

// -----> Home Slider Routes (POST, GET & PUT METHODS) <----- //

Route::post('/slider/home/store', [HomeSliderController::class, 'store'])
  ->name('store.home.slide');

Route::get('/slider/home/edit/{id}', function ($id) {
  $slideHome = DB::table('home_sliders')->find($id);

  return view('admin.home.edit_slide', compact('slideHome'));
});

Route::put('slider/home/update/{id}', [HomeSliderController::class, 'update']);

Route::patch('slider/home/visible', [HomeSliderController::class, 'visible']);

Route::patch('slider/home/update/up/{id}', [HomeSliderController::class, 'up']);

Route::patch('slider/home/update/down/{id}', [HomeSliderController::class, 'down']);

Route::get('slider/home/delete/{id}', [HomeSliderController::class, 'destroy']);

// -----> Team Slider Routes (POST, GET & PUT METHODS) <----- //

Route::post('/slider/team/store', [TeamSliderController::class, 'store'])
  ->name('store.team.slide');

Route::get('/slider/team/edit/{id}', function ($id) {
  $slideTeam = DB::table('team_sliders')->find($id);

  return view('admin.team.edit_slide', compact('slideTeam'));
});

Route::put('slider/team/update/{id}', [TeamSliderController::class, 'update']);

Route::patch('slider/team/update/up/{id}', [TeamSliderController::class, 'up']);

Route::patch('slider/team/update/down/{id}', [TeamSliderController::class, 'down']);

Route::get('slider/team/delete/{id}', [TeamSliderController::class, 'destroy']);
