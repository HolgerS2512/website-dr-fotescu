<?php

namespace App\Repositories\Http;

use Illuminate\Support\Facades\Request;

/**
 * Should contains this methods.
 * 
 * @method construct(Request $request)
 * @method setAttributes
 * @method setPages
 * @method setLinks
 * @method setAdminPageLink
 * @method setDePageLink
 * @method setEnPageLink
 * @method setRuPageLink
 * 
 */
interface GetPageLinkInterface
{
  public function __construct(Request $request);

  /**
   * Executes all functions that are set variably to the values.
   *
   * @return void
   * 
   */
  public function setAttributes();

  /**
   * Sets the variable pages to all db page data.
   *
   * @param \App\Models\Page
   * @var \App\Models\Page $pages
   * @return void
   * 
   */
  public function setPages();

  /**
   * Sets the variable links to the value present in variable pages.
   *
   * @param \App\Models\Page $pages
   * @param string $param
   * @var array $links
   * @return void
   * 
   */
  public function setLinks();

  /**
   * Set the URL values to the $adminPageLink variable.
   *
   * @param array $adminLinks
   * @param array $urlValues
   * @var string $adminPageLink
   * @return void
   * 
   */
  public function setAdminPageLink();

  /**
   * Set the URL values to the $dePageLink variable.
   *
   * @param array $deLinks
   * @param array $urlValues
   * @var string $dePageLink
   * @return void
   * 
   */
  public function setDePageLink();

  /**
   * Set the URL values to the $enPageLink variable.
   *
   * @param array $enLinks
   * @param array $urlValues
   * @var string $enPageLink
   * 
   */
  public function setEnPageLink();

  /**
   * Set the URL values to the $ruPageLink variable.
   *
   * @param array $ruLinks
   * @param array $urlValues
   * @var string $ruPageLink
   * @return void
   * 
   */
  public function setRuPageLink();
}