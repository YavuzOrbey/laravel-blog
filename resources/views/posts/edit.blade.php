@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- Select2 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
{{Html::script('js/wysiwyg.js') }}
@endsection
@section('content')
<div class="row mt-2">
        
    <div class="col-md-8">
        
        {!! //Model-Form binding: if you look the text and textarea automatically get post->body and post->title
        Form::model($post, ['route' => ['posts.update', $post->id], 'method'=>'PUT', 'data-parsley-validate'=>'', 'onSubmit'=> 'return sendForm()', 'files'=> true]) !!}
        {{Form::label('title', 'Title:') }}
        {{Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter a Title',  'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}

        {{Form::label('category', 'Category:') }}
        {{Form::select('category', $categories, $post->category->id, ['class'=>'form-control', 'placeholder'=>'Enter a Category', 'required'=>''])}}

        
        {{Form::label('tags', 'Tags:') }}
        {{Form::select('tags[]', $tags, null, ['class'=>'form-control js-example-basic-multiple', 'multiple'=>'multiple'] ) }}


        {{Form::label('slug', 'Slug:') }}
        {{Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Enter a Slug URL', 'required'=>'', 'minlength'=>5, 'maxlength'=>190] ) }}
        
        {{Form::label('image', 'Image:') }}
        {{Form::file('image') }}

        {{Form::label('body', 'Body:', array('class'=> 'btn-h1-spacing')) }}
        {{Form::hidden('body', null, array('id'=>'hidden-editor', 'required'=>'')) }}
        <section id="editor" class="textarea form-control" contenteditable>{!!$post->body!!}</section>
    </div>
    <div class="col-md-4">
        <div class="card">
        <div class="card-body bg-light">
           <div class="row">
                <div class="col-sm-6">{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}</div>
                <div class="col-sm-6">{{Form::submit('Save', array('id'=>'submit-btn', 'class'=>'btn btn-success btn-block')) }}</div>
           </div>
        </div>
    </div>
    </div>
    {!! Form::close() !!}
    <div class="col-md-12">
            <div class="buttons"></div>
            <div class="editor" contenteditable>
                <h1>Simple Html editor</h1>
                <p>Good to start</p>
              </div>
        </div>
</div>

@endsection
@section('title', '| Edit Post')

@section('scripts')
{{Html::script('js/parsley.min.js') }}
<!-- Select2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
init();
</script>
@endsection