<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $memberService;

    public function __construct()
    {
        parent::__construct();
        $this->memberService = new AdminService;
    }

    public function index()
    {
        $data = $this->memberService->list();

        $reCreateArray = array_values($data);

        // dd($reCreateArray);


        return response()->json(
            [
            'data' => $reCreateArray
            ]
        );

    }
}
