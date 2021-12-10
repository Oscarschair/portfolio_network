<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
	$this->portfolioTypes = new Collection(['Webデザイナー', 'CGクリエーター', 'イラストレーター', 'エンジニア', 'Webディレクター', 'コピーライター']);
	$this->portfolioColors = new Collection(['#06286d', '#066d63', '#6d1906', '#6d066a', '#086d06', '#c3710b']);
    }
    
    public function search(Request $request)
    {
	//\Debugbar::addMessage($request['type']);
	$keyword = $request['keyword'];
	if($request['type'] == 999 || $request['type'] == null){
		if($request['keyword'] != null){
			$portfolios = DB::table('portfolios')
			->whereNotNull('portfolios.verified_at')
			->where('display_flag','1')
			->where(function($query) use($keyword){
				$query->where('description','like', '%' . $keyword . '%')
					->orWhere('title','like', '%' . $keyword . '%');
			})
			->orderBy('portfolios.verified_at', 'desc')
			->paginate(8);
		}else{
			$portfolios = DB::table('portfolios')
			->whereNotNull('portfolios.verified_at')
			->where('display_flag','1')
			->orderBy('portfolios.verified_at', 'desc')
			->paginate(8);
		}
		$type = 999;
	}else{
		if($request['keyword'] != null){
			$portfolios = DB::table('portfolios')
			->whereNotNull('portfolios.verified_at')
			->where('display_flag','1')
			->where('type',$request['type'])
			->where(function($query) use($keyword){
				$query->where('description','like', '%' . $keyword . '%')
					->orWhere('title','like', '%' . $keyword . '%');
			})
			->orderBy('portfolios.verified_at', 'desc')
			->paginate(8);
		}else{
			$portfolios = DB::table('portfolios')
			->whereNotNull('portfolios.verified_at')
			->where('display_flag','1')
			->where('type',$request['type'])
			->orderBy('portfolios.verified_at', 'desc')
			->paginate(8);
		}
		$type = $request['type'];
	}
	$keyword = $request['keyword'];
	
	\Debugbar::addMessage($portfolios);

        $portfolioTypes = $this->portfolioTypes;
        $portfolioColors = $this->portfolioColors;
	
	
        return view('search', compact('portfolios','portfolioTypes','portfolioColors','type','keyword'));
    }
}
