<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Home\HomeFootController;
use App\Http\Controllers\Admin\Home\HomeHeadController;
use App\Http\Controllers\Admin\Home\HomeMainController;
use App\Http\Controllers\Admin\Team\TeamFootController;
use App\Http\Controllers\Admin\Team\TeamHeadController;
use App\Http\Controllers\Admin\Team\TeamMainController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
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
 *  ===================================================================================
 *  ***********************************************************************************
 * # --------------------------------> Admin Routes <-------------------------------- #
 *  ***********************************************************************************
 *  ===================================================================================
 *
 */

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

  /**
   *
   *  ===================================================================================
   *  ***********************************************************************************
   * # -----------------------------> Auth Routes Start <------------------------------ #
   *  ***********************************************************************************
   *  ===================================================================================
   *
   */
    /**
   *
   *  ===================================================================================
   * # ------------------> Dashboard Route (GET METHOD) <-------------------- #
   *  ===================================================================================
   *
   */
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


  /**
   *
   *  ===================================================================================
   * # ------------------> Home Header Routes (RESSOURCE METHODS) <-------------------- #
   *  ===================================================================================
   *
   */
  Route::get('/home/header', [HomeHeadController::class, 'index'])
    ->name('home.header');

  Route::post('/slider/home/store', [HomeHeadController::class, 'store'])
    ->name('store.home.slide');

  Route::get('/slider/home/edit/{id}', [HomeHeadController::class, 'edit']);

  Route::put('slider/home/update/{id}', [HomeHeadController::class, 'update']);

  Route::patch('slider/home/visible', [HomeHeadController::class, 'visible']);

  Route::patch('slider/home/update/up/{id}', [HomeHeadController::class, 'up']);

  Route::patch('slider/home/update/down/{id}', [HomeHeadController::class, 'down']);

  Route::get('slider/home/delete/{id}', [HomeHeadController::class, 'destroy']);
  /**
   *
   *  ===================================================================================
   * # -------------------> Home Main Routes (RESSOURCE METHODS) <--------------------- #
   *  ===================================================================================
   *
   */
  Route::get('/home/content', [HomeMainController::class, 'index'])
    ->name('home.content');


  /**
   *
   *  ===================================================================================
   * # ------------------> Team Header Routes (RESSOURCE METHODS) <-------------------- #
   *  ===================================================================================
   *
   */
  Route::get('/team/header', [TeamHeadController::class, 'index'])
    ->name('team.header');

  Route::post('/slider/team/store', [TeamHeadController::class, 'store'])
    ->name('store.team.slide');

  Route::get('/slider/team/edit/{id}', [TeamHeadController::class, 'edit']);

  Route::put('slider/team/update/{id}', [TeamHeadController::class, 'update']);

  Route::patch('slider/team/visible', [TeamHeadController::class, 'visible']);

  Route::patch('slider/team/update/up/{id}', [TeamHeadController::class, 'up']);

  Route::patch('slider/team/update/down/{id}', [TeamHeadController::class, 'down']);

  Route::get('slider/team/delete/{id}', [TeamHeadController::class, 'destroy']);
  
  /**
   *
   *  ===================================================================================
   * # -------------------> Team Main Routes (RESSOURCE METHODS) <--------------------- #
   *  ===================================================================================
   *
   */
  Route::get('/team/content', [TeamMainController::class, 'index'])
    ->name('team.content');



  /**
   *
   *  ===================================================================================
   *  ***********************************************************************************
   * # ------------------------------> Auth Routes End <------------------------------- #
   *  ***********************************************************************************
   *  ===================================================================================
   *
   */
});
