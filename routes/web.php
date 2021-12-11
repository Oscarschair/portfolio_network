<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
App::setLocale('ja');

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/guide', 'StaticController@guide')->name('guide');
Route::get('/terms', 'StaticController@terms')->name('terms');
Route::get('/privacypolicy', 'StaticController@privacypolicy')->name('privacypolicy');
Route::get('/company', 'StaticController@company')->name('company');


Route::get('/contact', 'ContactController@contact')->name('contact');
Route::post('/contact', 'ContactController@send')->name('contact.send');
Route::get('/contact/result', 'ContactController@result')->name('contact.result');


Route::get('/search', 'SearchController@search')->name('search');
Route::post('/search', 'SearchController@search')->name('globalSearch');


Route::get('/portfolio/{id}', 'PortfolioController@viewPortfolio')->name('viewPortfolio');
Route::post('/portfolio/{id}', 'PortfolioController@clickPortfolio')->name('clickPortfolio');

Route::get('/profile/{id}', 'ProfileController@viewProfile')->name('viewProfile');


Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/portfolio/mod/{id}', 'PortfolioController@viewEditPortfolio')->name('viewEditPortfolio');
    Route::post('/portfolio/mod/{id}', 'PortfolioController@editPortfolio')->name('editPortfolio');
}); 
	
Route::middleware(['verified'])->group(function(){
    Route::get('/myprofile', 'MyProfileController@myprofile')->name('myprofile');
    Route::post('/myprofile', 'MyProfileController@update')->name('editProfile');
    
    Route::get('/revoke_request', 'MyProfileController@revoke_request')->name('revoke_request');
    Route::post('/revoke_request', 'MyProfileController@revoke_consent')->name('revoke_consent');
}); 
 
 
 

