<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    protected $guarded = [];
    public function user_from(){
        return $this->belongsTo('App\Models\User');
    }
    public function user_to(){
        return $this->belongsTo('App\Models\User');
    }
}
