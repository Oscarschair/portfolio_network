<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sitemap()
    {
    	$routeCollection = Route::getRoutes();
    	$uris = new Collection();
    	
    	foreach($routeCollection as $routes){
	    if(strpos($routes->uri,'_') === 0 || $routes->uri == "sanctum/csrf-cookie" || $routes->uri == "api/user" || strpos($routes->uri,'password') === 0 || strpos($routes->uri,'email') === 0 || strpos($routes->uri,'revoke_request') === 0 || strpos($routes->uri,'portfolio/mod/') === 0 || strpos($routes->uri,'contact/result') === 0 || strpos($routes->uri,'logout') === 0 || strpos($routes->uri,'myprofile') === 0 || strpos($routes->uri,'sitemap') === 0 || strpos($routes->uri,'admin') === 0 || strpos($routes->uri,'login/google') === 0){
	      //不用
	    }else{
	      $uris->push($routes->uri);
            }
    	}
    	$uris = $uris->unique();
    	
      $portfolios = DB::table('portfolios')
      ->whereNotNull('portfolios.verified_at')
      ->where('display_flag','1')
      ->get();

      $users = DB::table('users')
      ->whereNotNull('users.email_verified_at')
      ->get();
    	
    	
        return response()->view('sitemap', compact('uris','portfolios','users'))->header('Content-Type', 'text/xml');
    }
}
