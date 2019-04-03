<?php

namespace App\Repositories\Eloquent;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;


class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function create(array $data):Bool
    {
        $data['password'] = Hash::make($data['password']);

        return (bool) $this->model->create($data);

    }

    public function update(int $id, array $data):Bool
    {
        $register = $this->find($id);

        if($register)
        {
            if(isset($data['password']))
            {
                $data['password'] = Hash::make($data['password']);
            }
            return (bool) $register->update($data);
        }else{
            return false;   
        }
    }
}