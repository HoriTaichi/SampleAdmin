<?php

namespace App\Utils;


class StringUtil
{
    public static function isEmpty($str)
    {
        return $str === null || $str === '';
    }


    public static function isNotEmpty($str)
    {
        return $str !== null && $str !== '';
    }
}
