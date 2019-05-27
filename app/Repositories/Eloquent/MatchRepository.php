<?php

namespace App\Repositories\Eloquent;
use App\Match;
use App\Repositories\Contracts\MatchRepositoryInterface;


class MatchRepository extends AbstractRepository implements MatchRepositoryInterface
{
    protected $model = Match::class;

    public function create(array $data):Bool
    {
        $user = auth()->user();
        $listRel = $user->rounds;
        $round_id = $data['round_id'];
        $exist = false;
        foreach ($listRel as $value) {
            if($round_id == $value->id){
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
            $listRel = $user->rounds;
            $round_id = $data['round_id'];
            $exist = false;
            foreach ($listRel as $value) {
                if($round_id == $value->id){
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