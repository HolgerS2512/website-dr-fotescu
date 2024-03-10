<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactFeedbackMail;
use App\Mail\ContactMail;
use App\Models\Content;
use App\Models\Publish;
use App\Repositories\Page\PageRepository;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Traits\GetLangMessage;
use Illuminate\Support\Facades\DB;
use App\Traits\GetBoolFromDB;
use Illuminate\Database\Eloquent\Collection;

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
 * @method construct(GetPageUrlVars $urlVars, Request $request)
 * @method index
 * @method contact(Request $request)
 * 
 */
final class PageController extends Controller implements PageRepository
{
    private $currentPageLink;
    private $pageValues;

    private Collection $contentItem;
    private array $slideImages;
    private $isSlideshow;

    public function __construct(GetPageUrlVars $urlVars, Request $request)
    {
        $this->currentPageLink = $urlVars->currentPageLink;

        $this->pageValues = Page::where('link', "$this->currentPageLink")->get()->first();

        $this->contentItem = $this->pageValues->contents()->orderBy('ranking')->get()->load([$urlVars::getLanguage(), 'list']);

        $images = $this->pageValues->images()->where('slide', true)->orderBy('ranking')->get();

        foreach ($images as $key => $image) {
            $this->slideImages[$key] = (object) $image->only(['title', 'image']);
        }

        $this->isSlideshow = GetBoolFromDB::getBool(Publish::all(), "$this->currentPageLink.slider");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index', [
            'contentItem' => $this->contentItem,
            'slideSrc' => $this->slideImages,
            'isSlideshow' => $this->isSlideshow,
        ]);
    }

    /**
     * Sends a contact email to the recipient and a confirmation to the email sender.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
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
