<?php

namespace App\Http\Controllers;

use App\Models\SelfInvestment;
use App\Models\TeamInvestment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $Level_enum;
    protected $level;
    protected $user;
    public function __construct()
    {
        $this->Level_enum = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        //dd($user['parent']);
        return view('user.profile', compact('user'));
    }

    protected function my_team_view()
    {
        $user = auth()->user();
        $data['title'] = 'My Team';
        $data['level'] = $this->Level_enum;
        $data['user'] = User::find(Auth::user()->id);
        $data['my_team'] = User::where('parent_id', $user->id)->get();
        return view('user.my_team', $data);
    }
    protected function my_team($user_id)
    {
        $user = User::find($user_id);
        $data['title'] = 'My Team';
        $data['user'] = $user;
        $data['users'] = User::where('parent_id', $user->id)->get();
        return view('user.my_team', $data);
    }

    protected function user_level_search(Request $request)
    {
        $user = auth()->user();
        $data['title'] = 'My Team';
        $data['user'] = User::find(Auth::user()->id);
        // $data['my_team'] = User::where('parent_id',$user->id)->where('level',$request->level)->get();
        $downline_tree = $this->get_downline_tree($user->id);

        foreach ($this->user as $key => $usr) {
            // echo $usr;
            if ($usr->level != $request->level) {
                //  echo $usr->level;
                unset($this->user[$key]);
                // $data['my_team'][]=$usr;
            }
        }
        // exit;
        $data['my_team'] = $this->user;
        // dd($data['my_team']);
        $html = view('user.level_view', $data)->render();
//$html='';
        return response()->json(['success' => 'Got Simple Ajax Request.', 'html' => $html]);
    }

    public function downline_report($user_id)
    {
        $this->level = 0;
        $data['title'] = 'Downline Report';
        $collection = $this->get_downline_tree($user_id);
        // $data['collection'] = $collection;
        //dd($this->user);
        if (!$this->user == null) {
            foreach ($this->user as $key => $user) {
                $this->user[$key]['self'] = $this->self_investment($user->id);
                $this->user[$key]['team'] = $this->team_investment($user->id);

            }

        }
        return $this->user;
        // $data['downline']=  $this->user;
        // return $data['downline'];
        // return view('report.downline_report',$data);
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

    protected function get_downline_tree($id, $sponsor_code = null, $level = -1)
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
    protected function tree_view()
    {
        $user = User::find(Auth::user()->id);
        $data['title'] = 'Tree View';
        $data['user'] = $user;
        $data['immediate'] = User::where('parent_id', $user->id)->get();
        return view('user.tree_view', $data);

    }
    protected function tree_view_individual(Request $request)
    {
        $user = User::find($request->id);
        //    dd($user);
        $data['title'] = 'Tree View';
        $data['user'] = $user;
        $data['immediate'] = User::where('parent_id', $user->id)->get();

        $html = view('user.tree_view_individual', $data)->render();
        return response()->json(['success' => 'Got Simple Ajax Request.', 'html' => $html]);

    }
    protected function reset_passscode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'passcode' => 'required|numeric|digits:6',
            'confirm_passcode' => 'required|numeric|digits:6|same:passcode',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::find(Auth::user()->id);
        $user->passcode = $request->passcode;
        $user->password=bcrypt($request->passcode);
        $user->save();
        return redirect()->back()->with('success', 'Passcode Reset Successfully');
    }


}
