<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Mail\ContactMe;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Http\Requests\ReCaptchaTestFormRequest;
use Session;
use Illuminate\Support\Facades\Auth;
class PagesController extends Controller{


    //controller actions

    public function getIndex(Request $request)
    {
        #process variable data or params
        # talk to the model
        # recieve data back from model
        # compiple or process data from model if needed
        # pass data to correct view

        
        /* 
        $posts = Post::latest()->limit(3)->get();
        I prefer the below method but the one above works just as well
        */
        // get the most recent posts from different categories and send them to the welcome page
        $user = User::where('username', 'yavuz')->first();
        $posts = [];
        $categories = Category::all(); // HERE
        if($user!=null){
            foreach ($categories as $key => $category) {
                $category_posts = Post::where('user_id', $user->id)->where('category_id', $category->id)->get();
                if($category_posts){
                    $posts[$category->name] = $category_posts;
                }
            }
            
        }
        Log::info("User roles");
        if(Auth::user()){
            Log::info(Auth::user()->hasRole(['superadministrator', 'administrator']));
            Log::info(Auth::user()->roles()->pluck('name')->implode(', '));
        }
        if (Auth::check()) {
            Log::info('Authenticated user: ' . Auth::user()->id);
        } else {
            Log::info('No user is authenticated.');
        }
        

       
/*         $posts['Gaming'] = Post::where('user_id', 8)->where('category_id', 2)->orderBy('created_at', 'desc')->take(3)->get(); */
        return view('pages.welcome', compact('posts'));
    }

   
    public function getAbout()
    {
        $first = 'Yavuz';
        $last = 'Orbey';
        $full = array('first', 'last');
        return view('pages.about', compact($full));
    }
    public function getProfile($username){
        if($user = User::where('username', $username)->first()){
            $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(3);
            $comments = Comment::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(3);
            
            return view('pages.profile', compact('user', 'posts', 'comments'));
        }
        else
        abort(404);
    }
    public function getContact(){
        return view('pages.contact');
    }
    public function portfolio(){
        return view('pages.portfolio');
    }
    public function sendEmail(ReCaptchaTestFormRequest $request){
/*         $validatedData = $request->validate([
            'email'=> 'bail|required|email',
            'fullname' => 'required',
            'message' => 'required|min:10'
        ]); */
        $validated = $request->validated();

  /*       $data = [
            'email' => $request->input('email'),
            'name' => $request->input('fullname'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        ]; */
        Mail::to("yavuz.orbey@gmail.com")->send(new ContactMe($validated, $request));
        Session::flash('success', 'Email sent!');
        return redirect()->route('contact');
    }
}