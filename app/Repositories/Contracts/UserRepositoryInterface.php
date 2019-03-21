<?php

namespace App\Repositories\Contracts;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
interface UserRepositoryInterface 
{
    //forçando só esse objeto Collection
    public function all(string $column = 'id', string $order = 'ASC'):Collection;

    //forçando só esse objeto LengthAwarePaginator
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator;
    public function finWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection;

}