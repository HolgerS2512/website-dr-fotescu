<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AOS extends Controller
{
    public static int $duration;

    public static string $animation;

    public function __construct(string $animation = 'fade', int $duration = 750)
    {
        self::$animation = $animation;

        self::$duration = $duration;
    }

    public static function up(int $delay = 0, int $offset = 0, int $duration = 0): string
    {
        return "data-aos-offset=\"$offset\" data-aos=\"" . self::$animation . "-up\" data-aos-delay=\"$delay\" data-aos-duration=\"" . ($duration ? $duration : self::$duration) . "\"";
    }

    public static function upLeft(int $delay = 0, int $offset = 0, int $duration = 0): string
    {
        return "data-aos-offset=\"$offset\" data-aos=\"" . self::$animation . "-up-left\" data-aos-delay=\"$delay\" data-aos-duration=\"" . ($duration ? $duration : self::$duration) . "\"";
    }

    public static function upRight(int $delay = 0, int $offset = 0, int $duration = 0): string
    {
        return "data-aos-offset=\"$offset\" data-aos=\"" . self::$animation . "-up-right\" data-aos-delay=\"$delay\" data-aos-duration=\"" . ($duration ? $duration : self::$duration) . "\"";
    }

    public static function right(int $delay = 0, int $offset = 0, int $duration = 0): string
    {
        return "data-aos-offset=\"$offset\" data-aos=\"" . self::$animation . "-right\" data-aos-delay=\"$delay\" data-aos-duration=\"" . ($duration ? $duration : self::$duration) . "\"";
    }
    
    public static function down(int $delay = 0, int $offset = 0, int $duration = 0): string
    {
        return "data-aos-offset=\"$offset\" data-aos=\"" . self::$animation . "-down\" data-aos-delay=\"$delay\" data-aos-duration=\"" . ($duration ? $duration : self::$duration) . "\"";
    }

    public static function left(int $delay = 0, int $offset = 0, int $duration = 0): string
    {
        return "data-aos-offset=\"$offset\" data-aos=\"" . self::$animation . "-left\" data-aos-delay=\"$delay\" data-aos-duration=\"" . ($duration ? $duration : self::$duration) . "\"";
    }
}
