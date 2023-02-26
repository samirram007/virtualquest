<?php

namespace App\Http\Controllers;

use App\Models\MainWallet;
use App\Models\PpsStaking;
use Illuminate\Http\Request;
use App\Models\PaymentRequest;
use App\Models\ReferralBenefit;
use Illuminate\Support\Facades\DB;
use App\Models\PpsLevelDistribution;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    protected $payment_method;
    public function __construct()
    {
        // $this->payment_method = config('app.payment_method');
        // $this->payment_method = ['ERC20','TRC20','TRC10'];
        $this->payment_method = ['ERC20', 'TRC10'];
    }

    protected function wallet_view()
    {
        $data['title'] = 'Wallet';
        $user = auth()->user();
        $data['referral_benefit'] = ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['pps_staking'] = PpsStaking::where('user_id', $user->id)->sum('commission');
        $data['pps_level'] = PpsLevelDistribution::where('parent_id', $user->id)->sum('commission');
        $data['total'] = $data['referral_benefit'] + $data['pps_staking'] + $data['pps_level'];
        return view('wallet.wallet_view', $data);
    }
    protected function main_wallet()
    {
        $data['title'] = 'Main Wallet';
        $user = auth()->user();
        // $ex_payment_request =PaymentRequest::where('user_id',$user->id)
        // ->where(DB::raw("(DATE_FORMAT(payment_request_date,'%Y-%m-%d'))"),date('Y-m-d'))->toSql();
        // dd($ex_payment_request);
        $data['rld_amount'] = MainWallet::where('user_id', $user->id)->Where('sub_wallet','rld')->sum('amount');
        $data['pps_amount'] = MainWallet::where('user_id', $user->id)->Where('sub_wallet','pps')->sum('amount');
        $data['ppsl_amount'] = MainWallet::where('user_id', $user->id)->Where('sub_wallet','ppsl')->sum('amount');
        $data['total'] = $data['rld_amount'] + $data['pps_amount'] + $data['ppsl_amount'];
        $data['total_paid'] = PaymentRequest::where('user_id', $user->id)->where('status', 'paid')->sum('amount');
        $data['total_pending'] = PaymentRequest::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
        $data['balance'] = $data['total'] - $data['total_paid'] - $data['total_pending'];
        $data['payment_method'] = $this->payment_method;
        return view('wallet.main_wallet_view', $data);
    }
    protected function pps_transfer_to_wallet(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = auth()->user();
            $data['title'] = 'PPS Wallet';
            $data['sub_wallet'] = 'pps';
            $today_data=MainWallet::where('user_id', Auth::user()->id)
            ->where('sub_wallet', 'pps')
            ->where('transfer_date',date('Y-m-d'))
            ->where('created_at','>=',date('Y-m-d H:i:s',strtotime('-30 seconds')))
            ->first();
            if($today_data){
                return redirect()->back()->with('error', 'Already Transfered Today');
            }

            $data['collection'] = PpsStaking::with('investment', 'user')->where('user_id', Auth::user()->id)->get();
            $data['total_benefit'] = PpsStaking::where('user_id', Auth::user()->id)->sum('commission');
            $data['transfered'] = MainWallet::where('user_id', Auth::user()->id)
                ->where('sub_wallet', 'vps')
                ->sum('amount');
            $data['balance'] = $data['total_benefit'] - $data['transfered'];
            $balance = $data['balance'];

            $request->validate([
                'balance' => 'required|numeric|min:0.0001|max:' . $balance,
            ]);

            $main_wallet = new MainWallet();
            $main_wallet->user_id = $user->id;
            $main_wallet->transfer_date = date('Y-m-d');
            $main_wallet->amount = $balance;
            $main_wallet->sub_wallet = $request->sub_wallet;
            $main_wallet->created_by = $user->id;
            $main_wallet->save();
        });



        return redirect()->back()->with('success', 'Transfered Successfully');
    }
    protected function rld_transfer_to_wallet(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = auth()->user();
            $data['title'] = 'RLD Wallet';
            $data['sub_wallet'] = 'rld';
            // if transfer to main wallet 30 seconds ago
            $today_data=MainWallet::where('user_id', Auth::user()->id)
            ->where('sub_wallet', 'rld')
            ->where('transfer_date',date('Y-m-d'))
            ->where('created_at','>=',date('Y-m-d H:i:s',strtotime('-30 seconds')))
            ->first();
    if($today_data){
        return redirect()->back()->with('error', 'Already Transfered Today');
    }

            $data['collection'] = ReferralBenefit::with('investment', 'parent')->where('parent_id', Auth::user()->id)->get();
            $data['total_benefit'] = ReferralBenefit::where('parent_id', Auth::user()->id)->sum('commission');
            $data['transfered'] = MainWallet::where('user_id', Auth::user()->id)
                ->where('sub_wallet', 'rld')
                ->sum('amount');
            $data['balance'] = $data['total_benefit'] - $data['transfered'];
            $balance = $data['balance'];

            $request->validate([
                'balance' => 'required|numeric|min:0.0001|max:' . $balance,
            ]);

            $main_wallet = new MainWallet();
            $main_wallet->user_id = $user->id;
            $main_wallet->transfer_date = date('Y-m-d');
            $main_wallet->amount = $balance;
            $main_wallet->sub_wallet = $request->sub_wallet;
            $main_wallet->created_by = $user->id;
            $main_wallet->save();
        });



        return redirect()->back()->with('success', 'Transfered Successfully');
    }
    protected function pps_level_transfer_to_wallet(Request $request)
    {
        //dd($request->all());
        $user = auth()->user();
        $today_data=MainWallet::where('user_id', Auth::user()->id)
                ->where('distribution_id', base64_decode($request->distribution_id))
                ->where('sub_wallet', 'ppsl')
                ->where('transfer_date',date('Y-m-d'))
                ->first();
        if($today_data){
            return redirect()->back()->with('error', 'Already Transfered Today');
        }
        DB::transaction(function () use ($request) {
            $user = auth()->user();
            $data['title'] = 'PPS LEVEL Wallet';
            $data['sub_wallet'] = 'ppsl';


            $main_wallet = new MainWallet();
            $main_wallet->user_id = $user->id;
            $main_wallet->transfer_date = date('Y-m-d');
            $main_wallet->distribution_id = base64_decode($request->distribution_id);
            $main_wallet->amount = base64_decode($request->payble);
            $main_wallet->sub_wallet = 'ppsl';
            $main_wallet->created_by = $user->id;

            $main_wallet->save();
        });

  //dd($main_wallet);

        return response()->json(['status'=>200,'success' => 'Transfered Successfully']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
