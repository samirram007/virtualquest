<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Mps60Investment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Mps60InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='MPS60 Investment';
        $create_slug="mps60/create";
        $investment = Mps60Investment::with('user')
        ->where('user_id', Auth::user()->id)
        ->orderby('created_at', 'desc')->get();
        // $investment=SelfInvestment::with('user')->where('user_id',$user->id)->orderby('created_at','desc')->get();
        // dd($investment);

        return view('mps60.index', compact('investment','title','create_slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title='MPS Application';
        return view('mps60.create');
    }
    public function application()
    {
        //
        $title='MPS Application';
        $html= view('mps60.application')->render();
        return response()->json(['html'=>$html]);
    }
    public function user_validate(Request $request)
    {
        $user = User::where('code', $request->user_code)->first();
        $auth_user = Auth::user();
        if($user->id!=$auth_user->id){
            //check if user is in the same tree
            $upline = $this->get_upline_validation($auth_user->id, $user->id);
            if (!$upline) {
                return response()->json(['status' => 'error', 'message' => 'User is not valid']);
            }

        }

        if ($user) {
            $investment = Mps60Investment::with('user')->where('user_id', $user->id)->orderby('created_at', 'desc')->get();
    //  dd($investment->count());
            $view = view('mps60.investment_index', compact('user', 'investment'))->render();
            //dd($view);
            return response()->json(['status' => 'success', 'data' => $user, 'view' => $view]);
        }
    }
    function get_upline_validation($user_id, $upline_id)
    {
        $user = User::find($user_id);
        $upline = User::find($upline_id);
        if($user->parent_id==$upline->id){
            return true;
        }
        if($user->parent_id==null){
            return false;
        }
        return $this->get_upline_validation($user->parent_id, $upline->id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'amount' => 'required|numeric',
                'investment_date' => 'required|date',
                'user_id' => 'required|numeric',
            ]);
            $investment = new Mps60Investment();
            $investment->investment_date = $request->investment_date;
            $investment->amount = $request->amount;
            $investment->user_id = $request->user_id;
            $investment->created_by = Auth::user()->id;
            $investment->status = 0;
            $investment->save();
            DB::commit();
        });

        return response()->json(['status' => 'success', 'message' => 'Mps Investment has been added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mps60Investment  $mps60Investment
     * @return \Illuminate\Http\Response
     */
    public function show(Mps60Investment $mps60Investment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mps60Investment  $mps60Investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Mps60Investment $mps60Investment)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
