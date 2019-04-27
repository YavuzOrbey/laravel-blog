@extends('layouts.admin')


@section('content')
<h1>Manage Permissions</h1>
<a href="{{route('permissions.create')}}">Create Permission</a>
<table class="table table-bordered table-hover table-sm " >
        <caption>List of permissions</caption>
    <thead  class="thead-light">
        <th scope="col">Display Name</th>
        <th scope="col">Description</th>
        <th scope="col">View</th>
        <th scope="col">Edit</th>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
        <tr>
        <td>{{$permission->display_name}}</td>
        <td>{{$permission->description}}</td>
        <td><a href="{{route('permissions.show', ['id'=>$permission->id])}}">View</a></td>
        <td><a href="{{route('permissions.edit', ['permission'=>$permission])}}">Edit</a></td>
    </tr>
        @endforeach
        {{-- $permissions->links() --}}
    </tbody>
</table>
@stop