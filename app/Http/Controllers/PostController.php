<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Post;
use App\User;
use App\Tag;
use App\Category;
use Purifier;
use Session;
use Image;
use Storage;
use File;
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
        $categories = Category::all();
        $tags = Tag::all();
        //Log::info($categories);
        /* $categories = $categories->mapWithKeys(function ($category) {
            return [$category['id']=>$category['name']];
        }); */
        $categories = $categories->pluck('name', 'id'); // a better way of doing the same thing as above
        $tags = $tags->pluck('name', 'id');
        //Log::info($categories);
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        
        // validate the data
        
        $validatedData = $request->validate([
            'title' => 'bail|required|max:190',
            'category'=> 'bail|required|integer',
            'body' => 'required',
            'slug' => ['bail', 'required', 'alpha_dash', 'min:5','max:190', Rule::unique('posts')->where(function ($query) {
                return $query->where('user_id', Auth::id());})],
            'image'=> 'sometimes|required|image|dimensions:max_width=600,max_height=600|max:6000'
        ]);

        //store in database
            $post = new Post;
            $post->user_id = Auth::id();
            $post->title = $request->input('title');
            $post->category_id = $request->input('category');
            $post->slug = $request->input('slug');
            $post->body = Purifier::clean($request->input('body')); 
            //save image
            if($request->hasFile('image')){
                
                $image = $request->image->store('users/' . Auth::id());
                //$filename = time() . "." . $image->getClientOriginalExtension();
                //$path = public_path() . 'users/' . Auth::id() . '/images/';
                /* if(!file_exists($path)){
                    File::makeDirectory($path);
                } 
                        */
                 //"users/8/XmgrGFyD8Q77yZrxL99eyrleGhutzHE2sZsnNkyi.jpeg"
                $thumbnail = str_replace(".jpeg", "-width-200.jpeg",$image);
                $thumbnail = "images/" . $thumbnail;
                Image::make($request->image)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnail)->destroy();

                $post->image = str_replace(".jpeg", "",$image);
            }
        
            $post->save();

            //attaching tag associations happens after the save (remember the many to many relatioship)
            $post->tags()->sync($request->tags);
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
        // This is a makeshift solution to a complicated problem. Find a better way!! Let's make a middleware owner that comes after auth that verifies that only the owner of the post can do anything to it
        if(Auth::id()==$post->user_id){
        return view('posts.show', compact('post'));

        }
        else
        return "Sorry davey you dont have permission to view that";
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

        if(Auth::id()==$post->user_id){
            $categories = Category::all();
            $categories = $categories->pluck('name', 'id');
            $tags = Tag::all();
            $tags = $tags->pluck('name', 'id');
            return view('posts.edit', compact('post', 'categories', 'tags'));
        }
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
            'category'=> 'bail|required|integer',
            'slug' => 'required|alpha_dash|min:5|max:190|unique:posts,slug,' . $id,
            'image'=> 'sometimes|required|image'
        ]);
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = Purifier::clean($request->input('body'));
        $post->category_id = $request->input('category');
        $post->slug = $request->input('slug');

        if($request->hasFile('image')){
            //add new photo
            $image = $request->image;
            $filename = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location)->destroy();

            $oldFileName = $post->image;
            // update database

            $post->image = $filename;

            //delete old photo 
            Storage::delete($oldFileName);
        }
        $post->save();
        $post->tags()->sync($request->tags);
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
        // below is kind of redundant with ondelete cascade but good practice
        $post->tags()->detach();
        Storage::delete($post->image);
        $post->delete();
        Session::flash('success', 'Post successfully deleted');
        return redirect()->route('posts.index');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('comments');
    }
}
