<?php

namespace App\Traits\ImageMethods\Head;

use App\Traits\GetLangMessage;
use Exception;

trait EditImageTrait
{
  /**
   * Show the form for editing the specified resource.
   * 
   * @method edit($id)
   * 
   * @param  \Illuminate\Http\Request $id
   * 
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images
   * 
   * @return \Illuminate\Http\Response
   * 
   */
  public function edit($id)
  {
    try {
      foreach ($this->images as $image) {
        if ($image->id === (int) $id) {
          return view('admin.header.edit_image', [
            'image' => $image,
            'page' => $this->page,
          ]);
        }
      }
    } catch (Exception $e) {
      return redirect()->back()->with([
        'present' => true,
        'status' => false,
        'message' => GetLangMessage::languagePackage('en')->deleteFalse,
      ]);
    }

    return redirect()->back()->with([
      'present' => true,
      'status' => false,
      'message' => GetLangMessage::languagePackage('en')->deleteFalse,
    ]);
  }
}
