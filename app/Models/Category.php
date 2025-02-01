<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // need to define it because naturally the table is added with just an s at the end

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
