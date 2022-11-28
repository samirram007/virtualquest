<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Mps48Investment;
use Illuminate\Support\Facades\DB;
use App\Models\Mps48TeamInvestment;
use App\Http\Controllers\Controller;
use App\Models\Mps48ReferralBenefit;
use App\Models\Mps48ReferralCommission;

class Mps48InvestmentController extends Controller
{
    protected $data_control;
    public function __construct()
    {
        $data_control = [
            '1' => 'Investment',
            '2' => 'mps48',
            '3' => 'mps48',
            '4' => 'admin.mps48',
            '5' => 'fas fa-money-bill-wave',
        ];
    }
    protected function mps48()
    {
        // dd(Mps48Investment::with('user')->paginate(10));
        return view('admin.mps48.mps48');
    }
    protected function mps48_index()
    {
        $mps48 = Mps48Investment::with('user')->where('status', 1)->orderby('created_at', 'desc')->get();
        // dd($mps48);
        return view('admin.mps48.mps48_index', compact('mps48'));
    }
    protected function mps48_all()
    {
        $mps48 = Mps48Investment::with('user')->orderby('created_at', 'desc')->get();
        // dd($mps48);
        return view('admin.mps48.mps48_index', compact('mps48'));
    }
    protected function mps48_pending()
    {
        $mps48 = Mps48Investment::with('user')->where('status', 0)->orderby('created_at', 'desc')->get();
        return view('admin.mps48.mps48_index', compact('mps48'));
    }
    protected function mps48_rejected()
    {
        $mps48 = Mps48Investment::with('user')->where('status', 3)->orderby('created_at', 'desc')->get();
        return view('admin.mps48.mps48_index', compact('mps48'));
    }
    protected function mps48_store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'amount' => 'required|numeric',
                'investment_date' => 'required|date',
                'user_id' => 'required|numeric',
            ]);
            $mps48 = new Mps48Investment();
            $mps48->investment_date = $request->investment_date;
            $mps48->amount = $request->amount;
            $mps48->user_id = $request->user_id;
            $mps48->status = 1;
            $mps48->save();
             //distribute to team_investment using user_id=id parent_id from user table
             $parent_id = User::where('id', $request->user_id)->first()->parent_id;
             // dd($parent_id);
             $cnt_distribution = 0;
             while ($parent_id != null) {
                 $team_investment = new Mps48TeamInvestment();
                 $team_investment->investment_id = $mps48->id;
                 $team_investment->investment_date = $request->investment_date;
                 $team_investment->user_id = $mps48->user_id; //investor_id
                 $team_investment->parent_id = $parent_id;
                 $team_investment->amount = $request->amount;
                 $team_investment->save();

                 if ($cnt_distribution < 1) {
                    $referral_commission = Mps48ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps48ReferralBenefit();
                    $existing = Mps48ReferralBenefit::where('investment_id', $mps48->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps48->id;
                        $referral_benefit->user_id = $mps48->user_id;
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
        return response()->json(['status' => 'success', 'message' => 'MPS48 Investment has been added successfully']);
        //return redirect()->back()->with('success', 'Investment Successfully');
    }
    protected function mps48_acknowledge(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'mps_id' => 'required|numeric',
            ]);
            $mps48 = Mps48Investment::find($request->mps_id);
            $mps48->status = 1;
            $mps48->save();

            $parent_id = User::where('id', $mps48->user_id)->first()->parent_id;
            // dd($parent_id);
            $cnt_distribution = 0;
            while ($parent_id != null) {
                $team_investment = new Mps48TeamInvestment();
                $team_investment->investment_id = $mps48->id;
                $team_investment->investment_date = $mps48->investment_date;
                $team_investment->user_id = $invesmps48tment->user_id; //investor_id
                $team_investment->parent_id = $parent_id;
                $team_investment->amount = $mps48->amount;
                $team_investment->save();

                if ($cnt_distribution < 1) {
                    $referral_commission = Mps48ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps48ReferralBenefit();
                    $existing = Mps48ReferralBenefit::where('investment_id', $mps48->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps48->id;
                        $referral_benefit->user_id = $mps48->user_id;
                        $referral_benefit->parent_id = $parent_id;
                        $referral_benefit->amount = $mps48->amount;
                        $referral_benefit->level = $cnt_distribution + 1;
                        $referral_benefit->commission = $mps48->amount * $referral_commission->commission / 100;
                        $referral_benefit->save();
                    }

                }

                // }
                $parent_id = User::where('id', $parent_id)->first()->parent_id;
                $cnt_distribution++;
            }

        });

        return response()->json(['status' => 'success', 'message' => 'MPS48 Investment has been acknowledged successfully']);
    }
    protected function user_validate(Request $request)
    {

        $user = User::where('code', $request->user_code)->first();
        // dd($user);
        if ($user) {
            $mps48 = Mps48Investment::with('user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();

            $view = view('admin.mps48.user_mps48', compact('user', 'mps48'))->render();
            return response()->json(['status' => 'success', 'data' => $user, 'view' => $view]);
        }
    }
}
