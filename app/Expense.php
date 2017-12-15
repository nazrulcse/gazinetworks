<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'category', 'date', 'user_id', 'title','description','is_approved','received_by','voucher_no', 'amount'
    ];

    function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
