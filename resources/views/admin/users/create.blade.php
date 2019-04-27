@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create User</h1></div>
<form action="{{route('users.store')}}" method="POST">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" >
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
    </div>
    <select name="role">
        @foreach($roles as $role)
    <option value="{{$role->id}}">{{$role->display_name}}</option>
        @endforeach
    </select>
    <div>
        <label for="">Password</label>
        <input type="text" id="password" name="password">
        <input type="checkbox" name="auto-generate" value="auto-generate">Auto Generate Password
    </div>

    <button>Submit</button>

</form>
</div>
@stop