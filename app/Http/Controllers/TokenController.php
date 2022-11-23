<?php

namespace App\Http\Controllers;

use App\Models\PpsStaking;
use Illuminate\Http\Request;
use App\Models\MpsInvestment;
use App\Models\PaymentRequest;
use App\Models\SelfInvestment;
use App\Models\ReferralBenefit;
use App\Models\TokenApplication;
use App\Models\PpsLevelDistribution;

class TokenController extends Controller
{
    protected $payment_method;
    protected $token_rate;

    function __construct()
    {
        // $this->payment_method = config('app.payment_method');
        // $this->payment_method = ['ERC20','TRC20','TRC10'];
        $this->payment_method = ['ERC20','TRC10'];
        $this->token_rate=0.35;
    }

    protected function create(){
        $data['title'] = 'Token Application';
        $data['title_pps'] = 'Token Against PPS';
        $data['title_mps'] = 'Token Against MPS';
        $user = auth()->user();
        //dd($user);
        $data['self_insvestment']=SelfInvestment::where('user_id',$user->id)->where('status','1')->sum('amount');
        $data['mps_insvestment']=MpsInvestment::where('user_id',$user->id)->where('status','1')->sum('amount');

        $data['pps_token_application_pending']=TokenApplication::where('email',$user->email)
        ->where('status','pending')
        ->where('is_staking','1')
        ->where('scheme','pps')
        ->sum('amount');
       // dd($data['token_application_exist']);
        $data['pps_token_application_approved']=TokenApplication::where('email',$user->email)
        ->where('status','approved')
        ->where('is_staking','1')
        ->where('scheme','pps')
        ->sum('amount');
        $data['pps_total_pending']=0;
        $data['pps_total']=$data['self_insvestment']-$data['pps_token_application_approved'];
        $data['pps_balance']=$data['self_insvestment']-$data['pps_token_application_approved']-$data['pps_token_application_pending'];
        // $data['balance']=$data['total']-$data['total_paid']-$data['total_pending'];


        //
        $data['mps_token_application_pending']=TokenApplication::where('email',$user->email)
        ->where('status','pending')
        ->where('is_staking','1')
        ->where('scheme','mps')
        ->sum('amount');
       // dd($data['token_application_exist']);
        $data['mps_token_application_approved']=TokenApplication::where('email',$user->email)
        ->where('status','approved')
        ->where('is_staking','1')
        ->where('scheme','mps')
        ->sum('amount');
        $data['mps_total_pending']=0;
        $data['mps_total']=$data['mps_insvestment']-$data['mps_token_application_approved'];
        $data['mps_balance']=$data['mps_insvestment']-$data['mps_token_application_approved']-$data['mps_token_application_pending'];

        $data['payment_method']=$this->payment_method;
        //session()->put('success','');
        return view('token.application',$data);
    }
    protected function store(Request $request){
        $user = auth()->user();
       // dd($user);

        $appli_data = new \App\Models\TokenApplication();
        //$appli_data= new TokenApplication();
        $appli_data->name=$user->name;
        $appli_data->email=$user->email;
        $appli_data->contact_no=$user->contact_no==null?'':$user->contact_no;
        $appli_data->amount=$request->amount;
        $appli_data->token=$request->amount/$this->token_rate;
        $appli_data->token_rate=$this->token_rate;
        $appli_data->scheme=$request->token_type;
        $appli_data->is_staking=1;
        $appli_data->status='pending';
        $appli_data->save();
        //session()->put('success','Application Submitted Successfully');
        return response()->json(['status'=>'success','message'=>'Application Submitted Successfully']);
    }
}
