
@extends('main')

@section('content')
<div class="jumbotron">
<h1 class="display-4">{{$username . "'s Blog"}}</h1>
    <p class="lead">Thanks for visiting</p>
</div>



<div class="row">
  <div class="col-md-8">
      @foreach ($posts as $post)
      <div class="blog-post">
            <h3>{{$post->title}}</h3>
            <p>{{ substr($post->body, 0, 200)}}{{ strlen($post->body) > 200 ? "...": ""}}</p>
            {!! Html::linkRoute('blog.single', 'Read more ', array($username, $post->slug), array('class'=>'btn btn-outline-secondary btn-sm')) 
            // Also can use url() or route(). Read more on these
            !!}
      </div>
      <hr>
      @endforeach
  </div>
  <div class="col-md-3 offset-md-1">
      <div class="row justify-content-md-center">
          <div class="col-md-12">
                {!! $posts->links() !!}
          </div>
      </div>
      
    </div>
</div>
@endsection

@section('title', '| Blog')
