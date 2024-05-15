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
use App\Models\Lang\Word;
use App\Models\Page;
use App\Models\Publish;
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
     * Contains the request variables with validation rules.
     *
     * @param  \Illuminate\Http\Request
     * @var array
     */
    private array $validateRules;

    /**
     * Contains the request variables for the respective language.
     *
     * @param  \Illuminate\Http\Request
     * @var array
     */
    private array $persistValues;

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
        $result = [];
        try {
            $result['page'] = $this->page;
            $result['content'] = Content::find($id);
            $result['pages'] = Page::all();
            $result['subpages'] = Subpage::all();
            $result['words'] = Word::all();

            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                $result[$lang . 'Content'] = ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::where('content_id', $id)->get();
                $result[$lang . 'List'] = ('\App\Models\Lang\\' . strtoupper($lang) . '_List')::where('content_id', $id)->get();
            }

            // dd($result);
            return view('admin.content.edit', $result);
        } catch (Exception $e) {

            return view('admin.content.index', compact('e'));
        }
        $err = GetLangMessage::languagePackage('en')->databaseError;

        return view('admin.content.index', compact('err'));
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
        try {
            $this->setValidateRules(array_filter($request->all()));
            $credentials = Validator::make($request->all(), $this->validateRules);
            
            if ($credentials->fails()) {
                return redirect()->back()
                ->withErrors($credentials->errors())
                ->withInput();
            }

            $VALUES = $this->buildValueContainer();
            // dump($this->validateRules);
            dd($credentials->fails(), $id, $this->persistValues);


            // if ($request->ranking !== $request->new_ranking) {
            //     $i = 1;
            //     foreach (Post::whereNot('id', $postId)->orderBy('ranking')->get() as $pModel) {
            //         if ($i === (int) $request->new_ranking) ++$i;
            //         $pModel->update(['ranking' => $i]);
            //         ++$i;
            //     }
            // }

            // $post = Post::find($postId);
            // $post->update([
            //     'ranking' => $request->new_ranking,
            //     'de' => $request->de,
            //     'en' => $request->en,
            //     'ru' => $request->ru,
            // ]);

            // $conTable = Content::find($conId);
            // $conTable->update([
            //     'url_link' => $post->getUrl(),
            // ]);

            // if ($request->image) {
            //     $ic = new ImageConverter($request->image, 'uploads/images/posts/');
            //     $ic->move();

            //     if ($request->old_image && File::exists($request->old_image)) {
            //         File::delete($request->old_image);
            //     }

            //     $img = Image::updateOrCreate([
            //         'id' => $post->image_id ?? null,
            //     ], [
            //         'page_id' => 3,
            //         'src' => $ic->saveUrl,
            //         'ext' => $ic->extension,
            //     ]);

            //     if ($img->id) {
            //         $post->update(['image_id' => $img->id]);
            //     }
            // }

            // foreach (GetPageUrlVars::getAllLangs() as $lang) {
            //     foreach ($this->filtedLang($lang, $this->persistValues) as $values) {
            //         if (array_key_exists('id', $values)) {
            //             ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::whereId(array_slice($values, 0, 1)['id'])
            //                 ->update(array_slice($values, 1));
            //         } else {
            //             $values['content_id'] = $conId;
            //             $deCon = ('\App\Models\Lang\\' . strtoupper($lang) . '_Content')::create($values);
            //             $deCon->save();
            //         }
            //     }
            // }

            return redirect()->back()->with([
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * @return \Illuminate\Http\Response
     */
    public function visible(Request $request, $_, $id)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'public' => 'required|numeric|min:0|max:1',
            ]);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            $pub = Publish::find($id);
            $pub->update([
                'public' => $request->public,
                'updated_at' => Carbon::now(),
            ]);

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

    /**
     * Filters the request and sets the variable values for validation.
     *
     * @param array $requVal
     * @return void
     */
    public function setValidateRules($requVal)
    {
        $rule = [
            false => 'max:255',
            true => 'max:4000',
        ];

        $this->persistValues = array_filter($requVal, function ($v) {
            return !($v === '_method' || $v === '_token');
        }, ARRAY_FILTER_USE_KEY);

        $this->persistValues = array_map(function ($val) {
            return preg_replace('/\r\n/', '<br>', trim($val));
        }, $this->persistValues);

        if (!array_key_exists('image', $this->persistValues)) unset($this->persistValues['old_image']);
        if (!array_key_exists('content_image', $this->persistValues)) unset($this->persistValues['content_old_image']);

        foreach ($this->persistValues as $key => $_) {

            if (!str_contains($key, 'image') && !str_contains($key, 'url_link') && !str_contains($key, 'btn')) {
                $this->validateRules[$key] = "required|min:2|{$rule[str_contains($key, 'content')]}";
            }
            if (str_contains($key, 'image')) {
                $this->validateRules[$key] = 'mimes:jpg,png,webp,jpeg';
            }
            if (str_contains($key, 'old_image')) {
                $this->validateRules[$key] = 'required|numeric';
            }
            if (str_contains($key, 'url_link') || str_contains($key, 'btn')) {
                $this->validateRules[$key] = 'required|min:1';
            }
        }

        // $this->validateRules['ranking'] = 'required|numeric|min:1';
        // $this->validateRules['new_ranking'] = 'required|numeric|min:1';
    }

    /**
     * Returned a array insert all sort values.
     *
     * @var array $persistValues
     * @return array $result
     */
    public function buildValueContainer(): array
    {
        $vault = [...$this->persistValues];

        $result = [
            'Image' => [],
            'Content' => [],
        ];

        foreach (GetPageUrlVars::getAllLangs() as $lang) {
            $result['Lang\\' . strtoupper($lang) . '_Content'] = [];
            $result['Lang\\' . strtoupper($lang) . '_List'] = [];
        }

        $this->setImageBox($result, $vault);

        $list = $this->differenceValues($vault, 'list');
        $content = $this->differenceValues($vault, 'cont');

        $this->setLangBoxes($result, $list, '_List');
        $this->setLangBoxes($result, $content, '_Content');

        unset($list, $content);
        $result['Content'] = $vault;

        return $result;
    }

    public function setImageBox(&$result, &$vault)
    {
        if (array_key_exists('image', $vault) && array_key_exists('old_image', $vault)) {
            $result['Image'][] = [
                'id' => $vault['old_image'],
                'new' => $vault['image'],
            ];
            unset($vault['old_image'], $vault['image']);
        }

        if (array_key_exists('content_image', $vault) && array_key_exists('content_old_image', $vault)) {
            $result['Image'][] = [
                'id' => $vault['content_old_image'],
                'new' => $vault['content_image'],
            ];
            unset($vault['content_old_image'], $vault['content_image']);
        }
    }

    public function differenceValues(&$vault, $search): array
    {
        $result = [];

        foreach ($vault as $record => $val) {
            if (str_contains($record, "_{$search}_")) {
                $result[str_replace("_$search", '', $record)] = $val;
                unset($vault[$record]);
            }
        }

        return $result;
    }

    public function setLangBoxes(&$result, &$box, $searchModel)
    {
        foreach (GetPageUrlVars::getAllLangs() as $lang) {
            foreach ($box as $key => $v) {
                if (str_contains($key, "_$lang")) {
                    $newKey = str_replace("_$lang", '', $key);
                    $model = 'Lang\\' . strtoupper($lang) . $searchModel;

                    if (str_contains($newKey, 'title_')) {
                        $tId = str_replace('title_', '', $newKey);

                        if (array_key_exists($tId, $result[$model])) {
                            $result[$model][$tId]['title'] = $v;
                        } else {
                            $result[$model][$tId] = ['title' => $v];
                        }
                        unset($box[$key]);
                    }

                    if (str_contains($newKey, 'item_')) {
                        $offset = strripos($newKey, '_');
                        $iId = substr($newKey, $offset + 1);

                        if (array_key_exists($iId, $result[$model])) {
                            $result[$model][$iId][substr($newKey, 0, $offset)] = $v;
                        } else {
                            $result[$model][$iId] = [substr($newKey, 0, $offset) => $v];
                        }
                        unset($box[$key]);
                    }

                    if (str_contains($newKey, 'content_')) {
                        $cId = str_replace('content_', '', $newKey);

                        if (array_key_exists($cId, $result[$model])) {
                            $result[$model][$cId]['content'] = $v;
                        } else {
                            $result[$model][$cId] = ['content' => $v];
                        }
                        unset($box[$key]);
                    }
                }
            }
        }
    }
}
