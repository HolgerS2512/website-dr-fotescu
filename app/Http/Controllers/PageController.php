<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AOS;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactFeedbackMail;
use App\Mail\ContactMail;
use App\Models\Content;
use App\Models\Info;
use App\Models\OpeningHours;
use App\Models\Subpage;
use App\Repositories\Page\PageRepository;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Traits\GetLangMessage;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Mime\Encoder\Base64Encoder;

/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Subpage $subpage
 * @var \App\Models\Image $images,
 * @var \App\Models\Info $infos
 * @var \App\Models\OpeningHours $opening
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
    private string|NULL $currPageLink;
    private string|NULL $postUrl;
    private string $currLanguage;
    private string $base64Logo;
    private bool $isBlogPost;
    
    private \App\Models\Page|Subpage $currPage;
    private \App\Models\Post|NULL $currPost;

    private Collection $pages;
    private Collection $subpages;
    private Collection $contentItem;
    private Collection $opening;
    private Info $infos;

    /**
     * Set $currPageLink, $currLanguage and calls setAttributes.
     *
     * @return void
     */
    public function __construct(GetPageUrlVars $urlVars, Request $request)
    {
        $this->currPageLink = $urlVars->currentPageLink;

        if (isset($urlVars->postUrl) && !is_null($urlVars->postUrl)) {
            $this->postUrl = $urlVars->postUrl;
        }

        if (!is_null($this->currPageLink)) {

            $this->isBlogPost = $urlVars->isBlogPost;

            $this->setAttributes();
        }
    }

    /**
     * Calls functions and this set attributes for this instance.
     *
     * @return void
     * 
     */
    public function setAttributes()
    {
        $this->currLanguage = app()->getLocale();

        $this->setDbValues();

        $this->currPage = $this->pages->where('weblink', "$this->currPageLink")->first() ?? $this->subpages->where('weblink', "$this->currPageLink")->first();

        if ( ! is_null($this->currPage) ) {

            if ($this->currPage instanceof Page) {
                
              $this->contentItem = $this->currPage->contents()->whereNotNull('format')->where('subpage_id', null)->orderBy('ranking')->get()->load([$this->currLanguage, "{$this->currLanguage}List"]);
            } else {
              $this->contentItem = $this->currPage->contents()->whereNotNull('format')->whereNotNull('subpage_id')->orderBy('ranking')->get()->load([$this->currLanguage, "{$this->currLanguage}List"]);

            }
        }

        $this->base64Logo = 'data:image/' . $this->infos->logo_ext . ';base64,' . base64_encode(file_get_contents(base_path($this->infos->logo_path)));

        if ($this->isBlogPost) {
            foreach ($this->contentItem as $content) {
                if ($content->url_link === $this->postUrl) {
                    $this->currPost = $content->findPost();
                }
            }
        }
    }

    /**
     * Sets db values to corresponding variables.
     *
     * @return void
     * 
     */
    public function setDbValues()
    {
        try {
            $this->pages = Page::all()->sortBy('ranking');

            $this->subpages = Subpage::all()->sortBy('ranking');

            $this->infos = Info::all()->firstOrFail();

            $this->opening = OpeningHours::all()->sortBy('ranking');
        } catch (\Throwable $th) {

            return view('errors.500');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->currPageLink)) return view('errors.404');

        if (is_null($this->currPage)) return view('errors.500');

        $blade = $this->isBlogPost ? 'feed' : 'index';

        return view("pages.$blade", [
            'currPage' => $this->currPage,
            'contentItem' => $this->contentItem ?? [],
            'pages' => $this->pages,
            'subpages' => $this->subpages,
            'infos' => $this->infos,
            'opening' => $this->opening,
            'locale' => $this->currLanguage,
            'isBlogPost' => $this->isBlogPost,
            'currPost' => $this->currPost ?? [],
            'postUrl' => $this->postUrl ?? '',
            'aos' => new AOS,
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
                'gender' => 'required|regex:/[w,m,d]{1}/',
                'firstname' => 'required|min:3|max:50',
                'lastname' => 'required|min:3|max:50',
                'email' => 'required|email',
                'phone' => 'required|regex:/(01)[0-9]*/',
                'reference' => 'required|min:3|max:50',
                'msg' => 'required|min:10|max:255',
                'terms' => 'accepted',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            $request['gender'] = $request['gender'] === 'd' ? '' : __("messages.words.gender_{$request['gender']}");

            Mail::to('schatte-@gmx.de')->send(new ContactMail($request, $this->base64Logo));
            // Mail::to($this->infos->mail)->send(new ContactMail($request, $this->base64Logo));

            Mail::to($request['email'])->send(new ContactFeedbackMail($request, $this->base64Logo));

            return redirect()->back()->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage($this->currLanguage)->contactTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage($this->currLanguage)->contactFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage($this->currLanguage)->contactFalse,
        ]);
    }

    /**
     * Response the download file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'name' => 'required|min:3|max:50',
                'path' => 'required|min:3|max:70',
            ]);

            if ($credentials->fails()) return view('errors.401');

            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            return response()->download($request->path, $request->name, $headers);
        } catch (Exception $e) {
            return view('errors.500');
        }

        return view('errors.500');
    }
}
