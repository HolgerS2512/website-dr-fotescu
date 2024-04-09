<?php

namespace App\Http\Controllers\HandleHttp;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Repositories\Http\UrlVariablesRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Collection;

/**
 * Contains this methods and variables.
 * 
 * @param \Illuminate\Http\Request $request
 * @var \App\Models\Page $page
 * @var static string $requestPath
 * @var static array $urlValues
 * @var Collection $pages
 * @var array $pageLinks
 * @var string $currentPageLink
 * @var static string $lang
 * @var static array $hasLanguages
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
final class GetPageUrlVars implements UrlVariablesRepository
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
  public static array $urlValues;

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
  private array $pageLinks, $webpageLinks;

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

    self::getLanguage();

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
      $this->webpageLinks[] = $page->only(['weblink'])['weblink'];
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
    // dump(self::$requestPath === '/' ? [0 => 'home'] : explode('/', self::$requestPath));
    self::$urlValues = self::$requestPath === '/' ? [0 => 'home'] : explode('/', self::$requestPath);
  }

  /**
   * Set the URL values to the $currentPageLink variable.
   *
   * @param array $webpageLinks
   * @param array $pageLinks
   * @param array $urlValues
   * @var string $currentPageLink
   * @return void
   * 
   */
  public function setCurrentPageLink()
  {
    $values = '';
    $collectValues = [];

    if (in_array('header', self::$urlValues) || in_array('content', self::$urlValues) || in_array('translation', self::$urlValues)) {
      foreach ($this->pageLinks as $link) {
        foreach (self::$urlValues as $urlString) {
          if ($link === $urlString) $values = $urlString;
        }
      }
    }

    if (!in_array('header', self::$urlValues) || !in_array('content', self::$urlValues) || !in_array('translation', self::$urlValues)) {
      foreach ($this->webpageLinks as $link) {

        if (count(self::$urlValues) === 1) {
          $urlString = 'home';
        } else {

          for ($i = 0; $i < count(self::$urlValues); $i++) {

            if (strlen(self::$urlValues[$i]) > 2) {

              if (count($collectValues)) {

                foreach ($collectValues as $val) {
                  if ($val === self::$urlValues[$i]) break;
                  $collectValues[] = self::$urlValues[$i];
                }
              } else {
                $collectValues[] = self::$urlValues[$i];
              }
            }
          }
          $urlString = implode('/', $collectValues);
        }

        // dump($urlString);
        if ($link === $urlString) $values = $urlString;
      }
    }

    $this->currentPageLink = $values;
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
    return self::$hasLanguages;
  }
}
