
@extends('main')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Welcome to my blog!</h1>
    <p class="lead">Thanks for visiting</p>
    <hr class="my-4">
    <p>My thoughts</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a>
</div>



<div class="row">
  <div class="col-md-8">
      @foreach ($posts as $post)
      <div class="blog-post">
            <h3>{{$post->title}}</h3>
            <p>{{ substr($post->body, 0, 200)}}{{ strlen($post->body) > 200 ? "...": ""}} 
            {!! Html::linkRoute('blog.single', 'Read more ', array($post->slug), array('class'=>'btn btn-outline-secondary btn-sm')) 
            // Also can use url() or route(). Read more on these
            !!}
      </div>
      <hr>
      @endforeach
  </div>
  <div class="col-md-3 offset-md-1">sidebar</div>
</div>
@endsection
