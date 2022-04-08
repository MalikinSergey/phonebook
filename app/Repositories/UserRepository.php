<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class UserRepository
{

    /**
     * @type Guard
     */
    protected Guard $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        $user = new User($data);

        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @param bool $force
     */
    public function update(User $user, array $data, bool $force = false): void
    {
        if ($force) {
            $user->forceFill($data);
            $user->save();
        } else {
            $user->update($data);
        }
    }

    /**
     * @param User $user
     */
    public function destroy(User $user): void
    {
        $user->delete();
    }

    /**
     * @return User|null
     */
    public function authUser(): User|null
    {
        return $this->auth->user();
    }
}