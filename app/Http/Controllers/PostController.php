<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Post;
use Session;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10); // testing ssh push
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
            'title' => 'required|unique:posts|max:190',
            'body' => 'required',
            'slug' => 'required|alpha_dash|min:5|max:190|unique:posts'
        ]);

        //store in database
            $post = new Post;
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
        return view('posts.show', compact('post'));
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
        return view('posts.edit', compact('post'));
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
            'title' => 'required|unique:posts|max:190',
            'body' => 'required',
            'slug' => 'required|alpha_dash|min:5|max:190|unique:posts'
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
}
