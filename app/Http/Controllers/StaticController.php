<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

    }
    public function terms()
    {
        return view('static.terms');
    }
    public function privacypolicy()
    {
        return view('static.privacypolicy');
    }
    public function company()
    {
        return view('static.company');
    }
}
