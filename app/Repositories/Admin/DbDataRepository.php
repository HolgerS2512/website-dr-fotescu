<?php

namespace App\Repositories\Admin;

use App\Models\Content;
use App\Repositories\Admin\DbDataInterface;
use App\Models\Page;
use App\Models\Image;
use App\Models\Publish;
use App\Repositories\Http\GetPageLinkRepository;

/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images
 * @var \App\Models\Content $content
 * @var \App\Models\Publish $publishes
 * @method construct(Request $request, GetPageLinkRepository $adminURL)
 * 
 */
class DbDataRepository implements DbDataInterface
{
  /**
   * Saves the associated db data for the respective variable.
   *
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images
   * @var \App\Models\Content $content
   * @var \App\Models\Publish $publishes
   */
  public $page, $images, $content, $publishes;

  /**
   * Store db data in this variables $page, $images, $publishes.
   * 
   * @param \Illuminate\Http\Request $request
   * @param \App\Repositories\Http\GetPageLinkRepository $adminURL
   * @var   \App\Models\Page $page
   * @var   \App\Models\Image $images
   * @var   \App\Models\Content $content
   * @var   \App\Models\Publish $publishes
   */
  public function __construct(GetPageLinkRepository $adminURL)
  {
    $page = Page::where('link', $adminURL->currentPageLink)->limit(1)->get();
    $this->page = ($page)[0];

    $this->images = Image::where('page_id', $this->page->id)->orderBy('ranking')->get();

    if ($adminURL::isHeadMethod()) {
      $this->content = Content::where('page_id', $this->page->id)->orderBy('ranking')->get();
    }

    $this->publishes = Publish::where('page_id', $this->page->id)->get();
  }
}
