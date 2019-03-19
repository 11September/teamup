<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\Setting;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Helpers\AvatarsHelper;
use App\Helpers\PasswordHelper;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

            $new_password = bcrypt(PasswordHelper::generatePassword());

            $user = $this->user->update_password($user->id, $new_password);

            \Mail::to($request->email)->send(new ResetPassword($user, $new_password));

        } catch (\Exception $exception) {
            Log::warning('AuthService@resetPassword Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $this->user->update_password(Auth::id(), Hash::make($request->password));

        } catch (\Exception $exception) {
            Log::warning('AuthService@changePassword Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function setAvatar(Request $request)
    {
        try {
            $user = Auth::user();

            $image = AvatarsHelper::storeBase64Image($request->avatar);

            if (isset($user->avatar) || !empty($user->avatar)) {
                AvatarsHelper::deletePreviousImage($user->avatar);
            }

            $this->user->update_field(Auth::id(), "avatar", $image);

            return $image;

        } catch (\Exception $exception) {
            Log::warning('AuthService@setAvatar Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function setPlayer(Request $request)
    {
        try {
            $this->user->update_field(Auth::id(), "player_id", $request->player);

        } catch (\Exception $exception) {
            Log::warning('AuthService@setPlayer Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function setPush(Request $request)
    {
        try {
            $this->user->update_field(Auth::id(), "push", $request->push);

        } catch (\Exception $exception) {
            Log::warning('AuthService@setPush Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function setPushChat(Request $request)
    {
        try {
            $this->user->update_field(Auth::id(), "push_chat", $request->push);

        } catch (\Exception $exception) {
            Log::warning('AuthService@setPushChat Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }

    public function settings()
    {
        try {
            return Setting::first();

        } catch (\Exception $exception) {
            Log::warning('AuthService@settings Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }
}
