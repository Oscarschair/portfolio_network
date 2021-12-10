<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

    }
    public function result()
    {
        return view('contact.result');
    }
    public function send(Request $request)
    {
	$user = Auth::user();
	
	$rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required'
        ];
        $this->validate($request, $rules);
 
        $to = [
            ['email' => config('app.sender_address'), 'name' => config('app.sender_name')]
        ];
        
        $data = $request->only('name', 'email', 'message');
        Mail::to($to)->send(new Contact($data));

        return redirect()->route('contact.result');
    }
    
    public function contact()
    {
	$user = Auth::user();

	\Debugbar::addMessage($user);
	return view('contact.index', compact('user'));
    }
}
