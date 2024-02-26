<?php

namespace App\Repositories\Admin;

use App\Http\Controllers\HandleDB\SetAdminDatabaseData;
use Illuminate\Http\Request;

/**
 * Contains this methods.
 * 
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
interface HandleLayoutRepository
{
  /**
   * Store db data in the variables.
   *
   * @return void
   */
  public function __construct(SetAdminDatabaseData $dbData);

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
  public function edit($_, $id);

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $_, $id);

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
  public function up(Request $request, $_, $id);

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Illuminate\Http\Request $id
   * @return \Illuminate\Http\Response
   */
  public function down(Request $request, $_, $id);

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Illuminate\Http\Request  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($_, $id);
}
