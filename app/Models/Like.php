<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function comment(){
        return $this->belongsTo('use App\Models\Comment');
    }
}
