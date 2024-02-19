<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Image;
use App\Models\Publish;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDB;

/**
 * The HeadController must contain these methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images,
 * @var \App\Models\Publish $publishes
 * @method __construct()
 * @method index
 * @method store(Request $request)
 * @method edit($id)
 * @method update(Request $request, $id)
 * @method visible(Request $request)
 * @method up(Request $request, $id)
 * @method down(Request $request, $id)
 * @method destroy($id)
 * 
 */
trait HeadControllerRepository
{
  /**
   * Stores the associated data for the respective page.
   *
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images,
   * @var \App\Models\Publish $publishes
   */
  public $page, $images, $publishes;

  /**
   * Saves the data for the respective page in the variable.
   *
   * @var \App\Models\Page $page
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

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
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

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
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
        'page_id' => $this->pageID,
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

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Illuminate\Http\Request  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
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

      return redirect($this->page->link . '/header')->with([
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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * @return \Illuminate\Http\Response
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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request  $id
   * @return \Illuminate\Http\Response
   */
  public function down(Request $request, $id)
  {
    try {
      foreach ($this->images as $image) {

        if ($image->id === (int) $request->next_id) {
          $image->update([
            'ranking' => $request->ranking - 1,
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Illuminate\Http\Request  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
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
