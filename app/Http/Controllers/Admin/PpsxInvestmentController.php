<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpsxLevelCommission;
use App\Models\PpsxLevelDistribution;
use App\Models\PpsxLevelDistributionLog;
use App\Models\PpsxStaking;
use App\Models\PpsxStakingLog;
use App\Models\PpsxReferralBenefit;
use App\Models\PpsxReferralCommission;
use App\Models\PpsxInvestment;
use App\Models\PpsxTeamInvestment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PpsxInvestmentController extends Controller
{
    protected $data_control;
    public function __construct()
    {
        $data_control = [
            '1' => 'Investment',
            '2' => 'investment',
            '3' => 'investment',
            '4' => 'admin.ppsx',
            '5' => 'fas fa-money-bill-wave',
        ];
    }
    protected function investment()
    {
        // dd(PpsxInvestment::with('user')->paginate(10));
        return view('admin.ppsx.ppsx');
    }
    protected function investment_index()
    {
        $investment = PpsxInvestment::with('user')->where('status', 1)->orderby('created_at', 'desc')->get();
        // dd($investment);
        return view('admin.ppsx.ppsx_index', compact('investment'));
    }
    protected function investment_all()
    {
        $investment = PpsxInvestment::with('user')->orderby('created_at', 'desc')->get();
        // dd($investment);
        return view('admin.ppsx.ppsx_index', compact('investment'));
    }
    protected function investment_pending()
    {
        $investment = PpsxInvestment::with('user')->where('status', 0)->orderby('created_at', 'desc')->get();
        return view('admin.ppsx.ppsx_index', compact('investment'));
    }
    protected function investment_rejected()
    {
        $investment = PpsxInvestment::with('user')->where('status', 3)->orderby('created_at', 'desc')->get();
        return view('admin.ppsx.ppsx_index', compact('investment'));
    }
    protected function investment_store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'amount' => 'required|numeric',
                'investment_date' => 'required|date',
                'user_id' => 'required|numeric',
            ]);
            $investment = new PpsxInvestment();
            $investment->investment_date = $request->investment_date;
            $investment->amount = $request->amount;
            $investment->user_id = $request->user_id;
            $investment->status = 1;
            $investment->save();
            //distribute to team_investment using user_id=id parent_id from user table
            $parent_id = User::where('id', $request->user_id)->first()->parent_id;
            // dd($parent_id);
            $cnt_distribution = 0;
            while ($parent_id != null) {
                $team_investment = new PpsxTeamInvestment();
                $team_investment->investment_id = $investment->id;
                $team_investment->investment_date = $request->investment_date;
                $team_investment->user_id = $investment->user_id; //investor_id
                $team_investment->parent_id = $parent_id;
                $team_investment->amount = $request->amount;
                $team_investment->save();

                if ($cnt_distribution < 10) {
                    $referral_commission = PpsxReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new PpsxReferralBenefit();
                    $existing = PpsxReferralBenefit::where('investment_id', $investment->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $investment->id;
                        $referral_benefit->user_id = $investment->user_id;
                        $referral_benefit->parent_id = $parent_id;
                        $referral_benefit->amount = $request->amount;
                        $referral_benefit->level = $cnt_distribution + 1;
                        $referral_benefit->commission = $request->amount * $referral_commission->commission / 100;
                        $referral_benefit->save();
                    }

                }
                $parent_id = User::where('id', $parent_id)->first()->parent_id;
                $cnt_distribution++;
            }
        });
        return response()->json(['status' => 'success', 'message' => 'Investment has been added successfully']);
        //return redirect()->back()->with('success', 'Investment Successfully');
    }
    protected function investment_acknowledge(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'investment_id' => 'required|numeric',
            ]);
            $investment = PpsxInvestment::find($request->investment_id);
            $investment->status = 1;
            $investment->save();

            $parent_id = User::where('id', $investment->user_id)->first()->parent_id;
            // dd($parent_id);
            $cnt_distribution = 0;
            while ($parent_id != null) {
                $team_investment = new PpsxTeamInvestment();
                $team_investment->investment_id = $investment->id;
                $team_investment->investment_date = $investment->investment_date;
                $team_investment->user_id = $investment->user_id; //investor_id
                $team_investment->parent_id = $parent_id;
                $team_investment->amount = $investment->amount;
                $team_investment->save();

                // if($cnt_distribution>0){
                if ($cnt_distribution < 10) {
                    $referral_commission = PpsxReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new PpsxReferralBenefit();
                    $existing = PpsxReferralBenefit::where('investment_id', $investment->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $investment->id;
                        $referral_benefit->user_id = $investment->user_id;
                        $referral_benefit->parent_id = $parent_id;
                        $referral_benefit->amount = $investment->amount;
                        $referral_benefit->level = $cnt_distribution + 1;
                        $referral_benefit->commission = $investment->amount * $referral_commission->commission / 100;
                        $referral_benefit->save();
                    }

                }

                // }
                $parent_id = User::where('id', $parent_id)->first()->parent_id;
                $cnt_distribution++;
            }

            // $view=view('admin.investment.user_investment',compact('investment'))->render();
        });

        return response()->json(['status' => 'success', 'message' => 'Investment has been acknowledged successfully']);
    }
    protected function user_validate(Request $request)
    {

        $user = User::where('code', $request->user_code)->first();
        // dd($user);
        if ($user) {
            $investment = PpsxInvestment::with('user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();

            $view = view('admin.ppsx.user_ppsx', compact('user', 'investment'))->render();
            return response()->json(['status' => 'success', 'data' => $user, 'view' => $view]);
        }
    }
    protected function ppsx_distribution()
    {

        DB::transaction(function () {
            $today = date('Y-m-d');
            $investment = PpsxInvestment::where('status', 1)
                ->where('investment_date', '<', $today)
                ->orderby('created_at')->get();
            // dd($investment);
            $cnt = 0;

            foreach ($investment as $key => $inv) {

                $pos = 0;
                if ($inv->amount <= 3999) {$pos = 0.5;}
                else { $pos = 0.6;}

                //date difference investment_date to today
                $date1 = date_create($inv->investment_date);
                $date2 = date_create(date('Y-m-d'));
                $diff = date_diff($date1, $date2);
                $days = $diff->format("%a");
                $days = $days - 1;
                // if($inv->id==69){
                //    // dd($days);
                // }
                $ex_data = PpsxStaking::where('investment_id', $inv->id)->where('user_id', $inv->user_id)->first();
                $data = new PpsxStaking();
                if ($ex_data) {
                    $data = $ex_data;
                }
                //dd($data);
                $data->investment_id = $inv->id;
                //dd($data);
                $data->user_id = $inv->user_id;
                $data->amount = $inv->amount;
                $data->day_count = $days;
                $inv_commission = ($inv->amount * ($pos) / 100) * $days;

                $data->commission = $inv_commission;
                $data->save();
                $parent_id = User::where('id', $inv->user_id)->first()->parent_id;
                $cnt_distribution = 0;
                while ($parent_id != null && $cnt_distribution < 20) {
                    $level_commission = PpsxLevelCommission::where('level', $cnt_distribution + 1)->first();
                    //dd($level_commission);
                    $ex_leveldata = PpsxLevelDistribution::where('investment_id', $inv->id)->where('parent_id', $parent_id)->first();
                    $pps_level = new PpsxLevelDistribution();
                    if ($ex_leveldata) {
                        $pps_level = $ex_leveldata;
                    }
                    $pps_level->investment_id = $inv->id;
                    // $pps_level->investment_date = $inv->investment_date;
                    $pps_level->user_id = $inv->user_id; //investor_id
                    $pps_level->parent_id = $parent_id;
                    $pps_level->amount = $inv->amount;
                    $pps_level->level = $cnt_distribution + 1;
                    $pps_level->day_count = $days;
                    $pps_level->commission = ($inv_commission * ($level_commission->commission) / 100);
                    $pps_level->save();

                    $parent_id = User::where('id', $parent_id)->first()->parent_id;
                    $cnt_distribution++;
                }

            }

        });

       // return Redirect()->back();
    }

    protected function ppsx_distribution_log()
    {
        // DB::transaction(function () {
            $today = date('Y-m-d');
            //  $today=date('Y-m-d',strtotime($today.'-10 day'));
            //dd($today);
            $investment = PpsxInvestment::where('status', 1)
                ->where('investment_date', '<', $today)
                ->orderby('created_at')->get();
               // dd($investment);
            $cnt = 0;
            foreach ($investment as $key => $inv) {
                $pos = 0;
                if ($inv->amount <= 3999) {$pos = 0.5;}
                else { $pos = 0.6;}
                //date difference investment_date to today
                $date1 = date_create($inv->investment_date);
                $date2 = date_create($today);
                $diff = date_diff($date1, $date2);
                $days = $diff->format("%a");
                $days = $days - 1;
                for ($i = 1; $i <= $days; $i++) {
                    $ex_data = PpsxStakingLog::where('investment_id', $inv->id)->where('user_id', $inv->user_id)->where('day_count', $i)->first();
                    $data = new PpsxStakingLog();
                    if ($ex_data) {
                        $data = $ex_data;
                    }
                    else{
                         $data->investment_id = $inv->id;
                    $data->log_date = date('Y-m-d', strtotime($inv->investment_date . ' + ' . $i . ' days'));

                    $data->user_id = $inv->user_id;
                    $data->amount = $inv->amount;
                    $data->percentage = $pos;
                    $data->day_count = $i;
                    $inv_commission = ($inv->amount * ($pos) / 100);
                    $data->commission = $inv_commission;
                    $data->cumulative_commission = $inv_commission * $i;
                    $data->save();
                    }

                    // dd($data);

                    $parent_id = User::where('id', $inv->user_id)->first()->parent_id;
                    $cnt_distribution = 0;
                    while ($parent_id != null && $cnt_distribution < 20) {
                        $level_commission = PpsxLevelCommission::where('level', $cnt_distribution + 1)->first();
                        $ex_leveldata = PpsxLevelDistributionLog::where('investment_id', $inv->id)->where('parent_id', $parent_id)->where('day_count', $i)->first();
                        $pps_level = new PpsxLevelDistributionLog();
                        if ($ex_leveldata) {
                            $pps_level = $ex_leveldata;
                        }
                        else{
                            $pps_level->investment_id = $inv->id;
                        $pps_level->user_id = $inv->user_id; //investor_id
                        $pps_level->parent_id = $parent_id;
                        $pps_level->log_date = date('Y-m-d', strtotime($inv->investment_date . ' + ' . $i . ' days'));
                        $pps_level->amount = $inv->amount;
                        $pps_level->level = $cnt_distribution + 1;
                        $pps_level->day_count = $i;
                        $pps_level->percentage = $level_commission->commission;
                        $pps_level->commission = ($inv_commission * ($level_commission->commission) / 100);
                        $pps_level->cumulative_commission = ($inv_commission * ($level_commission->commission) / 100) * $i;
                        $pps_level->save();
                        }

                        $parent_id = User::where('id', $parent_id)->first()->parent_id;
                        $cnt_distribution++;
                    }
                }

            }

    //   });
    //     DB::commit();
        //return Redirect()->back();
    }
    protected function ppsx_distribution_acknowledge(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'investment_id' => 'required|numeric',
            ]);
            $investment = PpsxInvestment::find($request->investment_id);
            $investment->status = 2;
            $investment->save();
            $pps_staking = PpsxStaking::where('investment_id', $investment->id)->first();
            $pps_staking->status = 1;
            $pps_staking->save();
            $pps_level = PpsxLevelDistribution::where('investment_id', $investment->id)->get();
            foreach ($pps_level as $level) {
                $level->status = 1;
                $level->save();
            }
        });
        return redirect()->back()->with('success', 'PPS Distribution has been acknowledged successfully');

    }
}
