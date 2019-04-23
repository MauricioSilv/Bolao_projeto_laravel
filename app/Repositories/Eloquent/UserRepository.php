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

        $registe = $this->model->create($data);
        if(isset($data['roles']) && count($data['roles']))
        {
            foreach ($data['roles'] as $key => $value) {
                $registe->roles()->attach($value);
            }
        }

        return (bool) $registe;

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

            $roles = $register->roles;
            if(count($roles))
            {
                foreach ($roles as $key => $value) {
                    $register->roles()->detach($value->id);
                }
            }
            if(isset($data['roles']) && count($data['roles']))
            {
                foreach ($data['roles'] as $key => $value) {
                    $register->roles()->attach($value);
                }
            }
            return (bool) $register->update($data);
        }else{
            return false;   
        }
    }
}