@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
@endsection
@section('content')
<div class="row mt-2">
        
    <div class="col-md-8">
        
        {!! //Model-Form binding: if you look the text and textarea automatically get post->body and post->title
        Form::model($post, ['route' => ['posts.update', $post->id], 'method'=>'PUT', 'data-parsley-validate'=>'']) !!}
        {{Form::label('title', 'Title:') }}
        {{Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter a Title',  'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}

        {{Form::label('slug', 'Slug:') }}
        {{Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Enter a Slug URL', 'required'=>'', 'minlength'=>5, 'maxlength'=>190] ) }}
        
        {{Form::label('body', 'Body:', array('class'=> 'btn-h1-spacing')) }}
        {{Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'What\'s on your mind?', 'required'=>'')) }}
    </div>
    <div class="col-md-4">
        <div class="card">
        <div class="card-body bg-light">
           <div class="row">
                <div class="col-sm-6">{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}</div>
                <div class="col-sm-6">{{Form::submit('Save', array('class'=>'btn btn-success btn-block')) }}</div>
           </div>
        </div>
    </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection
@section('title', '| Edit Post')

@section('scripts')
{{Html::script('js/parsley.min.js') }}
@endsection