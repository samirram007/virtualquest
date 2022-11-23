<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\MailLink;
use Illuminate\Http\Request;
use App\Models\JoiningRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
protected function get_parent(Request $request){
    $user=User::where('code',$request->parent_code)->first();
    if($user){
        return response()->json(['status'=>'success','data'=>$user]);
    }
}
protected function register_through_link(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required'|'string'|'max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'parent_id' => 'required|integer|exists:users,id',
    ]);

    //dd($validator->errors());
    // if($validator->fails()){
    //     return redirect()->back()->withErrors($validator)->withInput();
    // }

    $code = $this->get_unique_code();

    $passcode= rand(100000, 999999);
    $user=User::create([
        'name' => $request->name,
        'code' => 'VQ'.$code,
        'email' => $request->email,
        'parent_id' => $request->parent_id,
        'password' => Hash::make($passcode),
        'passcode' => $passcode,
    ]);
   // dd($user);
    $this->send_email($request->name,$request->email, $user->code, $passcode);
    return redirect()->route('landing')->with('success','Please check your email for passcode');
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $validator=Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'parent_id' => ['required', 'integer', 'exists:users,id']
        ]);
        //dd($validator->errors());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $code = $this->get_unique_code();

        $passcode= rand(100000, 999999);
        $user=User::create([
            'name' => $data['name'],
            'code' => 'VQ'.$code,
            'email' => $data['email'],
            'parent_id' => $data['parent_id'],
            'password' => Hash::make($passcode),
            'passcode' => $passcode,
        ]);
       // dd($user);
        $this->send_email($data['name'],$data['email'], $user->code, $passcode);
        return redirect()->route('landing')->with('success','Please check your email for passcode');
    }

    protected function send_email($name,$email, $code, $passcode){
        $data = array('name'=>$name,'email'=>$email, 'code'=>$code, 'passcode'=>$passcode);
        Mail::send('auth.email_passcode', $data, function($message) use ($data) {
            $message->to($data['email'])->subject('Secure:: VQ Accesscode');
        });
    }
    protected function get_unique_code(){
        $code = rand(10000000, 99999999);
        $user=User::where('code',$code)->first();
        if($user){
            $code = $this->get_unique_code();
        }
        return $code;
    }

    protected function confirm_registration_link($code)
    {
        $mail_link = MailLink::where('code', $code)->first();
        if($mail_link)
        {
            $user = User::where('email', $mail_link->email)->first();
            if($user==null)
            {
                $data=[
                    'email' => $mail_link->email,
                    'code' => $code,
                ];
                return view('auth.confirm_registration_link', $data)->with('success', 'email varified successfully');

            }

            else
            {
                return redirect('/landing')->with('error', 'Invalid confirmation link.');
            }

        }
        else
        {
            return redirect('/landing')->with('error', 'Invalid link');
        }




    }
    protected function confirm_joining_link($code)
    {
        $mail_link = JoiningRequest::where('code', $code)->first();
        if($mail_link)
        {
            $user = User::where('email', $mail_link->email)->first();
            $parent_user=User::where('id',$mail_link->user_id)->first();
            if($user==null)
            {
                $data=[
                    'email' => $mail_link->email,
                    'code' => $code,
                    'name' => $mail_link->name,
                    'parent_user' => $parent_user,
                ];
                $u_code = $this->get_unique_code();

                $passcode= rand(100000, 999999);
                $user=User::create([
                    'name' => $data['name'],
                    'code' => 'VQ'.$u_code,
                    'email' => $mail_link->email,
                    'parent_id' => $parent_user->id,
                    'password' => Hash::make($passcode),
                    'passcode' => $passcode,
                ]);
                //dd($user);
                $this->send_email($data['name'],$data['email'], $user->code, $passcode);

                $notification=[
                    'success'=>'User created successfully',
                ];
                toast($notification['success'],'success');
                return redirect()->route('landing')->with($notification);

                //return view('auth.confirm_joining_link', $data)->with('success', 'email varified successfully');

            }

            else
            {
                return redirect('/landing')->with('error', 'Invalid confirmation link.');
            }

        }
        else
        {
            return redirect('/landing')->with('error', 'Invalid link');
        }




    }

    protected function send_link()
    {
         return view('auth.send_link');
    }
    public function send_link_email(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'email'=>'required|email'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if($user==null)
        {
            $code = rand(100000, 999999);
            $data = [
                'name' => "Applicant",
                'code' => $code,
            ];
            $email=$request->email;
            $mail_link=MailLink::where('email',$email)->first();

            if($mail_link==null)
            {
                $mail_link=new MailLink();
                $mail_link->email=$email;
                $mail_link->code=$code;
                $mail_link->save();
            }
            else
            {
                $mail_link->code=$code;
                $mail_link->save();
            }

            //mail send exception


            //dd($mail_link);
            Mail::send('auth.registration_link',$data, function ($message) use ($email) {
                $message->to($email)->subject('Registration Link');
            });
            //dd($mail_link);
            return response()->json(['status'=>'success','message'=>'Link sent to your email address']);
           // return view('auth.reg_mail_send',compact('email'))->with('success', 'Link sent to your email address');
            //return redirect()->back()->with('success', 'Verification link sent to your email address');
        }
        else
        {
            return response()->json(['status'=>'error','message'=>'Email already exists']);
            //return redirect()->back()->with('error', 'Email already exists');
         //   return redirect()->back()->with('error', 'Email already in use');
        }

    }
    public function registration_link_body($code)
    {
       // $user = User::where('code', $code)->first();
        if($code==null)
        {
            return redirect()->route('send_link')->with('error', 'Invalid link');
        }
        else
        {
            return view('auth.registration_link', compact('code'));
        }
    }

}
