<?php

use Illuminate\Support\Facades\DB;

$title = [];
$dbTitle = DB::table('pages')->select('link', 'ru_name')->get();

foreach ($dbTitle as $value) {
  $title[$value->link] = $value->ru_name;
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
