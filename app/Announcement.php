<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'text', 'link', 'expire_date','publish_date', 'user_id'
    ];
}
