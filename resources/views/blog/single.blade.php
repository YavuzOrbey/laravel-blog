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
    <div class="col-md-8">
        <ol class="">
        @foreach($post->comments as $comment) 
        <li class="comment">
            <div class="row">
                <div class="col-md-10 offset-md-1 comment-text">{{ $comment->comment_text }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-1">
                    <div class="date-time-display">
                        {{'Posted at: ' . date('m/d/Y, g:i A', strtotime($comment->created_at)) . ($comment->created_at == $comment->updated_at ? ' ': 'Edit: ' . date('m/d/Y, g:i A', strtotime($comment->created_at)))}}
                    </div>
                    <strong>{{$comment->user->username /*$users[$key]->username didn't even need to send the users */}}</strong>
                </div>
            </div>
        </li>
        @endforeach
        </ol>
    </div>
</div>
<div class="row mt-2">
        <div class="col-md-8">
            <!-- may want to change this at some point to have post owner comment on his own posts -->
                @if (Auth::check() && Auth::id()!=$post->user_id )

                {!! Form::open(['route' => 'comments.store', 'data-parsley-validate'=>'']) !!}
    
                {{Form::label('comment', 'Comment:') }}
                {{Form::textarea('comment', null, array('class'=>'form-control', 'placeholder'=>'Add a comment...','required'=>'')) }}

                {{ Form::hidden('post_id', $post->id) }}
                {{ Form::hidden('user_id', $post->user_id) }}
                {{Form::submit('Create', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=> 'margin-top: 20px']) }}
    
                {!! Form::close() !!}
                @elseif (!Auth::check())
                <span>Only logged in users can comment on posts. Login to comment on this post!</span>
                
                @endif
        </div>
</div>



@endsection
@section('title', '| ' . htmlspecialchars($post->title))

@section('scripts')
{{Html::script('js/parsley.min.js') }}
@endsection