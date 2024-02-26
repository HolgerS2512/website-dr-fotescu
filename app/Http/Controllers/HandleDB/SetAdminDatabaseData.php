<?php

namespace App\Http\Controllers\HandleDB;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Content;
use App\Repositories\Admin\SetDbDataRepository;
use App\Models\Page;
use App\Models\Image;
use App\Models\Publish;

/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images
 * @var \App\Models\Content $content
 * @var \App\Models\Publish $publishes
 * @method __construct(GetPageUrlVars $urlVars)
 * 
 */
class SetAdminDatabaseData implements SetDbDataRepository
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
   * Store db data in this variables.
   * 
   * @param \App\Http\Controllers\HandleHttp\GetPageUrlVars
   * @var   \App\Models\Page $page
   * @var   \App\Models\Image $images
   * @var   \App\Models\Content $content
   * @var   \App\Models\Publish $publishes
   * @return void
   * 
   */
  public function __construct(GetPageUrlVars $urlVars)
  {
    $page = Page::where('link', $urlVars->currentPageLink)->limit(1)->get();
    $this->page = ($page)[0];

    $this->images = Image::where('page_id', $this->page->id)->orderBy('ranking')->get();

    if ($urlVars::isHeadMethod()) {
      $this->content = Content::where('page_id', $this->page->id)->orderBy('ranking')->get();
    }

    $this->publishes = Publish::where('page_id', $this->page->id)->get();
  }
}
