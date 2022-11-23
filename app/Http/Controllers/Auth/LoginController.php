<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function setLoginSession(Request $request){
        $request->session()->put('login', $request->type);
        return response()->json(['success' => true]);
    }
    protected function notify(Request $request){
       $validator=Validator::make($request->all(),[
           'email'=>'required|email',
           'name'=>'required',
           'message'=>'required'
         ]);
            if($validator->fails()){
                return response()->json(['success' => false,'errors'=>$validator->errors()]);
            }
            $desk_query=new \App\Models\DeskQuery();
            $desk_query->name=$request->name;
            $desk_query->email=$request->email;
            $desk_query->message=$request->message;
            $desk_query->save();

        return response()->json(['status' => 'success','message'=>'Your message has been sent successfully.']);
    }

}
