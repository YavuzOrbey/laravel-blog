<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use App\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    public function __construct(){
       
    }
    public function getIndex($username='yavuz'){
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
                //if($comments = Post::find($post->id)->comments){ // uses the hasmany relationship to find the comments EDIT: found out I don't even have to send 
                    // the comments through the controller. Because there's a hasmany relationship the post can use it's comments method to find them.
                    // Comment::where('post_id', $post->id)->get() Older way I did it 

                    // didn't need to send the users at all just needed to use the hasmany relationship the users had with comments
                    //$users = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->where('comments.post_id', '=', $post->id)->select('users.username')->get();
                    $recentPosts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(5)->get();
                    $category = Category::where('id', $post->category_id)->first();
                    $users = User::all();
                    return view('blog.single', compact('post', 'recentPosts', 'category', 'users'));
                //}

                
                //get the user who left the comment 
                //$users = User::unionAll('id', $comments->pluck('user_id'));
                //$users = $comments->join('users', 'users.id', '=', 'comments.user_id');
               // Log::info($users->get()->toArray());
            }
        }
        abort(404);
    }

    public function getRandom(){
        $users = User::pluck('id')->toArray();
        $user = User::where('id', array_rand($users))->first();
        return redirect()->route('blog.index', [$user->username]);
        //both work but i like the above better
        //return $this->getIndex($user->username);
        
    }
}
