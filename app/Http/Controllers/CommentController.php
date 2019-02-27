<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
class CommentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $comments = Comment::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('comments.index', compact('comments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the comment
        $validatedData = $request->validate([
            'comment'=> 'bail|required|max:190'
        ]);

        /*
        So laravel can associate belongsto relationships. The comment belongs to a post so we can first find the post given the id then associate this comment with the post
        $post = Post::find($request->input('post_id'));
        $comment->associate($post);
        */

        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->input('post_id'); //see note!
        $comment->comment_text = $request->input('comment');
        $comment->save();
        //need this to redirect back to the original author's post single page
        //$postAuthor = User::where('id',  $request->input('user_id'))->first();
        Session::flash('success', 'Comment added');
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'comment'=> 'required'
        ]);
        $comment->comment_text = $request->input('comment');
        $comment->save();

        Session::flash('success', 'Comment updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
    $this->middleware('owner:' . $comment->user);
    $comment->delete();
    Session::flash('success', 'Comment successfully deleted');
    return redirect()->back();
    }
}
