@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
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
            {!! Form::open(['route' => 'posts.store', 'data-parsley-validate'=>'']) !!}
                {{Form::label('title', 'Title:') }}
                {{Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter a Title', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}

                {{Form::label('category', 'Category:') }}
                {{Form::select('category', $categories, null, ['class'=>'form-control', 'placeholder'=>'Enter a Category', 'required'=>''])}}

                {{Form::label('tags', 'Tags:') }}
                {{Form::select('tags[]', $tags, null, ['class'=>'form-control js-example-basic-multiple', 'multiple'=>'multiple'] ) }}

                {{Form::label('slug', 'Url:') }}
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
<!-- Select2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection