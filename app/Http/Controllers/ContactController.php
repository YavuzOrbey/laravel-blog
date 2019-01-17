<?php

namespace YavuzOrbey\Http\Controllers;

use Illuminate\Http\Request;
use YavuzOrbey\Http\Requests;
class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store()
    {
    }
}
