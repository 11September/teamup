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

    public function update($id, array $attributes)
    {
        return $this->user->find($id)->update($attributes);
    }

    public function update_password($id, $password)
    {
        return $this->user->find($id)->update(['password', $password]);
    }

    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }
}
