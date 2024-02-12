<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
use Exception;
use Illuminate\Support\Facades\File;

class HomeSliderController extends Controller
{
    /**
     * Save user title & image in public/uploads/home_slider/.
     *
     * @param array \Illuminate\Http\Request;
     * @return \app\Models\HomeSlider
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
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with([
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->imageTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->imageFalse,
            ]);
        }

        return redirect()->back()->with([
            'status' => true,
            'message' => GetLangMessage::languagePackage('en')->imageFalse,
        ]);
    }

    /**
     * Update user title & image in public/uploads/home_slider/.
     *
     * @param array \Illuminate\Http\Request;
     * @param string $id;
     * @return \app\Models\HomeSlider
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

            HomeSlider::findOrFail($id)->update([
                'title' => mb_strtolower(str_replace(' ', '-', $request->title)),
                'image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            return redirect('dashboard')->with([
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateFalse,
            ]);
        }

        return redirect()->back()->with([
            'status' => true,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }

    /**
     * Delete this slide in public/uploads/home_slider/ & database.
     *
     * @param string $id;
     * @return \app\Models\HomeSlider
     */
    public function destroy($id)
    {
        try {
            $slide = HomeSlider::findOrFail($id);
            $slide->delete();

            if (File::exists($slide->image)) {
                File::delete($slide->image);
            }

            return redirect()->back()->with([
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->deleteTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->deleteFalse,
            ]);
        }

        return redirect()->back()->with([
            'status' => true,
            'message' => GetLangMessage::languagePackage('en')->deleteFalse,
        ]);
    }
}
