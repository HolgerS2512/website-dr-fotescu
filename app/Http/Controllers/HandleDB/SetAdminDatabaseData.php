<?php

namespace App\Http\Controllers\HandleDB;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Content;
use App\Repositories\Admin\SetDbDataRepository;
use App\Models\Page;
use App\Models\Publish;
use App\Models\Subpage;

/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Subpage $subpages
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
   * @var \App\Models\Subpage $subpages
   * @var \App\Models\Image $images
   * @var \App\Models\Content $content
   * @var \App\Models\Publish $publishes
   */
  public $page, $subpages, $images, $content, $publishes;

  /**
   * Store db data in this variables.
   * 
   * @param \App\Http\Controllers\HandleHttp\GetPageUrlVars
   * @var   \App\Models\Page $page
   * @var   \App\Models\Subpage $subpages
   * @var   \App\Models\Image $images
   * @var   \App\Models\Content $content
   * @var   \App\Models\Publish $publishes
   * @return void
   * 
   */
  public function __construct(GetPageUrlVars $urlVars)
  {
    $this->page = Page::where('link', $urlVars->currentPageLink)->get()->first();

    if (is_null($this->page)) {
      $this->page = Subpage::where('link', $urlVars->currentPageLink)->get()->first();
    }

    if (isset($this->page->any_pages) && $this->page->any_pages) {
      $this->subpages = Subpage::all()->where('page_id', $this->page->id)->sortBy('ranking');
    }

    if ( $urlVars::isHeadMethod() ) {
      $this->images = $this->page->images()->orderBy('ranking')->get();
      $this->publishes = $this->page->publishes()->get()->first();
    } else {
      $this->content = $this->page->contents()->orderBy('ranking')->get();
    }
  }
}
