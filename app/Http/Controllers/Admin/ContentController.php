<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandleDB\SetAdminDatabaseData;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Models\Content;
use App\Models\Format;
use App\Models\Helpers\FileConverter;
use App\Repositories\Admin\HandleLayoutRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Models\Lang\Word;
use App\Models\Page;
use App\Models\Publish;
use App\Models\Subpage;
use App\Traits\GetLangMessage;
use Illuminate\Http\UploadedFile;
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
                'words' => Word::all(),
                'pages' => Page::all(),
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
    public function store(Request $request, $_)
    {
        try {
            // dump($request->all());
            // dd($request->all());
            $page_id = NULL;
            $subpage_id = NULL;
            $valiVals = [];
            $requNew = [];

            foreach ($request->all() as $key => $value) {
                if ($value === null) {
                    $valiVals[$key] = str_contains($key, 'content') ? 'max:4000' : 'max:255';
                }
            }

            if ($this->page instanceof Page) {
                $page_id = $this->page->id;
            } else {
                $page_id = $this->page->page_id;
                $subpage_id = $this->page->id;
            }

            $vali = array_merge([
                'image' => 'image|mimes:jpg,svg,png,webp,jpeg',
                'content-image' => 'image|mimes:jpg,svg,png,webp,jpeg',
                'list-image' => 'image|mimes:jpg,svg,png,webp,jpeg',
                'file' => 'file|mimes:pdf',
                'format' => 'required|min:10|max:80',
                'btn' => 'max:255',
                'url_link' => 'max:255',
            ], $valiVals);

            $credentials = Validator::make(array_filter($request->all()), $vali);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            foreach ($request->all() as $key => $value) {
                if ((str_contains($key, 'title') || str_contains($key, 'content')) && preg_match_all('/\r\n/', $value)) {
                    $requNew[$key] = preg_replace('/\r\n/', '<br>', $value);
                } else {
                    $requNew[$key] = $value;
                }
            }

            if ($request->image) {
                $ic = new FileConverter($request->image, 'uploads/images/' . $this->page->link . '/');
                $ic->move();
                $image = new Image([
                    'page_id' => $page_id,
                    'subpage_id' => $subpage_id ?? NULL,
                    'src' => $ic->saveUrl,
                    'ext' => $ic->extension,
                ]);
                $image->save();
            }

            if ($request->content_image) {
                $ic = new FileConverter($request->content_image, 'uploads/images/' . $this->page->link . '/');
                $ic->move();
                $content_image = new Image([
                    'page_id' => $page_id,
                    'subpage_id' => $subpage_id ?? NULL,
                    'src' => $ic->saveUrl,
                    'ext' => $ic->extension,
                ]);
                $content_image->save();
            }

            if ($request->list_image) {
                $ic = new FileConverter($request->list_image, 'uploads/images/' . $this->page->link . '/');
                $ic->move();
                $list_image = new Image([
                    'page_id' => $page_id,
                    'subpage_id' => $subpage_id ?? NULL,
                    'src' => $ic->saveUrl,
                    'ext' => $ic->extension,
                ]);
                $list_image->save();
            }

            $url_link = $request->url_link;
            $btn = $request->btn;

            if ($request->file) {
                $ic = new FileConverter($request->file, 'download/');
                $ic->move();
                $url_link = $ic->saveUrl;
            }

            if ($request->pagelist) $url_link = $request->pagelist;
            if ($request->subpage) $url_link = $request->subpage;
            if ($request->btnlist) $btn = $request->btnlist;

            $newBlock = new Content([
                'page_id' => $page_id,
                'subpage_id' => $subpage_id ?? NULL,
                'btn' => $btn ?? NULL,
                'url_link' => $url_link ?? NULL,
                'image_id' => $image->id ?? NULL,
                'format' => substr($request->format, 0, strpos($request->format, '#')),
                'created_at' => Carbon::now(),
            ]);

            $newBlock->setRanking();
            $newBlock->save();

            $subValues = [];
            if (substr($request->format, 0, strpos($request->format, '#')) === 'buttons') {
                $pages = Page::find($url_link);
                $i = 1;
                foreach ($pages->getSubpagesAttribute() as $k => $v) {
                    $subValues['item_' . $i] = $v->link;
                    ++$i;
                }
            }

            // dump($newBlock);

            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                if (
                    array_key_exists("title_{$lang}_cont", array_filter($request->all()))
                    || array_key_exists("content_{$lang}_cont", array_filter($request->all()))
                ) {
                    $newLangCon = new ('\App\Models\Lang\\' . strtoupper($lang) . "_Content")([
                        'content_id' => $newBlock->id,
                        'title' => $requNew['title_' . $lang . '_cont'] ?? null,
                        'content' => $requNew['content_' . $lang . '_cont'] ?? null,
                        'words_name' => $request->words_name_cont ?? null,
                        'image_id' => $content_image->id ?? null,
                        'created_at' => Carbon::now(),
                    ]);
                    $newLangCon->save();
                    // dump($newLangCon);
                }

                if (
                    array_key_exists("title_{$lang}_list", array_filter($request->all()))
                    || array_key_exists("item_1_$lang", array_filter($request->all()))
                    || array_key_exists('words_name_list', array_filter($request->all()))
                    || substr($request->format, 0, strpos($request->format, '#')) === 'buttons'
                ) {
                    $newLangList = new ('\App\Models\Lang\\' . strtoupper($lang) . "_List")(array_merge([
                        'content_id' => $newBlock->id,
                        'title' => $requNew['title_' . $lang . '_list'] ?? null,
                        'item_1' => $request->{"item_1_$lang"} ?? null,
                        'item_2' => $request->{"item_2_$lang"} ?? null,
                        'item_3' => $request->{"item_3_$lang"} ?? null,
                        'item_4' => $request->{"item_4_$lang"} ?? null,
                        'item_5' => $request->{"item_5_$lang"} ?? null,
                        'item_6' => $request->{"item_6_$lang"} ?? null,
                        'item_7' => $request->{"item_7_$lang"} ?? null,
                        'item_8' => $request->{"item_8_$lang"} ?? null,
                        'item_9' => $request->{"item_9_$lang"} ?? null,
                        'item_10' => $request->{"item_10_$lang"} ?? null,
                        'item_11' => $request->{"item_11_$lang"} ?? null,
                        'item_12' => $request->{"item_12_$lang"} ?? null,
                        'item_13' => $request->{"item_13_$lang"} ?? null,
                        'item_14' => $request->{"item_14_$lang"} ?? null,
                        'item_15' => $request->{"item_15_$lang"} ?? null,
                        'item_16' => $request->{"item_16_$lang"} ?? null,
                        'item_17' => $request->{"item_17_$lang"} ?? null,
                        'item_18' => $request->{"item_18_$lang"} ?? null,
                        'item_19' => $request->{"item_19_$lang"} ?? null,
                        'item_20' => $request->{"item_20_$lang"} ?? null,
                        'words_name' => $request->words_name_list ?? null,
                        'image_id' => $list_image->id ?? null,
                        'created_at' => Carbon::now(),
                    ], $subValues));
                    $newLangList->save();
                    // dump($newLangList);
                }
            }

            // dd('END');


            return redirect('administration/content/' . $this->page->link)->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->createBlockTrue,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->createBlockFalse,
            ]);
        }

        return redirect()->back()->with([
            'present' => true,
            'status' => false,
            'message' => GetLangMessage::languagePackage('en')->createBlockFalse,
        ]);
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
            $this->filterRequest($request->all());

            $credentials = Validator::make($request->all(), $this->validateRules);

            if ($credentials->fails()) {
                return redirect()->back()
                    ->withErrors($credentials->errors())
                    ->withInput();
            }

            $VALUES = $this->buildValueContainer((int) $id);
            // dd($VALUES);

            foreach ($VALUES as $model => $valueArr) {
                foreach ($valueArr as $nowId => $values) {

                    if (!empty($VALUES[$model][$nowId])) {
                        $record = ('\App\Models\\' . $model)::find($nowId);

                        if ($record instanceof Image) {
                            $path = substr($record->src, 0, strripos($record->src, '/') + 1);
                            $ic = new FileConverter($values->image, $path);
                            $ic->move();

                            if ($record->src && File::exists($record->src)) {
                                File::delete($record->src);
                            }

                            $VALUES[$model][$nowId] = [
                                'src' => $ic->saveUrl,
                                'ext' => $ic->extension,
                            ];
                        }

                        if ($record instanceof Content) {

                            foreach ($values as $src => $check) {
                                if ($check instanceof UploadedFile) {
                                    $path = substr($record->{$src}, 0, strripos($record->{$src}, '/') + 1);
                                    $ic = new FileConverter($check, $path);
                                    $ic->move();

                                    if ($record->{$src} && File::exists($record->{$src})) {
                                        File::delete($record->{$src});
                                    }

                                    $VALUES[$model][$nowId][$src] = $ic->saveUrl;
                                }
                            }
                        }

                        $VALUES[$model][$nowId] = array_merge($VALUES[$model][$nowId], ['updated_at' => Carbon::now()]);
                        $record->update($VALUES[$model][$nowId]);
                    }
                }
            }

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
     * Add new empty content or content list.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * @param  \Illuminate\Http\Request $new
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $_, $id, $new)
    {
        try {
            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                $model = ('\App\Models\Lang\\' . strtoupper($lang) . "_$new")::where('content_id', $id)->get();
                $add = new ('\App\Models\Lang\\' . strtoupper($lang) . "_$new");
                $add->ranking = $model->count() + 1;
                $add->content_id = $id;
                $add->created_at = Carbon::now();
                $add->save();
            }

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
     * Add new empty content or content list.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * @param  \Illuminate\Http\Request $new
     * @return \Illuminate\Http\Response
     */
    public function deleteAdd(Request $request, $_, $new, $de, $en, $ru)
    {
        try {
            $ids = [];
            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                $ids[substr($$lang, 0, strpos($$lang, ':'))] = substr($$lang, strpos($$lang, ':') + 1);
            }

            foreach (GetPageUrlVars::getAllLangs() as $lang) {
                $model = ('\App\Models\Lang\\' . strtoupper($lang) . "_$new")::find($ids[$lang]);
                $model->delete();
            }

            return redirect()->back()->with([
                'present' => true,
                'status' => true,
                'message' => GetLangMessage::languagePackage('en')->deleteConTrue,
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
                        // if ($content)  dump($content);
                    }
                }

                if (!empty($lists->toArray())) {
                    foreach ($lists as $list) {
                        if ($list) $list->delete();
                        // if ($list) dump($list);
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
                return back()->with([
                    'present' => true,
                    'status' => true,
                    'message' => GetLangMessage::languagePackage('en')->deleteConTrue,
                ]);
            }
        } catch (Exception $e) {
            return back()->with([
                'present' => true,
                'status' => false,
                'message' => GetLangMessage::languagePackage('en')->deleteConFalse,
            ]);
        }

        return back()->with([
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
    public function filterRequest($requVal)
    {
        $rule = [
            false => 'max:255',
            true => 'max:4000',
        ];

        $this->persistValues = array_filter($requVal, function ($v) {
            return !($v === '_method' || $v === '_token');
        }, ARRAY_FILTER_USE_KEY);

        $this->persistValues = array_map(function ($val) {
            return (!$val instanceof UploadedFile) ? preg_replace('/\r\n/', '<br>', trim($val)) : $val;
        }, $this->persistValues);

        if (!array_key_exists('image', $this->persistValues)) unset($this->persistValues['old_image']);
        if (!array_key_exists('content_image', $this->persistValues)) unset($this->persistValues['content_old_image']);
        if (!array_key_exists('list_image', $this->persistValues)) unset($this->persistValues['list_old_image']);

        foreach ($this->persistValues as $key => $_) {

            if (!str_contains($key, 'image') && !str_contains($key, 'btn')) {
                $this->validateRules[$key] = "{$rule[str_contains($key, 'content')]}";
            }
            if (str_contains($key, 'image')) {
                $this->validateRules[$key] = 'required|image|mimes:jpg,svg,png,webp,jpeg';
            }
            if (str_contains($key, 'old_image')) {
                $this->validateRules[$key] = 'required|numeric';
            }
        }

        // $this->validateRules['ranking'] = 'required|numeric|min:1';
        // $this->validateRules['new_ranking'] = 'required|numeric|min:1';
    }

    /**
     * Returned a array insert all sort values.
     *
     * @param int $id
     * @var array $persistValues
     * @return array $result
     */
    public function buildValueContainer(int $id): array
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
        $result['Content'] = [$id => $vault];

        return $this->getBlankData($result);
    }

    /**
     * Sets data for existing images.
     *
     * @param array &$result
     * @param array &$vault
     * @return void
     */
    public function setImageBox(array &$result, array &$vault)
    {
        if (array_key_exists('image', $vault) && array_key_exists('old_image', $vault)) {
            $result['Image'][intval($vault['old_image'])] = (object) ['image' => $vault['image']];
            unset($vault['old_image'], $vault['image']);
        }

        if (array_key_exists('content_image', $vault) && array_key_exists('content_old_image', $vault)) {
            $result['Image'][intval($vault['content_old_image'])] = (object) ['image' => $vault['content_image']];
            unset($vault['content_old_image'], $vault['content_image']);
        }

        if (array_key_exists('list_image', $vault) && array_key_exists('list_old_image', $vault)) {
            $result['Image'][intval($vault['list_old_image'])] = (object) ['image' => $vault['list_image']];
            unset($vault['list_old_image'], $vault['list_image']);
        }
    }

    /**
     * Returned an array of Content or List values and delete this in $vault.
     *
     * @param string $search
     * @param array &$vault
     * @return array
     */
    public function differenceValues(array &$vault, string $search): array
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

    /**
     * Assembles the language models with appropriate values.
     *
     * @param array &$vault
     * @param array &$box
     * @param string $searchModel
     * @return void
     */
    public function setLangBoxes(array &$result, array &$box, string $searchModel)
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

                    if (str_contains($newKey, 'words_name_')) {
                        $cId = str_replace('words_name_', '', $newKey);

                        if (array_key_exists($cId, $result[$model])) {
                            $result[$model][$cId]['words_name'] = $v;
                        } else {
                            $result[$model][$cId] = ['words_name' => $v];
                        }
                        unset($box[$key]);
                    }
                }
            }
        }
    }

    /**
     * Returned an key, value array of pure data without empty models.
     *
     * @param array $result
     * @return array
     */
    public function getBlankData(array $result): array
    {
        foreach ($result as $key => $value) {

            if (empty($value)) {
                unset($result[$key]);
            }

            foreach ($value as $val) {
                if (empty($val)) {
                    unset($result[$key]);
                }
            }
        }

        return $result;
    }
}
