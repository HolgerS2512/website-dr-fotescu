<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lang\Word;
use Exception;
use Illuminate\Http\Request;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class TranslationController extends Controller
{
    /**
     * Stores a specific model resource.
     *
     * @param  \Illuminate\Http\Request  $name
     * @var     \Illuminate\Database\Eloquent\Model
     */
    private Model $model;

    /**
     * Set the variable $model.
     *
     * @param  \Illuminate\Http\Request  $name
     * @var    \Illuminate\Database\Eloquent\Model
     * @return void
     */
    public function setModel($name)
    {
        switch ($name) {
            case 'Words':
                $this->model = new Word;
                break;
            case 'Title':
                $this->model = new Page;
                break;
            default:
                break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        try {
            $name = ucfirst(strtolower($name));
            $this->setModel($name);

            return view('admin.translation.index', [
                'name' => $name, 
                'editable' => $this->model::all(),
            ]);
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
     * @param  \Illuminate\Http\Request  $name
     * @param  \Illuminate\Http\Request  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name, $id)
    {
        try {
            $name = ucfirst(strtolower($name));
            $this->setModel($name);

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

            $this->model::whereId($id)->update([
                'de' => $request->de,
                'en' => $request->en,
                'ru' => $request->ru,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->updateTrue,
            ]);
            // return back()->with([
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
        }

        return response()->json([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->updateFalse,
        ]);
    }
}
