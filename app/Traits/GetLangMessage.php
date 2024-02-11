<?php

namespace App\Traits;

use App\Models\LanguageFactory;

/**
 *
 * @method static \App\Traits\GetLangMessage languagePackage($locale)
 * 
 */
trait GetLangMessage
{
  /**
   * Return a new LanguageFactory class.
   * 
   * @param  string  $locale
   * @return instance \App\Models\LanguageFactory
   */
  public static function languagePackage($locale = false)
  {
    return new LanguageFactory($locale);
  }
}
