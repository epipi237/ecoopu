<?php
namespace App\Http\Controllers;

use Request;
use Auth;
use App\User;
use App\country;
use App\Http\Requests;

class SettingsAccount extends Controller
{

	public function index()
	{
		$countries = country::all();
		$users = User::where('id', Auth::user()->id)->get();
		return view('SettingsAccount.index', compact('users','countries'));
	}

	public function update()
	{
		$user = Auth::user();
		$user->name = Request::input('name');
		$user->email = Request::input('email');
		$user->save();
		return redirect('/home');
	}
}
