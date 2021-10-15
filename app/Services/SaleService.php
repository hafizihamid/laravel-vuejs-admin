<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Member;
use Illuminate\Support\Carbon;

class SaleService
{

    public function salesByStaff()
    {

$today = Carbon::now()->format('Y-m-d');

    // $data= Sale::select('staffid', \DB::raw('SUM(quantity) AS total_quantity'))
    //         ->get()
    //         ->groupBy(function($val) {
    //         return Carbon::parse($val->sales_date)->format('m');
    //  });

    //  print($data);


// $visitorTraffic = Sale::select('staffid', 'quantity')->
// where('sales_date', '=', '2015-07-31')

//                             ->get(array(
//                                 \DB::raw('Date(sales_date) as date'),
//                                 \DB::raw('SUM(quantity) AS total_quantity')
//                             ));



//                             print($visitorTraffic);





        $today = '2015-08-14';
        // $yesterday = '2015-08-03';



        $salesByToday = Sale::select('staffid', \DB::raw('SUM(quantity) AS total_quantity_today'))
        ->where('sales_date', $today)
        ->groupBy('staffid')
        ->get()
        ->toArray();

        // $salesByYesterday = Sale::select('staffid', \DB::raw('SUM(quantity) AS total_quantity'))
        // ->whereDate('sales_date', $yesterday)
        // ->groupBy('staffid')
        // ->get()
        // ->toArray();

        // dd($salesByYesterday);





        dd($salesByToday);



        // $data = json_decode($sales, TRUE);


        // dd($data);

        // $member = Member::select('id', 'membername')
        // ->get()
        // ->toArray();

        // foreach ($member as $value) {
        //     $t = $value;
        // }

        // foreach ($sales as $value) {
        //     if($value['staffid']== $t['id']) {
        //        dd($t['membername']);
        //     };
        //     // dd($value['staffid']);
        //     // foreach ($value as $key) {
        //     //     dd($key);
        //     // }
        // }



        // $test = array_intersect($sales, $member);

        // dd($test);




        // return response()->json(
        //     [$sales,$member]
        // );
        // return $data1 = Sale::get()->groupBy('staffid');
    }
}

// \DB::raw('sum(actualhours) as sumhours')