@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
@endsection
@section('content')
    <div class="row justify-content-center">
        
        <div class="col-md-8"><h1>Create New Post</h1></div>
        <div class="col-md-12">
            {!! Form::open(['route' => 'posts.store', 'data-parsley-validate'=>'']) !!}
                {{Form::label('title', 'Title:') }}
                {{Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter a Title', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}

                {{Form::label('slug', 'Slug:') }}
                {{Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Enter a Slug URL', 'required'=>'', 'minlength'=>5, 'maxlength'=>190] ) }}

                {{Form::label('body', 'Post Body:') }}
                {{Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'What\'s on your mind?','required'=>'')) }}

                {{Form::submit('Create', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=> 'margin-top: 20px']) }}

            {!! Form::close() !!}
        </div>
        
    </div>
@endsection
@section('title', '| Create Post')

@section('scripts')
{{Html::script('js/parsley.min.js') }}
@endsection