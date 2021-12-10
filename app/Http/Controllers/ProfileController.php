<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class ProfileController extends Controller
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

    public function viewProfile($id)
    {
	\Debugbar::addMessage($id);


	$user = DB::table('users')
        ->where('id', $id)
        ->first();
	\Debugbar::addMessage($user);
	
        $portfolios = DB::table('portfolios')
        ->where('user_id', $id)
        ->get();

        $portfolioTypes = $this->portfolioTypes;

        return view('profile.view', compact('user', 'portfolios','portfolioTypes'));
    }
}
