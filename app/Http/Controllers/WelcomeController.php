<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class WelcomeController extends Controller
{

	/**
     * Create a new password controller instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('web');
	}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()) {
            return view('home');
        } else {
            return view('welcome');
        }
    }

}
