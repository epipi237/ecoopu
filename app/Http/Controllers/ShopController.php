<?php

namespace App\Http\Controllers;

use App\country;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;

class ShopController extends Controller
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

public function index(){
	$countries = country::all();
	$orders=order::where('duration','>',date('Y-m-d H:i:s'))->orderBy('id','desc')->paginate(4);
	return view('shop.home',compact('countries','orders'));	
}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
        //
    }

}