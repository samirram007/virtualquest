<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mps24Staking;
use Illuminate\Http\Request;
use App\Models\MpsInvestment;
use App\Models\Mps24StakingLog;
use App\Models\MpsTeamInvestment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Mps24LevelCommission;
use App\Models\Mps24ReferralBenefit;
use App\Models\Mps24LevelDistribution;
use App\Models\Mps24ReferralCommission;
use App\Models\Mps24LevelDistributionLog;

class MpsInvestmentController extends Controller
{
    protected $data_control;
    public function __construct()
    {
        $data_control = [
            '1' => 'Investment',
            '2' => 'mps',
            '3' => 'mps',
            '4' => 'admin.mps',
            '5' => 'fas fa-money-bill-wave',
        ];
    }
    protected function mps()
    {
        // dd(MpsInvestment::with('user')->paginate(10));
        return view('admin.mps.mps');
    }
    protected function mps_index()
    {
        $mps = MpsInvestment::with('user')->where('status', 1)->orderby('created_at', 'desc')->get();
        // dd($mps);
        return view('admin.mps.mps_index', compact('mps'));
    }
    protected function mps_all()
    {
        $mps = MpsInvestment::with('user')->orderby('created_at', 'desc')->get();
        // dd($mps);
        return view('admin.mps.mps_index', compact('mps'));
    }
    protected function mps_pending()
    {
        $mps = MpsInvestment::with('user')->where('status', 0)->orderby('created_at', 'desc')->get();
        return view('admin.mps.mps_index', compact('mps'));
    }
    protected function mps_rejected()
    {
        $mps = MpsInvestment::with('user')->where('status', 3)->orderby('created_at', 'desc')->get();
        return view('admin.mps.mps_index', compact('mps'));
    }
    protected function mps_store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'amount' => 'required|numeric',
                'investment_date' => 'required|date',
                'user_id' => 'required|numeric',
            ]);
            $mps = new MpsInvestment();
            $mps->investment_date = $request->investment_date;
            $mps->amount = $request->amount;
            $mps->user_id = $request->user_id;
            $mps->status = 1;
            $mps->save();
           // dd($mps);
             //distribute to team_investment using user_id=id parent_id from user table
             $parent_id = User::where('id', $request->user_id)->first()->parent_id;
             // dd($parent_id);
             $cnt_distribution = 0;
             while ($parent_id != null) {
                 $team_investment = new MpsTeamInvestment();
                 $team_investment->investment_id = $mps->id;
                 $team_investment->investment_date = $request->investment_date;
                 $team_investment->user_id = $mps->user_id; //investor_id
                 $team_investment->parent_id = $parent_id;
                 $team_investment->amount = $request->amount;
                 $team_investment->save();

                 if ($cnt_distribution < 1) {
                    $referral_commission = Mps24ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps24ReferralBenefit();
                    $existing = Mps24ReferralBenefit::where('investment_id', $mps->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps->id;
                        $referral_benefit->user_id = $mps->user_id;
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
          DB::commit();
        });
     //   dd('success');
        return response()->json(['status' => 'success', 'message' => 'MPS Investment has been added successfully']);
        //return redirect()->back()->with('success', 'Investment Successfully');
    }
    protected function mps_acknowledge(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'mps_id' => 'required|numeric',
            ]);
            $mps = MpsInvestment::find($request->mps_id);
            $mps->status = 1;
            $mps->save();

            $parent_id = User::where('id', $mps->user_id)->first()->parent_id;
            // dd($parent_id);
            $cnt_distribution = 0;
            while ($parent_id != null) {
                $team_investment = new MpsTeamInvestment();
                $team_investment->investment_id = $mps->id;
                $team_investment->investment_date = $mps->investment_date;
                $team_investment->user_id = $mps->user_id; //investor_id
                $team_investment->parent_id = $parent_id;
                $team_investment->amount = $mps->amount;
                $team_investment->save();

                if ($cnt_distribution < 1) {
                    $referral_commission = Mps24ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps24ReferralBenefit();
                    $existing = Mps24ReferralBenefit::where('investment_id', $mps->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps->id;
                        $referral_benefit->user_id = $mps->user_id;
                        $referral_benefit->parent_id = $parent_id;
                        $referral_benefit->amount = $mps->amount;
                        $referral_benefit->level = $cnt_distribution + 1;
                        $referral_benefit->commission = $mps->amount * $referral_commission->commission / 100;
                        $referral_benefit->save();
                    }

                }

                // }
                $parent_id = User::where('id', $parent_id)->first()->parent_id;
                $cnt_distribution++;
            }

        });

        return response()->json(['status' => 'success', 'message' => 'MPS Investment has been acknowledged successfully']);
    }
    protected function user_validate(Request $request)
    {

        $user = User::where('code', $request->user_code)->first();
        // dd($user);
        if ($user) {
            $mps = MpsInvestment::with('user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();

            $view = view('admin.mps.user_mps', compact('user', 'mps'))->render();
            return response()->json(['status' => 'success', 'data' => $user, 'view' => $view]);
        }
    }

    protected function mps24_distribution()
    {

        DB::transaction(function () {
            $today = date('Y-m-d');
            $investment = MpsInvestment::where('status', 1)
                ->where('investment_date', '<', $today)
                ->orderby('created_at')->get();
            // dd($investment);
            $cnt = 0;

            foreach ($investment as $key => $inv) {

                $pos = 5;
                // if ($inv->amount < 2500) {$pos = 0.4;}
                // elseif ($inv->amount < 5000) {$pos = 0.6;}
                // else { $pos = 0.8;}
                $save_status=true;
                //date difference investment_date to today
                $date1 = date_create($inv->investment_date);
                $date2 = date_create(date('Y-m-d'));
                $diff = date_diff($date1, $date2);
                $days = $diff->format("%a");
                $days = $days - 1;
                // if($inv->id==69){
                 //dd($days);
                // }
                $no_of_distribution=(int)floor($days / 30);
                //dd($no_of_distribution);
                if($no_of_distribution>0){
                    $ex_data = Mps24Staking::where('investment_id', $inv->id)->where('user_id', $inv->user_id)->first();
                    $data = new Mps24Staking();
                    if ($ex_data) {
                        $data = $ex_data;
                        if($ex_data->day_count>=$no_of_distribution){
                            $save_status=false;
                        }
                    }

                    //dd($data);
                    $data->investment_id = $inv->id;
                    //dd($data);
                    $data->user_id = $inv->user_id;
                    $data->amount = $inv->amount;
                    $data->day_count = $no_of_distribution;
                    $inv_commission = ($inv->amount * ($pos) / 100) * $no_of_distribution;

                    $data->commission = $inv_commission;
                    if($save_status){
                        $data->save();
                    }
                    $parent_id = User::where('id', $inv->user_id)->first()->parent_id;
                    $cnt_distribution = 0;

                    while ($parent_id != null && $cnt_distribution < 20) {
                        $level_save_status=true;
                        $level_commission = Mps24LevelCommission::where('level', $cnt_distribution + 1)->first();
                        //dd($level_commission);
                        $ex_leveldata = Mps24LevelDistribution::where('investment_id', $inv->id)->where('parent_id', $parent_id)->first();
                        $pps_level = new Mps24LevelDistribution();
                        if ($ex_leveldata) {
                            $pps_level = $ex_leveldata;
                            if($ex_leveldata->day_count>=$no_of_distribution){
                                $level_save_status=false;
                            }
                        }
                        $pps_level->investment_id = $inv->id;
                        // $pps_level->investment_date = $inv->investment_date;
                        $pps_level->user_id = $inv->user_id; //investor_id
                        $pps_level->parent_id = $parent_id;
                        $pps_level->amount = $inv->amount;
                        $pps_level->level = $cnt_distribution + 1;
                        $pps_level->day_count = $no_of_distribution;
                        $pps_level->commission = ($inv_commission * ($level_commission->commission) / 100);
                        if($level_save_status){
                            $pps_level->save();
                        }

                        $parent_id = User::where('id', $parent_id)->first()->parent_id;
                        $cnt_distribution++;
                    }
                }


            }

        });

         return Redirect()->back();
    }

    protected function mps24_distribution_log()
    {
        // DB::transaction(function () {
            $today = date('Y-m-d');
            //  $today=date('Y-m-d',strtotime($today.'-10 day'));
            //dd($today);
            $investment = MpsInvestment::where('status', 1)
                ->where('investment_date', '<', $today)
                ->orderby('created_at')->get();
               // dd($investment);
            $cnt = 0;
            foreach ($investment as $key => $inv) {
                $pos = 5;
                // if ($inv->amount < 2500)
                // {$pos = 0.4;}
                // elseif ($inv->amount < 5000) {$pos = 0.6;}
                // else { $pos = 0.8;}
                //date difference investment_date to today
                $date1 = date_create($inv->investment_date);
                $date2 = date_create($today);
                $diff = date_diff($date1, $date2);
                $days = $diff->format("%a");
                $days = $days - 1;
                $no_of_distribution=(int)floor($days / 30);
                for ($i = 1; $i <= $no_of_distribution; $i++) {
                    $ex_data = Mps24StakingLog::where('investment_id', $inv->id)->where('user_id', $inv->user_id)->where('day_count', $i)->first();
                    $data = new Mps24StakingLog();
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
                        $level_commission = Mps24LevelCommission::where('level', $cnt_distribution + 1)->first();
                        $ex_leveldata = Mps24LevelDistributionLog::where('investment_id', $inv->id)->where('parent_id', $parent_id)->where('day_count', $i)->first();
                        $pps_level = new Mps24LevelDistributionLog();
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
         return Redirect()->back();
    }
}
