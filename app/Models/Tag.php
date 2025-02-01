<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    //tags can belong to  many posts 
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}
