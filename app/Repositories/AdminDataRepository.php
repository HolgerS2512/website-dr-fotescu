<?php

namespace App\Repositories;

use App\Models\Content;
use App\Repositories\AdminInterface;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Image;
use App\Models\Publish;

/**
 * Contains this methods and variables.
 * 
 * @param \Illuminate\Http\Request $request
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images
 * @var \App\Models\Content $content
 * @var \App\Models\Publish $publishes
 * @method construct
 * @method getLinkCode(Request $request): string
 * 
 */
class AdminDataRepository implements AdminInterface
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
   * @var   \App\Models\Page $page
   * @var   \App\Models\Image $images
   * @var   \App\Models\Content $content
   * @var   \App\Models\Publish $publishes
   */
  public function __construct(Request $request)
  {
    $pageUrl = $this->getLinkCode($request);

    $is_head_Method = str_contains($request->path(), 'content');

    $page = Page::where('link', $pageUrl)->limit(1)->get();
    $this->page = ($page)[0];

    $this->images = Image::where('page_id', $this->page->id)->orderBy('ranking')->get();

    if ($is_head_Method) {
      $this->content = Content::where('page_id', $this->page->id)->orderBy('ranking')->get();
    }

    $this->publishes = Publish::where('page_id', $this->page->id)->get();
  }

  /**
   * Returns the respective page contained in the URL.
   *
   * @param \Illuminate\Http\Request $request
   * @return string
   */
  public function getLinkCode(Request $request): string
  {
    $pageUrl = str_replace('header/', '', $request->path());
    $pos = strpos($pageUrl, '/');

    if ($pos) {
      $pageUrl = substr($pageUrl, 0, $pos);
    }

    return $pageUrl;
  }
}
