@extends('main')

@section('title', " | Edit $category->name")

@section('content')
<form action="{{ route('categories.update', $category->id) }}" method="POST" data-parsley-validate>
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" id="name">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@stop

