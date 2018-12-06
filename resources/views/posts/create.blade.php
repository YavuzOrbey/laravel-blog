@extends('main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8"><h1>Create New Post</h1></div>
        <form action="">
            <div class="form-group">
                <label for="theTitle">Title</label>
                <input class="form-control" type="text" id="theTitle" placeholder="Enter a Title">
            </div>
            <div class="form-group">
                <label for="theBody">Body</label>
                <textarea class="form-control" placeholder="What do you want to talk about?"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary" >
        </form>
    </div>
@endsection
@section('title', '| Create Post')