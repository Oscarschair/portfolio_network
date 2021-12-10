<?php

namespace App\Libs;
use Illuminate\Support\Facades\DB;

class BankLib
{
  // 銀行コードに紐づく銀行名を取得
  public static function getBankName($bank_id){
    // 銀行名を取得
    $bank = DB::table('ginko_sitens')
    ->select('name')
    ->where('bank_id', $bank_id)
    ->where('kbn', 1)
    ->first();
    return $bank->name;
  }

  // 銀行コードと支店コードに紐づく支店名を取得
  public static function getBrancheName($bank_id, $branch_id){
    // 支店名を取得
    $branche = DB::table('ginko_sitens')
    ->select('name')
    ->where('bank_id', $bank_id)
    ->where('branch_id', $branch_id)
    ->where('kbn', 2)
    ->first();
    return $branche->name;
  }
}