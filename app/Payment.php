<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'invoice_id','receiver_id','date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'invoice_id');
    }
}
