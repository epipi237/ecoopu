<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\User;
use App\OrderItem;
use App\Order;
use Validator;
use App\Orderlist_address;
use Auth;
use App\country;
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
        $orders=Order::whereUserId(Auth::user()->id)->orderBy('id','desc')->paginate(8);
        $countries=country::all();
     //   dd($orders);
        return view('pages.order',compact('orders','countries'));
    }

    public function create(){
    	$rules = array(
    		'shop' => 'required|max:255',
    		'duration' => 'required|integer',
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
    		//$order->location = Request::input('location');
            $days=Request::input('duration');
            $date=date('Y-m-d', strtotime(date('Y-m-d'). "+ $days days")).' '.date('H:i:s');
            $order->duration =$date ;
            $order->country_id=Request::input('market');
            $order->save();
            $address=new Orderlist_address;
            $address->description=Request::input('location');
            $address->user_id=Auth::user()->id;
            $address->order_id=$order->id;
            $address->save();

            $orders = Order::where('user_id', Auth::user()->id)->firstOrFail();
            $orderItems =OrderItem::where('user_id', Auth::user()->id)->get();
            return Redirect::back()->with('message','successfully created');
        } 

    }

    public function orderlist($id){
        $orders=order::find($id);
        $countries = country::all();
        $orderItems =OrderItem::where('user_id', Auth::user()->id)->where('order_id',$id)->get();
        return view('pages.orderlist', compact('orderItems','orders','countries'));
    }
    public function removeitem($id){
        $item=orderItem::find($id);
        $item->delete();
        return \Redirect::back()->with('message','successfully deleted');
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
            $orderItem->order_id=Request::input('orderid');
            $orderid=Request::input('orderid');
            $orderItem->save();
            return \Redirect("pages/create/orderlist/$orderid");
        }

    }

    public function marketplace($id){
        $orders=Order::whereUserId(Auth::user()->id)->where('country_id',$id)->orderBy('id','desc')->paginate(8);
        $countries=country::all();
     //  dd($orders);
        return view('pages.order',compact('orders','countries'));
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