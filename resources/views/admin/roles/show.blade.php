@extends('layouts.admin')


@section('content')
<div>
    {{$role->display_name}}
<table class="table table-bordered table-hover table-sm " >
<caption>{{$role->description}}</caption>
    <thead  class="thead-light">
        <th scope="col">Permissions for {{$role->display_name}}</th>
    </thead>
    <tbody>
        @foreach($role->permissions as $permission)
        <tr>
        <td>{{$permission->display_name}}</td>
        </tr>
        @endforeach
    </tr>
    </tbody>
</table>
</div>
@stop