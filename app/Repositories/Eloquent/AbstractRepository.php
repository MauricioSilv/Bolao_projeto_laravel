<?php

namespace App\Repositories\Eloquent;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractRepository 
{
    protected $model;

    function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function all(string $column = 'id', string $order = 'ASC'):Collection
    {
        return $this->model->orderBy($column, $order)->get();
    }
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
        return $this->model->orderBy($column, $order)->paginate($paginate);
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function create(array $data):Bool
    {
        return (bool) $this->model->create($data);

    }

    public function find(int $id)
    {
        return $register = $this->model->find($id);
    }

    public function delete(int $id):Bool
    {
        return $register = $this->model->delete($id);
    }

    public function update(int $id, array $data):Bool
    {
        $register = $this->find($id);

        if($register)
        {
            return (bool) $register->update($data);
        }else{
            return false;   
        }
    }


    public function finWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection
    {
        $query = $this->model;

        foreach ($columns as $key => $value) {
            $query = $query->orWhere($value, 'like', '%'.$search.'%');
        }

        return $query->orderBy($column, $order)->get();

    }
}