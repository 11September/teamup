<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        try {
            if (!Auth::attempt(request(['email', 'password']))) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $token = $this->token($request->user());

            return $token;

        } catch (\Exception $exception) {
            Log::warning('AuthService@login Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $user = $this->user->create($request->all());

            $token = $this->token($user);

            return $token;

        } catch (\Exception $exception) {
            Log::warning('AuthService@register Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();

        } catch (\Exception $exception) {
            Log::warning('AuthService@logout Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function token($user)
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return $tokenResult;
    }

    public function resetPassword(Request $request)
    {
        try {
            $user = $this->user->findEmail($request->email);

            $new_password = bcrypt($this->generatePassword());

            $user = $this->user->update_password($user->id, $new_password);

            \Mail::to($request->email)->send(new ResetPassword($user, $new_password));

        } catch (\Exception $exception) {
            Log::warning('AuthService@resetPassword Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function generatePassword($length = 8)
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
}
