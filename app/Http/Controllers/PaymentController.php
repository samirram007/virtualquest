<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PpsStaking;
use App\Models\PpsxStaking;
use App\Models\Mps24Staking;
use App\Models\Mps36Staking;
use App\Models\Mps48Staking;
use App\Models\Mps60Staking;
use Illuminate\Http\Request;
use App\Models\MpsInvestment;
use App\Models\PaymentRequest;
use App\Models\PpsxInvestment;
use App\Models\SelfInvestment;
use App\Models\Mps36Investment;
use App\Models\Mps48Investment;
use App\Models\Mps60Investment;
use App\Models\ReferralBenefit;
use Illuminate\Support\Facades\DB;
use App\Models\PpsxReferralBenefit;
use App\Models\Mps24ReferralBenefit;
use App\Models\Mps36ReferralBenefit;
use App\Models\Mps48ReferralBenefit;
use App\Models\Mps60ReferralBenefit;
use App\Models\PpsLevelDistribution;
use App\Models\PpsxLevelDistribution;
use App\Models\Mps24LevelDistribution;
use App\Models\Mps36LevelDistribution;
use App\Models\Mps48LevelDistribution;
use App\Models\Mps60LevelDistribution;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $payment_method;
    public function __construct()
    {
        // $this->payment_method = config('app.payment_method');
        // $this->payment_method = ['ERC20','TRC20','TRC10'];
        $this->payment_method = ['ERC20', 'TRC10'];
    }

    protected function payment_request_view()
    {


        $data['title'] = 'Payment Request';
        $user = auth()->user();
        // $ex_payment_request =PaymentRequest::where('user_id',$user->id)
        // ->where(DB::raw("(DATE_FORMAT(payment_request_date,'%Y-%m-%d'))"),date('Y-m-d'))->toSql();
        // dd($ex_payment_request);
        $data['referral_benefit'] = ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['pps_staking'] = PpsStaking::where('user_id', $user->id)->sum('commission');
        $data['pps_level'] = PpsLevelDistribution::where('parent_id', $user->id)->sum('commission');

        $data['ppsx_referral_benefit'] = PpsxReferralBenefit::where('parent_id', $user->id)->sum('commission');
        //$data['referral_benefit']+=$data['ppsx_referral_benefit'];
        $data['ppsx_staking'] = PpsxStaking::where('user_id', $user->id)->sum('commission');
       // $data['pps_staking']+=$data['ppsx_staking'];
        $data['ppsx_level'] = PpsxLevelDistribution::where('parent_id', $user->id)->sum('commission');
       // $data['pps_level']+=$data['ppsx_level'];

        $data['mps_referral_benefit']=0;
        $data['mps_staking']=0;
        $data['mps_level']=0;

        $data['mps24_referral_benefit'] = Mps24ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps_referral_benefit']+=$data['mps24_referral_benefit'];
        $data['mps24_staking'] = Mps24Staking::where('user_id', $user->id)->sum('commission');
        $data['mps_staking']+=$data['mps24_staking'];
        $data['mps24_level'] = Mps24LevelDistribution::where('parent_id', $user->id)->sum('commission');
        $data['mps_level']+=$data['mps24_level'];

        $data['mps36_referral_benefit'] = Mps36ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps_referral_benefit']+=$data['mps36_referral_benefit'];
        $data['mps36_staking'] = Mps36Staking::where('user_id', $user->id)->sum('commission');
        $data['mps_staking']+=$data['mps36_staking'];
        $data['mps36_level'] = Mps36LevelDistribution::where('parent_id', $user->id)->sum('commission');
        $data['mps_level']+=$data['mps36_level'];

        $data['mps48_referral_benefit'] = Mps48ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps_referral_benefit']+=$data['mps48_referral_benefit'];
        $data['mps48_staking'] = Mps48Staking::where('user_id', $user->id)->sum('commission');
        $data['mps_staking']+=$data['mps48_staking'];
        $data['mps48_level'] = Mps48LevelDistribution::where('parent_id', $user->id)->sum('commission');
        $data['mps_level']+=$data['mps48_level'];

        $data['mps60_referral_benefit'] = Mps60ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps_referral_benefit']+=$data['mps60_referral_benefit'];
        $data['mps60_staking'] = Mps60Staking::where('user_id', $user->id)->sum('commission');
        $data['mps_staking']+=$data['mps60_staking'];
        $data['mps60_level'] = Mps60LevelDistribution::where('parent_id', $user->id)->sum('commission');
        $data['mps_level']+=$data['mps60_level'];
        $data['mps_level']=0;

        $data['total'] = $data['referral_benefit'] + $data['pps_staking'] + $data['pps_level']
        + $data['ppsx_referral_benefit'] + $data['ppsx_staking'] + $data['ppsx_level']
        + $data['mps_referral_benefit']+$data['mps_staking'] + $data['mps_level'];

        $data['total_paid'] = PaymentRequest::where('user_id', $user->id)->where('status', 'paid')->sum('amount');
        $data['total_pending'] = PaymentRequest::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
        $data['balance'] = $data['total'] - $data['total_paid'] - $data['total_pending'];
        $data['payment_method'] = $this->payment_method;
        // return view('wallet.wallet_view',$data);
        return view('payment.payment_request', $data);
    }
    protected function payment_request_process_new(Request $request)
    {
        $user = auth()->user();
        // $data['total']=$this->check_payble_amount($user->id);
        $today=date('Y-m-d');
        $ex_payment_request =PaymentRequest::where('user_id',$user->id)
        ->where(DB::raw("(DATE_FORMAT(payment_request_date,'%Y-%m-%d'))"),$today)->first();
        if($ex_payment_request){
            return response()->json(['status' => 'error', 'message' => 'Please Try Again After 24 Hours']);
        }
        $ex_pending_payment_request =PaymentRequest::where('user_id',$user->id)
        ->where('status','pending')->first();
        if($ex_pending_payment_request){
            return response()->json(['status' => 'error', 'message' => 'You have a pending payment request']);
        }

        $payment_request = new PaymentRequest();
        $payment_request->user_id = $user->id;
        $payment_request->amount = $request->amount;
        $payment_request->payment_request_date = date('Y-m-d H:i:s');

        $payment_request->payment_method = $request->payment_method;
        $payment_request->payment_account = $request->address;
        // dd($payment_request)    ;
        $payment_request->save();
        return response()->json(['status' => 'success', 'message' => 'Payment Request Sent Successfully']);
    }
    protected function payment_request_process(Request $request)
    {
        $user = auth()->user();
        // $data['total']=$this->check_payble_amount($user->id);
        $today=date('Y-m-d');
        $ex_payment_request =PaymentRequest::where('user_id',$user->id)
        ->where(DB::raw("(DATE_FORMAT(payment_request_date,'%Y-%m-%d'))"),$today)->first();
        if($ex_payment_request){
            return response()->json(['status' => 'error', 'message' => 'Please Try Again After 24 Hours']);
        }
        $ex_pending_payment_request =PaymentRequest::where('user_id',$user->id)
        ->where('status','pending')->first();
        if($ex_pending_payment_request){
            return response()->json(['status' => 'error', 'message' => 'You have a pending payment request']);
        }
        $report_controller = new ReportController();

        $user_immediate_count = User::Where('parent_id', $user->id)->count();
        $data['self_investment'] = SelfInvestment::where('user_id', $user->id)->where('status', true)->sum('amount');
        $data['ppsx_investment'] = PpsxInvestment::where('user_id', $user->id)->where('status', true)->sum('amount');
        $data['mps24_investment'] = MpsInvestment::where('user_id', $user->id)->where('status', true)->sum('amount');
        $data['mps36_investment'] = Mps36Investment::where('user_id', $user->id)->where('status', true)->sum('amount');
        $data['mps48_investment'] = Mps48Investment::where('user_id', $user->id)->where('status', true)->sum('amount');
        $data['mps60_investment'] = Mps60Investment::where('user_id', $user->id)->where('status', true)->sum('amount');
        $total_investment=$data['self_investment']+$data['ppsx_investment']+$data['mps24_investment']+$data['mps36_investment']+$data['mps48_investment']+$data['mps60_investment'];
        if ($total_investment == 0) {
            return response()->json(['status' => 'error', 'message' => 'You are not an active user']);
            // return back()->with('error','You are not an active user');
        }
        $data['referral_benefit'] = ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['pps_staking'] = PpsStaking::where('user_id', $user->id)->sum('commission');
        $data['ppsx_referral_benefit'] = PpsxReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['ppsx_staking'] = PpsxStaking::where('user_id', $user->id)->sum('commission');
        $data['mps24_referral_benefit'] = Mps24ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps24_staking'] = Mps24Staking::where('user_id', $user->id)->sum('commission');
        $data['mps36_referral_benefit'] = Mps36ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps36_staking'] = Mps36Staking::where('user_id', $user->id)->sum('commission');
        $data['mps48_referral_benefit'] = Mps48ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps48_staking'] = Mps48Staking::where('user_id', $user->id)->sum('commission');
        $data['mps60_referral_benefit'] = Mps60ReferralBenefit::where('parent_id', $user->id)->sum('commission');
        $data['mps60_staking'] = Mps60Staking::where('user_id', $user->id)->sum('commission');

        $pps_level_total = 0;
        $ppsx_level_total = 0;
        //dd($user_immediate_count);
        if ($user_immediate_count >= 2) {
            $pps_level13 = PpsLevelDistribution::where('parent_id', $user->id)
                ->where('level', '<=', 3)
                ->sum('commission');
            $pps_level_total += $pps_level13 != null ? $pps_level13 : 0;
            //ppxx
            $ppsx_level13 = PpsxLevelDistribution::where('parent_id', $user->id)
                ->where('level', '<=', 3)
                ->sum('commission');
            $ppsx_level_total += $ppsx_level13 != null ? $ppsx_level13 : 0;
          //  dd($pps_level_total);
        }
        if ($user_immediate_count >= 3) {
            $pps_level46 = PpsLevelDistribution::where('parent_id', $user->id)
                ->where('level', '>=', 4)
                ->where('level', '<=', 6)
                ->sum('commission');
            $pps_level_total += $pps_level46 != null ? $pps_level46 : 0;
            //ppsx
            $ppsx_level46 = PpsxLevelDistribution::where('parent_id', $user->id)
                ->where('level', '>=', 4)
                ->where('level', '<=', 6)
                ->sum('commission');
            $ppsx_level_total += $ppsx_level46 != null ? $ppsx_level46 : 0;
        }
        if ($user_immediate_count >= 5) {
            $pps_level710 = PpsLevelDistribution::where('parent_id', $user->id)
                ->where('level', '>=', 7)
                ->where('level', '<=', 10)
                ->sum('commission');
            $pps_level_total += $pps_level710 != null ? $pps_level710 : 0;
            //ppsx
            $ppsx_level710 = PpsxLevelDistribution::where('parent_id', $user->id)
                ->where('level', '>=', 7)
                ->where('level', '<=', 20)
                ->sum('commission');
            $ppsx_level_total += $ppsx_level710 != null ? $ppsx_level710 : 0;
        }

        $data['pps_level'] = $pps_level_total;
        $data['ppsx_level'] = $ppsx_level_total;
        // $data['pps_level']=PpsLevelDistribution::where('parent_id',$user->id)->sum('commission');

        $data['total'] = $data['referral_benefit'] + $data['pps_staking'] + $data['pps_level'];
        $data['total'] += $data['ppsx_referral_benefit'] + $data['ppsx_staking'] + $data['ppsx_level'];
        $data['total'] += $data['mps24_referral_benefit'] + $data['mps24_staking'];
        $data['total'] += $data['mps36_referral_benefit'] + $data['mps36_staking'];
        $data['total'] += $data['mps48_referral_benefit'] + $data['mps48_staking'];
        $data['total'] += $data['mps60_referral_benefit'] + $data['mps60_staking'];

        $data['total_paid'] = PaymentRequest::where('user_id', $user->id)->where('status', 'paid')->sum('amount');
        $data['total_payable'] = $data['total'] - $data['total_paid'];

        // $request->validate([
        //     'amount' => 'required|numeric|min:10|max:'.$data['total_payable'],
        //     'payment_method' => 'required',
        //     'address' => 'required',
        // ]);
        if ($data['total_payable'] < 10) {
            return response()->json(['status' => 'error', 'message' => 'You have not enough balance to request for payment']);

        }

        //dd($data['self_investment']);
        if ($request->amount > $data['total_payable']) {
            return response()->json(['status' => 'error', 'message' => 'You are elligible for $' . $data['total_payable'] . ' only']);
            // return back()->with('error','You can not request more than 3 times of your investment amount');
        }
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:10|max:1000',
            'payment_method' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
            // return redirect()->back()->withErrors($validator)->withInput();
        }

        // if (($data['self_investment'] * 3) < ($data['total_paid'] + $request->amount)) {
        if (($total_investment * 3) < ($data['total_paid'] + $request->amount)) {
            return response()->json(['status' => 'error', 'message' => 'You can not request more than 3 times of your self investment amount.']);
            // return back()->with('error','You can not request more than 3 times of your investment amount');
        }

        $payment_request = new PaymentRequest();
        $payment_request->user_id = $user->id;
        $payment_request->amount = $request->amount;
        $payment_request->payment_request_date = date('Y-m-d H:i:s');

        $payment_request->payment_method = $request->payment_method;
        $payment_request->payment_account = $request->address;
        // dd($payment_request)    ;
        $payment_request->save();
        return response()->json(['status' => 'success', 'message' => 'Payment Request Sent Successfully']);
        // return back()->with('success','Payment Request Sent Successfully');
    }

    protected function check_payble_amount($user_id)
    {
        // $user = auth()->user();
        // $report_controller = new ReportController();
        // $collection= $report_controller->get_downline_tree($user->id);
        // $count13 = 0;
        // $count46 = 0;
        // $count710 = 0;
        // foreach($report_controller->user as $key => $tree_user){
        //     if($tree_user->level==1 || $tree_user->level==3){
        //         $count13++;
        //     }
        //     if($tree_user->level==4 || $tree_user->level==6){
        //         $count46++;
        //     }
        //     if($tree_user->level==7 || $tree_user->level==10){
        //         $count710++;
        //     }
        // }
        // $data['self_investment']=PpsStaking::where('user_id',$user->id)->sum('amount');
        // $data['referral_benefit']=ReferralBenefit::where('parent_id',$user->id)->sum('commission');
        // $data['pps_staking']=PpsStaking::where('user_id',$user->id)->sum('commission');
        // if($count13>2){
        //     $data['pps_level13']=PpsLevelDistribution::where('parent_id',$user->id)
        //     ->where('level','<=',3)
        //     ->sum('commission');
        // }
        // if($count46>2){
        //     $data['pps_level46']=PpsLevelDistribution::where('parent_id',$user->id)
        //     ->where('level','>=',4)
        //     ->where('level','<=',6)
        //     ->sum('commission');
        // }
        // if($count710>2){
        //     $data['pps_level710']=PpsLevelDistribution::where('parent_id',$user->id)
        //     ->where('level','>=',7)
        //     ->where('level','<=',10)
        //     ->sum('commission');
        // }
        // $data['pps_level']=$data['pps_level13']+$data['pps_level46']+$data['pps_level710'];
        // // $data['pps_level']=PpsLevelDistribution::where('parent_id',$user->id)->sum('commission');
        // $data['total']=$data['referral_benefit']+$data['pps_staking']+$data['pps_level'];
        // $data['total_paid']=PaymentRequest::where('user_id',$user->id)->where('status','paid')->sum('amount');
        // $data['total_payable']=$data['total']-$data['total_paid'];
        // return $data['total'];
    }

}
