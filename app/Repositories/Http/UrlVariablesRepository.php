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
 * @method setAdminPageLink
 * @method setWebPageLink
 * @method static getLanguage(): string
 * @method static isHeadMethod(): bool
 * @method static hasLanguages(): array
 * @method static getAllLangs(): array
 * 
 */
interface UrlVariablesRepository
{
  /**
   * Set the variable $urlValues and executes the setAttributes method.
   *
   * @param \Illuminate\Http\Request $request
   * @var string $requestPath
   * @var array $hasLanguages
   * @method setAttributes
   * @return void
   * 
   */
  public function __construct(Request $request);

  /**
   * Set all attributes for this instance.
   *
   * @method setPages
   * @method setLinks
   * @method setUrlValues
   * @method getLanguage
   * @method setCurrentPageLink
   * @return void
   * 
   */
  public function setAttributes();

  /**
   * Sets the variable pages to all db page and subpage data.
   *
   * @var \App\Models\Page
   * @var \App\Models\Subpage
   * @return void
   * 
   */
  public function setPages();

  /**
   * Sets the variable links to the value present in variable pages.
   *
   * @param \App\Models\Page $pages
   * @param \App\Models\Subpage $subpages
   * @var array $pagelinks
   * @var array $webpagelinks
   * @return void
   * 
   */
  public function setLinks();

  /**
   * Converts the request string path into an array.
   *
   * @param static string $requestPath
   * @var static array $urlValues
   * @return void
   * 
   */
  public function setUrlValues();

  /**
   * Set the URL values to the $currentPageLink variable.
   *
   * @method setAdminPageLink
   * @method setWebPageLink
   * @param array $urlValues
   * @var string $currentPageLink
   * @return void
   * 
   */
  public function setCurrentPageLink();

  /**
   * Returns URL administration values as a string (current page link).
   *
   * @param array $pageLinks
   * @param array $urlValues
   * @return string
   * 
   */
  public function setAdminPageLink();

  /**
   * Returns URL webpage values as a string (current page link).
   *
   * @param array $webpageLinks
   * @param array $urlValues
   * @return string
   * 
   */
  public function setWebPageLink();

  /**
   * Set the language for APP, variable $lang & return lang string.
   *
   * @param static array $hasLanguages
   * @param static array $urlValues
   * @param \Illuminate\Support\Facades\App
   * @var static string $lang
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

  /**
   * Static method return all Languages as array.
   *
   * @return array
   * 
   */
  public static function getAllLangs(): array;
}
