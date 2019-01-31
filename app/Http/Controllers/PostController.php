<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Post;
use Session;
class PostController extends Controller
{
    public function __construct(){
        // all this does is make sure you're logged in. It doesn't make sure that you own what you're trying to reach
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $validatedData = $request->validate([
            'title' => 'bail|required|max:190',
            'body' => 'required',
            'slug' => ['bail', 'required', 'alpha_dash', 'min:5','max:190', Rule::unique('posts')->where(function ($query) {
                return $query->where('user_id', Auth::id());})]
        ]);

        //store in database
            $post = new Post;
            $post->user_id = Auth::id();
            $post->title = $request->input('title');
            $post->slug = $request->input('slug');
            $post->body = $request->input('body');

            $post->save();
        //redirect to another page
        //$request->session()->flash('success', 'Post successfully saved');
        Session::flash('success', 'Blog successfully saved');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        // This is a makeshift solution to a complicated problem. Find a better way!!
        if(Auth::id()==$post->user_id)
        return view('posts.show', compact('post'));
        else
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(Auth::id()==$post->user_id)
        return view('posts.edit', compact('post'));
        else
        abort(404);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:190',
            'body' => 'required',
            'slug' => 'required|alpha_dash|min:5|max:190|unique:posts,slug,' . $id
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->slug = $request->input('slug');

        $post->save();

        Session::flash('success', 'Post successfully updated');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Session::flash('success', 'Post successfully deleted');
        return redirect()->route('posts.index');
    }

    public function comments()
    {
        return $this->hasMany('comments');
    }
}
