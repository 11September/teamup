<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 15:11
 */

namespace App\Repositories;

use App\User;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($attributes)
    {
        return $this->user->create($attributes);
    }

    public function all()
    {
        return $this->user->latest()->get();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function findEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function findByAttr($attribute, $value)
    {
        return $this->user->where($attribute, $value)->first();
    }

    public function update($id, array $attributes)
    {
        return $this->user->findOrFail($id)->update($attributes);
    }

    public function update_password($id, $password)
    {
        return $this->user->findOrFail($id)->update(['password' => $password]);
    }

    public function update_field($id, $field, $attribute)
    {
        return $this->user->findOrFail($id)->update([$field => $attribute]);
    }

    public function update_avatar($id, $path)
    {
        return $this->user->findOrFail($id)->update(['avatar' => $path]);
    }

    public function delete($id)
    {
        return $this->user->findOrFail($id)->delete();
    }
}
