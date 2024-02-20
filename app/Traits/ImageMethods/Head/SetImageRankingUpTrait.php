<?php

namespace App\Traits\ImageMethods\Head;

use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Exception;

trait SetImageRankingUpTrait
{
  /**
   * Update the ranking of an image up in db.
   * 
   * @method up(Request $request, $id)
   * 
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * 
   * @var \App\Models\Image $images
   * 
   * @return \Illuminate\Http\Response
   * 
   */
  public function up(Request $request, $id)
  {
    try {
      foreach ($this->images as $image) {

        if ($image->id === (int) $request->previous_id) {
          $image->update([
            'ranking' => $request->ranking + 1,
            'updated_at' => Carbon::now(),
          ]);
        }

        if ($image->id === (int) $id) {
          $image->update([
            'ranking' => intval($request->ranking),
            'updated_at' => Carbon::now(),
          ]);
        }
      }

      return redirect()->back();
    } catch (Exception $e) {
      return redirect()->back()->with([
        'present' => true,
        'status' => false,
        'message' => $e,
      ]);
    }

    return redirect()->back()->with([
      'present' => true,
      'status' => false,
      'message' => GetLangMessage::languagePackage('en')->updateFalse,
    ]);
  }
}
