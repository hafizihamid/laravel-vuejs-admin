<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'salesid',
        'sales_mode',
        'sales_date',
        'sales_stamp',
        'sales_time',
        'sales_datetime',
        'staffid',
        'senderid',
        'productid',
        'price',
        'cost',
        'quantity',
        'pay_bank',
        'pay_method',
        'buyer_name',
        'buyer_address',
        'mobile_no',
        'tracking_no',
        'unitcost',
        'profit',
        'buyer_nickname',
        'pay_type',
        'price_paid',
        'price_pending',
        'pay_note',
        'price_ori',
        'discount',
        'comm_date',
        'est_pay_date'
    ];
}
