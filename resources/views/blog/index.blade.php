
@extends('main')
@section('stylesheets')

@stop
@section('content')
<div class="jumbotron bg">
    <div class="container">
        <h1 class="display-4">{{$username . "'s Blog"}}</h1>
        <p class="lead">Thanks for visiting</p>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="row">
            @foreach ($posts as $post)
            <div class="blog-post col-md-3">
                {{-- <img src="{{asset('images/' . $post->image . "-width-200.jpeg")}}"> --}}
                <h4><a href="#">{{$post->category->name}}</a></h4>
                <time datetime="{{date('Y-m-d H:i', strtotime($post->created_at))}}">
                    {{date('m/d/y', strtotime($post->created_at)) . " " . date('g:i A', strtotime($post->created_at))}}
                </time>
            
            </div>
            <div class="col-md-9">
                <h4>{{$post->title}}</h4>
                <p>{{ substr(strip_tags($post->body), 0, 200)}}{{ strlen(strip_tags($post->body)) > 200 ? "...": ""}}</p>
                <a href="{{ route('blog.single', [$username, $post->slug]) }}" class="btn btn-outline-secondary btn-sm">
    Read more
</a>

            </div>
            <hr>
            @endforeach
            <div class="col-md-3 offset-md-1">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                    {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

@section('title', '| Blog')
