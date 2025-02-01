@extends('layouts.admin')


@section('content')
<h1>{{$user->name}}</h1>
<p>One time access token displayed: {{$token}} </p>

<table class="table table-bordered table-hover table-sm " >
<caption>Information about {{$user->name}}</caption>
    <thead  class="thead-light">
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Join Date</th>
        <th scope="col">Actions</th>
    </thead>
    <tbody>
        <tr>
        <td>{{$user->username}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->roles->first()->display_name}}</td>
        <td>{{$user->created_at->toFormattedDateString()}}</td>
        <td><a href="{{route('users.edit', ['user'=>$user])}}">Edit</a></td>
        
    </tr>
    </tbody>
</table>
@stop