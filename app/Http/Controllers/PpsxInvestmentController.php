<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PpsxInvestment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PpsxInvestmentController extends Controller
{
    public function index()
    {
        $title='PPSX Investment';
        $create_slug="ppsx/create";
        $investment = PpsxInvestment::with('user')
        ->where('user_id', Auth::user()->id)
        ->orderby('created_at', 'desc')->get();
        // $investment=PpsxInvestment::with('user')->where('user_id',$user->id)->orderby('created_at','desc')->get();
        // dd($investment);

        return view('ppsx.ppsx_index', compact('investment','title','create_slug'));

    }
    public function self_investment_contact_admin()
    {
        return view('investment.contact_admin');

    }
    public function user_validate(Request $request)
    {
        $user = User::where('code', $request->user_code)->first();
        $auth_user = Auth::user();
        if ($user->id != $auth_user->id) {
            //check if user is in the same tree
            $upline = $this->get_upline_validation($auth_user->id, $user->id);
            if (!$upline) {
                return response()->json(['status' => 'error', 'message' => 'User is not valid']);
            }

        }

        if ($user) {
            $investment = PpsxInvestment::with('user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();

            $view = view('ppsx.ppsx_index', compact('user', 'investment'))->render();
            //dd($view);
            return response()->json(['status' => 'success', 'data' => $user, 'view' => $view]);
        }
    }
    public function get_upline_validation($user_id, $upline_id)
    {
        $user = User::find($user_id);
        $upline = User::find($upline_id);
        if ($user->parent_id == $upline->id) {
            return true;
        }
        if ($user->parent_id == null) {
            return false;
        }
        return $this->get_upline_validation($user->parent_id, $upline->id);
    }

    public function self_report()
    {
        $investment = PpsxInvestment::with('user')->where('user_id', Auth::user()->id)->orderby('created_at', 'desc')->get();
        // $investment=PpsxInvestment::with('user')->where('user_id',$user->id)->orderby('created_at','desc')->get();
        // dd($investment);
        return view('ppsx.user_ppsx', compact('investment'));
        //return view('investment.user_investment');

    }
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            //dd($request->all());
            $request->validate([
                'amount' => 'required|numeric',
                'investment_date' => 'required|date',
                'user_id' => 'required|numeric',
            ]);

            $investment = new PpsxInvestment();
            $investment->investment_date = $request->investment_date;
            $investment->amount = $request->amount;
            $investment->user_id = $request->user_id;
            $investment->created_by = Auth::user()->id;
            $investment->status = 0;
            $investment->save();
            DB::commit();
        });
        return response()->json(['status' => 'success', 'message' => 'PPS Investment has been added successfully']);
    }
    public function self_investment_contact_admin_store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'amount' => 'required',
        ]);
        $inv = new PpsxInvestment();
        $inv->user_id = $user->id;
        $inv->investment_date = date('Y-m-d');
        $inv->amount = $request->amount;
        $inv->status = 0;
        $inv->save();
        return Redirect::back()->with('success', 'Your request has been sent to admin');

    }
    public function self_investment_pay()
    {
        return view('investment.pay');

    }
}
