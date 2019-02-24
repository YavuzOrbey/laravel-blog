<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //tags can belong to  many posts 
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
