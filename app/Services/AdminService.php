<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Carbon;

class AdminService
{
    public function list()
    {
        $admin = Member::all()->toArray();

        return $admin;
    }
}
