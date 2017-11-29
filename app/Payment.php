<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'receiver_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'invoice_id');
    }
}
