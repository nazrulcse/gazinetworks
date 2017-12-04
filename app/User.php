<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Role;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    use EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password','phone','work_zone','nid','address','monthly_salary','image',
        'customer_id', 'customer_road', 'customer_house', 'customer_flat', 'customer_tv_count',
        'customer_monthly_bill', 'customer_discount', 'customer_connection_charge', 'customer_is_free',
        'customer_set_top_box_iv','customer_status','customer_zone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice', 'customer_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payments', 'receiver_id');
    }

    public function contact()
    {
        return $this->hasMany('App\Contact', 'customer_id');
    }

    public function complain()
    {
        return $this->hasMany('App\Complain', 'customer_id');
    }
}
