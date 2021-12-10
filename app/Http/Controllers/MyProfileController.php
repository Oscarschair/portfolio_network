<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class MyProfileController extends Controller
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

    public function update(Request $request)
    {
	$user = Auth::user();

	$portfolios = DB::table('portfolios')
        ->where('user_id', $user->id)
        ->get();

    	if($request['updateMethod'] == 'editName'){
	  $user->name = $request['name'];
	  $user->save();
        }elseif($request['updateMethod'] == 'editDescription'){
	  $user->description = $request['description'];
	  $user->save();
        }elseif($request['updateMethod'] == 'iconupload'){
          if($user->icon_path == null){
            $tmpString = Str::random(16).'.png';
            $user->icon_path = $tmpString;
            $user->save();
          }else{
            $tmpString = $user->icon_path;
          }
          \Debugbar::addMessage($tmpString);
          $request->file('file')->storeAs('usricon',$tmpString);
        }elseif($request['updateMethod'] == 'deletePortfolio'){
          DB::table('portfolios')->where('id', '=', $request['portfolioID'])->delete();
	  $portfolios = DB::table('portfolios')
          ->where('user_id', $user->id)
          ->get();
        }elseif($request['updateMethod'] == 'addPortfolio'){
          DB::table('portfolios')->insert([
	    'user_id' =>  $user->id,
	    'url' => $request['newURL'],
	    'first_token' => Str::random(20),
	    'second_token' => Str::random(20),
	    'created_at' => DB::raw('NOW()'),
	  ]);
	  
	  $portfolios = DB::table('portfolios')
          ->where('user_id', $user->id)
          ->get();
        }

        $portfolioTypes = $this->portfolioTypes;
        
	return view('myprofile', compact('user', 'portfolios','portfolioTypes'));
    }
    public function revoke_request()
    {
        return view('auth.revoke');
    }
    public function revoke_consent(Request $request)
    {
	$user = Auth::user();
	
	$user->revoked_at = DB::raw('NOW()');
	$user->name = '退会済';
	$user->email = '退会済'.Str::random(4);
	$user->password = '';
	$user->save();

	$portfolios = DB::table('portfolios')
        ->where('user_id', $user->id)
        ->get();

//	\Debugbar::addMessage($user);
	if(count($portfolios) > 0){
	  foreach($portfolios as $portfolio){
	    DB::table('portfolios')->where('id', '=', $portfolio->id)->delete();	    
	  }
	}

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('auth.revoke_consent');//, compact('user', 'portfolios'));        
    }
    public function myprofile()
    {
	$user = Auth::user();
	\Debugbar::addMessage($user);
	
        $portfolios = DB::table('portfolios')
        ->where('user_id', $user->id)
        ->get();

        $portfolioTypes = $this->portfolioTypes;

        return view('myprofile', compact('user', 'portfolios','portfolioTypes'));
    }
}
