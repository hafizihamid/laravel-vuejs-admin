<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    protected $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService;
    }

    public function login()
    {
        $credentials = request()->validate(
            [
                'username' => 'username|required',
                'password' => 'required'
            ]
        );

        $data = $this->userService->login($credentials);

        if ($data['status'] != $this->status_code['ok']) {
            return $this->formatErrorResponse([$data['message']], $data['status'], $data['http_code']);
        }

        return $this->formatDataResponse($data['message'], $data['status'], $data['http_code']);
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->user()->token()->revoke();

            return $this->formatGeneralResponse(config("staticdata.messages.authentication_logout_success"), $this->status_code['ok'], $this->http_code['success']);
        }

        return $this->formatErrorResponse([config("staticdata.messages.authentication_error")], $this->status_code['authentication_error'], $this->http_code['unauthorized']);
    }

    public function forgot()
    {
        $credentials = request()->validate(['username' => 'required|username']);

        $data = $this->userService->forgot($credentials);

        if ($data['status'] != $this->status_code['ok']) {
            return $this->formatErrorResponse([$data['message']], $data['status'], $data['http_code']);
        }

        return $this->formatGeneralResponse($data['message'], $data['status'], $data['http_code']);
    }

    public function reset(PasswordRequest $request)
    {
        $data = $this->userService->reset($request->all());

        if ($data['status'] != $this->status_code['ok']) {
            return $this->formatErrorResponse([$data['message']], $data['status'], $data['http_code']);
        }

        return $this->formatGeneralResponse($data['message'], $data['status'], $data['http_code']);
    }

    public function authCheck()
    {
        $user = auth()->user();

        $userArray = $this->userService->getUserWithRolesPermissions($user);
        //middleware should already performed necessary check
        return $this->formatDataResponse(
            ['user' => $userArray],
            config('staticdata.status_codes.ok'),
            config('staticdata.http_codes.success')
        );
    }
}
