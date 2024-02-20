<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface AdminInterface
{
  /**
   * Store db data in the variables.
   *
   * @param \Illuminate\Http\Request $request
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images
   * @var \App\Models\Content $content
   * @var \App\Models\Publish $publishes
   * @return void
   */
  public function __construct(Request $request);

  /**
   * Returns the respective page contained in the URL.
   *
   * @param \Illuminate\Http\Request $request
   * @return string $pageUrl
   */
  public function getLinkCode(Request $request): string;
}
