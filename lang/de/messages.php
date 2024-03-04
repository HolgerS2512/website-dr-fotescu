<?php

use Illuminate\Support\Facades\DB;

$title = [];
$dbTitle = DB::table('pages')->select('link', 'name')->get();

foreach ($dbTitle as $value) {
  $title[$value->link] = $value->name;
}

$words = [];
$dbWords = DB::table('words')->select('name', 'de')->get();

foreach ($dbWords as $value) {
  $words[$value->name] = $value->de;
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
