<?php

namespace App\Libs;

class StrLib
{
  // 文字列を指定した文字数に分け、改行などを付ける
  // 使用例：mb_wordwrap($storyline, 21, '<br/>', true);
  public static function mb_wordwrap($string, $width=75, $break="\n", $cut = false) {
    if (!$cut) {
        $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}\b#U';
    } else {
        $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.'}#';
    }
    $string_length = mb_strlen($string,'UTF-8');
    $cut_length = ceil($string_length / $width);
    $i = 1;
    $return = '';
    while ($i < $cut_length) {
        preg_match($regexp, $string, $matches);
        $new_string = (!$matches ? $string : $matches[0]);
        $return .= $new_string.$break;
        $string = substr($string, strlen($new_string));
        $i++;
    }
    return $return.$string;
  }
}