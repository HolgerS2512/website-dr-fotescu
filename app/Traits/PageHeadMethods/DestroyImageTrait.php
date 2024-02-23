<?php

namespace App\Traits\PageHeadMethods;

use App\Models\Image;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Exception;

trait DestroyImageTrait
{
  /**
   * Remove the an image from storage.
   * 
   * @method destroy($id)
   * 
   * @param  \Illuminate\Http\Request $id
   * 
   * @var \App\Models\Image $images
   * 
   * @return \Illuminate\Http\Response
   * 
   */
  public function destroy($link, $id)
  {
    try {
      if (count($this->images) === 1) {
        return redirect()->back()->with([
          'present' => true,
          'status' => false,
          'message' => GetLangMessage::languagePackage('en')->methodError . ' At least 1 image must be available.',
        ]);
      }

      foreach ($this->images as $image) {
        if ($image->id === (int) $id) {
          if (File::exists($image->image)) {
            File::delete($image->image);
          }
          $image->delete();
        }
      }

      $data = $this->images;

      for ($i = 0; $i < count($this->images); $i++) {
        Image::whereId($data[$i]->id)->update([
          'ranking' => ($i + 1),
          'updated_at' => Carbon::now(),
        ]);
      }

      return redirect()->back()->with([
        'present' => true,
        'status' => true,
        'message' => GetLangMessage::languagePackage('en')->deleteTrue,
      ]);
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
