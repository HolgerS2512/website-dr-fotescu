<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactFeedbackMail;
use App\Mail\ContactMail;
use App\Models\Publish;
use App\Repositories\Page\PageRepository;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Traits\GetLangMessage;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDB;

/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images,
 * @var \App\Models\Publish $publishes
 * @var \App\Models\Content $contents
 * @var \App\Models\ContentList $contentLists
 * @var \App\Models\Lang\DE_content $deContents
 * @var \App\Models\Lang\EN_content $enContents
 * @var \App\Models\Lang\RU_content $ruContents
 * @method index
 * @method store(Request $request)
 * 
 */
final class PageController extends Controller implements PageRepository
{
    private $currentPageLink;
    private $pageValues;

    private array $imageValues;
    private $publicValues;

    public function __construct(GetPageUrlVars $urlVars)
    {
        $this->currentPageLink = $urlVars->currentPageLink;

        $this->pageValues = Page::all()->where('link', "$this->currentPageLink")[0];

        $images = $this->pageValues->images()->where('slide', true)->orderBy('ranking')->get();

        foreach ($images as $key => $image) {
            $this->imageValues[$key] = (object) $image->only(['title', 'image']);
        }

        $this->publicValues = GetBoolFromDB::getBool(Publish::all(), "$this->currentPageLink.slider");
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.$this->currentPageLink", [
            'src' => $this->imageValues,
            'public' => $this->publicValues,
        ]);
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
                'name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'reference' => 'required|min:3|max:50',
                'msg' => 'required|min:10|max:255',
                'terms' => 'accepted',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($request));

            Mail::to($request['email'])->send(new ContactFeedbackMail);

            return redirect()->back()->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage()->contactTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage()->contactFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage()->contactFalse,
        ]);
    }
}
