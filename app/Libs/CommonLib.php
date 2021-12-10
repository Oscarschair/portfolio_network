<?php

namespace App\Libs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use App\User;

class CommonLib
{
  public static $common_profile_path = "";
  public static $common_nickname = "";
  public static $common_notification_cnt = "";
  public static $notifications = [];

  // 全画面の表示時の共通情報を取得
  public static function get_info(){
    if (Auth::check()) {
//      $user = User::find(Auth::id());

//      self::$common_nickname = $user->nickname;

//      if ($user->profile_path !== null){
//        self::$common_profile_path = $user->profile_path;
//      }
      
      // 通知数を取得
  //    self::$common_notification_cnt = DB::table('notifications')->where('to_user_id', Auth::id())->where('opened_flg', 0)->count();

      // 通知数を取得
 //     self::$notifications = DB::table('notifications')->where('to_user_id', Auth::id())->orderByDesc('created_at')->limit(10)->get();
    }
  }
}
