<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactFeedbackMail;
use App\Mail\ContactMail;
use App\Models\Content;
use App\Models\Info;
use App\Models\OpeningHours;
use App\Models\Publish;
use App\Models\Subpage;
use App\Repositories\Page\PageRepository;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Traits\GetLangMessage;
use Illuminate\Support\Facades\DB;
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
final class PageController extends Controller 
// implements PageRepository
{
    private string $currPageLink;
    private string $currLanguage;
    
    private $pageValues;
    private $subpageValues;

    private Collection $pages;
    private Collection $subpages;
    private Collection $contentItem;

    private array $slideImages;
    private bool $isSlideshow;

    /**
     * Set $currPageLink, $currLanguage and calls setAttributes.
     *
     * @return void
     */
    public function __construct(GetPageUrlVars $urlVars, Request $request)
    {
        $this->currLanguage = $urlVars::getLanguage();

        $this->currPageLink = $urlVars->currentPageLink;

        $this->setAttributes();
    }

    /**
     * Calls functions and this set attributes for this instance.
     *
     * @return void
     * 
     */
    public function setAttributes()
    {
        $this->setWebpages();

        $this->pageValues = $this->pages->where('weblink', "$this->currPageLink")->first();
        // $this->subpageValues = $this->subpages->where('weblink', "$this->currentPageLink")->first();

        if (is_null($this->pageValues)) dd('url values test =>', $this->pageValues, $this->pageValues);
        if (!is_null($this->pageValues)) {

            $this->contentItem = $this->pageValues->contents()->orderBy('ranking')->get()->load([$this->currLanguage, "{$this->currLanguage}List"]);

            $slideImages = $this->pageValues->images()->where('slide', true)->orderBy('ranking')->get();

            foreach ($slideImages as $key => $image) {
                $this->slideImages[$key] = (object) $image->only(['title', 'src', 'ext']);
            }

            $publishes = Publish::all()->where('name', $this->pageValues->link . '.slider')->first();
            if (!is_null($publishes)) {
                $this->isSlideshow = ($publishes->only(['public']))['public'];
            }
        }
    }

    /**
     * Sets webpage db values to corresponding variables.
     *
     * @return void
     * 
     */
    public function setWebpages()
    {
        $this->pages = Page::all()->sortBy('ranking');

        $this->subpages = Subpage::all()->sortBy('ranking');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->pageValues)) {
            return view('errors.500');
        }

        return view('pages.index', [
            'currPageValues' => $this->pageValues,
            'contentItem' => $this->contentItem ?? [],
            'slideSrc' => $this->slideImages ?? [],
            'isSlideshow' => $this->isSlideshow ?? [],
            'pages' => $this->pages,
            'subpages' => $this->subpages,
            'infos' => Info::all()->firstOrFail(),
            'opening' => OpeningHours::all()->sortBy('ranking'),
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
