<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class PortfolioController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function __construct()
    {
	$this->portfolioTypes = new Collection(['Webデザイナー', 'CGクリエーター', 'イラストレーター', 'エンジニア', 'Webディレクター', 'コピーライター']);

    }

    public function editPortfolio(Request $request, $id)
    {
	$user = Auth::user();

        $portfolio = DB::table('portfolios')
        ->where('id', $id)
        ->first();

	\Debugbar::addMessage($id);

	if($request['updateMethod'] == 'iconupload'){
          if($portfolio->icon_path == null){
            $tmpString = Str::random(16).'.png';
            $portfolio->icon_path = $tmpString;
            DB::table('portfolios')
            ->where('id', $id)
            ->update(['icon_path' => $tmpString]);
          }else{
            $tmpString = $portfolio->icon_path;
          }
          $request->file('file')->storeAs('portfolioicon',$tmpString);
	}elseif($request['updateMethod'] == 'editTitle'){
          DB::table('portfolios')
          ->where('id', $id)
          ->update(['title' => $request['title']]);
	}elseif($request['updateMethod'] == 'editDescription'){
          DB::table('portfolios')
          ->where('id', $id)
          ->update(['description' => $request['description']]);
	}elseif($request['updateMethod'] == 'editType'){
          DB::table('portfolios')
          ->where('id', $id)
          ->update(['type' => $request['type']]);
	}elseif($request['updateMethod'] == 'switchDisplay'){
	  if($request['displaySwitcher']=="on"){
	    $tmpflag = "1";
	  }else{
	    $tmpflag = "0";
	  }
          DB::table('portfolios')
          ->where('id', $id)
          ->update(['display_flag' => $tmpflag]);
	}elseif($request['updateMethod'] == 'downloadAuthentication'){
	  $first_token=$portfolio->first_token;
	  $second_token=$portfolio->second_token;
	  $tmpHTML="<!DOCTYPE html><html lang=\"ja\"><head><meta charset=\"UTF-8\"><meta name=\"portfolio-authentication\" content=\"".$second_token."\"></head><body></body></html>";
	  $tmpFilename=$first_token.".html";
	  
	  return response()->streamDownload(function () use ($tmpHTML) {
	    echo $tmpHTML;
	  }, $tmpFilename);
	}elseif($request['updateMethod'] == 'authenticateNow'){
          $first_token=$portfolio->first_token;
	  $second_token=$portfolio->second_token;
	  
	  if(substr($portfolio->url, -1) == "/"){
	    $url=$portfolio->url.$first_token.".html";
	  }else{
	    $url=$portfolio->url."/".$first_token.".html";
	  }
	  
	  $context = stream_context_create(array(
	    'http' => array('ignore_errors' => true)
	  ));
	  
	  $html = file_get_contents($url, false, $context);
	  $checkString = "!DOCTYPE html><html lang=\"ja\"><head><meta charset=\"UTF-8\"><meta name=\"portfolio-authentication\" content=\"".$second_token."\"></head><body></body></html>"; 

	  if (strpos($html,"not found") > 0 ) {
	    DB::table('portfolios')
            ->where('id', $id)
            ->update(['failed_message' => "ファイルが見つかりません",'failed_at' => DB::raw('NOW()')]);
	  }elseif (strpos($html,$checkString)!=false) {
	    DB::table('portfolios')
            ->where('id', $id)
            ->update(['verified_at' => DB::raw('NOW()')]);	  
	  }else{
	    DB::table('portfolios')
            ->where('id', $id)
            ->update(['failed_message' => "認証ファイルが一致しません",'failed_at' => DB::raw('NOW()')]);	  
	  }
	}

	DB::table('portfolios')
	->where('id', $id)
	->update(['updated_at' => DB::raw('NOW()')]);

        $portfolio = DB::table('portfolios')
        ->where('id', $id)
        ->first();

	$portfolioTypes = $this->portfolioTypes;
	return view('portfolio.edit', compact('user', 'portfolio','portfolioTypes'));
	
    }
    public function clickPortfolio(Request $request, $id)
    {
	\Debugbar::addMessage($request['urlClicked']);

	$urlClicked = $request['urlClicked'];

	$user = Auth::user();

        DB::table('portfolios')
        ->where('id', $id)
        ->increment('view');

        DB::table('portfolios')
        ->where('id', $id)
        ->increment('click');

        $portfolio = DB::table('portfolios')
        ->where('id', $id)
        ->first();

	$portfolioTypes = $this->portfolioTypes;
		
	return view('portfolio.view', compact('user', 'portfolio','portfolioTypes','urlClicked'));
    }
    public function viewPortfolio($id)
    {
	$urlClicked = null;

        DB::table('portfolios')
        ->where('id', $id)
        ->increment('view');

        $portfolio = DB::table('portfolios')
        ->where('id', $id)
        ->first();
	\Debugbar::addMessage($portfolio);


	$user =  DB::table('users')
        ->where('id', $portfolio->user_id)
        ->first();


	$portfolioTypes = $this->portfolioTypes;
	return view('portfolio.view', compact('user', 'portfolio','portfolioTypes','urlClicked'));
    }
    public function viewEditPortfolio($id)
    {
	$user = Auth::user();

        $portfolio = DB::table('portfolios')
        ->where('id', $id)
        ->first();
	\Debugbar::addMessage($portfolio);

	$portfolioTypes = $this->portfolioTypes;
	return view('portfolio.edit', compact('user', 'portfolio','portfolioTypes'));
    }
}
