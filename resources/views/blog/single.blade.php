@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
@endsection
@section('content')
<div class="row mt-2">
    <div class="col-md-6">
        <div class="blog-post">
            <h3>{{$post->title}}</h3>
            <p>{{$post->body}}</p>
        </div>
    </div>
    <div class="col-md-4 offset-md-2">
        <div class="card">
        <div class="card-body bg-light">
           <dl class="dl-horizontal">
            <dt>Created At</dt>
           <dd>{{date('M j, Y g:i A', strtotime($post->created_at))}}</dd>
           </dl>
           <dl class="dl-horizontal">
            <dt>Last Updated At</dt>
            <dd>{{ date('M j, Y g:i A', strtotime($post->updated_at)) }}</dd>
           </dl>
           <hr>
        </div>
    </div>
    </div>
</div>
<div class="row mt-2">
    <ol>
    @foreach($comments as $key=>$comment)
<li>{{ $comment->comment_text . ' by ' . $users[$key]->username}}</li>
    @endforeach
    </ol>
</div>
<div class="row mt-2">
        <div class="col-md-8">
                @auth
                {!! Form::open(['route' => 'comments.store', 'data-parsley-validate'=>'']) !!}
    
                {{Form::label('comment', 'Comment:') }}
                {{Form::textarea('comment', null, array('class'=>'form-control', 'placeholder'=>'Add a comment...','required'=>'')) }}

                {{ Form::hidden('post_id', $post->id) }}
                {{ Form::hidden('user_id', $post->user_id) }}
                {{Form::submit('Create', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=> 'margin-top: 20px']) }}
    
                {!! Form::close() !!}
                @else
                <span>Only logged in users can comment on posts. Login to comment on this post!</span>
                @endauth
        </div>
</div>



@endsection
@section('title', "| $post->title")

@section('scripts')
{{Html::script('js/parsley.min.js') }}
@endsection