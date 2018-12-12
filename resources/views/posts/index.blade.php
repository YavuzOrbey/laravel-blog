@extends('main')
@section('content')
<div class="row">
  <div class="col-md-8">
    @foreach ($posts as $post)
    <div class="blog-post">
        <h3>{{$post->title}}</h3>
        <p>{{$post->body}}</p>
        {!! Html::linkRoute('posts.show', 'Read More', array($post->id), array('class'=>'btn btn-primary')) !!}
    </div>
    <hr>
    @endforeach
  </div>
</div>
@endsection

@section('title', '| Posts')