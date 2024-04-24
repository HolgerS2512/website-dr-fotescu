<?php

namespace App\Http\Controllers\HandleHttp;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;
use App\Models\Subpage;
use App\Repositories\Http\UrlVariablesRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

/**
 * Contains this methods and variables.
 * 
 * @param \Illuminate\Http\Request $request
 * @var \App\Models\Page $pages
 * @var \App\Models\Subpage $subpages
 * @var static string $requestPath
 * @var static array $urlValues
 * @var Collection $pages
 * @var Collection $subpages
 * @var array $pageLinks
 * @var string $currentPageLink
 * @var static string $lang
 * @var static array $hasLanguages
 * @var bool $isBlogPost
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
   * @param \App\Models\Subpage $subpages
   * @var \Illuminate\Database\Eloquent\Collection
   * 
   */
  private Collection $pages, $subpages;

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
  public string|NULL $currentPageLink;

  /**
   * Contains the current language value.
   *
   * @param array $urlValues;
   * @var string
   * 
   */
  public static string $lang;

  /**
   * Contains is current page a blog post.
   *
   * @var bool
   * 
   */
  public bool $isBlogPost = false;

  /**
   * Contains is current post url link.
   *
   * @var string|null
   * 
   */
  public string $postUrl;

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
   * @var array $hasLanguages
   * @method setAttributes
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
  public function setAttributes()
  {
    $this->setPages();

    $this->setLinks();

    $this->setUrlValues();

    self::getLanguage();

    $this->setCurrentPageLink();
  }

  /**
   * Sets the variable pages to all db page and subpage data.
   *
   * @var \App\Models\Page
   * @var \App\Models\Subpage
   * @return void
   * 
   */
  public function setPages()
  {
    $this->pages = Page::all();

    $this->subpages = Subpage::all();
  }

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
  public function setLinks()
  {
    foreach ($this->pages as $page) {
      $this->pageLinks[] = $page->only(['link'])['link'];
      $this->webpageLinks[] = $page->only(['weblink'])['weblink'];
    }

    foreach ($this->subpages as $page) {
      $this->pageLinks[] = $page->only(['link'])['link'];
      $this->webpageLinks[] = $page->only(['weblink'])['weblink'];
    }
  }

  /**
   * Converts the request string path into an array.
   *
   * @param static string $requestPath
   * @var static array $urlValues
   * @return void
   * 
   */
  public function setUrlValues()
  {
    if (strlen(self::$requestPath) <= 2) self::$requestPath .= '/home';

    self::$urlValues = self::$requestPath === '/' ? [0 => 'home'] : explode('/', self::$requestPath);
    // self::$urlValues = self::$requestPath === '/' ? [0 => 'home'] : explode('/', preg_replace('/\/download+/', '', self::$requestPath));
  }

  /**
   * Set the URL values to the $currentPageLink variable.
   *
   * @method setAdminPageLink
   * @method setWebPageLink
   * @method setPageBlogLink
   * @param array $urlValues
   * @var string $currentPageLink
   * @return void
   * 
   */
  public function setCurrentPageLink()
  {
    $value = '';
    $withoutLanguage = [];

    if (in_array('administration', self::$urlValues)) {
      $value = $this->setAdminPageLink();
    }

    if (!in_array('administration', self::$urlValues)) {

      foreach (self::$urlValues as $arrVal) {

        if (!in_array($arrVal, self::$hasLanguages['options'])) {
          $withoutLanguage[] = $arrVal;
        }
      }

      if (in_array('blog', self::$urlValues) && count($withoutLanguage) > 1) {
        $value = $this->setPageBlogLink();
      } else {
        $value = $this->setWebPageLink();
      }
    }

    $this->currentPageLink = $value;
  }

  /**
   * Returns URL administration values as a string (current page link).
   *
   * @param array $pageLinks
   * @param array $urlValues
   * @return string
   * 
   */
  public function setAdminPageLink()
  {
    $urlString = '';

    foreach ($this->pageLinks as $link) {
      foreach (self::$urlValues as $urlString) {
        if ($link === $urlString) return $urlString;
      }
    }
  }

  /**
   * Returns URL webpage values as a string (current page link).
   *
   * @param array $webpageLinks
   * @param array $urlValues
   * @return string
   * 
   */
  public function setWebPageLink()
  {
    $urlString = '';
    $collectValues = [];

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

    foreach ($this->webpageLinks as $link) {
      if ($link === $urlString) return $urlString;
    }
  }

  /**
   * Returns blog as a string if the link to the respective blog exists (link to the current page) and isBlogPage var.
   *
   * @param \App\Models\Content&&Post
   * @param Collection $pages
   * @param array $urlValues
   * @var string $postUrl
   * @var bool $isBlogPost
   * @return string|null
   * 
   */
  public function setPageBlogLink(): string|NULL
  {
    $check = false;

    $posts = DB::table('contents')->where('format', 'post')
      ->rightJoin('posts', function (JoinClause $join) {
        $join->on('contents.id', '=', 'posts.content_id')
          ->where('posts.public', true);
      })->get();

    foreach (self::$urlValues as $urlStr) {

      foreach ($posts as $post) {
        $result = $post->url_link === $urlStr;
        if ($result) {
          $this->postUrl = $urlStr;
          $this->isBlogPost = $result;
          $check = $result;
        }
      }
    }

    return $check ? 'blog' : NULL;
  }

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
    return str_contains(self::$requestPath, 'header');
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
