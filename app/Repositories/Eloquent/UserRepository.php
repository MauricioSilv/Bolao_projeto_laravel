<?php

namespace App\Repositories\Eloquent;
use App\User;
use App\Repositories\Contracts\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        $modelo = app(User::class);

        return $modelo->all();
    }
}