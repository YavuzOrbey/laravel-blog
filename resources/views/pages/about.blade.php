@extends('main')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1>{{$first . " " . $last}}</h1>
      <p>I am a freelance web developer and tutor who is always looking for upcoming projects. Let me show you what I can offer you. More info coming soon...</p>
    </div>
  </div>
@endsection

@section('title', '| About')