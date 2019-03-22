<?php

namespace App\Http\Controllers\App;

use App\Services\AuthService;
use App\Http\Requests\SetPush;
use App\Http\Requests\SetAvatar;
use App\Http\Requests\SetPlayer;
use App\Http\Requests\SetPushChat;
use App\Http\Requests\ChangePassword;
use Illuminate\Support\Facades\Log;

class UsersController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */

    public function details()
    {
        $user = $this->authService->details();

        return response()->json([
            'data' => $user
        ]);
    }


    /**
     * ResetPassword
     *
     * @param  [string] password_old
     * @param  [string] password
     * @param  [string] password_confirmation
     *
     * @return [json] text
     */

    public function ChangePassword(ChangePassword $request)
    {
        $this->authService->changePassword($request);

        return response()->json(['message' => 'Password changed!'], 200);
    }

    /**
     * SetAvatar
     *
     * @param  [string] avatar - base64
     *
     * @return [json] text
     */

    public function SetAvatar(SetAvatar $request)
    {
        try {
            $avatar = $this->authService->setAvatar($request);

            return response()->json(['message' => 'Avatar changed!', 'avatar' => $avatar], 200);

        } catch (\Exception $exception) {
            Log::warning('UsersController@SetAvatar Exception: ' . $exception->getMessage() . " - " . $exception->getLine());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }


    /**
     * SetPlayer
     *
     * @param  [string] player
     *
     * @return [json] text
     */

    public function SetPlayer(SetPlayer $request)
    {
        $this->authService->setPlayer($request);

        return response()->json(['message' => 'Player_id Installed!'], 200);
    }


    /**
     * SetPush
     *
     * @param  [string] push |  ['enabled', 'disabled']
     *
     * @return [json] text
     */

    public function SetPush(SetPush $request)
    {
        $this->authService->setPush($request);

        return response()->json(['message' => 'Push notification changed!'], 200);
    }


    /**
     * SetPushChat
     *
     * @param  [string] push | ['true', 'false']
     *
     * @return [json] text
     */

    public function SetPushChat(SetPushChat $request)
    {
        $this->authService->setPushChat($request);

        return response()->json(['message' => 'Push notification changed!'], 200);
    }
}
