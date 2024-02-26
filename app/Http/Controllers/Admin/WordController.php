<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lang\Word;
use Exception;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

final class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $editable = Word::all();
            $name = 'Words';

            return view('admin.translation.words.index', compact('name', 'editable'));
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
                'de' => 'required|min:3|max:255',
                'en' => 'required|min:3|max:255',
                'ru' => 'required|min:3|max:255',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            Word::whereId($id)->update([
                'de' => $request->de,
                'en' => $request->en,
                'ru' => $request->ru,
                'updated_at' => Carbon::now(),
            ]);

            return redirect('translation/words#' . $id)->with([
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