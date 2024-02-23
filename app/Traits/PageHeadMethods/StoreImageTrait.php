<?php

namespace App\Traits\PageHeadMethods;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
use Exception;

trait StoreImageTrait
{
  /**
   * Store a newly created image in storage.
   * 
   * @method store(Request $request)
   * @param  \Illuminate\Http\Request $request
   * @var \App\Models\Page $page
   * @var int $pageID
   * @return \Illuminate\Http\Response
   * 
   */
  public function store(Request $request)
  {
    try {
      $credentials = Validator::make($request->all(), [
        'title' => 'required|min:3|max:255',
        'image' => 'required|mimes:jpg,png,webp,jpeg',
      ]);

      if ($credentials->fails()) {
        return redirect()->back()
          ->withErrors($credentials->errors())
          ->withInput();
      }

      $file = $request->file('image');

      $name = str_replace(' ', '-', strtolower($request->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden';
      $extension = strtolower($file->getClientOriginalExtension());
      $img_name = $name . '.' . $extension;

      $upload_location = 'uploads/images/' . $this->page->link . '/';
      $save_url = $upload_location . $img_name;

      $file->move($upload_location, $img_name);

      // $manager = new ImageManager(new Driver());
      // $read_img = $manager->read($save_url);
      // $resize_img = $read_img->resize(300, 200);
      // $resize_img->toJpeg(85)->save(base_path($save_url));

      Image::insert([
        'ranking' => $request->ranking,
        'page_id' => $this->page->id,
        'slide' => 1,
        'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
        'image' => $save_url,
        'created_at' => Carbon::now(),
      ]);

      return redirect()->back()->with([
        'present' => true,
        'status' => true,
        'message' => GetLangMessage::languagePackage('en')->uploadTrue,
      ]);
    } catch (Exception $e) {
      return redirect()->back()->with([
        'present' => true,
        'status' => false,
        'message' => GetLangMessage::languagePackage('en')->uploadFalse,
      ]);
    }

    return redirect()->back()->with([
      'present' => true,
      'status' => false,
      'message' => GetLangMessage::languagePackage('en')->uploadFalse,
    ]);
  }
}
