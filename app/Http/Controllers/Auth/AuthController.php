<?php
namespace App\Http\Controllers\Auth;

use Request;
use App\Http\Requests;
use App\User;
use App\Order;
use App\country;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request as frequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;

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
    protected $redirectTo = '/';

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
            return \Redirect('/admin/dashboard'); //redirect to admin panel
        }elseif ($user->role === 'shop') {
            return \Redirect('/shop/index');
        }else{
            $orders = order::where('duration','>',date('Y-m-d H:i:s'))->whereUserId(Auth::user()->id)->orderBy('id','desc')->paginate(4);
            $countries = country::all();
            //redirect to standard user homepage
            return \Redirect('home'); 
        }
    }

    public function update(Request $request, $id) {
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
    public function register(){
        $rules = array(
            'name' => 'required|min:5',
            'phone' => 'required',
            'role' => 'required',
            'address' => 'required',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|max:255|unique:users',
            );

        $messages = array(
            'required' => 'The :attribute is required.',
            );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return \Redirect::back()->withErrors($validator)->withInput();

        } else {
            $data = Request::all();

            //calling welcome mail sending function
            $this->sendWelcomeMail($data);

            $user = new User;
            $user->name = frequest::input('name');
            $user->phone = frequest::input('phone');
            $user->email = frequest::input('email');
            $user->address = frequest::input('address');
            $user->role = frequest::input('role');
            $user->password = bcrypt(frequest::input('password'));
            $user->save();
            return \Redirect()->to('/login')->with('status', 'Registration successful!');
        }
    }

    public function logout(){
        Auth::logout();
        return \Redirect()->to('/')->with('status', 'Logged out successfully. Hope to see you next time');
    }

    public function sendWelcomeMail($data){
        //sending a welcome mail
        Mail::send('emails.welcome', $data, function ($message) use($data){

            $message->from('info@ecoopu.com', 'Get the best deals for all your purchases');

            $message->to($data['email'])->subject("Welcome to eCoopu");
        });

    }

}