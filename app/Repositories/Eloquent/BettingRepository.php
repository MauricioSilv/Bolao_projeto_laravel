<?php

namespace App\Repositories\Eloquent;
use App\Betting;
use App\Repositories\Contracts\BettingRepositoryInterface;


class BettingRepository extends AbstractRepository implements BettingRepositoryInterface
{
    protected $model = Betting::class;

    public function create(array $data):Bool
    {
        $user = Auth()->user();
        $data['user_id'] = $user->id;
        
        return (bool) $this->model->create($data);

    }

    public function update(int $id, array $data):Bool
    {
        $register = $this->find($id);

        if($register)
        {
            $user = Auth()->user();
            $data['user_id'] = $user->id; //pegando o id usuario logado e atribuindo ao campo user_id
            return (bool) $register->update($data);
        }else{
            return false;   
        }
    }
}