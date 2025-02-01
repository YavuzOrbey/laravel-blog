@extends('main')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')

<div class="row mt-2">
    <div class="col-md-8">
            <h3>Posts under category: {{$category->name}} </h3>
            <small>{{count($category->posts)}} entries</small>
            
            @foreach ($category->posts as $post)
            <h4><a href="{{route('blog.single', ['username'=>$post->user->username, 'slug' =>$post->slug])}}">{{$post->title }}</a></h4>
            @endforeach
            
    </div>
</div>

@stop