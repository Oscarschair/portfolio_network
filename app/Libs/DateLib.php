<?php

namespace App\Libs;
use Carbon\Carbon;


class DateLib
{
  // 例：2019年01月02日(水)
  public static function format_localized($day){
    $date2 =  new Carbon($day);
    setlocale(LC_ALL, 'ja_JP.UTF-8');
    return $date2->formatLocalized('%Y年%m月%d日(%a)');
  }

  // 例：2019年01月02日
  public static function format_ymd($day){
    $date2 =  new Carbon($day);
    setlocale(LC_ALL, 'ja_JP.UTF-8');
    return $date2->formatLocalized('%Y年%m月%d日');
  }

  // 例：2019.01.02
  public static function format_ymd2($day){
    $date2 =  new Carbon($day);
    return $date2->formatLocalized('%Y.%m.%d');
  }

  // 例：2019年01月02日　06時30分
  public static function format_ymdhi($day){
    $date2 =  new Carbon($day);
    return $date2->format('Y年m月d日 H時i分');
  }

  // 例：06時30分
  public static function format_hi_start($day){
    $date2 =  new Carbon($day);
    $hi = $date2->format('H時i分');
    return $hi;
  }
  public static function format_hi_end($day){
    $date2 =  new Carbon($day);
    $hi = $date2->format('H時i分');
    if ($hi==="00時00分"){
      return "24時00分";
    }
    return $hi;
  }

  // 例：2019-01-02
  public static function format_ymd_hyphen($day){
    $date2 =  new Carbon($day);
    return $date2->format('Y-m-d');
  }

  // 引数の日付が未来の場合はtrue
  public static function is_future($day){

    $day2 =  new Carbon($day);
    $dt_now = Carbon::now();

    return ($day2->gte($dt_now));
  }


}