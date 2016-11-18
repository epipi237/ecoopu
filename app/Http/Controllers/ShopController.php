<?php

namespace App\Http\Controllers;

use Auth;
use App\country;
use App\OrderItem;
use App\price;
use Validator;
use App\Order;
use App\Shop;
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
     $countries = country::all();
     $orders=order::join('shops', 'orders.shop', '=', 'shops.name')->where('shops.user_id', $user)->where('duration','>',date('Y-m-d H:i:s'))->orderBy('orders.id','desc')->paginate(4);
     return view('shop.home',compact('countries','orders'));	
   }

   public function addprice(){
     $rules = array(
      'price' => 'required',
      );
     $messages = array(
      'required' => 'The :attribute is required.',
      );
     $validator = Validator::make(Input::all(), $rules);
     if ($validator->fails()) {
      $messages = $validator->messages();
      return Redirect::back()->withErrors($validator)->withInput();

    } else {
      $prices = Input::get('price');
      $order_id = Input::get('user_id');
      foreach($prices as $price) {
        \DB::insert('insert into prices (price,order_id) values (?,?)', array($price,$order_id));
      }
      // $price->order_id=Request::input('order_id');
      // $price->price = Request::input('price');
      // $price->save();
     return redirect()->route('shop_index')->with('status', 'Price(s) saved successfully!!!');;
    }
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

public function orderlist($id){
  $orders=order::find($id);
  $countries = country::all();
    // $orderItems =OrderItem::join('orders', 'order_items.user_id','=','orders.user_id')->where('orders.order_id',$id)->get();
  $prices = price::all();
  $orderItems =OrderItem::where('order_id',$id)->get();
  return view('shop.list', compact('orderItems','orders','countries','prices'));
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