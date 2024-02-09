<?php

namespace App\Traits;

use App\Models\LanguageFactory;

trait GetLangMessage
{
  /**
   * Return a new LanguageFactory class.
   *
   * @return \App\Models\LanguageFactory
   */
  public static function languagePackage($locale = false)
  {
    return new LanguageFactory($locale);
  }
}
