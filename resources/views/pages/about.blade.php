@extends('main')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1>{{$first . " " . $last}}</h1>
      <p>This is my blog where I talk about the video games that I personally enjoy playing. I've put the consoles I will be playing on the top navigation. If you visit the links you can see some images and reviews of various games. Hope you enjoy!</p>
    </div>
  </div>
@endsection

@section('title', '| About')