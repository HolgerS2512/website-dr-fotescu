<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\File\OverwriteLangMsgFiles;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

final class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $editable = Page::all();
            $name = 'Title';

            return view('admin.translation.title.index', compact('name', 'editable'));
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->databaseError,
            ]);
        }
        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->databaseError,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Request  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'name' => 'required|min:3|max:255',
                'en_name' => 'required|min:3|max:255',
                'ru_name' => 'required|min:3|max:255',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            Page::whereId($id)->update([
                'name' => $request->name,
                'en_name' => $request->en_name,
                'ru_name' => $request->ru_name,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateTrue,
            ]);

            // return redirect('translation/title#' . $id)->with([
            //     'present' => true,
            //     'status' => true,
            //     'message' => GetLangMessage::languagePackage('en')->updateTrue,
            // ]);
        } catch (Exception $e) {
            return response()->json([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->updateFalse,
            ]);
            
            // return redirect('translation/title#' . $id)->with([
            //     'present' => true,
            //     'status' => false,
            //     'message' => GetLangMessage::languagePackage('en')->updateFalse,
            // ]);
        }

        return response()->json([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }
}
