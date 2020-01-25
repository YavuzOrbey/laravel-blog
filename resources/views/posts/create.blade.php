@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- Select2 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
    <div class="row justify-content-center">
        
        <div class="col-md-8"><h1>Create New Post</h1></div>
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            </div>

                
            @endif
            {!! Form::open(['route' => 'posts.store', 'data-parsley-validate'=>'', 'onSubmit'=> 'return sendForm()', 'files'=> true]) !!}
                {{Form::label('title', 'Title:') }}
                {{Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter a Title', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}

                {{Form::label('category', 'Category:') }}
                {{Form::select('category', $categories, null, ['class'=>'form-control', 'placeholder'=>'Enter a Category', 'required'=>''])}}

                {{Form::label('tags', 'Tags:') }}
                {{Form::select('tags[]', $tags, null, ['class'=>'form-control js-example-basic-multiple', 'multiple'=>'multiple'] ) }}

                {{Form::label('slug', 'Url:') }}
                {{Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Enter a Slug URL', 'required'=>'', 'minlength'=>5, 'maxlength'=>190] ) }}

                {{Form::label('image', 'Image:') }}
                {{Form::file('image') }}

                {{Form::label('body', 'Post Body:') }}
                {{Form::hidden('body', null, array('id'=>'hidden-editor', 'required'=>'')) }}
                <section id="editor" class="textarea form-control" contenteditable style="display:inline-block">{{old('body')}}</section>

                {{Form::submit('Create', ['id'=>'submit-btn', 'class'=>'btn btn-primary btn-lg btn-block', 'style'=> 'margin-top: 20px']) }}

            {!! Form::close() !!}
        </div>
        <div class="col-md-12">
            <div class="buttons"></div>
        </div>
        
    </div>
@endsection
@section('title', '| Create Post')

@section('scripts')
{{Html::script('js/wysiwyg.js') }}
{{Html::script('js/parsley.min.js') }}
<!-- Select2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

init();

</script>
@endsection