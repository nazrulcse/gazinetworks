<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use NitinKaware\DependableSoftDeletable\Traits\DependableDeleteTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use DependableDeleteTrait, SoftDeletes ;

    protected static $dependableRelationships = ['payments'];

    protected $fillable = [
        'customer_id','invoice_amount','year','month','date','is_paid','other_invoice_title'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'invoice_id');
    }
}
