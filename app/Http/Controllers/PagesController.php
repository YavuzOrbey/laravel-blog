<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

    public function getContact(){
        return view('pages.contact');
    }
}