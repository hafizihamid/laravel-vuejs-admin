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

        $default = array('quantity_today' => '0', 'quantity_yesterday' => '0', 'quantity_two_days' => '0', 'quantity_by_month' => '0', 'quantity_by_last_month' => '0');
        $staff = Member::select('id as staffid', 'membername')
        ->orderBy('id')
        ->get()
        ->toArray();

        foreach ($staff as $key => $value) {
            $staff[$key]=$value + $default;
        }
        $staffEncode = json_encode($staff);

        $result = array();
        $mergedArray = array_merge(json_decode($staffEncode), json_decode($todayEncode), json_decode($yesterdayEncode), json_decode($twoDaysEncode), json_decode($lastMonthEncode), json_decode($monthEncode));

        foreach ($mergedArray as $arr) {
            if (!isset($result[$arr->staffid])) {
                $result[$arr->staffid] = $arr;
            } else {
                foreach ($arr as $key => $value) {
                    $result[$arr->staffid]->$key = $value;
                }
            }
        }

        return $result;
    }

    public function pendingPrint()
    {
        $pendingForPrint = Sale::select('staffid', \DB::raw('COUNT(salesid) AS counted'))
        ->whereNull('tracking_no')
        ->where('sales_mode', '!=', 'cod')
        ->groupBy('staffid')
        ->get();

        $pendingEncode = json_encode($pendingForPrint);


        $staff = Member::select('id as staffid', 'membername')
        ->orderBy('id')
        ->get()
        ->toArray();

        $default = array('counted' => '0');

        foreach ($staff as $key => $value) {
            $staff[$key]=$value + $default;
        }
        $staffEncode = json_encode($staff);

        $mergedArray = array_merge(json_decode($staffEncode), json_decode($pendingEncode));

        $result = array();

        foreach ($mergedArray as $arr) {
            if (!isset($result[$arr->staffid])) {
                $result[$arr->staffid] = $arr;
            } else {
                foreach ($arr as $key => $value) {
                    $result[$arr->staffid]->$key = $value;
                }
            }
        }

        return $result;
    }
}
