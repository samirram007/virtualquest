<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MainWallet;
use App\Models\MpsInvestment;
use App\Models\MpsTeamInvestment;
use App\Models\PpsLevelDistribution;
use App\Models\PpsStaking;
use App\Models\ReferralBenefit;
use App\Models\SelfInvestment;
use App\Models\TeamInvestment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    protected $level;
    public $user;
    public function downline_report()
    {
        $this->level = 0;
        $data['title'] = 'VPS Investment Report';
        $collection = $this->get_downline_tree(Auth::user()->id);
        // $data['collection'] = $collection;
        //dd($this->user);
        if (!$this->user == null) {
            foreach ($this->user as $key => $user) {
                $this->user[$key]['self'] = $this->self_investment($user->id);
                $this->user[$key]['team'] = $this->team_investment($user->id);

            }

        }

        $data['downline'] = $this->user;
        return view('report.downline_report', $data);
    }
    public function mps_downline_report()
    {
        $this->level = 0;
        $data['title'] = 'MPS Investment Report';
        $collection = $this->get_downline_tree(Auth::user()->id);
        // $data['collection'] = $collection;
        //dd($this->user);
        if (!$this->user == null) {
            foreach ($this->user as $key => $user) {
                $this->user[$key]['self'] = $this->mps_investment($user->id);
                $this->user[$key]['team'] = $this->mps_team_investment($user->id);

            }

        }

        $data['downline'] = $this->user;
        return view('report.downline_report', $data);
    }
    public function referral_benefit_report()
    {
        $user = auth()->user();
        $today=date('Y-m-d');
        $this->level = 0;
        $data['title'] = 'RLD Wallet';
        $data['sub_wallet'] = 'rld';
        $data['collection'] = ReferralBenefit::with('investment', 'user')->where('parent_id', Auth::user()->id)->get();
        $data['total_benefit'] = ReferralBenefit::where('parent_id', Auth::user()->id)->sum('commission');
        $data['transfered'] = MainWallet::where('user_id', Auth::user()->id)
            ->where('sub_wallet', 'rld')
            ->sum('amount');

        // $data['balance'] = $data['total_benefit'] - $data['transfered'];

        $user_immediate_count = User::Where('parent_id', $user->id)->count();
        $rld_total = 0;
        //dd($pps_level_total);
        if ($user_immediate_count >= 2) {
            $rld13 = ReferralBenefit::where('parent_id', $user->id)
                ->where('level', '<=', 3)
                ->sum('commission');
            $rld_total += $rld13 != null ? $rld13 : 0;
        }
        if ($user_immediate_count >= 3) {
            $rld46 = ReferralBenefit::where('parent_id', $user->id)
                ->where('level', '>=', 4)
                ->where('level', '<=', 6)
                ->sum('commission');
            $rld_total += $rld46 != null ? $rld46 : 0;
        }
        if ($user_immediate_count >= 5) {
            $rld710 = ReferralBenefit::where('parent_id', $user->id)
                ->where('level', '>=', 7)
                ->where('level', '<=', 10)
                ->sum('commission');
            $rld_total += $rld710 != null ? $rld710 : 0;
        }

        $data['rld'] = $rld_total;
        $data['balance'] = $rld_total - $data['transfered'];
        return view('report.referral_benefit_report', $data);
    }
    public function pps_staking_report()
    {
        $this->level = 0;
        $data['title'] = 'VPS Wallet';
        $data['sub_wallet'] = 'pps';
        $data['collection'] = PpsStaking::with('investment', 'user')->where('user_id', Auth::user()->id)->get();
        $data['total_benefit'] = PpsStaking::where('user_id', Auth::user()->id)->sum('commission');
        $data['transfered'] = MainWallet::where('user_id', Auth::user()->id)
            ->where('sub_wallet', 'pps')
            ->sum('amount');
        $data['balance'] = $data['total_benefit'] - $data['transfered'];
        // $data['balance']= 0.25;

        return view('report.pps_staking_report', $data);
    }
    public function pps_level_report()
    {
        $user = auth()->user();
        $today=date('Y-m-d');
        $this->level = 0;
        $total_payble = 0;
        $data['title'] = 'VPS Level Wallet';
        $collection = PpsLevelDistribution::with('investment', 'user')->where('parent_id', Auth::user()->id)->get();
        $user_immediate_count = User::Where('parent_id', $user->id)->count();
        $immediate_13=false;$immediate_46=false;$immediate_710 = false;
        if ($user_immediate_count >= 2) {
            $immediate_13 = true;
        }
        if ($user_immediate_count >= 3) {
            $immediate_46 = true;
        }
        if ($user_immediate_count >= 5) {
            $immediate_710 = true;
        }
        $pps_level_array=[];
        foreach($collection as $key=>$value){
            $pps_level_array[$key]['id']=$value->id;
            $pps_level_array[$key]['code']=$value->user->code;
            $pps_level_array[$key]['name']=$value->user->name;
            $pps_level_array[$key]['user_id']=$value->user_id;
            $pps_level_array[$key]['parent_id']=$value->parent_id;
            $pps_level_array[$key]['investment_id']=$value->investment_id;
            $pps_level_array[$key]['amount']=$value->amount;
            $pps_level_array[$key]['level']=$value->level;
            $pps_level_array[$key]['day_count']=$value->day_count;
            $pps_level_array[$key]['commission']=$value->commission;
            $transfered=MainWallet::where('user_id',$value->parent_id)->where('sub_wallet','ppsl')->where('distribution_id',$value->id)->sum('amount');

            $pps_level_array[$key]['transfered']=$transfered;
            $balance=$value->commission-$transfered;
            $pps_level_array[$key]['balance']=$balance;
            $payble=0;
            if($value->level<=3 && $immediate_13==true){
                $payble=$balance;
            }
            if($value->level>=4 && $value->level<=6 && $immediate_46==true){
                $payble=$balance;
            }
            if($value->level>=7 && $value->level<=10 && $immediate_710==true){
                $payble=$balance;
            }
            if($value->level==1){
                $payble=0;
                $pps_staking_transfer=MainWallet::Where('user_id',$value->user_id)->where('sub_wallet','pps')->latest('id')->first();
                // dd($pps_staking_transfer);
                if($pps_staking_transfer!=null && $pps_staking_transfer->transfer_date==$today){
                    $payble=$balance;
                }

            }
            else{
                $payble=0;
                $immediate_Level= $value->level-1;

                $immediate_user=PpsLevelDistribution::where('investment_id',$value->investment_id)->where('level',$immediate_Level)->first();

                $immediate_user_transfered=MainWallet::where('user_id',$immediate_user->parent_id)->where('sub_wallet','ppsl')->where('distribution_id',$immediate_user->id)->sum('amount');

                if($immediate_user->commission- $immediate_user_transfered==0){
                    $payble=$balance;
                }


            }
            $total_payble+=$payble;
             $pps_level_array[$key]['payble']=$payble;
             //dd($value);
        }
        // dd($pps_level_array);
        //$collection[$key]['level'] = $this->get_level($value->user_id);

        $data['collection']=$pps_level_array;
        $data['total_payble']=$total_payble;
        return view('report.pps_level_report', $data);
    }

    protected function self_investment($user_id)
    {
        $amount = SelfInvestment::where('user_id', $user_id)->where('status', 1)->sum('amount');
        return $amount;
    }
    protected function team_investment($user_id)
    {
        $amount = TeamInvestment::where('parent_id', $user_id)->sum('amount');
        return $amount;
    }
    protected function mps_investment($user_id)
    {
        $amount = MpsInvestment::where('user_id', $user_id)->where('status', 1)->sum('amount');
        return $amount;
    }
    protected function mps_team_investment($user_id)
    {
        $amount = MpsTeamInvestment::where('parent_id', $user_id)->sum('amount');
        return $amount;
    }

    public function get_downline_tree($id, $sponsor_code = null, $level = -1)
    {
        if ($level < 0) {
            // dd($id);
            $downline_tree = User::where('id', $id)->get();
            // dd($downline_tree);
        } else {
            $downline_tree = User::where('parent_id', $id)->get();
        }
        //print_r($downline_tree->toArray());
        foreach ($downline_tree as $key => $value) {
            $downline_tree[$key]['level'] = $level + 1;
            $downline_tree[$key]['sponsor'] = $sponsor_code;
            $value['level'] = $level + 1;
            $value['sponsor'] = $sponsor_code;
            $this->user[] = $value;
            $downline_tree[$key]['downline_tree'] = $this->get_downline_tree($value->id, $value->code, $value->level);

        }
        return $downline_tree;
    }
}
