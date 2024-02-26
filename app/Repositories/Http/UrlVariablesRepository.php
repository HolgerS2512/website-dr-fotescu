<?php

namespace App\Repositories\Http;

use Illuminate\Http\Request;

/**
 * Contains this methods.
 * 
 * @method __construct(Request $request)
 * @method setAttributes
 * @method setPages
 * @method setLinks
 * @method setUrlValues
 * @method setCurrentPageLink
 * @method static getLanguage(): string
 * @method static isHeadMethod(): bool
 * @method static hasLanguages(): array
 * 
 */
interface UrlVariablesRepository
{
  /**
   * Set the variable $urlValues and executes the setAttributes method.
   *
   * @param \Illuminate\Http\Request $request
   * @var string $requestPath
   * @return void
   * 
   */
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
   * @var array $links
   * @return void
   * 
   */
  public function setLinks();

  /**
   * Converts the request string path into an array.
   *
   * @param static $requestPath
   * @var array $urlValues
   * @return void
   * 
   */
  public function setUrlValues();

  /**
   * Set the URL values to the $currentPageLink variable.
   *
   * @param array $pageLinks
   * @param array $urlValues
   * @var string $currentPageLink
   * @return void
   * 
   */
  public function setCurrentPageLink();

  /**
   * Set the language for APP, variable $lang & return lang string.
   *
   * @param array $urlValues
   * @var string $lang
   * @return string
   * 
   */
  public static function getLanguage(): string;

  /**
   * Static method to check is a HEAD or CONTENT method.
   *
   * @param static $requestPath
   * @return bool
   * 
   */
  public static function isHeadMethod(): bool;

  /**
   * Static method return Languages.
   *
   * @return array
   * 
   */
  public static function hasLanguages(): array;
}