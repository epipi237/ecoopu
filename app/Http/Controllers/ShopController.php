<?php

namespace App\Http\Controllers;

use Auth;
use App\country;
use App\OrderItem;
use App\price;
use Validator;
use App\Order;
use App\Shop;
use App\User;
use App\Orderlist_address;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class ShopController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct() {
     	$this->middleware('auth');
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
      $user_id = Auth::user()->id;
      $shops = Shop::where('user_id', $user_id)->get();
      $countries = country::all();

      $orders = order::join('shops', function($join) use($user_id){
        $join->on('orders.shop', 'like', 'shops.name')->where('shops.user_id', '=', $user_id);
      })->orderBy('orders.id','desc')->selectRaw('orders.*')->paginate(4);

      return view('shop.home',compact('countries','orders','shops'));	
    }

    public function addshop(){
      $rules = array(
        'name' => 'required|unique:shops',
        'address' => 'required',
        'market' => 'required',
        );
      $messages = array(
        'required' => 'The :attribute is required.',
        );
      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails()) {
        $messages = $validator->messages();
        return Redirect::back()->withErrors($validator)->withInput();

      } else {
        $shop = new Shop;
        $shop->user_id=Auth::user()->id;
        $shop->name=Request::input('name');
        $shop->address = Request::input('address');
        $shop->market_place = Request::input('market');
        $shop->save();
          \Session::flash('status', 'Shop successfully added');
          \Session::flash('classAlert', 'success text-center');

        return Redirect::back();
      }
    }

    public function clients($id){
      $order=order::find($id);
      if($order == null) {
          \Session::flash('status', 'Orderlist not found');
          \Session::flash('classAlert', 'danger text-center');
        return \Redirect::back();
      }

      $order_id = $order->id;
      $countries = country::all();
      $clients = User::distinct()->join('order_items', 'order_items.user_id','=','users.id')->where('order_items.order_id', $order_id)->select('users.*')->orderBy('users.id','asc')->get();
      return view('shop.client', compact('clients','order_id','countries'));
    }

    public function clientorderlist($id, $order_id){

      $user = User::find($id);
      $countries = country::all();
      $orderItems =OrderItem::where('user_id', $user->id)->where('order_id', $order_id)->get();
      $price = Price::where('user_id', $user->id)->where('order_id', $order_id)->first();
      $order = Order::find($order_id);
      if(!$price){
        $price = new Price;
        $price->price = 0;
      }

      $processingFee = $price->price * 0.01;
      $orderlist_address = Orderlist_address::whereOrderId($order->id)->whereUserId($user->id)->first();

      return view('shop.list', compact('orderItems', 'order', 'countries','price', 'order_id','user', 'processingFee', 'orderlist_address'));
    }

    public function addprice(){

      $rules = array(
        'total_price' => 'required|numeric|min:1',
        );

      $messages = array(
        'required' => 'The :attribute is required.',
        );

      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails()) {
        $messages = $validator->messages();
          \Session::flash('status', 'Sorry wrong price value entered');
          \Session::flash('classAlert', 'danger text-center');
        return Redirect::back()->with($messages)->withInput();

      } else {

        $sum = 0;

        $orderItems = OrderItem::whereUserId(Request::input('user_id'))->whereOrderId(Request::input('order_id'))->get();

        foreach ($orderItems as $orderItem) {
          $orderItem->price = Request::input($orderItem->id); 
          $sum += $orderItem->price;
          $orderItem->save();
        }

        if($sum == Request::input('total_price')) {
          $price = Price::where('user_id', Request::input('user_id'))->where('order_id', Request::input('order_id'))->first();
          if($price == null) $price = new Price;

          $price->order_id = Request::input('order_id');
          $price->user_id = Request::input('user_id');
          $price->price = Request::input('total_price');
          $price->save();
        }else{
          \Session::flash('status', 'Sorry wrong price value entered');
          \Session::flash('classAlert', 'danger text-center');
          return Redirect::back()->withInput();
        }

        \Session::flash('status', 'Price(s) saved successfully!!!');
        \Session::flash('classAlert', 'success text-center');
        return \Redirect('/shop/clients/'.$price->order_id);
      }
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
        \Session::flash('status', 'Order list successfully created');
        \Session::flash('classAlert', 'success text-center');

        return \Redirect("pages/create/orderlist/$orderid");
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

    public function store(){
        //i want to see wat happens when i am writting on God's will see this code this way and i am sure that my worls will be good n the well formed chcicked of th inodoumoia .I am happy to be a Cameroonian and to be a good one for that matter and to see my country in peace and lord .This is unbelieveable and i thing this is the good way of doing things to see the right oppotunity
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