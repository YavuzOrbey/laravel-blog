@extends('main')

@section('content')
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
<div class="row">
    <div class="col-sm-12">
    <div>Name : {{$user->name}}</div>
    <div>Email : {{$user->email}}</div>
    <div>Change Password </div>
    </div>
</div>
    
@stop