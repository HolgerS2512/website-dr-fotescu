<?php

namespace App\Repositories\Head;

use Illuminate\Http\Request;

interface HeadAdminInterface
{
  /**
   * Store db data in the variables.
   *
   * @param \Illuminate\Http\Request $request
   * @var \App\Models\Page $page,
   * @var \App\Models\Image $images,
   * @var \App\Models\Publish $publishes
   * @return void
   */
  public function __construct(Request $request);
}
