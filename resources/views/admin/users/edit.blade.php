@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Edit User</h1></div>
<form action="{{route('users.update', ['user'=>$user->id])}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div>
        <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="{{$user->name}}" value="{{$user->name}}">
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="{{$user->username}}" value="{{$user->username}}">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="{{$user->email}}" value="{{$user->email}}">
    </div>
    <select name="role" value="{{$user->roles->first()->id}}">
            @foreach($roles as $role)
        <option value="{{$role->id}}" {{$role->id ===$user->roles->first()->id ? "selected": ""}}>{{$role->display_name}}</option>
            @endforeach
        </select>
        
    <div>
        <label for="">Password</label>
        <input type="text" id="password" name="password" >
        <input type="checkbox" id="auto" name="auto" value="true">Auto Generate Password
    </div>
    <div>
        <label for="">Add Token Authentication? </label>
        <input type="checkbox" id="token_auth" name="token_auth">
    </div>

    <button>Submit</button>

</form>
</div>
@stop