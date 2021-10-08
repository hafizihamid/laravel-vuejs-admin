<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'membername',
        'email',
        'contact_no',
        'mobile_no',
        'company',
        'website',
        'memberstatus',
        'membertype',
        'username',
        'password',
        'remarks',
        'adddate',
        'addstamp',
        'photo_large',
        'photo_small',
        'groupid',
        'sales_target',
        'quantity_target'
    ];

    public $timestamps = false;
}
