<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Mps60Investment;
use Illuminate\Support\Facades\DB;
use App\Models\Mps60TeamInvestment;
use App\Http\Controllers\Controller;
use App\Models\Mps60ReferralBenefit;
use App\Models\Mps60ReferralCommission;

class Mps60InvestmentController extends Controller
{
    protected $data_control;
    public function __construct()
    {
        $data_control = [
            '1' => 'Investment',
            '2' => 'mps60',
            '3' => 'mps60',
            '4' => 'admin.mps60',
            '5' => 'fas fa-money-bill-wave',
        ];
    }
    protected function mps60()
    {
        // dd(Mps60Investment::with('user')->paginate(10));
        return view('admin.mps60.mps60');
    }
    protected function mps60_index()
    {
        $mps60 = Mps60Investment::with('user')->where('status', 1)->orderby('created_at', 'desc')->get();
        // dd($mps60);
        return view('admin.mps60.mps60_index', compact('mps60'));
    }
    protected function mps60_all()
    {
        $mps60 = Mps60Investment::with('user')->orderby('created_at', 'desc')->get();
        // dd($mps60);
        return view('admin.mps60.mps60_index', compact('mps60'));
    }
    protected function mps60_pending()
    {
        $mps60 = Mps60Investment::with('user')->where('status', 0)->orderby('created_at', 'desc')->get();
        return view('admin.mps60.mps60_index', compact('mps60'));
    }
    protected function mps60_rejected()
    {
        $mps60 = Mps60Investment::with('user')->where('status', 3)->orderby('created_at', 'desc')->get();
        return view('admin.mps60.mps60_index', compact('mps60'));
    }
    protected function mps60_store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'amount' => 'required|numeric',
                'investment_date' => 'required|date',
                'user_id' => 'required|numeric',
            ]);
            $mps60 = new Mps60Investment();
            $mps60->investment_date = $request->investment_date;
            $mps60->amount = $request->amount;
            $mps60->user_id = $request->user_id;
            $mps60->status = 1;
            $mps60->save();
             //distribute to team_investment using user_id=id parent_id from user table
             $parent_id = User::where('id', $request->user_id)->first()->parent_id;
             // dd($parent_id);
             $cnt_distribution = 0;
             while ($parent_id != null) {
                 $team_investment = new Mps60TeamInvestment();
                 $team_investment->investment_id = $mps60->id;
                 $team_investment->investment_date = $request->investment_date;
                 $team_investment->user_id = $mps60->user_id; //investor_id
                 $team_investment->parent_id = $parent_id;
                 $team_investment->amount = $request->amount;
                 $team_investment->save();

                 if ($cnt_distribution < 1) {
                    $referral_commission = Mps60ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps60ReferralBenefit();
                    $existing = Mps60ReferralBenefit::where('investment_id', $mps60->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps60->id;
                        $referral_benefit->user_id = $mps60->user_id;
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
        return response()->json(['status' => 'success', 'message' => 'MPS60 Investment has been added successfully']);
        //return redirect()->back()->with('success', 'Investment Successfully');
    }
    protected function mps60_acknowledge(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'mps_id' => 'required|numeric',
            ]);
            $mps60 = Mps60Investment::find($request->mps_id);
            $mps60->status = 1;
            $mps60->save();

            $parent_id = User::where('id', $mps60->user_id)->first()->parent_id;
            // dd($parent_id);
            $cnt_distribution = 0;
            while ($parent_id != null) {
                $team_investment = new Mps60TeamInvestment();
                $team_investment->investment_id = $mps60->id;
                $team_investment->investment_date = $mps60->investment_date;
                $team_investment->user_id = $mps60->user_id; //investor_id
                $team_investment->parent_id = $parent_id;
                $team_investment->amount = $mps60->amount;
                $team_investment->save();

                if ($cnt_distribution < 1) {
                    $referral_commission = Mps60ReferralCommission::where('level', $cnt_distribution + 1)->first();
                    $referral_benefit = new Mps60ReferralBenefit();
                    $existing = Mps60ReferralBenefit::where('investment_id', $mps60->id)->where('parent_id', $parent_id)->first();
                    if ($existing == null) {
                        $referral_benefit->investment_id = $mps60->id;
                        $referral_benefit->user_id = $mps60->user_id;
                        $referral_benefit->parent_id = $parent_id;
                        $referral_benefit->amount = $mps60->amount;
                        $referral_benefit->level = $cnt_distribution + 1;
                        $referral_benefit->commission = $mps60->amount * $referral_commission->commission / 100;
                        $referral_benefit->save();
                    }

                }

                // }
                $parent_id = User::where('id', $parent_id)->first()->parent_id;
                $cnt_distribution++;
            }

        });

        return response()->json(['status' => 'success', 'message' => 'MPS60 Investment has been acknowledged successfully']);
    }
    protected function user_validate(Request $request)
    {

        $user = User::where('code', $request->user_code)->first();
        // dd($user);
        if ($user) {
            $mps60 = Mps60Investment::with('user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();

            $view = view('admin.mps60.user_mps60', compact('user', 'mps60'))->render();
            return response()->json(['status' => 'success', 'data' => $user, 'view' => $view]);
        }
    }

}
