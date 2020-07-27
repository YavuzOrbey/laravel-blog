
@extends('main')

@section('content')
{{-- Need to do a few things here. For one need to loop through the posts and see which categories there are in the first place.  --}}
<div class='row'>
@foreach ($posts  as $key=>$category)
    <div class="col-xl-6">
        <div class='{{strtolower($key)}} item '>
        <h3 class='blog-title' style="color: @if($loop->index%3==0) {{'white'}} @else {{'black'}} @endif"><span>{{$key}}</span></h3>
            <div class='recent-posts'>
                <h5>Recent Posts</h5>
                <ul>
                    @if(!count($posts[$key]))
                    <li>No posts to show!</li>
                    @endif
                    @foreach($posts[$key] as $post)
                <li><a href="{{route('blog.single', [$post->user->username, $post->slug])}}">{{$post->title}} - <time datetime="{{date('Y-m-d H:i', strtotime($post->created_at))}}">
                    {{date('m/d/y', strtotime($post->created_at)) . " " . date('g:i A', strtotime($post->created_at))}}
                </time></a></li>
                    @endforeach
                
                </ul>
            </div>
        </div>
    </div>
    
@endforeach
</div>


@endsection

@section('scripts')

<script
src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/p5@0.10.2/lib/p5.js"></script>
{{-- <script src="{{asset('js/particles.js')}}"></script> --}}

@stop

@section('stylesheets')
<link href="https://fonts.googleapis.com/css?family=Mirza:400,700&display=swap" rel="stylesheet">

@stop