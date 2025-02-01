@extends('main')

@section('title', " | Edit $tag->name")

@section('content')
<form action="{{ route('tags.update', $tag) }}" method="POST" data-parsley-validate="">
    @csrf
    @method('PUT')
    <label for="name">Tag Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}" />
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@stop


