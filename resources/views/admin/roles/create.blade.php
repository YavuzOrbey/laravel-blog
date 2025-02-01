@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create Role</h1></div>
<form action="{{route('roles.store')}}" method="POST">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="name">Display Name</label>
        <input type="text" id="display_name" name="display_name">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description">
    </div>
    <div>
        @foreach($permissions as $permission)
        <input type="checkbox" name="permissions[{{$loop->index}}]" value="{{$permission->id}}" > {{$permission->display_name}}
        @endforeach
    </div>
    <button>Submit</button>

</form>
</div>
@stop