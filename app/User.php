<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    use EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password','phone','work_zone','nid','address','monthly_salary','image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne('App\Role');
    }
}
