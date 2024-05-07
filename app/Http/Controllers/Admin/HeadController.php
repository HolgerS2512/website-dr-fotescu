<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\HandleDB\SetAdminDatabaseData;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Helpers\ImageConverter;
use App\Repositories\Admin\HandleLayoutRepository;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Models\Subpage;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;

/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Subpage $subpages,
 * @var \App\Models\Image $images,
 * @var \App\Models\Publish $publishes
 * @method construct
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
final class HeadController extends Controller implements HandleLayoutRepository
{
    /**
     * Saves the associated db data for the respective variable.
     *
     * @var \App\Models\Page $page,
     * @var \App\Models\Subpage $subpages,
     * @var \App\Models\Image $images,
     * @var \App\Models\Publish $publishes
     */
    private $page, $subpages, $images, $publishes;

    /**
     * Store db data in this variables $page, $images, $publishes.
     * 
     * @param \App\Repositories\Admin\DbDataRepository $dbData
     * @var   \App\Models\Page $page,
     * @var   \App\Models\Subpage $subpages,
     * @var   \App\Models\Image $images,
     * @var   \App\Models\Publish $publishes
     * @method __construct($dbData)
     * 
     */
    public function __construct(SetAdminDatabaseData $dbData)
    {
        try {
            $this->page = $dbData->page;

            $this->images = $dbData->images->where('slide', true);

            $this->publishes = $dbData->publishes;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display a listing of the resource.
     * 
     * @method index return view admin.header.index
     * 
     * @var \App\Models\Page $page
     * @var \App\Models\Subpage $subpages,
     * @var \App\Models\Image $images
     * @var \App\Models\Publish $publishes
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        try {
            return view('admin.header.index', [
                'page' => $this->page ?? [],
                'images' => $this->page->anySlideData(),
                'public' => $this->publishes->public,
            ]);
        } catch (Exception $e) {

            return view('admin.header.index', compact('e'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('admin.header.index', compact('err'));
    }

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

            $ic = new ImageConverter($request->image, 'uploads/images/' . $this->page->link . '/');
            $ic->move();

            // $manager = new ImageManager(new Driver());
            // $read_img = $manager->read($save_url);
            // $resize_img = $read_img->resize(300, 200);
            // $resize_img->toJpeg(85)->save(base_path($save_url));

            Image::insert([
                'ranking' => $request->ranking,
                'page_id' => $this->page->id,
                'slide' => 1,
                'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
                'src' => $ic->saveUrl,
                'ext' => $ic->extension,
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
    public function edit($_, $id)
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
    public function update(Request $request, $_, $id)
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
                $ic = new ImageConverter($request->image, 'uploads/images/' . $this->page->link . '/');

                if (File::exists($request->old_image)) {
                    File::delete($request->old_image);
                }

                $ic->move();

                foreach ($this->images as $image) {
                    if ($image->id === (int) $id) {
                        $image->update([
                            'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
                            'src' => $ic->saveUrl,
                            'ext' => $ic->extension,
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

            return redirect('/administration' . '/' . 'header/' . $this->page->link)->with([
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

            if ($this->publishes instanceof Collection) {
                foreach ($this->publishes as $publish) {
                    if ($publish->name ===  $this->page->link . '.slider') {
                        $publish->updateOrCreate([
                            'public' => $request->slideshow,
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            } else {
                if ($this->publishes->name ===  $this->page->link . '.slider') {
                    $this->publishes->updateOrCreate([
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
    public function up(Request $request, $_, $id)
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
     * Update the ranking of an image down in db.
     * 
     * @method down(Request $request, $id)
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * 
     * @var \App\Models\Image $images
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function down(Request $request, $_, $id)
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
    public function destroy($_, $id)
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
