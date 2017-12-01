<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
		    protected $fillable = [
        'customer_id','message','subject', 'category'
    ];

        public function user()
        {
            return $this->belongsTo('App\User', 'customer_id');
        }

}
