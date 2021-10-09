<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use DB;

class UserService extends BaseService
{
    public function login($credentials)
    {
        if (!auth()->attempt($credentials)) {
            return $this->formatGeneralResponse(
                config('staticdata.messages.authentication_error'),
                config('staticdata.status_codes.authentication_error'),
                config('staticdata.http_codes.unauthorized')
            );
        }

        $user = auth()->user();

        $data = [
            'user' => 'test',
        ];

        return $this->formatGeneralResponse(
            $data,
            config('staticdata.status_codes.ok'),
            config('staticdata.http_codes.success')
        );



//     $users = Member::where(DB::raw('length(password)'), '<', 60)->get();
//     foreach($users as $user)
// {
//     $user->password = Hash::make($user->password);
//     $user->save();
// }

// dd($users);




//         $user = Member::where(
//             [
//             'username' => $credentials['username'],
//             'password' => $credentials['password']
//             ]
//         )->first();

    

       


        // $user = auth()->user();
        // dd($user);

        // if ($user->is_disabled) {
        //     return $this->formatGeneralResponse(
        //         config('staticdata.messages.user_disabled'),
        //         config('staticdata.status_codes.forbidden'),
        //         config('staticdata.http_codes.forbidden')
        //     );
        // }

        // $accessToken = $user->createToken('authToken')->accessToken;

        // $userArray = $this->getUserWithRolesPermissions($user);

        // $data = [
        //     'user' => $userArray,
        //     'accessToken' => $accessToken
        // ];
    }

    // public function getUserWithRolesPermissions($user)
    // {
    //     $userArray = $user->toArray();

    //     $roles = $user->roles->pluck('name');
    //     $permissions = ($user->getAllPermissions()->pluck('name'));
    //     $userArray['roles'] = $roles;
    //     $userArray['permissions'] = $permissions;

    //     return $userArray;
    // }

    public function forgot($credentials)
    {
        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->is_disabled) {
            return $this->formatGeneralResponse(
                config('staticdata.messages.user_disabled'),
                config('staticdata.status_codes.forbidden'),
                config('staticdata.http_codes.forbidden')
            );
        }

        try {
            Password::sendResetLink($credentials);
        } catch (\Exception $e) {
            \Log::error($e);
            $message = $e->getMessage();
            if ($e instanceof \GuzzleHttp\Exception\ConnectException) {
                $message = config("staticdata.messages.email_failed");
            }
            return $this->formatGeneralResponse(
                $message,
                config('staticdata.status_codes.error'),
                config('staticdata.http_codes.internal_server_error')
            );
        }

        return $this->formatGeneralResponse(
            config("staticdata.messages.authentication_reset_email_successful"),
            config('staticdata.status_codes.ok'),
            config('staticdata.http_codes.success')
        );
    }

    public function reset($credentials)
    {
        $userInstance = null;

        $reset_password_status = Password::reset(
            $credentials,
            function ($user, $password) use (&$userInstance) {
                $user->password = Hash::make($password);
                $user->save();
                $userInstance = $user;
            }
        );

        if ($reset_password_status == Password::PASSWORD_RESET) {
            //revoke all token for safety reason
            if ($userInstance instanceof \App\Models\User) {
                $userTokens = $userInstance->tokens;
                foreach ($userTokens as $token) {
                    $token->revoke();
                }
            }
            return $this->formatGeneralResponse(
                config("staticdata.messages.authentication_reset_successful"),
                config('staticdata.status_codes.ok'),
                config('staticdata.http_codes.success')
            );
        } else {
            return $this->formatGeneralResponse(
                config("staticdata.messages.authentication_reset_invalid_token"),
                config('staticdata.status_codes.authentication_error'),
                config('staticdata.http_codes.bad_request')
            );
        }
    }

    public function setPassword($credentials)
    {
        $reset_password_status = Password::reset(
            $credentials,
            function ($user, $password) use (&$userInstance) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($reset_password_status == Password::PASSWORD_RESET) {
            return $this->formatGeneralResponse(
                config("staticdata.messages.authentication_set_password_successful"),
                config('staticdata.status_codes.ok'),
                config('staticdata.http_codes.success')
            );
        } else {
            return $this->formatGeneralResponse(
                config("staticdata.messages.authentication_set_password_invalid_token"),
                config('staticdata.status_codes.authentication_error'),
                config('staticdata.http_codes.bad_request')
            );
        }
    }
    public function changePassword($credentials)
    {
        $user = auth()->user();

        $check = Hash::check($credentials['old_password'], $user->password);

        if ($check) {
            $user->password = Hash::make($credentials['password']);
            $user->save();

            $userTokens = $user->tokens;
            foreach ($userTokens as $token) {
                $token->revoke();
            }

            return $this->formatGeneralResponse(
                config("staticdata.messages.action_success"),
                config('staticdata.status_codes.ok'),
                config('staticdata.http_codes.success')
            );
        } else {
            return $this->formatGeneralResponse(
                ["old_password" => [config("staticdata.messages.authentication_change_old_password_incorrect")]],
                config('staticdata.status_codes.validation_failed'),
                config('staticdata.http_codes.bad_request')
            );
        }
    }

    public function list($keyword, $per_page)
    {
        $users = User::select('id', 'name', 'email', 'is_disabled')
            ->when(
                $keyword,
                function ($query) use ($keyword) {
                    $query->where('name', 'ilike', '%' . $keyword . '%')
                        ->orWhere('email', 'ilike', '%' . $keyword . '%');
                }
            )
            ->with('roles:id,name')
            ->orderBy('id');

        $users = $users->paginate($per_page ?? config('staticdata.default_per_page'));

        return $users;
    }

    public function create($input)
    {
        try {
            DB::beginTransaction();

            $user_input = [
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt(str_random(8))
            ];
            $user = User::create($user_input);
            $user->assignRole($input['role']);

            $token = Password::createToken($user);

            $response = $user->sendSetPasswordNotification($token);
            if (!$response) {
                throw new \Exception(config("staticdata.messages.email_failed"));
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            $message = $e->getMessage();
            if ($e instanceof \GuzzleHttp\Exception\ConnectException) {
                $message = config("staticdata.messages.email_failed");
            }
            return $this->formatGeneralResponse(
                $message,
                config('staticdata.status_codes.error'),
                config('staticdata.http_codes.internal_server_error')
            );
        }

        return $this->formatGeneralResponse(
            config('staticdata.messages.action_success'),
            config('staticdata.status_codes.ok'),
            config('staticdata.http_codes.success')
        );
    }

    public function disable($disable, $user_id)
    {
        $user = User::find($user_id);

        //cannot delete default system SUPER ADMIN and SELF
        if ($user->email == config('staticdata.frontend.email') || auth()->user()->id == $user->id) {
            return $this->formatGeneralResponse(
                config('staticdata.messages.action_not_allow'),
                config('staticdata.status_codes.forbidden'),
                config('staticdata.http_codes.forbidden')
            );
        }

        $user->is_disabled = $disable;
        $user->save();

        //revoke all token
        if ($disable) {
            $userTokens = $user->tokens;
            foreach ($userTokens as $token) {
                $token->revoke();
            }
        }

        return $this->formatGeneralResponse(
            config('staticdata.messages.action_success'),
            config('staticdata.status_codes.ok'),
            config('staticdata.http_codes.success')
        );
    }

    public function update($input, $id)
    {

        $user = User::find($id);
        try {
            DB::beginTransaction();
            $user_input = [
                'name' => $input['name']
            ];
            $user->update($user_input);
            $user->syncRoles($input['role']);
            $user->is_disabled = $input['disable'];
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return $this->formatGeneralResponse(
                $e->getMessage(),
                config('staticdata.status_codes.error'),
                config('staticdata.http_codes.internal_server_error')
            );
        }

        return $this->formatGeneralResponse(
            config('staticdata.messages.action_success'),
            config('staticdata.status_codes.ok'),
            config('staticdata.http_codes.success')
        );
    }

    public function details($id)
    {
        $user = User::select('id', 'name', 'email', 'is_disabled')->with('roles')->find($id);

        return $user;
    }
}
