<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Betting extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'current_round',
        'value_result',
        'extra_value',
        'value_fee'
    ];

    //relacionamento de apostas com usuarios
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //acessor/mutators para adicionar um registro adcional a tabela
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }
}
