<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Mps36Investment;
use Illuminate\Support\Facades\DB;
use App\Models\Mps36TeamInvestment;
use App\Http\Controllers\Controller;
use App\Models\Mps36ReferralBenefit;
use App\Models\Mps36ReferralCommission;

class Mps36InvestmentController extends Controller
{
    protected $data_control;
    public function __construct()
    {
        $data_control = [
            '1' => 'Investment',
            '2' => 'mps36',
            '3' => 'mps36',
            '4' => 'admin.mps36',
            '5' => 'fas fa-money-bill-wave',
        ];
    }
    protected function mps36()
    {
        // dd(Mps36Investment::with('user')->paginate(10));
        return view('admin.mps36.mps36');
    }
    protected function mps36_index()
    {
        $mps36 = Mps36Investment::with('user')->where('status', 1)->orderby('created_at', 'desc')->get();
        // dd($mps36);
        return view('admin.mps36.mps36_index', compact('mps36'));
    }
    protected function mps36_all()
    {
        $mps36 = Mps36Investment::with('user')->orderby('created_at', 'desc')->get();
        // dd($mps36);
        return view('admin.mps36.mps36_index', compact('mps36'));
    }
    protected function mps36_pending()
    {
        $mps36 = Mps36Investment::with('user')->where('status', 0)->orderby('created_at', 'desc')->get();
        return view('admin.mps36.mps36_index', compact('mps36'));
    }
    protected function mps36_rejected()
    {
        $mps36 = Mps36Investment::with('user')->where('status', 3)->orderby('created_at', 'desc')->get();
        return view('admin.mps36.mps36_index', compact('mps36'));
    }
    protected function mps36_store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'amount' => 'required|numeric',
                'investment_date' => 'required|date',
                'user_id' => 'required|numeric',
            ]);
            $mps36 = new Mps36Investment();
            $mps36->investment_date = $request->investment_date;
            $mps36->amount = $request->amount;
            $mps36->user_id = $request->user_id;
            $mps36->status = 1;
            $mps36->save();
             //distribute to team_investment using user_id=id parent_id from user table
             $parent_id = User::where('id', $request->user_id)->first()->parent_id;
             // dd($parent_id);
             $cnt_distribution = 0;
             while ($parent_id != null) {
                 $team_investment = new Mps36TeamInvestment();
                 $team_investment->investment_id = $mps36->id;
                 $team_investment->investment_date = $request->investment_date;
                 $team_investment->user_id = $mps36->user_id; //investor_id
                 $team_investment->parent_id = $parent_id;
                 $team_investment->amount = $request->amount;
                 $team_investment->save();

                 if ($cnt_distribution < 1) {
                    $referral_commission = Mps36ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps36ReferralBenefit();
                    $existing = Mps36ReferralBenefit::where('investment_id', $mps36->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps36->id;
                        $referral_benefit->user_id = $mps36->user_id;
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
        return response()->json(['status' => 'success', 'message' => 'MPS36 Investment has been added successfully']);
        //return redirect()->back()->with('success', 'Investment Successfully');
    }
    protected function mps36_acknowledge(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'mps_id' => 'required|numeric',
            ]);
            $mps36 = Mps36Investment::find($request->mps_id);
            $mps36->status = 1;
            $mps36->save();

            $parent_id = User::where('id', $investment->user_id)->first()->parent_id;
            // dd($parent_id);
            $cnt_distribution = 0;
            while ($parent_id != null) {
                $team_investment = new Mps36TeamInvestment();
                $team_investment->investment_id = $mps36->id;
                $team_investment->investment_date = $mps36->investment_date;
                $team_investment->user_id = $mps36->user_id; //investor_id
                $team_investment->parent_id = $parent_id;
                $team_investment->amount = $mps36->amount;
                $team_investment->save();

                if ($cnt_distribution < 1) {
                    $referral_commission = Mps36ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps36ReferralBenefit();
                    $existing = Mps36ReferralBenefit::where('investment_id', $mps36->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps36->id;
                        $referral_benefit->user_id = $mps36->user_id;
                        $referral_benefit->parent_id = $parent_id;
                        $referral_benefit->amount = $mps36->amount;
                        $referral_benefit->level = $cnt_distribution + 1;
                        $referral_benefit->commission = $mps36->amount * $referral_commission->commission / 100;
                        $referral_benefit->save();
                    }

                }

                // }
                $parent_id = User::where('id', $parent_id)->first()->parent_id;
                $cnt_distribution++;
            }

        });

        return response()->json(['status' => 'success', 'message' => 'MPS36 Investment has been acknowledged successfully']);
    }
    protected function user_validate(Request $request)
    {

        $user = User::where('code', $request->user_code)->first();
        // dd($user);
        if ($user) {
            $mps36 = Mps36Investment::with('user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();

            $view = view('admin.mps36.user_mps36', compact('user', 'mps36'))->render();
            return response()->json(['status' => 'success', 'data' => $user, 'view' => $view]);
        }
    }
}
