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

class ProductController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){

    }

    //listing all shops and orders
    public function listShopsAndOrderlists(Request $request) {
        $countries=country::all();

        $shops = Shop::/*select('shops.*')->leftJoin('orders', function($query){
            $query->where('orders.shop', 'LIKE', 'shops.name');
        })->*/orderBy('shops.id', 'desc')->paginate(5);

        //dd($shops);

        $orders = Order::orderBy('id', 'desc')->paginate(4);

        return view('pages.shop_and_orderlists', compact('countries', 'shops', 'orders'));
    }

    //list all orders for this shop
    public function listOrders(Request $request, $id){
        $shop = Shop::find($id);
        if(!$shop){
            \Session::flash('status', 'Sorry shop not found.'); 
            \Session::flash('classAlert', 'danger text-center');
            return \Redirect::back();
        }

        $orders = Order::where('shop', 'like', $shop->name)->paginate(8);
        $countries=country::all();

        return view('pages.list_orders', compact('countries', 'orders', 'shop'));
    }

}
