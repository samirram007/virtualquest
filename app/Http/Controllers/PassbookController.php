<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PassbookController extends Controller
{
    protected function passbook()
    {
        $data['title'] = 'Passbook';
        $data['from_date'] = date('Y-m-01', strtotime(date('Y-m-d')));
        $data['to_date'] = date('Y-m-d');
        return view('passbook.passbook', $data);
    }
    protected function passbook_search(Request $request)
    {

        $user = Auth::user();
        $data['title'] = 'Passbook';
        // $data['from_date'] = $request->from_date;
        // $data['to_date'] = $request->to_date;
        $from_date = '2022-09-01';
        $to_date = date('Y-m-d');

        // referral benefit and self investment relation and quesr on investment date of self investment raw query
        $sql = "select 0 as debit,sum(referral_benefits.commission) as credit,
        self_investments.investment_date as log_date from referral_benefits
        join self_investments on referral_benefits.investment_id=self_investments.id
        where referral_benefits.parent_id=$user->id and
        self_investments.investment_date between '$from_date' and '$to_date'
        group by self_investments.investment_date order by self_investments.investment_date desc";
        // dd($sql);
        $referral_benefit = DB::select(DB::raw($sql));
        $referral_benefit = json_decode(json_encode($referral_benefit), true);
        $total_referral_benefit = 0;
        foreach ($referral_benefit as $key => $value) {
            $total_referral_benefit += $value['credit'];
        }

        $pps_staking_log_sql = "select 0 as debit,sum(commission) as credit,log_date from pps_staking_logs
        where user_id=$user->id and log_date between '$from_date' and '$to_date'
        group by log_date order by log_date ";
        $pps_staking_log = DB::select(DB::raw($pps_staking_log_sql));
        $pps_staking_log = json_decode(json_encode($pps_staking_log), true);

        $total_pps_staking = 0;
        foreach ($pps_staking_log as $key => $value) {
            $total_pps_staking += $value['credit'];
        }

        $merge = array_merge($referral_benefit, $pps_staking_log);

        $pps_level_distribution_sql="select 0 as debit,sum(commission) as credit,log_date from pps_level_distribution_logs
        where parent_id=$user->id and log_date between '$from_date' and '$to_date'
        group by log_date order by log_date ";
        $pps_level_distribution_logs = DB::select(DB::raw($pps_level_distribution_sql));

        $pps_level_distribution_logs = json_decode(json_encode($pps_level_distribution_logs), true);
        $merge = array_merge($merge, $pps_level_distribution_logs);
        $total_pps_level_distribution = 0;
        foreach ($pps_level_distribution_logs as $key => $value) {
            $total_pps_level_distribution += $value['credit'];
        }

        $payment_request = DB::table('payment_requests')
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereBetween(DB::raw("DATE_FORMAT(payment_confirm_date,'%Y-%m-%d')"), [$from_date, $to_date])
            ->select(DB::raw('sum(amount) as debit'), DB::raw('0 as credit'), DB::raw("DATE_FORMAT(payment_confirm_date,'%Y-%m-%d') as log_date"))
            ->groupBy('payment_confirm_date')
            ->orderBy('payment_confirm_date', 'asc')
            ->get();
           // dd($payment_request);
        $payment_request = json_decode(json_encode($payment_request), true);
        $merge = array_merge($merge, $payment_request);

        $passbook = new \Illuminate\Support\Collection($merge);

        $passbook = json_decode(json_encode($passbook), true);

        $filtered_passbook = [];
        //    list of dates in $passbook
        $dates = array_column($passbook, 'log_date');

        //    list of unique dates
        $unique_dates = array_unique($dates); // 1, 2, 3
        //sorted unique dates
        usort($unique_dates, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });

 //dd($unique_dates);

        //    loop through unique dates
        $balance = 0;

        foreach ($unique_dates as $date) {
            //    filter passbook by date
            $filtered = array_filter($passbook, function ($item) use ($date) {
                return $item['log_date'] == $date;
            });
            //    sum credit and debit
            $credit = array_sum(array_column($filtered, 'credit'));
            $debit = array_sum(array_column($filtered, 'debit'));
            $balance = $balance + $credit - $debit;
            //    push to filtered passbook
            array_push($filtered_passbook, [
                'log_date' => $date,
                'credit' => $credit,
                'debit' => $debit,
                'balance' => $balance,
            ]);
        }
        //    sort filtered passbook by date desc
        usort($filtered_passbook, function ($a, $b) {
            return strtotime($b['log_date']) - strtotime($a['log_date']);
        });

        // usort($filtered_passbook, function ($a, $b) {
        //     return strtotime($a['log_date']) - strtotime($b['log_date']);
        // });

     //   dd($filtered_passbook);
        //     //datewise total credit and debit
        //     $data['total_credit']=$passbook->sum('credit');
        //     $data['total_debit']=$passbook->sum('debit');
        //     $data['total_balance']=$data['total_credit']-$data['total_debit'];
        //    // $passbook=$passbook->DB::raw->groupBy('log_date');
        //    foreach($passbook as $key=>$value){
        //     $passbook[$key]->credit=$passbook->where('log_date',$value->log_date)->sum('credit');
        //     $passbook[$key]->debit=$passbook->where('log_date',$value->log_date)->sum('debit');
        //     $passbook[$key]->balance=$passbook[$key]->credit-$passbook[$key]->debit;
        //    }
        $data['passbook'] = $filtered_passbook;

        $html_view = view('passbook.passbook_search', $data)->render();
        //dd($html_view);
        return response()->json(['status' => true, 'html_view' => $html_view]);
    }

    public function compareByTimeStamp($a, $b)
    {
        return strtotime($b) - strtotime($a);
    }
}
