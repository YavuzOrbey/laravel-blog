@extends('layouts.admin')


@section('content')
<div class="row">
        <div class="col-sm-6">
            <h1>Manage Users</h1>
        </div>
        <div class="col-sm-6">
                <a href="{{route('users.create')}}" class="btn btn-block btn-primary">Create User</a>
        </div>
    </div>
<table class="table table-bordered table-hover table-sm " >
        <caption>List of users</caption>
    <thead  class="thead-light">
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Join Date</th>
        <th scope="col">Actions</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
        <td><a href="{{route('users.show', ['user'=>$user->id])}}">{{$user->username}}</a></td>
        <td>{{$user->email}}</td>
        <td>@foreach ($user->roles as $role) {{$role->name}}@endforeach</td>
        <td>{{$user->created_at->toFormattedDateString()}}</td>
        <td><a href="{{route('users.edit', ['user'=>$user])}}">Edit</a></td>
    </tr>
        @endforeach
        {!! $users->links() !!}
    </tbody>
</table>
@stop