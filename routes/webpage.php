<?php

use App\Http\Controllers\PageController;
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
Route::get('en', [PageController::class, 'index']);
// Route::get('en/praxis_&_team', [PageController::class, 'index']);
Route::get('ru', [PageController::class, 'index']);

$splitUrl = explode('/', str_replace(config('app.url'), '', url()->current()));
usort($splitUrl, fn($a, $b) => strlen($a) <=> strlen($b));
$local = array_filter($splitUrl, function($v) {
  if (strlen($v) === 2) return $v;
});
sort($local);
$lang = isset($local[0]) ? ($local[0] === 'de' ? '' : $local[0]) : '';

Route::get("$lang/behandlungen", [PageController::class, 'index']);

Route::get("$lang/blog", [PageController::class, 'index']);

Route::get("$lang/kosten", [PageController::class, 'index']);

Route::get("$lang/praxis_&_team", [PageController::class, 'index']);

Route::get("$lang/ueberweisung", [PageController::class, 'index']);

Route::get("$lang/kontakt", [PageController::class, 'index']);

Route::get("$lang/datenschutz", [PageController::class, 'index']);

Route::get("$lang/impressum", [PageController::class, 'index']);

/*
|
|--------------------------------------------------------------------------
| Contact Route
|--------------------------------------------------------------------------
|
*/

Route::post("$lang/kontakt", [PageController::class, 'contact'])->name('contact');

/*
|
|--------------------------------------------------------------------------
| Subpage Routes
|--------------------------------------------------------------------------
|
*/

Route::get("$lang/behandlungen/notfallversorgung", [PageController::class, 'index']);

Route::get("$lang/behandlungen/familientermine", [PageController::class, 'index']);

Route::get("$lang/behandlungen/prophylaxe", [PageController::class, 'index']);

Route::get("$lang/behandlungen/allgemeine_zahnheilkunde", [PageController::class, 'index']);

Route::get("$lang/behandlungen/parodontologie", [PageController::class, 'index']);

Route::get("$lang/behandlungen/bleaching", [PageController::class, 'index']);

Route::get("$lang/behandlungen/restaurative_zahnheilkunde", [PageController::class, 'index']);

Route::get("$lang/behandlungen/implantate", [PageController::class, 'index']);

Route::get("$lang/behandlungen/zahnersatz", [PageController::class, 'index']);
