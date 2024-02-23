<?php

namespace App\Repositories\Admin;

use App\Repositories\Http\GetPageLinkRepository;
use Illuminate\Http\Request;

interface DbDataInterface
{
  /**
   * Store db data in the variables.
   *
   * @param \IApp\Repositories\Http\GetPageLinkRepository $adminURL
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images
   * @var \App\Models\Content $content
   * @var \App\Models\Publish $publishes
   * @return void
   */
  public function __construct(GetPageLinkRepository $adminURL);
}
