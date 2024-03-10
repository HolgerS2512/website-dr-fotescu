<?php

namespace App\Repositories\Page;

use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use Illuminate\Http\Request;

/**
 * Contains this methods and variables.
 * 
 * @method construct(GetPageUrlVars $urlVars)
 * @method index
 * @method contact(Request $request)
 * 
 */
interface PageRepository
{
  /**
   * Store db data in the variables.
   *
 * @method index
 * @method contact(Request $request)
   *
   */
  public function __construct(GetPageUrlVars $urlVars, Request $request);

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index();

  /**
   * Sends a contact email to the recipient and a confirmation to the email sender.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function contact(Request $request);
}
