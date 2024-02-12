<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager as Image;
use Exception;

class HomeSliderController extends Controller
{
    /**
     * Save user title & image in public/assets/img/home_slider/.
     *
     * @param array \Illuminate\Http\Request;
     * @return \app\Models\HomeSlider
     */
    public function store(Request $request)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'title' => 'required|string|min:3|max:255|unique:home_sliders',
                'image' => 'required|mimes:jpg.jpeg,png,webp',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            $image = $request->file('image');

            $name = str_replace(' ', '-', strtolower($request->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden';
            $image_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name . '.' . $image_ext;

            $up_location = 'assets/img/home_slider/';
            $last_img = $up_location . $img_name;

            $image->move($up_location, $img_name);

            HomeSlider::insert([
                'title' => trim($request->title),
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with([
                'status' => true,
                'message' => GetLangMessage::languagePackage()->sliderTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => false,
                'message' => GetLangMessage::languagePackage()->sliderFalse,
            ]);
        }

        return redirect()->back()->with([
            'status' => false,
            'message' => GetLangMessage::languagePackage()->sliderFalse,
        ]);
    }
}
