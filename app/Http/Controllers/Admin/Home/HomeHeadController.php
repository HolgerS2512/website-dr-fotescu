<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Models\Publish;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDB;

class HomeHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $src = DB::table('home_sliders')->orderBy('ranking')->get();
            $publish = DB::table('publishes')->get();

            $slideIds = [];

            foreach ($src as $slider) {
                $slideIds[$slider->ranking] = $slider->id;
            }

            return view('admin.home.head.index', [
                'src' => $src,
                'public' => GetBoolFromDB::getBool($publish, 'home.slider'),
                'slideIds' => $slideIds,
            ]);
        } catch (Exception $e) {

            return view('admin.home.head.index', compact('e'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('admin.home.head.index', compact('err'));
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
                'title' => 'required|min:3|max:255|unique:home_sliders',
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

            $upload_location = 'uploads/home_slider/';
            $save_url = $upload_location . $img_name;

            $file->move($upload_location, $img_name);

            // $manager = new ImageManager(new Driver());
            // $read_img = $manager->read($save_url);
            // $resize_img = $read_img->resize(300, 200);
            // $resize_img->toJpeg(85)->save(base_path($save_url));

            HomeSlider::insert([
                'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
                'image' => $save_url,
                'ranking' => $request->ranking,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with([
                'present' => true,
                'message' => GetLangMessage::languagePackage('en')->uploadTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'message' => GetLangMessage::languagePackage('en')->uploadFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
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
            $slide = DB::table('home_sliders')->find($id);

            return view('admin.home.head.edit_slide', compact('slide'));
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

            $upload_location = 'uploads/home_slider/';
            $save_url = $upload_location . $img_name;

            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }

            $file->move($upload_location, $img_name);

            HomeSlider::whereId($id)->update([
                'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
                'image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            return redirect('admin.home.head')->with([
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
        $credentials = Validator::make($request->all(), [
            'slideshow' => 'required|numeric|min:0|max:1',
        ]);

        if ($credentials->fails()) {
            return redirect()->back()
            ->withErrors($credentials->errors())
            ->withInput();
        }

        try {
            Publish::where('name', 'home.slider')->update([
                'public' => $request->slideshow,
                'updated_at' => Carbon::now(),
            ]);

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
            HomeSlider::whereId($request->previous_id)->update([
                'ranking' => $request->ranking + 1,
                'updated_at' => Carbon::now(),
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => $e,
            ]);
        }

        try {
            HomeSlider::whereId($id)->update([
                'ranking' => intval($request->ranking),
                'updated_at' => Carbon::now(),
            ]);

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
            HomeSlider::whereId($request->next_id)->update([
                'ranking' => $request->ranking - 1,
                'updated_at' => Carbon::now(),
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => $e,
            ]);
        }

        try {
            HomeSlider::whereId($id)->update([
                'ranking' => intval($request->ranking),
                'updated_at' => Carbon::now(),
            ]);

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
            $check = HomeSlider::all();

            if (count($check) === 1) {
                return redirect()->back()->with([
                    'present' => true,
                    'status' => false,
                    'message' => GetLangMessage::languagePackage('en')->methodError . ' At least 1 photo must be available.',
                ]);
            }

            $slide = HomeSlider::findOrFail($id);
            $slide->delete();

            if (File::exists($slide->image)) {
                File::delete($slide->image);
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
