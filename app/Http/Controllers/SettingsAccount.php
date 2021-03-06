<?php
namespace App\Http\Controllers;

use Request;
use Auth;
use Validator;
use App\User;
use App\country;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class SettingsAccount extends Controller
{

	public function index()
	{
		$countries = country::all();
		$user = Auth::user();
		return view('SettingsAccount.index', compact('user', 'countries'));
	}

	public function update()
	{
		$rules = array(
			'name' => 'required|min:5',
			'address' => 'required',
			'phone' => 'required',
			'email' => 'required|email|max:255',
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
			$user = Auth::user();
			$user->name = Request::input('name');
			$user->email = Request::input('email');
			$user->phone = Request::input('phone');
			$user->address = Request::input('address');
			$user->save() ;
			return redirect('/home');
		}
	}
}
