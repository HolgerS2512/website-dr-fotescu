<?php

namespace App\Repositories\Head;

use App\Repositories\Head\HeadAdminInterface;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Image;
use App\Models\Publish;

class HeadAdminRepository implements HeadAdminInterface
{
  /**
   * Saves the associated db data for the respective variable.
   *
   * @var \App\Models\Page $page,
   * @var \App\Models\Image $images,
   * @var \App\Models\Publish $publishes
   */
  public $page, $images, $publishes;

  /**
   * Store db data in this variables $page, $images, $publishes.
   * 
   * @param int $pageID
   * @var   \App\Models\Page $page,
   * @var   \App\Models\Image $images,
   * @var   \App\Models\Publish $publishes
   */
  public function __construct(Request $request)
  {
    $urlLink = str_replace('header/', '', $request->path());
    $pos = strpos($urlLink, '/');

    if ($pos) {
      $urlLink = substr($urlLink, 0, $pos);
    }

    $page = Page::where('link', $urlLink)->limit(1)->get();
    $this->page = ($page)[0];

    $this->images = Image::where('page_id', $this->page->id)->orderBy('ranking')->get();
    $this->publishes = Publish::where('page_id', $this->page->id)->get();
  }
}
