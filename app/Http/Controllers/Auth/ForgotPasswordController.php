<?php

namespace App\Http\Controllers\Auth;

use App\Services\MemberService;
use Illuminate\Http\Request;
use App\Models\Member;
use Mail;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;


use App\Http\Controllers\ApiController;

class ForgotPasswordController extends ApiController
{

    protected $memberService;

    public function __construct()
    {
        parent::__construct();
        $this->memberService = new MemberService;
    }

    public function showForgetPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate(
            [
              'email' => 'required|email|exists:members',
            ]
        );

        $token = Str::random(64);


        DB::table('password_resets')->insert(
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );


        Mail::send(
            'auth.passwords.forgotPassword',
            ['token' => $token],
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            }
        );

        return view('auth.login')->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate(
            [
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
              ]
        );
  
        $updatePassword = DB::table('password_resets')
                            ->where(
                                [
                                'email' => $request->email,
                                'token' => $request->token
                                  ]
                            )
                              ->first();
  
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
  
          $user = Member::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('auth.login')->with('message', 'Your password has been changed!');
    }
}
