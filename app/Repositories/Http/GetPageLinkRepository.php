<?php

namespace App\Repositories\Http;

use Illuminate\Http\Request;
use App\Models\Page;
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
 * @method setAdminPageLink
 * @method setDePageLink
 * @method setEnPageLink
 * @method setRuPageLink
 * 
 */
final class GetPageLinkRepository implements GetPageLinkInterface
{
  /**
   * Contains strings in an array from the request path.
   *
   * @param \Illuminate\Http\Request $request
   * @var array
   * 
   */
  private array $urlValues;

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
  private array $adminLinks;
  private array $deLinks;
  private array $enLinks;
  private array $ruLinks;

  /**
   * Contains value that is returned from the URL.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Page $pages
   * @var string
   * 
   */
  public string $adminPageLink;
  public string $dePageLink;
  public string $enPageLink;
  public string $ruPageLink;

  /**
   * Set the variable $urlValues and executes the setAttributes method.
   *
   * @param \Illuminate\Http\Request $request
   * @var \App\Models\Page $pages
   * @return void
   * 
   */
  public function __construct(Request $request)
  {
    $this->urlValues = explode('/', $request->path());

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

    $this->setAdminPageLink();

    $this->setDePageLink();

    $this->setEnPageLink();

    $this->setRuPageLink();
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
   * @param string $param
   * @var array $links
   * @return void
   * 
   */
  public function setLinks()
  {
    foreach ($this->pages as $page) {
      $this->adminLinks[] = $page->only(['link'])['link'];
    }

    foreach ($this->pages as $page) {
      $this->deLinks[] = $page->only(['name'])['name'];
    }

    foreach ($this->pages as $page) {
      $this->enLinks[] = $page->only(['en_name'])['en_name'];
    }

    foreach ($this->pages as $page) {
      $this->ruLinks[] = $page->only(['ru_name'])['ru_name'];
    }
  }

  /**
   * Set the URL values to the $adminPageLink variable.
   *
   * @param array $adminLinks
   * @param array $urlValues
   * @var string $adminPageLink
   * @return void
   * 
   */
  public function setAdminPageLink()
  {
    $values = [];

    foreach ($this->adminLinks as $link) {
      foreach ($this->urlValues as $urlString) {
        if ($link === $urlString) $values = $urlString;
      }
    }

    $this->adminPageLink = is_array($values) ? implode('/', $values) : $values;
  }

  /**
   * Set the URL values to the $dePageLink variable.
   *
   * @param array $deLinks
   * @param array $urlValues
   * @var string $dePageLink
   * @return void
   * 
   */
  public function setDePageLink()
  {
    $values = [];

    foreach ($this->deLinks as $link) {
      foreach ($this->urlValues as $urlString) {
        if ($link === $urlString) $values = $urlString;
      }
    }

    $this->dePageLink = is_array($values) ? implode('/', $values) : $values;
  }

  /**
   * Set the URL values to the $enPageLink variable.
   *
   * @param array $enLinks
   * @param array $urlValues
   * @var string $enPageLink
   * 
   */
  public function setEnPageLink()
  {
    $values = [];

    foreach ($this->enLinks as $link) {
      foreach ($this->urlValues as $urlString) {
        if ($link === $urlString) $values = $urlString;
      }
    }

    $this->enPageLink = is_array($values) ? implode('/', $values) : $values;
  }

  /**
   * Set the URL values to the $ruPageLink variable.
   *
   * @param array $ruLinks
   * @param array $urlValues
   * @var string $ruPageLink
   * @return void
   * 
   */
  public function setRuPageLink()
  {
    $values = [];

    foreach ($this->ruLinks as $link) {
      foreach ($this->urlValues as $urlString) {
        if ($link === $urlString) $values = $urlString;
      }
    }

    $this->ruPageLink = is_array($values) ? implode('/', $values) : $values;
  }
}
