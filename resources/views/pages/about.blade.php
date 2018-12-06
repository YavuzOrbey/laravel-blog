@extends('main')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1>{{$first . " " . $last}}</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, harum, sed molestias quod officiis minus nam atque tempora excepturi assumenda distinctio enim est, eaque repellendus incidunt reiciendis. Laborum, vero ipsam.</p>
    </div>
  </div>
@endsection

@section('title', '| About')