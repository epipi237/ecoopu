<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ErrorController extends Controller
{
    public function defaultError(){
    	return view('errors.503');
    }
}
