<?php

use Illuminate\Support\Facades\DB;

$title = [];
$dbPages = DB::table('pages')->select('link', 'ru')->get();
$dbSubpages = DB::table('subpages')->select('link', 'ru')->get();

foreach ($dbPages as $value) {
  $title[$value->link] = $value->ru;
}
foreach ($dbSubpages as $value) {
  $title[$value->link] = $value->ru;
}

$words = [];
$dbWords = DB::table('words')->select('name', 'ru')->get();

foreach ($dbWords as $value) {
  $words[$value->name] = $value->ru;
}

return [


  /*
  |--------------------------------------------------------------------------
	| Words Message Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines are used in the webpage that we need to display to the user.
  |
  |
  |
  */

  'words' => $words,


  /*
  |--------------------------------------------------------------------------
	| Title Message Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines are used in the webpage that we need to display to the user.
  |
  |
  |
  */

  'title' => $title,

];
