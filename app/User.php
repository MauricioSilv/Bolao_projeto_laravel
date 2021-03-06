<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    
    public function bettings()
    {
        return $this->hasMany('App\Betting');
    }
    
    public function getRoundsAttribute()
    {
        $listbettings = $this->bettings;
        $rounds = [];
        foreach ($listbettings as $value) 
        {
            array_push($rounds, $value->rounds);
        }

        $listRounds = Arr::collapse($rounds);

        return $listRounds;
    }
    public function hasRoles($roles)
    {
        $userRoles = $this->roles;

       return (boolean) $roles->intersect($userRoles)->count();
        
    }

    public function isAdmin()
    {
        return $this->hasRole("Admin");
    }

    public function hasRole($role)
    {
        if(is_string($role))
        {
            $role = Role::where('name', '=',$role)->firstOrFail();
        }

        return (boolean) $this->roles()->find($role->id);
        
    }

}
