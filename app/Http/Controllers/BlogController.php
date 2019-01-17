<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('blog.index', compact('posts'));
    }
    public function getSingle($slug){
        // fetch post from databased based on the slug
        $post = Post::where('slug', $slug)->first();
        return view('blog.single', compact('post'));
    }
}
