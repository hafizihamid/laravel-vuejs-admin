<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Services\MemberService;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends ApiController
{
    protected $memberService;

    public function __construct()
    {
        parent::__construct();
        $this->memberService = new MemberService;
    }

    public function showLoginPasswordForm()
    {
        return view('auth.login');
    }

    public function submitLoginPasswordForm(Request $request)
    {
        $credentials = $request->validate(
            [
            'username' => 'required',
            'password' => 'required',
            ]
        );

        $user = Member::where('username', $credentials['username'])->first();

        if (!$user) {
            return view('auth.login')->withErrors(["errorUsername"=>"Invalid username"]);
        }

        $data = $this->memberService->login($credentials);

        if ($data['status'] != $this->statusCode['ok']) {
            return view('auth.login')->withErrors(["error"=>'Invalid username/password combination']);
        }
            return redirect()->intended('home');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('auth.login');
    }
}
