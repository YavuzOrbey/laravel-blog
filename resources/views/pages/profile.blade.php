@extends('main')

@section('content')
<div class="container">
<div class="row">
    <div class="col-sm-2">
            <img class="portrait-icon" src="{{ 'https://www.gravatar.com/avatar/' .  md5( strtolower( trim($user->email)))}}">
    </div>
    <div class="col-sm-8 profile-header">
        <div class="profile-username">{{strtoupper($user->username)}}</div>
        <a href="{{route('blog.index', ['username' => $user->username])}}" class="blog-link" >Blog</a>
        <span>Joined {{date('M Y', strtotime($user->created_at))}}</span>
    </div>
</div>
<div class="row mt-3 profile">
    <div class="col-sm-12">
    <div>Name : {{$user->name}} </div>
    <div>Username : {{$user->username}}</div>
    <div>Email : {{$user->email}}</div>
    </div>
</div>
<div class="row profile mt-5">
        <div class="col-sm-12"><u>Recent Posts</u>
            <div class="row ml-3">
                @foreach ($posts as $post)
            <div class="col-sm-12"><a href="{{route('blog.single', ['username' => $user->username, 'slug'=>$post->slug])}}">{{$post->title}}</a> {{ date('m/d/Y g:i A', strtotime($post->created_at)) . ($post->created_at == $post->updated_at ? ' ': ' Edited on: ' . date('m/d/Y, g:i A', strtotime($post->updated_at)))}}</div>
                @endforeach

            </div>

        </div>
</div>
<div class="row profile mt-5">
    <div class="col-sm-12"><u>Recent Comments</u>
        <div class="row ml-3">
                @foreach ($comments as $comment)
                <div class="col-sm-12"><a href="{{route('blog.single', ['username' => $comment->post->user->username, 'slug'=>$comment->post->slug])}}">{{$comment->comment_text}}</a></div>
                @endforeach
        </div>
    </div>

</div>    
</div>
@stop