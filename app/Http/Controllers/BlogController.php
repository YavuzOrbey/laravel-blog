<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class BlogController extends Controller
{
    public function __construct(){
       
    }
    public function getIndex($username){
        //fetch posts from database based on the userid

        //first find out what the userid is based on username 
        if($user = User::where('username', $username)->first()){
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('blog.index', compact('posts', 'username'));
        }
        abort(404);
    }
    public function getSingle($slug){
        // fetch post from databased based on the slug
        $post = Post::where('slug', $slug)->first();
        return view('blog.single', compact('post'));
    }
}
