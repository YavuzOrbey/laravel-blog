@extends('layouts.admin')


@section('content')
<div class="row">
        <div class="col-sm-6">
            <h1>Manage Roles</h1>
        </div>
        <div class="col-sm-6">
                <a href="{{route('roles.create')}}" class="btn btn-block btn-primary">Create Role</a>
        </div>
    </div>
<table class="table table-bordered table-hover table-sm " >
        <caption>List of Roles</caption>
    <thead  class="thead-light">
        <th scope="col">Role Name</th>
        <th scope="col">Description</th>
        <th scope="col">View</th>
        <th scope="col">Edit</th>
    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
        <td>{{$role->display_name}}</td>
        <td>{{$role->description}}</td>
        <td><a href="{{route('roles.show', ['role'=>$role])}}">View</a></td>
        <td><a href="{{route('roles.edit', ['role'=>$role])}}">Edit</a></td>
    </tr>
        @endforeach
    </tbody>
</table>
@stop