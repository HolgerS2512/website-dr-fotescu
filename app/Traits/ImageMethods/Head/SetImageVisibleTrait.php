<?php

namespace App\Traits\ImageMethods\Head;

use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;

trait SetImageVisibleTrait
{
  /**
   * Update the specified resource in storage.
   * 
   * @method visible(Request $request)
   * 
   * @param  \Illuminate\Http\Request $request
   * 
   * @var \App\Models\Page $page
   * @var \App\Models\Publish $publishes
   * 
   * @return \Illuminate\Http\Response
   * 
   */
  public function visible(Request $request)
  {
    try {
      $credentials = Validator::make($request->all(), [
        'slideshow' => 'required|numeric|min:0|max:1',
      ]);

      if ($credentials->fails()) {
        return redirect()->back()
          ->withErrors($credentials->errors())
          ->withInput();
      }

      foreach ($this->publishes as $is_public) {
        if ($is_public->name ===  $this->page->link . '.slider') {
          $is_public->update([
            'public' => $request->slideshow,
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
