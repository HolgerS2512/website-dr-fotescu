<?php

namespace App\Traits\PageHeadMethods;

use App\Traits\GetLangMessage;
use App\Traits\GetBoolFromDB;
use Exception;

trait GetImageIndexTrait
{
  /**
   * Display a listing of the resource.
   * 
   * @method index return view admin.header.index
   * 
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images
   * @var \App\Models\Publish $publishes
   * 
   * @return \Illuminate\Http\Response
   * 
   */
  public function index()
  {
    try {
      $imageIds = [];

      foreach ($this->images as $image) {
        $imageIds[$image->ranking] = $image->id;
      }

      return view('admin.header.index', [
        'page' => $this->page,
        'src' => $this->images,
        'public' => GetBoolFromDB::getBool($this->publishes, $this->page->link . '.slider'),
        'imageIds' => $imageIds,
      ]);
    } catch (Exception $e) {

      return view('admin.header.index', compact('e'));
    }
    $err = GetLangMessage::languagePackage('en')->databaseError;

    return view('admin.header.index', compact('err'));
  }
}
