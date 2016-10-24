<?php
namespace App\Http\Controllers;

use Request;
use Auth;
use App\User;
use App\Http\Requests;

class SettingsAccount extends Controller
{

	public function index()
	{
		$users = User::where('id', Auth::user()->id)->get();
		return view('SettingsAccount.index', compact('users'));
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
