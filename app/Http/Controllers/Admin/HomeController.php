<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use App\Models\PpsLevelDistribution;
use App\Models\PpsStaking;
use App\Models\ReferralBenefit;
use App\Models\SelfInvestment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user_count'] = User::count();
        $data['total_investment'] = SelfInvestment::where('status', 1)->sum('amount');
        $data['pending_investment'] = SelfInvestment::where('status', 0)->sum('amount');

        $data['payment_request'] = PaymentRequest::sum('amount');
        $data['paid_payment_request'] = PaymentRequest::where('status', 'paid')->sum('amount');
        $data['pending_payment_request'] = PaymentRequest::where('status', 'pending')->sum('amount');

        $data['rejected_payment_request'] = PaymentRequest::where('status', 'rejected')->sum('amount');

        $data['total_pps_staking'] = PpsStaking::sum('commission');
        $data['total_pps_level_distribution'] = PpsLevelDistribution::sum('commission');
        $data['total_referral_benefits'] = ReferralBenefit::sum('commission');

        $data['total_earning'] = $data['total_pps_staking'] + $data['total_pps_level_distribution'] + $data['total_referral_benefits'];
        $data['due_payment'] = $data['total_earning'] - $data['paid_payment_request'];
        $data['total_pps_stakings_user'] = DB::table('pps_stakings')
            ->select('pps_stakings.user_id as user_id', DB::raw("SUM(pps_stakings.commission) as commission"))
            ->groupBy('pps_stakings.user_id')
            ->get();
        $data['total_pps_level_distributions_user'] = DB::table('pps_level_distributions')
            ->select('pps_level_distributions.parent_id as user_id', DB::raw("SUM(pps_level_distributions.commission) as commission"))
            ->groupBy('pps_level_distributions.parent_id')
            ->get();
        //dd( sizeof($data['total_pps_level_distributions_user']));
        $data['total_referral_benefits_group_by_user'] = DB::table('referral_benefits')
            ->select('referral_benefits.parent_id as user_id', DB::raw("SUM(referral_benefits.commission) as commission"))
            ->groupBy('referral_benefits.parent_id')
            ->get();
        // dd( sizeof($data['total_pps_level_distributions_user']));
        //  $data['total_commission']=array();
        $new_dataobj = $data['total_pps_stakings_user'];

        $new_dataobj = $new_dataobj->merge($data['total_pps_level_distributions_user']);

        $new_dataobj = $new_dataobj->merge($data['total_referral_benefits_group_by_user']);
        //dd( sizeof($new_dataobj));
       // $new_array = (array) $new_dataobj;
        $new_array = $this->objectToArray($new_dataobj);

        array_multisort(array_column($new_array, 'user_id'), SORT_ASC, $new_array);
        // Get Sum By User_id
        $new_array = $this->getSumByUser($new_array);
        $data['amount_grater_than_10'] = $this->amountGreaterThan10($new_array);
     //   dd($data['amount_grater_than_10'] );
      //

        // array_multisort(array_column($new_array, 'user_id'), SORT_DESC, $new_array);
        // array_multisort($userid, SORT_DESC, $new_array);

        // $new_array=array_merge($new_array,(array)$data['total_pps_level_distributions_user']);
        //dd( $new_array);
        // $new_array=array_merge($new_array,(array)$data['total_referral_benefits_group_by_user']);
// array_push($data['total_commission'],$data['total_pps_stakings_user']);
// array_push($data['total_commission'],$data['total_pps_level_distributions_user']);
// array_push($data['total_commission'],$data['total_referral_benefits_group_by_user']);

        return view('admin.home', $data);
    }

    protected function amountGreaterThan10($array){
        $amount_greater_than_10 = 0;
        foreach ($array as $key => $value) {
            if($value['commission'] >= 10){
                $amount_greater_than_10 += $value['commission'];
            }
        }
        return $amount_greater_than_10;
    }
    protected function getSumByUser($array)
    {
        $new_array = array();
        $user_id = 0;
        $commission = 0;
        foreach ($array as $key => $value) {
            if ($user_id == $value['user_id']) {
                $commission =  $commission+ $value['commission'];
            } else {
                $user_id = $value['user_id'];
                $commission = 0+$value['commission'];
            }
            $new_array[$user_id]['user_id'] = $user_id;
            $new_array[$user_id]['commission'] = $commission;
           // unset($array[$key-1]);
        }
        $new_array = array_values($new_array);
        return $new_array;
    }
    private function group_by($key, $data)
    {
        $result = array();

        foreach ($data as $k=> $val) {
            if (array_key_exists($key, $val)) {
                $result[$val[$key]][] = $val;
            } else {
                $result[""][] = $val;
            }
        }

        return $result;
    }
    public function objectToArray(&$object)
    {
        return @json_decode(json_encode($object), true);
    }

}
