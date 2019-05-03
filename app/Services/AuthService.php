<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\Team;
use App\Helpers\UserHelper;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Helpers\AvatarsHelper;
use App\Helpers\PasswordHelper;
use App\Mail\ResetPasswordCode;
use App\Helpers\SubscribeHelper;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthService
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function loginIsActive(Request $request)
    {
        $user = $this->user->findEmail($request->email);

        $isActive = UserHelper::isActive($user);

        return ['status' => (bool)$isActive, 'user' => $this->prepareDetailsLoginData($user)];
    }

    public function loginIsSubscriber(Request $request)
    {
        $user = $this->user->findEmail($request->email);

        $subscribe = SubscribeHelper::IsSubscriber($user);

        return ['status' => (bool)$subscribe, 'user' => $this->prepareDetailsLoginData($user)];
    }

    public function loginAttempt(Request $request)
    {
        return Auth::attempt(request(['email', 'password']));
    }

    public function loginToken(Request $request)
    {
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return $tokenResult;
    }

    public function register(Request $request)
    {
        $this->generateAndSetNewPassword($request);

        $user = $this->user->create($request->all());

        $token = $this->token($user);

        return $token;
    }

    public function forgot_password(Request $request)
    {
        $code = PasswordHelper::generateEmailCode();

        $user = $this->user->findEmail($request->email);

        $this->user->update_field($user->id, 'password_reset_code', $code);

        \Mail::to($request->email)->send(new ResetPasswordCode($code));
    }

    public function confirm_code(Request $request)
    {
        $user = $this->user->findByAttr('password_reset_code', $request->code);

        if ($user->password_reset_code != $request->code) {
            return response()->json(['message' => 'Code does not match!'], 422);
        }
    }

    public function reset_password(Request $request)
    {
        $user = $this->user->findByAttr('password_reset_code', $request->code);

        $this->user->update_field($user->id, 'password', PasswordHelper::HashPassword($request->password));

        return $this->user->update_field($user->id, 'password_reset_code', null);
    }

    public function logout(Request $request)
    {
        return $request->user()->token()->revoke();
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
        $user = $this->user->findEmail($request->email);

        $new_password = bcrypt(PasswordHelper::generatePassword());

        $user = $this->user->update_password($user->id, $new_password);

        \Mail::to($request->email)->send(new ResetPassword($user, $new_password));

        return true;
    }

    public function changePassword(Request $request)
    {
        return $this->user->update_password(Auth::id(), PasswordHelper::HashPassword($request->password));
    }

    public function setCodeAndRelationTeam(Request $request)
    {
        $team = Team::where('code', $request->code)->first();

        $team->users()->sync(Auth::id(), false);

        $user_id = Auth::id();

        $teams = Team::select('id', 'name')
            ->whereHas('users', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->get();

        return $teams;
    }

    public function setUserActive()
    {
        return $this->user->update_field(Auth::id(), 'status', 'active');
    }

    public function setAvatar(Request $request)
    {
        $user = Auth::user();

        $image = AvatarsHelper::storeBase64Image($request->avatar);

        if (isset($user->avatar) || !empty($user->avatar)) {
            AvatarsHelper::deletePreviousImage($user->avatar);
        }

        $this->user->update_field(Auth::id(), "avatar", $image);

        return $image;
    }

    public function setPlayer(Request $request)
    {
        return $this->user->update_field(Auth::id(), "player_id", $request->player);
    }

    public function setPush(Request $request)
    {
        $this->user->update_field(Auth::id(), "push", $request->push);
    }

    public function setPushChat(Request $request)
    {
        return $this->user->update_field(Auth::id(), "push_chat", $request->push);
    }

    public function details()
    {
        Auth::user()->dayLeft = SubscribeHelper::calculateDaysLeft(Auth::user()->expiration_date);

        Auth::user()->number_students_busy = 0;

        $user = Auth::user();

        $user->load(['teams' => function ($query) {
            $query->select('team_id', 'name');
        }]);

        $user->load(['goal' => function ($query) {
            $query->select('goal', 'activity_id', 'user_id');
        }]);

        $user = $this->prepareDetailsData($user);
        $user = $this->prepareDetailsAvatar($user);

        return $user;
    }

    public function prepareDetailsData($user)
    {
        $user = collect($user)->except(
            [
                'created_at',
                'updated_at',
                'email_verified_at',
                'status',
                'player_id'
            ]
        );

        return $user;
    }

    public function prepareDetailsLoginData($user)
    {
        $user = collect($user)->only(
            [
                'id',
                'first_name',
                'last_name',
            ]
        );

        return $user;
    }

    public function prepareDetailsAvatar($user)
    {
        if ($user->avatar && file_exists(storage_path("app/public") . $user->avatar)) {
            $user->avatar = Config::get('app.storageurl') . $user->avatar;
        }else{
            $user->avatar = null;
        }

        return $user;
    }

    public function attemptUser()
    {
        if (!Auth::attempt(request(['email', 'password']))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return true;
    }

    public function generateAndSetNewPassword(Request $request)
    {
        $password = PasswordHelper::HashPassword($request->password);

        $request->merge([
            'password' => $password,
        ]);
    }
}
