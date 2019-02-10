<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // need to define it because naturally the table is added with just an s at the end

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
