<?php

use Illuminate\Support\Facades\DB;

$title = [];
$dbPages = DB::table('pages')->select('link', 'en')->get();
$dbSubpages = DB::table('subpages')->select('link', 'en')->get();

foreach ($dbPages as $value) {
  $title[$value->link] = $value->en;
}
foreach ($dbSubpages as $value) {
  $title[$value->link] = $value->en;
}

$words = [];
$dbWords = DB::table('words')->select('name', 'en')->get();

foreach ($dbWords as $value) {
  $words[$value->name] = $value->en;
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
