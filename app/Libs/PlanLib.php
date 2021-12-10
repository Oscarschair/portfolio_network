<?php

namespace App\Libs;
use Illuminate\Support\Facades\DB;

class PlanLib
{
  // 案件IDに紐づくタグ一覧を取得
  public static function GetDetails($id){
    // プラン詳細
    $plan_details = DB::table('plan_details')
    ->where('plan_id', $id)
    ->whereNotNull('title')
    ->orderBy('edaban', 'asc')->get();

    return $plan_details;
  }

}