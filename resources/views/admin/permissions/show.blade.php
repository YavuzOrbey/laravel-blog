@extends('layouts.admin')


@section('content')
<table class="table table-bordered table-hover table-sm " >
<caption>Information about {{$permission->display_name}}</caption>
    <thead  class="thead-light">
        <th scope="col">Display Name</th>
        <th scope='col'>Permission Name</th>
        <th scope="col">Description</th>
    </thead>
    <tbody>
        <tr>
        <td>{{$permission->display_name}}</td>
        <td>{{$permission->name}}</td>
        <td>{{$permission->description}}</td>
    </tr>
    </tbody>
</table>
@stop