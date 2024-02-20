<?php

namespace App\Repositories\Image;

use App\Models\Page;

class HeadAdminRepository
{
  public function __construct()
  {
    Page::all();
    $current = url()->current();
 
    $previous = url()->previous();
  }
}
