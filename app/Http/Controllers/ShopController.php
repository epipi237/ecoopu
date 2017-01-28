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

     $user = Auth::user()->id;
     $shops = Shop::where('user_id', $user)->get();
     $countries = country::all();
     $orders=order::join('shops', 'orders.shop', '=', 'shops.name')->where('shops.user_id', $user)->where('duration','<',date('Y-m-d H:i:s'))->orderBy('orders.id','desc')->paginate(4);

     return view('shop.home',compact('countries','orders','shops'));	
   }

   public function addshop(){
     $rules = array(
      'name' => 'required',
      'location' => 'required',
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
      $shop->location = Request::input('location');
      $shop->save();
      return Redirect::back();
    }
  }

  public function clients($id){
    $order=order::find($id);
    if(!$order) return \Redirect::back()->with('status','Orderlist is empty');

    $order_id = $order->id;
    $countries = country::all();
    $clients = User::distinct()->join('order_items', 'order_items.user_id','=','users.id')->where('order_items.order_id', $order_id)->select('users.*')->orderBy('users.id','asc')->get();
    return view('shop.client', compact('clients','order_id','countries'));
  }

  public function clientorderlist($id, $order_id){

    // $orderid = OrderItem::where('order_id', $order_id)->get();
    // dd($orderid);

    $user = User::find($id);
    $countries = country::all();
    $orderItems =OrderItem::where('user_id', $user->id)->where('order_id', $order_id)->get();
    $price = Price::where('user_id', $user->id)->where('order_id', $order_id)->first();
    if(!$price){
      $price = new Price;
      $price->price = 0;
    }
    $processingFee = $price->price * 0.01;

    return view('shop.list', compact('orderItems','countries','price', 'order_id','user', 'processingFee'));
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
      return Redirect::back()->with('status', 'Sorry wrong price value entered')->withInput();

    } else {

      $sum = 0;

      $orderItems = OrderItem::whereOrderId(Request::input('order_id'))->get();

      foreach ($orderItems as $orderItem) {
        $orderItem->price = Request::input($orderItem->id);
        echo(Request::input($orderItem->id));
        $sum += $orderItem->price;
        $orderItem->save();
      }

      if($sum == Request::input('total_price')) {
        $price = new Price;
        $price->order_id = Request::input('order_id');
        $price->user_id = Request::input('user_id');
        $price->price = Request::input('total_price');
        $price->save();
      }


      return redirect()->route('shop_index')->with('status', 'Price(s) saved successfully!!!');
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