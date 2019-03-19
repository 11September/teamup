<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 018 18.03.19
 * Time: 13:36
 */

namespace App\Http\Controllers\App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController{


//    public function ResetPassword(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|string|email|max:255',
//        ]);
//
//        $validator_exist = Validator::make($request->all(), [
//            'email' => 'exists:users,email',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['message' => 'Дані в запиті не заповнені або не вірні!'], 400);
//        }
//
//        if ($validator_exist->fails()) {
//            return response()->json(['message' => 'Користувача не існує!'], 404);
//        }
//
//        try {
//            $user = User::where('email', $request->email)->first();
//            $new_password = $this->generatePassword();
//            $user->password = bcrypt($new_password);
//
//            \Mail::to($request->email)->send(new ResetPassword($user, $new_password));
//
//            $user->save();
//
//            return response()->json(['message' => 'Перевірте пошту з новим паролем!'], 200);
//        } catch (\Exception $exception) {
//            Log::warning('UsersController@resetPassword Exception: ' . $exception->getMessage());
//            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
//        }
//    }
//
//
//    public function ChangePassword(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'password_old' => 'required|string|min:6|max:255',
//            'password' => 'required|string|min:6|max:255',
//            'password_confirmation' => 'required|string|min:6|max:255',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['message' => 'Дані в запиті не заповнені або не вірні!'], 400);
//        }
//
//        if ($request->password !== $request->password_confirmation) {
//            return response()->json(['message' => 'Паролі не співпадають!'], 422);
//        }
//
//        $user = User::where('token', '=', $request->header('x-auth-token'))->first();
//
//        if (Hash::check($request->password_old, $user->password)) {
//            $user->password = Hash::make($request->password);
//            $user->save();
//
//            return response()->json(['message' => 'Пароль змінений!'], 200);
//        } else {
//            return response()->json(['message' => 'Старий пароль невірний!'], 422);
//        }
//    }
//
//    public function SetAvatar(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'avatar' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['message' => 'Дані в запиті не заповнені або не вірні!'], 400);
//        }
//
//        try {
//            $user = User::where('token', '=', $request->header('x-auth-token'))->first();
//
//            $image = $this->storeBase64Image($request->avatar);
//
//            if (!$image) {
//                return response()->json(['message' => 'Збереження не вдалося. Перевірте картинку!'], 422);
//            }
//
//            if (isset($user->avatar) || !empty($user->avatar)) {
//                $this->deletePreviousImage($user->avatar);
//            }
//
//            $user->avatar = $image;
//            $user->save();
//
//            return response()->json(['message' => 'Аватар змінено!', 'avatar' => Config::get('app.storageurl') . $image], 200);
//
//        } catch (\Exception $exception) {
//            Log::warning('UsersController@SetAvatar Exception: ' . $exception->getMessage() . " - " . $exception->getLine());
//            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
//        }
//    }
//
//
//    public function SetPlayer(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'player' => 'required|string',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['message' => 'Дані в запиті не заповнені або не вірні!'], 400);
//        }
//
//        try {
//            $user = User::where('token', '=', $request->header('x-auth-token'))->first();
//            $user->player_id = $request->player;
//            $user->save();
//
//            return response()->json(['message' => 'Player_id Встановлено!'], 200);
//
//        } catch (\Exception $exception) {
//            Log::warning('UsersController@SetPlayer Exception: ' . $exception->getMessage() . " - " . $exception->getLine());
//            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
//        }
//    }
//
//
//    public function SetPush(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'push' => [
//                'required',
//                'string',
//                Rule::in(['enabled', 'disabled']),
//            ]
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['message' => 'Дані в запиті не заповнені або не вірні!'], 400);
//        }
//
//        try {
//            $user = User::where('token', '=', $request->header('x-auth-token'))->first();
//            $user->push = $request->push;
//            $user->save();
//
//            return response()->json(['message' => 'Push повiдомлення змiнено!', 'data' => $user->push], 200);
//
//        } catch (\Exception $exception) {
//            Log::warning('UsersController@SetPlayer Exception: ' . $exception->getMessage() . " - " . $exception->getLine());
//            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
//        }
//    }
//
//    public function SetPushChat(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'push' => [
//                'required',
//                'string',
//                Rule::in(['true', 'false']),
//            ]
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['message' => 'Дані в запиті не заповнені або не вірні!'], 400);
//        }
//
//        try {
//            $user = User::where('token', '=', $request->header('x-auth-token'))->first();
//            $user->push_chat = $request->push;
//            $user->save();
//
//            return response()->json(['message' => 'Push повiдомлення змiнено!', 'data' => $user->push_chat], 200);
//
//        } catch (\Exception $exception) {
//            Log::warning('UsersController@SetPushChat Exception: ' . $exception->getMessage() . " - " . $exception->getLine());
//            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
//        }
//    }
//
//    public function storeBase64Image($data)
//    {
//        $folderPath = "images/uploads/avatars/";
//        $image_parts = explode(";base64,", $data);
//
//        if (!$image_parts || !isset($image_parts[1]) || $image_parts[1] == null || $image_parts[1] == "") {
//            return null;
//        }
//
//        explode("image/", $image_parts[0]);
//        $image_base64 = base64_decode($image_parts[1]);
//        $imageName = time() . "-" . uniqid() . '.png';
//
//        File::put(storage_path('app/public/images/uploads/avatars/') . $imageName, $image_base64);
//        $path = "/" . $folderPath . $imageName;
//
//        return $path;
//    }
//
//    public function deletePreviousImage($data)
//    {
//        $preview = storage_path('app/public') . $data;
//        if (file_exists($preview)) {
//            unlink($preview);
//        }
//
//        return true;
//    }
}
