<?php

namespace App\Repositories\Admin;

use App\Models\Content;
use App\Repositories\Admin\DbDataInterface;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Image;
use App\Models\Publish;
use App\Repositories\Http\GetPageLinkRepository;

/**
 * Contains this methods and variables.
 * 
 * @param \Illuminate\Http\Request $request
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images
 * @var \App\Models\Content $content
 * @var \App\Models\Publish $publishes
 * @method construct(Request $request, GetPageLinkRepository $adminRoute)
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
   * @param \App\Repositories\Http\GetPageLinkRepository $adminRoute
   * @var   \App\Models\Page $page
   * @var   \App\Models\Image $images
   * @var   \App\Models\Content $content
   * @var   \App\Models\Publish $publishes
   */
  public function __construct(Request $request, GetPageLinkRepository $adminRoute)
  {
    $is_head_Method = str_contains($request->path(), 'content');

    $page = Page::where('link', $adminRoute->adminPageLink)->limit(1)->get();
    $this->page = ($page)[0];

    $this->images = Image::where('page_id', $this->page->id)->orderBy('ranking')->get();

    if ($is_head_Method) {
      $this->content = Content::where('page_id', $this->page->id)->orderBy('ranking')->get();
    }

    $this->publishes = Publish::where('page_id', $this->page->id)->get();
  }
}
