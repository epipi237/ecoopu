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
use App\Shop;
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
    private $eurodkk = 7.43781;
    private $eurogbp = 0.849823;
    private $gbpdkk = 8.75445;

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
        \Session::set('status', '');

        return view('pages.order', compact('orders', 'countries'));
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
            /*$order->location = Request::input('location');*/
            $order->country_id=Request::input('market');
            $order->save();
            $address=new Orderlist_address;
            $address->description = 'Not yet specified by the client';//Request::input('location');
            $address->user_id=Auth::user()->id;
            $address->order_id=$order->id;
            $address->save();

            $orders = Order::where('user_id', Auth::user()->id)->firstOrFail();
            $orderItems =OrderItem::where('user_id', Auth::user()->id)->get();

            return Redirect::to('pages/create/orderlist/'.$order->id)->with(['status' => 'Order list successfully created', 'classAlert' => 'success text-center']);
        } 
    }

    public function orderlist($id){
        $order=order::find($id);
        if(!$order) return \Redirect::back();

        $countries = country::all();
        $user_id = Auth::user()->id;
        $orderItems = OrderItem::where('user_id', $user_id)->where('order_id',$id)->get();
        $price = Price::where('user_id', $user_id)->where('order_id', $id)->first();
        if(!$price) {
            $price = new Price;
            $price->price = 0;
        }
        $processingFee = $price->price * 0.01;

        $orderlist_address = Orderlist_address::whereOrderId($order->id)->whereUserId($user_id)->first();
        
        if(!$orderlist_address) {
            $orderlist_address = new Orderlist_address;
            $orderlist_address->id = 0;
            $orderlist_address->user_id = 0;
            $orderlist_address->order_id = 0;
        }

        if($price->paidStatus == true && $price->price > 0){
            \Session::flash('status', 'Thanks for completing your platform charges, you can now update your delivery address. The seller will be notified of your payment and can contact you for your order.');
            \Session::flash('classAlert', 'success');
        }elseif($price->paidStatus == false && $price->price < 0) {
            \Session::flash('status', 'For you order to be delievered, you need to wait for an offer and then pay the processing fee.'); 
            \Session::flash('classAlert', 'info text-center');
        }elseif($price->paidStatus == false && $price->price > 0) {
            \Session::flash('status', 'For you order to be delievered, pay the processing fee.'); 
            \Session::flash('classAlert', 'info text-center');
        }

        $paypalUrl = 'http://ecoopu.webshinobis.com/pages/create/orderlist/'.$order->id;

        foreach ($orderItems as $orderItem) {
            $orderItem->new_price = 0;
        }

        $items = OrderItem::whereOrderId($id)->selectRaw('DISTINCT product, count(product) as product_count')->groupBy('product')->get();
        
        $user_currency_code = $this->getCurrenyCode();
        $user_currency_symbol = country::select('currency_symbol')->whereCurrencyCode($user_currency_code)->first();
        $user_currency_symbol = $user_currency_symbol->currency_symbol;

        //converting price to user's locale
        if($order->country->currency_code != $user_currency_code){
            foreach ($orderItems as $orderItem) {
                $orderItem->new_price = $this->convertCurrency($order->country->currency_code, $user_currency_code, $orderItem->price);
            }

            $price->new_price = $this->convertCurrency($order->country->currency_code, $user_currency_code, $price->price);
        }

        return view('pages.orderlist', compact('orderItems', 'order', 'user_currency_symbol', 'user_id', 'countries', 'price', 'processingFee', 'paypalUrl', 'orderlist_address', 'items'));
    }

    public function paymentStatus($id, $status){
        $request = Request::all();
        $merchantIdentityToken = 'bz6NBE8VbOISB0AYsYGcXrbfxYf1D-gxvvg2qJ-ORWUUSr65xDXoEextb1u';
        if($status == 'failed'){
            \Session::flash('status', 'Sorry but couldn\'t process your payment, please try again.');
            \Session::flash('classAlert', 'danger text-center');
            return $this->orderlist($id);
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
            $transaction->status = $request['st'];
            $transaction->save();

            return $this->orderlist($id);
        }

    }

    public function paymentStatusIPN(){
        $request = Request::all();
        $merchantIdentityToken = 'bz6NBE8VbOISB0AYsYGcXrbfxYf1D-gxvvg2qJ-ORWUUSr65xDXoEextb1u';
        if($status == 'failed'){
            //session(['status'=>'Sorry but couldn\'t process your payment, please try again.', 'classAlert' => 'danger text-center']);
        }else{
            //updating the price table to say the platform fee has been paid
            $order = order::find($id);
            $user_id = Auth::user()->id;
            $price = Price::where('user_id', $user_id)->where('order_id', $id)->first();
            $price->paidStatus = true;
            $price->save();

            //keeping a record of this transaction
            $transaction = new transaction;
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->description = 'IPN ' . $request['item_name'];
            $transaction->tx = $request['tx'];
            $transaction->amount_paid = $request['amt'];
            $transaction->cc = $request['cc'];
            $transaction->status = $request['st'];
            $transaction->save();

        }

    }

    public function updateShippingAddress(){
        $request = Request::all();
        $id = $request['id'];
        $order_id = $request['order_id'];
        $orderlist_address = Orderlist_address::whereId($id)->whereOrderId($order_id)->whereUserId(Auth::user()->id)->first();

        if($orderlist_address == null) $orderlist_address = new Orderlist_address;

        $orderlist_address->user_id = Auth::user()->id;
        $orderlist_address->order_id = $request['order_id'];
        $orderlist_address->description = $request['shipping_address'];
        $orderlist_address->save();

        return Redirect::back()->with(['status' => 'Successfully updated your shipping address', 'classAlert' => 'success text-center']);
    }

    public function removeItem($id){
        $item=orderItem::find($id);
        $item->delete();
        return \Redirect::back()->with(['status' => 'Item successfully deleted', 'classAlert' => 'success text-center']);
    }

    public function addItem(){
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
            $orderItem->description = Request::input('details');
            $orderItem->quantity = Request::input('quantity');
            $orderItem->order_id=Request::input('orderid');
            $orderid=Request::input('orderid');
            $orderItem->save();

            return \Redirect("pages/create/orderlist/$orderid")->with(['status' => 'Item successfully added', 'classAlert' => 'success text-center']);
        }
    }

    public function marketplace($id){

        $orders=Order::whereCountryId($id)->orderBy('id', 'desc')->paginate(8);
        $countries=country::all();
        $country = country::find($id);

        \Session::set('status', '');
        \Session::set('classAlert', '');

        return view('pages.marketplaces',compact('orders','countries','country'));
    }

    public function expired(){
        $countries=country::all();
        $orders=order::where('duration','<',date('Y-m-d H:i:s'))->paginate(4);
        \Session::set('status', '');

        return view('pages.expiredorder', compact('countries','orders'));
    }

    public function removeorder($id){
        $item=order::find($id);
        $item->delete();

        return \Redirect::back()->with('message', 'Order successfully deleted');
    }

    /*
    *Getting the country from the request object
    *
    */
    function getCurrenyCode() {

        $ip = $_SERVER['REMOTE_ADDR'];
        try {
            $country = file_get_contents("http://ipinfo.io/{$ip}/country");
        }catch(Exception $e) {
            return 'EUR';
        }

        $currency_codes = array(
            'UK' => 'GBP',
            'FR' => 'EUR',
            'DE' => 'EUR',
            'DK' => 'DKK',
            );

        if(isset($currency_codes[$country])) {
            return $curreny_codes[$country];
        }

        return 'EUR'; // Default to EUR
    }

    public function convertCurrency($fromCode, $toCode, $amount){
        $new_price = 0;
        if($toCode == 'DKK'){
            if($fromCode == "EUR"){
                $new_price = $amount*$this->eurodkk;
            }elseif($fromCode == 'GBP'){
                $new_price = $amount*$this->gbpdkk;
            }
        }elseif($toCode == 'EUR'){
            if($fromCode == "DKK"){
                $new_price = $amount/$this->eurodkk;
            }elseif($fromCode == 'GBP'){
                $new_price = $amount/$this->eurogbp;
            }
        }elseif($toCode == 'GBP'){
            if($fromCode == "EUR"){
                $new_price = $amount*$this->eurogbp;
            }elseif($fromCode == 'DKK'){
                $new_price = $amount/$this->gbpdkk;
            }
        }
        return round($new_price, 2);
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