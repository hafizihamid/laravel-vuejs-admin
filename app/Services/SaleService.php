<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Member;
use Illuminate\Support\Carbon;

class SaleService
{

    public function salesByStaff()
    {
        $today = date("Y-m-d");
        $yesterday = date('Y-m-d', strtotime("-1 days"));

        $salesByToday = Sale::select('staffid', \DB::raw('SUM(quantity) AS quantity_today'))
        ->where('sales_date', $today)
        ->groupBy('staffid')
        ->get();

        $salesByYesterday = Sale::select('staffid', \DB::raw('SUM(quantity) AS quantity_yesterday'))
        ->whereDate('sales_date', $yesterday)
        ->groupBy('staffid')
        ->get();

        $salesByTwoDays = Sale::select('staffid', \DB::raw('SUM(quantity) AS quantity_two_days'))
        ->whereDate('sales_date', '>', $yesterday)
        ->whereDate('sales_date', '<', $today)
        ->groupBy('staffid')
        ->get();

        $salesByMonth = Sale::select('staffid', \DB::raw('SUM(quantity) AS quantity_by_month'))
        ->whereYear('sales_date', Carbon::now()->format('Y'))
        ->whereMonth('sales_date', Carbon::now()->format('m'))
        ->groupBy('staffid')
        ->get();


        $salesByLastMonth = Sale::select('staffid', \DB::raw('SUM(quantity) AS quantity_by_last_month'))
        ->whereYear('sales_date', Carbon::now()->format('Y'))
        ->whereMonth('sales_date', Carbon::now()->subMonth()->month)
        ->groupBy('staffid')
        ->get();



        $todayEncode = json_encode($salesByToday);
        $yesterdayEncode = json_encode($salesByYesterday);
        $twoDaysEncode = json_encode($salesByTwoDays);
        $lastMonthEncode = json_encode($salesByLastMonth);
        $monthEncode = json_encode($salesByMonth);
        $result = array();
        if ($todayEncode > 0) {

            

        }


        $staff = Member::select('id', 'membername')
        ->get();


        dd(json_decode($staffEncode));

        $mergedArray = array_merge(json_decode($todayEncode), json_decode($yesterdayEncode), json_decode($twoDaysEncode), json_decode($lastMonthEncode), json_decode($monthEncode));

        foreach ($mergedArray as $arr) {
            if (!isset($result[$arr->staffid])) {
                $result[$arr->staffid] = $arr;
                dd($arr);

            } else {
                foreach ($arr as $key => $value) {
                    $result[$arr->staffid]->$key = $value;
                }
            }
        }
        return $result;
    }
}
