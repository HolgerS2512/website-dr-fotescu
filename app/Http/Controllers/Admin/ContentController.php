<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandleDB\SetAdminDatabaseData;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Content;
use App\Models\Format;
use App\Repositories\Admin\HandleLayoutRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Models\Lang\DE_Content;
use App\Models\Subpage;
use App\Traits\GetLangMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;


/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images
 * @var \App\Models\Content $content
 * @var \App\Models\Publish $publishes
 * @method construct
 * @method index
 * @method store(Request $request)
 * @method edit($id)
 * @method update(Request $request, $id)
 * @method visible(Request $request)
 * @method up(Request $request, $id)
 * @method down(Request $request, $id)
 * @method destroy($id)
 * 
 */
final class ContentController extends Controller
// implements HandleLayoutRepository
{
    /**
     * Saves the associated db data for the respective variable.
     *
     * @var \App\Models\Page $page,
     * @var \App\Models\Image $images,
     * @var \App\Models\Content $content
     * @var \App\Models\Publish $publishes
     */
    public $page, $images, $contents, $publishes;

    /**
     * Store db data in this variables $page, $images, $publishes.
     * 
     * @param \App\Repositories\Admin\DbDataRepository $dbData
     * @var   \App\Models\Page $page,
     * @var   \App\Models\Image $images,
     * @var   \App\Models\Content $content
     * @var   \App\Models\Publish $publishes
     * @method __construct($dbData)
     * 
     */
    public function __construct(SetAdminDatabaseData $dbData)
    {
        try {
            $this->page = $dbData->page;
            $this->contents = $dbData->contents;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admin.content.index', [
                'page' => $this->page,
                'contents' => $this->contents,
            ]);
        } catch (Exception $e) {

            return view('admin.content.index', compact('e'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('admin.content.index', compact('err'));
    }

    /**
     * Create a newly resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.content.create', [
                'page' => $this->page,
                'format' => Format::all(),
            ]);
        } catch (Exception $e) {

            return view('admin.content.index', compact('e'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('admin.content.index', compact('err'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $id
     * @return \Illuminate\Http\Response
     */
    public function edit($_, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $_, $id)
    {
    }

    /**
     * Update the ranking of content up or down in db.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * @return \Illuminate\Http\Response
     */
    public function changeRanking(Request $request, $_, $id)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'ranking' => 'required|numeric|min:0',
                'new_ranking' => 'required|numeric|min:0',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            $content = Content::find($id);
            $content->update([
                'ranking' => $request->new_ranking,
                'updated_at' => Carbon::now(),
            ]);

            $i = 1;
            $subpage_id = null;
            $page_id = null;

            if ($this->page instanceof Subpage) {
                $subpage_id = $this->page->id;
                $page_id = $this->page->page()->first()->id;
            }

            $contents = Content::whereNot('id', $id)
                ->where('page_id', $page_id ?? $this->page->id)
                ->where('subpage_id', $subpage_id)
                ->orderBy('ranking')
                ->get();

            foreach ($contents as $content) {
                if ($i === (int) $request->new_ranking) ++$i;
                $content->update([
                    'ranking' => $i,
                    'updated_at' => Carbon::now(),
                ]);
                ++$i;
            }

            return redirect()->back();
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
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($_, $id)
    {
        $imageIds = [];

        try {
            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                $contents = ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::all()->where('content_id', $id);
                $lists = ('\App\Models\Lang\\' . strtoupper($lang) . '_List')::all()->where('content_id', $id);

                if (!empty($contents->toArray())) {
                    foreach ($contents as $content) {
                        if ($content) $content->delete();
                        if ($content)  dump($content);
                    }
                }

                if (!empty($lists->toArray())) {
                    foreach ($lists as $list) {
                        if ($list) $list->delete();
                        if ($list) dump($list);
                    }
                }
            }

            $rmContent = Content::find($id);

            if ($rmContent->format === 'headline_image' || $rmContent->format === 'image_overlap' || $rmContent->format === 'image_solo') {
                if ($rmContent->image_id) $imageIds[] = $rmContent->image_id;

                $imgLangCon = ('\App\Models\Lang\\' . strtoupper(GetPageUrlVars::$hasLanguages['base']) . '_Content')::all()->where('content_id', $rmContent->id);

                if (!empty($imgLangCon->toArray())) {
                    foreach ($imgLangCon as $item) {
                        if ($item->image_id) $imageIds[] = $item->image_id;
                    }
                }
            }

            if (!empty($imageIds)) {

                $imgs = Image::whereIn('id', $imageIds)->get();

                if (!empty($imgs->toArray())) {
                    foreach ($imgs as $img) {
                        if (File::exists($img->src)) File::delete($img->src);
                        $img->delete();
                    }
                }
            }

            $rmContent->delete();

            if ($rmContent) {
                return response()->json([
                    'present' => true,
                    'status' => true,
                    'message' => GetLangMessage::languagePackage('en')->deleteConTrue,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->deleteConFalse,
            ]);
        }

        return response()->json([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->deleteConFalse,
        ]);
    }
}
