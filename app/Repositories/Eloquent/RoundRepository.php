<?php

namespace App\Repositories\Eloquent;
use App\Round;
use App\Repositories\Contracts\RoundRepositoryInterface;


class RoundRepository extends AbstractRepository implements RoundRepositoryInterface
{
    protected $model = Round::class;

    public function create(array $data):Bool
    {
        $user = auth()->user();
        $listRel = $user->bettings;
        $betting_id = $data['betting_id'];
        $exist = false;
        foreach ($listRel as $value) {
            if($betting_id == $value->id){
                $exist = true;
            }
        }
        if($exist)
        {
            return (bool) $this->model->create($data);
        }else{
            return false;
        }




    }

    public function update(int $id, array $data):Bool
    {
        $register = $this->find($id);

        if($register)
        {
            $user = auth()->user();
            $listRel = $user->bettings;
            $betting_id = $data['betting_id'];
            $exist = false;
            foreach ($listRel as $value) {
                if($betting_id == $value->id){
                    $exist = true;
                }
            }
            if($exist)
            {
                return (bool) $register->update($data);
            }else{
                return false;
            }


           
        }else{
            return false;   
        }
    }
}