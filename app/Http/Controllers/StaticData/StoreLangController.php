<?php

namespace App\Http\Controllers\StaticData;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class StoreLangController extends Controller
{
    public static $language;

    public function __construct(string $language = '')
    {
        if (empty($language)) {

            self::$language = app()->getLocale();
        } else {

            self::$language = $language;
            App::setLocale($language);
        }
    }
}
