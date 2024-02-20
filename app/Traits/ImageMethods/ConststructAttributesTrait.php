<?php

namespace App\Traits\ImageMethods;

use App\Models\Page;
use App\Models\Image;
use App\Models\Publish;
use App\Traits\GetLangMessage;
use Exception;

trait ConststructAttributesTrait
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
   * @method __construct()
   *
   * @param int $pageID
   * @var   \App\Models\Page $page,
   * @var   \App\Models\Image $images,
   * @var   \App\Models\Publish $publishes
   */
  public function __construct()
  {
    try {
      $this->page = Page::find($this->pageID);
      $this->images = Image::where('page_id', $this->pageID)->orderBy('ranking')->get();
      $this->publishes = Publish::where('page_id', $this->pageID)->get();
    } catch (Exception $e) {
      redirect()->back()->with([
        'present' => true,
        'status' => false,
        'message' => GetLangMessage::languagePackage('en')->databaseError,
      ]);
    }
  }
}
