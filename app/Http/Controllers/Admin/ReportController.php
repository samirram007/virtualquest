<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SelfInvestment;
use App\Http\Controllers\Controller;
use App\Models\DeskQuery;
use App\Models\PaymentRequest;
use App\Models\TeamInvestment;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    protected $level;
    protected $user;
    protected $payment_status;
    public function downline_report()
    {
        $this->level = 0;
        $data['title'] = 'Downline Report';
         $collection= $this->get_downline_tree(Auth::user()->id);
           // $data['collection'] = $collection;
           //dd($this->user);
           //ksort($this->user, SORT_NUMERIC);
           //asort($this->user, 'sortByLevel');
           foreach($this->user as $key => $user){
               $this->user[$key]['self'] = $this->self_investment($user->id);
               $this->user[$key]['team'] = $this->team_investment($user->id);
           }


        $data['downline']=  $this->user;
        return view('admin.report.downline_report',$data);
    }
    protected function self_investment($user_id){
        $amount=SelfInvestment::where('user_id',$user_id)->where('status',1)->sum('amount');
        return $amount;
    }
    protected function team_investment($user_id){
        $amount=TeamInvestment::where('parent_id',$user_id)->sum('amount');
        return $amount;
    }

        protected function generate_team_investment(){
            foreach($this->user as $key => $user){
               // $this->user[$key]['team'] = $this->team_investment($user->id);
            }
        }

        function sortByLevel($a, $b)
            {
                $a = $a['level'];
                $b = $b['level'];

                if ($a == $b) return 0;
                return ($a < $b) ? -1 : 1;
            }

    protected function get_downline_tree($id,$sponsor_code=null,$level=0)
    {

        $downline_tree = User::where('parent_id', $id)->get();
        //print_r($downline_tree->toArray());
        foreach ($downline_tree as $key => $value) {
            $downline_tree[$key]['level']=$level+1;
            $downline_tree[$key]['sponsor'] = $sponsor_code;
            $value['level']=$level+1;
            $value['sponsor'] = $sponsor_code;
            $this->user[] = $value;
            $downline_tree[$key]['downline_tree'] = $this->get_downline_tree($value->id,$value->code,$value->level);

        }
        return $downline_tree;
    }
   function __construct()
   {
    $this->payment_status=['pending','rejected','paid'];
   }
    protected function payment_request_process()
    {
        $data['collection']=PaymentRequest::orderby('created_at','desc')->get();
        $data['title']='Payment Request Process';
        $data['payment_status']=$this->payment_status;
        return view('admin.payment.payment_request',$data);
    }
    protected function status_form(Request $request)
    {
        $data['payment_request']=PaymentRequest::find($request->id);
        $data['payment_status']=$this->payment_status;
        $html=view('admin.payment.status_form',$data)->render();
        return response()->json(['status'=>'success','html'=>$html]);

    }
    protected function payment_status_change(Request $request)
    {
        $request->validate([
            'status'=>'required',
            'id'=>'required'
        ]);
        $payment_request=PaymentRequest::find($request->id);
        $payment_request->status=$request->status;
        $payment_request->payment_confirm_date=date('Y-m-d H:i:s');
        $payment_request->note=$request->note;

        $payment_request->save();
        if($request->status=='paid'){
            $this->send_approved_payment_request_email($payment_request->user_id,$payment_request->amount,$payment_request->status);
        }

        return response()->json(['status'=>'success','message'=>'Payment Status Changed Successfully']);
    }
    protected function send_approved_payment_request_email($user_id,$amount,$status)
    {
        $user=User::find($user_id);
        $data['user']=$user;
        $data['amount']=$amount;
        $data['status']=$status;
        $data['subject']='Payment Request Status';
        $data['email']=$user->email;
        $data['name']=$user->name;
        $data['message']='Your Payment Request Status is '.$status;
        // send_email($data);
    }
    //send email to user
    protected function desk_query()
    {
        $data['collection']=DeskQuery::orderby('created_at','desc')->get();
        return view('admin.operation.desk_query',$data);

    }
}
