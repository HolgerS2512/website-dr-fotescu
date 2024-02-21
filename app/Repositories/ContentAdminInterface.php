<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface ContentAdminInterface
{
  /**
   * Store db data in the variables.
   *
   * @param \App\Repositories\AdminDataRepository $AdminData
   * @var \App\Models\Page $page
   * @var \App\Models\Image $images
   * @var \App\Models\Content $content
   * @var \App\Models\Publish $publishes
   * @return void
   */
  public function __construct();

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

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \Illuminate\Http\Request $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id);

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id);

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function visible(Request $request);

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * @return \Illuminate\Http\Response
   */
  public function up(Request $request, $id);

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * @return \Illuminate\Http\Response
   */
  public function down(Request $request, $id);

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Illuminate\Http\Request  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id);
}