<?php

use Illuminate\Support\Facades\DB;

$title = [];
$dbPages = DB::table('pages')->select('link', 'de')->get();
$dbSubpages = DB::table('subpages')->select('link', 'de')->get();

foreach ($dbPages as $value) {
  $title[$value->link] = $value->de;
}
foreach ($dbSubpages as $value) {
  $title[$value->link] = $value->de;
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
