<?php

namespace App\Repositories\Page;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use Illuminate\Http\Request;

interface PageRepository
{
  /**
   * Store db data in the variables.
   *
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images,
   * @var \App\Models\Publish $publishes
   * @var \App\Models\Content $contents
   * @var \App\Models\ContentList $contentLists
   * @var \App\Models\Lang\DE_content $deContents
   * @var \App\Models\Lang\EN_content $enContents
   * @var \App\Models\Lang\RU_content $ruContents
   * @return void
   */
  public function __construct(GetPageUrlVars $urlVars);

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index();

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request);
}
