
@extends('main')

@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h2>Welcome to my website. Feel free to register and start blogging. Enjoy!</h2>
        <p>First register for an account up top, follow the instructions and you're on your way!</p>
    </div>
</div>


@endsection

@section('scripts')

<script
src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/p5@0.10.2/lib/p5.js"></script>
<script src="{{asset('js/particles.js')}}"></script>
@stop

@section('stylesheets')
<link rel="stylesheet" href="{{asset('css/particles.css')}}">
@stop