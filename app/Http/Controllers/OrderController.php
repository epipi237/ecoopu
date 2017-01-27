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
use App\price;
use App\transaction;
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
        return view('pages.order', compact('orders','countries'));
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
            $order->location = Request::input('location');
            $order->country_id=Request::input('market');
            $order->save();
            $address=new Orderlist_address;
            $address->description = Request::input('location');
            $address->user_id=Auth::user()->id;
            $address->order_id=$order->id;
            $address->save();

            $orders = Order::where('user_id', Auth::user()->id)->firstOrFail();
            $orderItems =OrderItem::where('user_id', Auth::user()->id)->get();
            return Redirect::back()->with('status','successfully created');
        } 
    }

    public function orderlist($id, $status = "For your order to be delivered you need to pay a processing fee", $classAlert='success'){
        $order=order::find($id);
        $countries = country::all();
        $user_id = Auth::user()->id;
        $orderItems =OrderItem::where('user_id', $user_id)->where('order_id',$id)->get();
        $price = Price::where('user_id', $user_id)->where('order_id', $id)->first();
        if(!$price) {
            $price = new Price;
            $price->price = 0;
        }
        $processingFee = $price->price * 0.01;

        $paypalUrl = 'http://ecoopu.webshinobis.com/pages/create/orderlist/'.$order->id;
        //session(['status' => 'For your order to be delivered you need to pay a processing fee']);
        return view('pages.orderlist', compact('orderItems', 'order', 'user_id', 'countries', 'price', 'processingFee', 'status', 'paypalUrl', 'classAlert'));
    }

    public function paymentStatus($id, $status){
        $request = Request::all();
        $merchantIdentityToken = 'bz6NBE8VbOISB0AYsYGcXrbfxYf1D-gxvvg2qJ-ORWUUSr65xDXoEextb1u';
        if($status == 'failed'){
            return $this->orderlist($id, "Sorry but couldn't process your payment, please try again", 'danger');
        }else{
            //updating the price table to say the platform fee has been paid
            $order=order::find($id);
            $user_id = Auth::user()->id;
            $price = Price::where('user_id', $user_id)->where('order_id', $id)->first();
            $price->paidStatus = true;
            $price->save();

            //keeping a record of this transaction
            $transaction = new transaction;
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->description = $request['item_name'];
            $transaction->tx = $request['tx'];
            $transaction->amount_paid = $request['amt'];
            $transaction->cc = $request['cc'];
            $transaction->status = $request['status'];
            $transaction->save();


            return $this->orderlist($id, 'Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at www.paypal.com to view details of this transaction.');
        }

    }

    public function paymentStatusIPN(){
        $request = Request::all();
        $merchantIdentityToken = 'bz6NBE8VbOISB0AYsYGcXrbfxYf1D-gxvvg2qJ-ORWUUSr65xDXoEextb1u';
        if($status == 'failed'){
            return $this->orderlist($id, "Sorry but couldn't process your payment, please try again", 'danger');
        }else{
            //updating the price table to say the platform fee has been paid
            $order=order::find($id);
            $user_id = Auth::user()->id;
            $price = Price::where('user_id', $user_id)->where('order_id', $id)->first();
            $price->paidStatus = true;
            $price->save();

            //keeping a record of this transaction
            $transaction = new transaction;
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->description = $request['item_name'];
            $transaction->tx = $request['tx'];
            $transaction->amount_paid = $request['amt'];
            $transaction->cc = $request['cc'];
            $transaction->status = $request['status'];
            $transaction->save();


            return $this->orderlist($id, 'Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at www.paypal.com to view details of this transaction.');
        }

    }

    public function updateShippingAddress(){
        $request = Request::all();
        $id = $request['id'];
        
        $orderlist_address = Orderlist_address::find($id);
        if($orderlist_address == null) return Redirect::back()->with('status', 'Sorry could not update this address');

        $orderlist_address->description = $request['shipping_address'];
        $orderlist_address->save();

        return Redirect::back()->with('status', 'Successfully updated your shipping address');
    }

    public function removeitem($id){
        $item=orderItem::find($id);
        $item->delete();
        return \Redirect::back()->with('status', 'successfully deleted');
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
        $country = country::find($id);
        // dd($country);
     //  dd($orders);
        return view('pages.marketplaces',compact('orders','countries','country'));
    }

    public function expired(){
        $countries=country::all();
        $orders=order::where('duration','<',date('Y-m-d H:i:s'))->paginate(4);
        return view('pages.expiredorder', compact('countries','orders'));
    }

    public function removeorder($id){
        $item=order::find($id);
        $item->delete();
        return \Redirect::back()->with('message','successfully deleted');
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