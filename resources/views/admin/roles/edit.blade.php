@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Edit role</h1></div>
    <form action="{{route('roles.update', ['id'=>$role->id])}}" class="edit-role" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div >
        <label for="name">Display Name</label>
        <input type="text" id="display_name" name="display_name" placeholder="{{$role->display_name}}" value="{{$role->display_name}}">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description"  placeholder="{{$role->description}}" value="{{$role->description}}">
    </div>
    <div class="permissions">Permissions
    @foreach($permissions as $permission)
    <label class="checkbox-container">
        <input type="checkbox" name="permissions[{{$loop->index}}]" value="{{$permission->id}}" {{$role->permissions->contains($permission) ? "checked=checked" : '' }}> {{$permission->display_name}}
        <span class="checkmark"></span>
    </label>
    @endforeach
</div>
    <button>Save Changes</button>

</form>
</div>

@stop