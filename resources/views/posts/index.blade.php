@extends('main')
@section('content')
<div class="row">
  <div class="col-md-10">
    <h1>All Posts</h1>
  </div>
  <div class="col-md-2">
  <a href="{{ route('posts.create') }}" class="btn btn-h1-spacing btn-sm btn-success">Create New Post</a>
  </div>
</div>

@foreach ($posts as $key => $post)
    <div class="row">
        <div class="col-md-3">
          <h5>{{ $key+1 }}. {{ $post->title }}</h5>
          {{ date('M j, Y g:i A', strtotime($post->created_at)) }}
        </div>
        <div class="col-md-9">
          <p>{{ substr(strip_tags($post->body), 0, 200) }}{{ strlen(strip_tags($post->body)) > 200 ? "..." : "" }} 
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary btn-sm">View</a>
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
          </p>
        </div>
    </div>
    <hr>
@endforeach

    <div class="text-center">{!! $posts->links() !!}</div>
@stop

@section('title', '| Posts')