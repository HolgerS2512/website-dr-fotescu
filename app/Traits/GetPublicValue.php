<?php

namespace App\Traits;

/**
 *
 * @method static \App\Traits\GetPublicValue isPublic($dbData, $searchString)
 * 
 */
trait GetPublicValue
{
  /**
   * Search the specified resource in DB data.
   *
   * @param  $dbData
   * @param  $searchString
   * @return boolean
   */
  public static function isPublic($dbData = [], $searchString = ''): bool
  {
    $result = [];

    foreach ($dbData as $key) {
      if ($key->name === $searchString) {
        $result[] = $key->public;
      }
    }

    return $result[0] ?? false;
  }
}
