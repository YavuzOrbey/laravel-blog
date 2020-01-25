<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactMe;
use App\User;
use App\Post;
use App\Comment;
use Session;
class PagesController extends Controller{


    //controller actions

    public function getIndex()
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
        
        return view('pages.welcome');
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

    public function sendEmail(Request $request){
        $validatedData = $request->validate([
            'email'=> 'bail|required|email',
            'fullname' => 'required',
            'message' => 'required|min:10'
        ]);
        $data = [
            'email' => $request->input('email'),
            'name' => $request->input('fullname'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        ];
        Mail::to("yavuz.orbey@gmail.com")->send(new ContactMe($data, $request));
        Session::flash('success', 'Email sent!');
        return redirect()->route('send.email');
    }
}