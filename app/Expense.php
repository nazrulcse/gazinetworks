<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'category', 'date', 'title','description','is_approved','received_by','voucher_no', 'amount'
    ];
}
