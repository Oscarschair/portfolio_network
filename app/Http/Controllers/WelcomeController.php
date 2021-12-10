<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class WelcomeController extends Controller
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
    
    public function index()
    {
        $portfolios = DB::table('portfolios')
        ->whereNotNull('portfolios.verified_at')
        ->where('display_flag','1')
        ->orderBy('portfolios.verified_at', 'desc')
        ->paginate(5);

	\Debugbar::addMessage($portfolios);

        $portfolioTypes = $this->portfolioTypes;
        $portfolioColors = $this->portfolioColors;
        
        return view('welcome', compact('portfolios','portfolioTypes','portfolioColors'));
    }
}
