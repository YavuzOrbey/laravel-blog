@extends('main')
@section('stylesheets')
<style>
    .custom-container{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        flex-flow: row wrap; /* combo of 2 properties above*/
        align-items: stretch;
        max-width: 1200px;
        margin: 0 auto;
    }
    .portfolio-item{
        max-width: 300px;
        padding: 10px;
        box-shadow: 1px 1px 3px 3px #b3b3b35d;
        margin: 10px;
        border-radius: 5px;
        transform: scale(1);
        transition: transform .2s;
        
    }
    .portfolio-item:hover{
        box-shadow: 2px 2px 5px 5px #08080850;
        transform: scale(1.1);
    }
    h1{
        text-align: center;
    }
    a{
        text-decoration: none;
        color: inherit;
    }
</style>
@endsection
@section('content')
<h1>Portfolio</h1>
<div class='portfolio-container'>
    <div class="container">
        <div class="row">
            @foreach ($projects as $project)
            <div class="col-md-3 p-3 border">
                <div>
            <a href='{{route('projects.show', $project)}}'><img class="mw-100" src='{{asset('images/' . $project->final_image)}}'></a></div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="custom-container">
        @foreach ($projects as $project)
        <a href='{{route('projects.show', $project)}}'>
            <div class='portfolio-item'>
                <img class="mw-100" src='{{asset('images/' . $project->final_image)}}'>
            <h3>{{$project->name}}</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit.</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@stop
@section('title', '| Portfolio')

@section('scripts')
@endsection