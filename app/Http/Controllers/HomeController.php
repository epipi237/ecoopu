<?php

namespace App\Http\Controllers;

use App\Order;
use App\country;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = country::all();
        $orders = order::where('duration','>',date('Y-m-d H:i:s'))->orderBy('id','desc')->paginate(4);
        return view('home', compact('countries','orders'));
    }
}
