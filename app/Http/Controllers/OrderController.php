<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\User;
use App\OrderItem;
use App\Order;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class OrderController extends Controller{
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
    public function order(){
    	return view('pages.order');
    }

    public function create(){
    	$rules = array(
    		'shop' => 'required|max:255',
    		'location' => 'required',
    		'duration' => 'required',
    		);
    	$messages = array(
    		'required' => 'The :attribute is required.',
    		'same'  => 'The :others must match.'
    		);
    	$validator = Validator::make(Input::all(), $rules);
    	if ($validator->fails()) {
    		$messages = $validator->messages();
    		return Redirect::back()->withErrors($validator)->withInput();

    	} else {
    		$order = new Order;
    		$order->user_id=Auth::user()->id;
    		$order->shop = Request::input('shop');
    		$order->location = Request::input('location');
    		$order->duration = Request::input('duration');
    		$order->save();

    		$orders = Order::where('user_id', Auth::user()->id)->firstOrFail();
    		$orderItems =OrderItem::where('user_id', Auth::user()->id)->get();
    		return view('pages.orderlist', compact('orders','orderItems'));
    	} 

    }

    public function orderlist(){
    	$orders = Order::where('user_id', Auth::user()->id)->firstOrFail();
    	$orderItems =OrderItem::where('user_id', Auth::user()->id)->get();
    	return view('pages.orderlist', compact('orderItems','orders'));
    }

    public function createOrderList(){
    	$rules = array(
    		'product' => 'required',
    		'quantity' => 'required',
    		);
    	$messages = array(
    		'required' => 'The :attribute is required.',
    		'same'  => 'The :others must match.'
    		);
    	$validator = Validator::make(Input::all(), $rules);
    	if ($validator->fails()) {
    		$messages = $validator->messages();
    		return Redirect::back()->withErrors($validator)->withInput();

    	} else {
    		$orderItem = new OrderItem;
    		$orderItem->user_id=Auth::user()->id;
    		$orderItem->product = Request::input('product');
    		$orderItem->quantity = Request::input('quantity');
    		$orderItem->save();
    		return view('pages.orderlist');
    	}

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}