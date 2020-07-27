@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1>Manage Permissions</h1>
    </div>
    <div class="col-sm-6">
            <a href="{{route('permissions.create')}}" class="btn btn-block btn-primary">Create Permission</a>
    </div>
</div>

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
        <td><a href="{{route('permissions.show', ['permission'=>$permission])}}">View</a></td>
        <td><a href="{{route('permissions.edit', ['permission'=>$permission])}}">Edit</a></td>
    </tr>
        @endforeach
        {{-- $permissions->links() --}}
    </tbody>
</table>
@stop