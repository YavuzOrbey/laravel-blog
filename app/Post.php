<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    //posts can 'have' many tags so we say posts belong to tags 
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
