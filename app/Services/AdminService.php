<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Group;
use Illuminate\Support\Carbon;
Use \DB;


class AdminService
{
    public function list()
    {
        $admin = DB::table('members')
        ->join('members_group', 'members_group.groupid', '=', 'members.groupid')
        ->get();

        $response =$admin->toArray();
        return $response;
    }
}
