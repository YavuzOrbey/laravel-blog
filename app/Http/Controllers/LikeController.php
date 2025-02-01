<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(Request $request){
        $like = new Like;
        $like->user_id = Auth::id();
        $like->comment_id = $request->commentID;//get from the ajax request
        $like->save();
        return Comment::find($request->commentID)->likes->count();
    }

    public function delete(Request $request){
        // find the like given the comment id and the auth user
        $comment = Comment::find($request->commentID);
        if($like = $comment->likes->where('user_id', '=',  Auth::user()->id)->first()){
            $like->delete();
        }
        return Comment::find($request->commentID)->likes->count();
       
    }
}
