@extends('main')
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@endsection
@section('content')
    <div class="row justify-content-center">
        
        <div class="col-md-8"><h1>Create New Project</h1></div>
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
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate="" onsubmit="return sendForm()">
    @csrf
    <div class="row g-3">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter a Name" required minlength="3" maxlength="190" />
    </div>
    
    <div class="row g-3 form-floating">
        <input type="text" name="technology_text" id="technology_text" class="form-control" placeholder="Enter Technologies Used" required minlength="3" maxlength="190" />
        <label for="technology_text">Technologies Used:</label>
    </div>
    
    <div class="g-3">
        <label for="design_image">Design Image:</label>
        <input type="file" name="design_image" id="design_image" />
    </div>
    
    <div class="form-floating row g-3">
        <textarea name="design_text" id="design_text" class="form-control" required></textarea>
        <label for="design_text">Design Text:</label>
    </div>
    
    <div class="g-3">
        <label for="final_image">Final Image:</label>
        <input type="file" name="final_image" id="final_image" />
    </div>
    
    <div class="row g-3 form-floating">
        <textarea name="final_text" id="final_text" class="form-control" required></textarea>
        <label for="final_text">Final Text:</label>
    </div>
    
    <button type="submit" id="submit-btn" class="btn btn-primary btn-lg btn-block" style="margin-top: 20px">Create</button>
</form>

        </div>
        <div class="col-md-12">
            <div class="buttons"></div>
        </div>
        
    </div>
@endsection
@section('title', '| Create Post')

@section('scripts')
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection