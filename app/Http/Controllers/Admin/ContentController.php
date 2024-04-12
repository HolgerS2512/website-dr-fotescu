<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandleDB\SetAdminDatabaseData;
use App\Repositories\Admin\HandleLayoutRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
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
final class ContentController extends Controller implements HandleLayoutRepository
{
    /**
     * Saves the associated db data for the respective variable.
     *
     * @var \App\Models\Page $page,
     * @var \App\Models\Image $images,
     * @var \App\Models\Content $content
     * @var \App\Models\Publish $publishes
     */
    public $page, $images, $content, $publishes;

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
            $this->images = $dbData->images;
            $this->content = $dbData->content;
            $this->publishes = $dbData->publishes;
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
                'content' => $this->content,
                'src' => $this->images->where('slide', false),
                'public' => $this->publishes,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function visible(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * @return \Illuminate\Http\Response
     */
    public function up(Request $request, $_, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Request $id
     * @return \Illuminate\Http\Response
     */
    public function down(Request $request, $_, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($_, $id)
    {
    }
}
