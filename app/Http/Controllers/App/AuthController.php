<?php

namespace App\Http\Controllers\App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CheckCode;
use App\Http\Requests\AuthLogin;
use App\Services\Api\AuthService;
use App\Http\Requests\CheckEmail;
use App\Http\Requests\AuthRegister;
use App\Http\Requests\ResetPassword;

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
        $user = $this->authService->findUser($request->email);

        if (!$user || !$this->authService->loginAttempt($request)) {
            return response()->json(['message' => 'User does not exist or the login / password is not suitable!'], 401);
        }

        $responce = $this->authService->loginIsActive($user);

        if (!$responce['status']) {
            return response()->json(
                [
                    'message' => 'Your account is inactive. Please contact administrator!',
                    'user' => $responce['user']
                ],
                403);
        }

        $responce = $this->authService->loginIsSubscriber($request);

        if (!$responce['status']) {
            return response()->json(
                [
                    'message' => 'Your account has been expired. Please contact administrator!',
                    'user' => $responce['user']
                ],
                403);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
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

    public function recovery_password(CheckEmail $request)
    {
         $this->authService->recovery_password($request);

        return response()->json([
            'message' => 'Successfully send code to Email!',
        ], 202);
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
        ], 202);
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
        $this->authService->reset_password($request);

        return response()->json([
            'message' => 'Password changed!',
        ], 200);
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
        ], 200);
    }
}
