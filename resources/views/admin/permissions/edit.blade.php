@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Edit Permission</h1></div>
    <form action="{{route('permissions.update', ['permission'=>$permission->id])}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div>
        <label for="name">Display Name</label>
        <input type="text" id="display_name" name="display_name" placeholder="{{$permission->display_name}}" value="{{$permission->display_name}}">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description"  placeholder="{{$permission->description}}" value="{{$permission->description}}">
    </div>

    <button>Submit</button>

</form>
</div>

@stop