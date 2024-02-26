<?php

namespace App\Repositories\Http;

use App\Http\Controllers\StaticData\StoreLangController;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Http\GetPageLinkInterface;

/**
 * Contains this methods and variables.
 * 
 * @param \Illuminate\Http\Request $request
 * @var \App\Models\Page $page
 * @method construct(Request $request)
 * @method setAttributes
 * @method setPages
 * @method setLinks
 * @method setUrlValues
 * @method setcurrentPageLink
 * @method static getLanguage: string
 * @method static isHeadMethod: bool
 * 
 */
final class GetPageLinkRepository implements GetPageLinkInterface
{
  /**
   * Contains the request path.
   *
   * @param \Illuminate\Http\Request $request->path()
   * @var string
   * 
   */
  private static string $requestPath;

  /**
   * Contains strings in an array from the request path.
   *
   * @param \Illuminate\Http\Request $request
   * @var array
   * 
   */
  private static array $urlValues;

  /**
   * Contains the value that is returned from the URL.
   *
   * @param \App\Models\Page $pages
   * @var \Illuminate\Database\Eloquent\Collection
   * 
   */
  private Collection $pages;

  /**
   * Contains strings in an array from db.
   *
   * @param \Illuminate\Http\Request $request
   * @var array
   * 
   */
  private array $pageLinks;

  /**
   * Contains value that is returned from the URL.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Page $pages
   * @var string
   * 
   */
  public string $currentPageLink;

  /**
   * Contains the current language value.
   *
   * @param array $urlValues;
   * @var string
   * 
   */
  public static string $lang;

  /**
   * Contains the current languages for this webpage.
   *
   * @var array
   * 
   */
  public static array $hasLanguages = [
    'base' => 'de',
    'options' => [
      'en',
      'ru',
    ]
  ];

  /**
   * Set the variable $urlValues and executes the setAttributes method.
   *
   * @param \Illuminate\Http\Request $request
   * @var string $requestPath
   * @return void
   * 
   */
  public function __construct(Request $request)
  {
    self::$requestPath = $request->path();

    self::$hasLanguages['base'] = config('app.locale');

    $this->setAttributes();
  }

  /**
   * Executes all functions that are set variably to the values.
   *
   * @return void
   * 
   */
  public function setAttributes()
  {
    $this->setPages();

    $this->setLinks();

    $this->setUrlValues();

    GetPageLinkRepository::getLanguage();

    $this->setCurrentPageLink();
  }

  /**
   * Sets the variable pages to all db page data.
   *
   * @param \App\Models\Page
   * @var \App\Models\Page $pages
   * @return void
   * 
   */
  public function setPages()
  {
    $this->pages = Page::all();
  }

  /**
   * Sets the variable links to the value present in variable pages.
   *
   * @param \App\Models\Page $pages
   * @var array $links
   * @return void
   * 
   */
  public function setLinks()
  {
    foreach ($this->pages as $page) {
      $this->pageLinks[] = $page->only(['link'])['link'];
    }
  }

  /**
   * Converts the request string path into an array.
   *
   * @param static $requestPath
   * @var array $urlValues
   * @return void
   * 
   */
  public function setUrlValues()
  {
    self::$urlValues = self::$requestPath === '/' ? [0 => 'home'] : explode('/', self::$requestPath);
  }

  /**
   * Set the URL values to the $currentPageLink variable.
   *
   * @param array $pageLinks
   * @param array $urlValues
   * @var string $currentPageLink
   * @return void
   * 
   */
  public function setCurrentPageLink()
  {
    $values = [];

    // foreach ($this->{self::$lang . 'Links'} as $link) {
    foreach ($this->pageLinks as $link) {
      $link = str_replace(' ', '_', mb_strtolower($link));
      $link = str_replace(['(', ')'], '', $link);

      foreach (self::$urlValues as $urlString) {
        $urlString = strlen($urlString) > 2 ? $urlString : 'home';

        if ($link === $urlString) $values = $urlString;
      }
    }

    $this->currentPageLink = is_array($values) ? implode('/', $values) : $values;
  }

  /**
   * Set the language for APP, variable $lang & return lang string.
   *
   * @param array $urlValues
   * @var string $lang
   * @return string
   * 
   */
  public static function getLanguage(): string
  {
    $setCheck = true;
    foreach (self::$hasLanguages['options'] as $hasLang) {
      if (in_array($hasLang, self::$urlValues)) {
        $setCheck = false;
        self::$lang = $hasLang;
        App::setLocale($hasLang);
        return $hasLang;
      }
    }

    if ($setCheck) {
      self::$lang = self::$hasLanguages['base'];
      App::setLocale(self::$hasLanguages['base']);
      return self::$hasLanguages['base'];
    }
  }

  /**
   * Static method to check is a HEAD or CONTENT method.
   *
   * @param static $requestPath
   * @return bool
   * 
   */
  public static function isHeadMethod(): bool
  {
    return str_contains(self::$requestPath, 'content');
  }

  /**
   * Static method return Languages.
   *
   * @return array
   * 
   */
  public static function hasLanguages(): array
  {
    return GetPageLinkRepository::$hasLanguages;
  }
}
