<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id','invoice_amount','year','month','date'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }
}
