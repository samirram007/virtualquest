<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JoiningRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JoiningRequestController extends Controller
{
    protected $Level_enum;
    protected $level;
    protected $user;
    public function __construct()
    {
        $this->Level_enum = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    }
    public function index()
    {


        return view('user.joining_request', $data);
    }
    public function joining_request()
    {
        $user = auth()->user();
        $data['title'] = 'Joining Request';
        $data['level'] = $this->Level_enum;
        $data['user'] = User::find(Auth::user()->id);
        $data['my_team'] = User::where('parent_id', $user->id)->get();
        $data['collections']=JoiningRequest::where('user_id',Auth::user()->id)->get();
        //dd($user['parent']);
        return view('user.joining_request', $data);
    }
    public function send_joining_request(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:joining_requests|unique:users',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'error','message'=>$validator->errors()->first()]);
        }

        $user = auth()->user();
       // $data = $request->all();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $email=$request->email;
        $data['code']=rand(100000,999999);
        $data['user_id'] = $user->id;
        JoiningRequest::create($data);
        Mail::send('auth.joining_link',$data, function ($message) use ($email) {
            $message->to($email)->subject('Joining Link');
        });
       return response()->json(['status'=>'success','message'=>'Joining Request Sent Successfully']);
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
