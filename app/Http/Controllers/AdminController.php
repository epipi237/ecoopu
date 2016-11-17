<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\User;
use App\country;
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
        return view('admin.index',compact('countries'));
    }

    public function addAdmin(){

        return view('admin.addAdmin');
    }

    public function register(){

        $rules = array(
           'name' => 'required|max:255',
           'username' => 'required|min:3|unique:users',
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
            $admin->username = Request::input('username');
            $admin->role = Request::input('role');
            $admin->email = Request::input('email');
            $admin->password = bcrypt(Request::input('name'));
            $admin->save();
            return view('admin.index');
        }
    }

    public function getMarket(){
        $markets = Country::all();
        return view('admin.market',compact('markets'));
    }

    public function addMarket(){
        $rules = array(
           'name' => 'required|max:255',
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
            $country->save();

            $markets = Country::all();
            return view('admin.market',compact('markets'));
        }
    }

    public function removemarket($id){
        $item=country::find($id);
        $item->delete();
        return \Redirect::back()->with('message','successfully deleted');
    }



}
