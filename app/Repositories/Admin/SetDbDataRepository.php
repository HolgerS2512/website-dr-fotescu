<?php

namespace App\Repositories\Admin;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;

interface SetDbDataRepository
{
  /**
   * Store db data in this variables.
   *
   * @method __construct(GetPageUrlVars $urlVars)
   * 
   */
  public function __construct(GetPageUrlVars $urlVars);
}
