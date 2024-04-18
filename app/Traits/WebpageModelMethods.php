<?php

namespace App\Traits;

use App\Models\Content;
use App\Models\Image;
use App\Models\Publish;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 * Contains this page & subpage model methods.
 *
 * @method contents
 * @method images
 * @method publishes
 * @method isSlideshow
 * @method getSliderData
 * @method getHeadline
 * @method getMetaData
 * 
 */
trait WebpageModelMethods
{
  /**
   * Get the contents for this page.
   * 
   * @return \Illuminate\Database\Eloquent\Relations\HasMany 
   */
  public function contents(): HasMany
  {
    return $this->hasMany(Content::class);
  }

  /**
   * Get the images for this page.
   * 
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function images(): HasMany
  {
    return $this->hasMany(Image::class);
  }

  /**
   * Get the publish for this page.
   * 
   * @return \Illuminate\Database\Eloquent\Relations\HasMany 
   */
  public function publishes(): HasMany
  {
    return $this->hasMany(Publish::class);
  }

  /**
   * For the current page it is displayed whether the slideshow is visible or not.
   * 
   * @return bool
   */
  public function isSlideshow(): bool
  {
    return $this->publishes()->first()->public ?? false;
  }

  /**
   * Get one or any images for header.
   * 
   * @return Collection|Image|null
   */
  public function getSliderData(): Collection|Image|NULL
  {
    $exp = $this->images()->where('slide', true);

    return ($this->isSlideshow() ? $exp->get() : $exp->first());
  }

  /**
   * Get the main title (h1 Headline) for this page.
   * 
   * @return string|null
   */
  public function getHeadline(): string|NULL
  {
    $title = '';

    switch ($this->link) {
      case 'home':
        $splitArr = explode(' ', (__('messages.words.main_title')));
        $title = $splitArr[0] . (app()->getLocale() === 'de' ? '' : ' ' . $splitArr[1]) . '<br/>';
        $range = app()->getLocale() === 'de' ? 1 : 2;

        for($i = $range; $i < count($splitArr); $i++) {
          $title .= ($range === $i ? '' : ' ') . $splitArr[$i];
        }
        break;
      case 'blog':
        $title = __('messages.words.page_title_blog');
        break;
      default:
        $title = __("messages.title.$this->link");
        break;
    }

    return is_null($title) ? '' : ucwords($title);
  }

  /**
   * Return header informations for this page as string.
   * 
   * @return string
   */
  public function getHeader($input = 'default'): string
  {
    $result = [
      'description' => '',
      'keywords' => '',
      'title' => '',
      'default' => '',
    ];

    $isCurrPageHome = $this->link === 'home';

    $result['description'] = ($isCurrPageHome ? '' : "{$this->getHeadline()} | ");
    $result['description'] .= __('messages.words.meta_data');

    $result['keywords'] = __('messages.words.seo_keywords');
    $result['keywords'] .= ($isCurrPageHome ? '' : ', ' . mb_strtolower((explode(' ', __('messages.words.zfatreatments')))[0]) . '-');
    $result['keywords'] .= ($isCurrPageHome ? '' : (str_replace(' ', '-', mb_strtolower($this->{app()->getLocale()}))));

    $result['title'] = $isCurrPageHome ? '' : "{$this->getHeadline()} | ";
    $result['title'] .= __('messages.words.main_title');

    return ucwords($result[$input]);
  }
}
