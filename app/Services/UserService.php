<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use Illuminate\Http\Request;
use App\Helpers\PasswordHelper;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->all();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

        $attributes['password'] = PasswordHelper::HashPassword($attributes['password']);

        return $this->user->create($attributes);
    }

    public function read($id)
    {
        return $this->user->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this->user->update($id, $attributes);
    }

    public function update_password(Request $request, $id)
    {
        $password = Hash::make($request->password);

        return $this->user->update_field($id, "password", $password);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }
}
