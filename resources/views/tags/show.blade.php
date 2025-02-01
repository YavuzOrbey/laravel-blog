@extends('main')

@section('title', " | $tag->name Tag")
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')

<div class="row mt-2">
    <div class="col-md-8">
    <h3>Posts under tag: {{$tag->name}} </h3>
    <small>{{count($tag->posts)}} entries</small>
    
    @foreach ($tag->posts as $post)
    <h4><a href="{{route('blog.single', ['username'=>$post->user->username, 'slug' =>$post->slug])}}">{{$post->title }}</a></h4>
    @endforeach
    
    </div>
</div>

@stop