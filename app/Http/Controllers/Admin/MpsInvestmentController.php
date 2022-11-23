<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MpsInvestment;
use App\Models\MpsTeamInvestment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
             //distribute to team_investment using user_id=id parent_id from user table
             $parent_id = User::where('id', $request->user_id)->first()->parent_id;
             // dd($parent_id);
             $cnt_distribution = 0;
             while ($parent_id != null) {
                 $team_investment = new MpsTeamInvestment();
                 $team_investment->investment_id = $investment->id;
                 $team_investment->investment_date = $request->investment_date;
                 $team_investment->user_id = $investment->user_id; //investor_id
                 $team_investment->parent_id = $parent_id;
                 $team_investment->amount = $request->amount;
                 $team_investment->save();

                 $parent_id = User::where('id', $parent_id)->first()->parent_id;
                 $cnt_distribution++;
             }
          DB::commit();
        });
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

            $parent_id = User::where('id', $investment->user_id)->first()->parent_id;
            // dd($parent_id);
            $cnt_distribution = 0;
            while ($parent_id != null) {
                $team_investment = new MpsTeamInvestment();
                $team_investment->investment_id = $investment->id;
                $team_investment->investment_date = $investment->investment_date;
                $team_investment->user_id = $investment->user_id; //investor_id
                $team_investment->parent_id = $parent_id;
                $team_investment->amount = $investment->amount;
                $team_investment->save();

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
}
