<?php
namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
   // protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function authenticated($request, $user){
        //dd($user);
        if($user->role === 'admin'){
        return view('admin.index'); //redirect to admin panel
    }
        else {
          
        return view('home'); //redirect to standard user homepage
    }
    }

    public function update(Request $request, $id)
    {
      $user = User::with('users')->find($id);
      if(!$User) {
        return response('User not found', 404);
    }

    $UserInfo = $User->user_info;
    if(!$UserInfo) {
        $UserInfo = new UserInfo();
        $UserInfo->user_id = $id;
        $UserInfo->save();
    }

    try {
        $values = Input::only($UserInfo->getFillable());
        $UserInfo->update($values);
    } catch(Exception $ex) {
        return response($ex->getMessage(), 400);
    }
}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'address' => 'required|min:5',
            'username' => 'required|min:3|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            ]);
    }
}
