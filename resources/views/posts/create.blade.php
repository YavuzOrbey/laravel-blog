@extends('main')
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
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
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate onsubmit="return sendForm()">
    @csrf
    
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" class="form-control" placeholder="Enter a Title" required minlength="3" maxlength="190" value="{{ old('title') }}">
    
    <label for="category">Category:</label>
    <select name="category" id="category" class="form-control" required>
        <option value="" disabled>Select a Category</option>
        @foreach($categories as $key => $category)
            <option value="{{ $key }}">{{ $category }}</option>
        @endforeach
    </select>

    <label for="tags">Tags:</label>
    <select name="tags[]" id="tags" class="form-control js-example-basic-multiple" multiple="multiple">
        @foreach($tags as $key => $tag)
            <option value="{{ $key }}">{{ $tag }}</option>
        @endforeach
    </select>

    <label for="slug">Url:</label>
    <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter a Slug URL" required minlength="5" maxlength="190" value="{{ old('slug') }}">

    <label for="image">Image:</label>
    <input type="file" name="image" id="image">

    <label for="body">Post Body:</label>
    <textarea name="body" id="hidden-editor" class="form-control" required style="display: none;"></textarea>
    <section id="editor" class="textarea form-control" contenteditable style="display: inline-block">{{ old('body') }}</section>

    <button type="submit" id="submit-btn" class="btn btn-primary btn-lg btn-block" style="margin-top: 20px;">Create</button>
</form>

        </div>
        <div class="col-md-12">
            <div class="buttons"></div>
        </div>
        
    </div>
@endsection
@section('title', '| Create Post')

@section('scripts')
<script src="{{ asset('js/wysiwyg.js') }}"></script>
<script src="{{ asset('js/parsley.min.js') }}"></script>

<!-- Select2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

init();

</script>
@endsection