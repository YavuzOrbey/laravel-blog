<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
    public function getSingle($username, $slug){
        // fetch post from database based on the slug

        if($user = User::where('username', $username)->first()){
            if($post = Post::where('user_id', $user->id)->where('slug', $slug)->first()){
                //get all comments for this specific post
                if($comments = Comment::where('post_id', $post->id)->get()){
                    $users = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->where('comments.post_id', '=', $post->id)->select('users.username')->get();
                    return view('blog.single', compact('post', 'comments', 'users'));
                }

                
                //get the user who left the comment 
                //$users = User::unionAll('id', $comments->pluck('user_id'));
                //$users = $comments->join('users', 'users.id', '=', 'comments.user_id');
               // Log::info($users->get()->toArray());
            }
        }
        abort(404);
    }
}
