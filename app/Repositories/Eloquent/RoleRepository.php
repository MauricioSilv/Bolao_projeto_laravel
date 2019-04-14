<?php

namespace App\Repositories\Eloquent;
use App\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;


class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    protected $model = Role::class;

    public function create(array $data):Bool
    {
        $registe = $this->model->create($data);
        if(isset($data['permissions']) && count($data['permissions']))
        {
            foreach ($data['permissions'] as $key => $value) {
                $registe->permissions()->attach($value);
            }
        }

        return (bool) $registe;
    }

    public function update(int $id, array $data):Bool
    {
        $register = $this->find($id);

        if($register)
        {
            $permissions = $register->permissions;
            if(count($permissions))
            {
                foreach ($permissions as $key => $value) {
                    $register->permissions()->detach($value->id);
                }
            }
            if(isset($data['permissions']) && count($data['permissions']))
            {
                foreach ($data['permissions'] as $key => $value) {
                    $register->permissions()->attach($value);
                }
            }
            return (bool) $register->update($data);
        }else{
            return false;   
        }
    }
}