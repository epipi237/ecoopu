<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\User;
use App\country;
use App\Order;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AdminController extends Controller
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
        $orders = Order::all();
        
        return view('admin.index',compact('countries', 'orders'));
    }

    public function addAdmin(){
        $countries = Country::all();
        return view('admin.addAdmin', compact('countries'));
    }

    public function register(){

        $rules = array(
         'name' => 'required|max:255',
         'email' => 'required|email|max:255|unique:users',
         'password' => 'required|min:6|confirmed',
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
            $admin = new User;
            $admin->name = Request::input('name');
            $admin->role = Request::input('role');
            $admin->email = Request::input('email');
            $admin->password = bcrypt(Request::input('name'));
            $admin->save();

            $data = Request::all();

            //sending mail to newly registerd admin with details
            $this->sendWelcomeMail($data);

            \Session::flash('status', 'Successfully registered admin, check email for invitation with the details.');
            \Session::flash('classAlert', 'success text-center');

            return view('admin.index');
        }
    }

    public function getMarket(){
        $countries = Country::all();
        return view('admin.market',compact('countries'));
    }

    public function addMarket(){
        $rules = array(
         'name' => 'required|max:255',
         'currency_code' => 'required',
         'currency_symbol' => 'required'
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
            $country = new Country;
            $country->name = Request::input('name');
            $country->currency_symbol = Request::input('currency_symbol');
            $country->currency_code = Request::input('currency_code');
            $country->save();
            $countries = Country::all();

            \Session::flash('status', 'Successfully registered market place.');
            \Session::flash('classAlert', 'success text-center');

            return view('admin.market',compact('countries'));
        }
    }

    public function removemarket($id){
        $item=country::find($id);
        $item->delete();
        \Session::flash('status', 'Successfully deleted market place.');
        \Session::flash('classAlert', 'success text-center');

        return \Redirect::back()->with('message','Successfully deleted');
    }

    public function sendWelcomeMail($data){
        //sending a welcome mail
        \Mail::send('emails.welcome', $data, function ($message) use($data){

            $message->from('info@ecoopu.com', 'Get the best deals for all your purchases');

            $message->to($data['email'])->subject("Welcome to eCoopu");
        });

    }

}
