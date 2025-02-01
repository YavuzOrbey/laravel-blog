@extends('main')
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- Select2 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="{{ asset('js/wysiwyg.js') }}"></script>
@endsection
@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate onsubmit="return sendForm()">
    @method('PUT')
    @csrf
    <div class="row mt-2">
        <div class="col-md-8">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" placeholder="Enter a Title" required minlength="3" maxlength="190" value="{{ old('title', $post->title) }}">

            <label for="category">Category:</label>
            <select name="category" class="form-control" required>
                @foreach($categories as $id => $category)
                    <option value="{{ $id }}" {{ $id == old('category', $post->category->id) ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>

            <label for="tags">Tags:</label>
            <select name="tags[]" class="form-control js-example-basic-multiple" multiple>
                @foreach($tags as $id => $tag)
                    <option value="{{ $id }}" {{ in_array($id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $tag }}</option>
                @endforeach
            </select>

            <label for="slug">Slug:</label>
            <input type="text" name="slug" class="form-control" placeholder="Enter a Slug URL" required minlength="5" maxlength="190" value="{{ old('slug', $post->slug) }}">

            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control">

            <label for="body" class="btn-h1-spacing">Body:</label>
            <input type="hidden" name="body" id="hidden-editor" required value="{{ old('body', $post->body) }}">
            <section id="editor" class="textarea form-control" contenteditable style="display:inline-block">{!! old('body', $post->body) !!}</section>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-sm-6"><a href="{{ route('posts.show', $post->id) }}" class="btn btn-danger btn-block">Cancel</a></div>
                        <div class="col-sm-6">
                            <button type="submit" id="submit-btn" class="btn btn-success btn-block">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
@section('title', '| Edit Post')

@section('scripts')
<script src="{{ asset('js/parsley.min.js') }}"></script>
<!-- Select2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
init();
</script>
@endsection