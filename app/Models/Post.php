<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    //posts can 'have' many tags so we say posts belong to tags 
    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
