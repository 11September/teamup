<?php

namespace App\Http\Controllers\App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\CheckCode;
use App\Http\Requests\AuthLogin;
use App\Http\Requests\CheckEmail;
use App\Http\Requests\AuthRegister;
use App\Http\Requests\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     *
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(AuthLogin $request)
    {
        $token = $this->authService->login($request);

        return response()->json([
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $token->token->expires_at
            )->toDateTimeString()
        ]);
    }


    /**
     * Create user
     *
     * @param  [string] first_name
     * @param  [string] last_name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] type
     * @param  [int|nullable] number_students
     *
     * @return [string] message
     */
    public function register(AuthRegister $request)
    {
        $token = $this->authService->register($request);

        return response()->json([
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $token->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Method forgot_password
     *
     * @param  [string] email
     *
     * @return [string] message
     */

    public function forgot_password(CheckEmail $request)
    {
        $this->authService->forgot_password($request);

        return response()->json([
            'message' => 'Successfully send code to Email!',
        ]);
    }


    /**
     * Method confirm_code
     *
     * @param  [string] code
     *
     * @return [string] message
     */

    public function confirm_code(CheckCode $request)
    {
        return response()->json([
            'message' => 'Code is Valid!',
        ]);
    }


    /**
     * Method reset_password
     *
     * @param  [string] password
     * @param  [string] password_confirmation
     *
     * @return [string] message
     */

    public function reset_password(ResetPassword $request)
    {
        $success = $this->authService->reset_password($request);

        return response()->json([
            'message' => 'Password changed!',
            'data' => $success
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return response()->json([
            'message' => 'Successfully logged out!'
        ]);
    }
}
