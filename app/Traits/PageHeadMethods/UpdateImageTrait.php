<?php

namespace App\Traits\PageHeadMethods;

use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Exception;

trait UpdateImageTrait
{
  /**
   * Update the specified resource in storage.
   * 
   * @method update(Request $request, $id)
   * 
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * 
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images
   * 
   * @return \Illuminate\Http\Response
   * 
   */
  public function update(Request $request, $link, $id)
  {
    try {
      $credentials = Validator::make($request->all(), [
        'title' => 'min:3|max:255',
        'image' => 'mimes:jpg,png,webp,jpeg',
      ]);

      if ($credentials->fails()) {
        return redirect()->back()
          ->withErrors($credentials->errors())
          ->withInput();
      }

      if (!empty($request->file('image'))) {

        $file = $request->file('image');

        $name = str_replace(' ', '-', strtolower($request->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden';
        $extension = strtolower($file->getClientOriginalExtension());
        $img_name = $name . '.' . $extension;

        $upload_location = 'uploads/images/' . $this->page->link . '/';
        $save_url = $upload_location . $img_name;

        if (File::exists($request->old_image)) {
          File::delete($request->old_image);
        }

        $file->move($upload_location, $img_name);

        foreach ($this->images as $image) {
          if ($image->id === (int) $id) {
            $image->update([
              'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
              'image' => $save_url,
              'updated_at' => Carbon::now(),
            ]);
          }
        }
      } else {

        foreach ($this->images as $image) {
          if ($image->id === (int) $id) {
            $image->update([
              'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
              'updated_at' => Carbon::now(),
            ]);
          }
        }
      }

      return redirect('/'.'header/'.$this->page->link)->with([
        'present' => true,
        'status' => true,
        'message' => GetLangMessage::languagePackage('en')->updateTrue,
      ]);
    } catch (Exception $e) {
      return redirect()->back()->with([
        'present' => true,
        'status' => false,
        'message' => GetLangMessage::languagePackage('en')->updateFalse,
      ]);
    }

    return redirect()->back()->with([
      'present' => true,
      'status' => false,
      'message' => GetLangMessage::languagePackage('en')->updateFalse,
    ]);
  }
}
