@extends('main')
@section('stylesheets')

@endsection
@section('content')
<div id='container'>
    <div class='row mb-3'>
        <div class='col design-description'>
        <h2>{{$project->name}}</h2>
            <h4>Technologies Used: {{$project->technology_text}}</h4>
            <span>
                {{$project->design_text}}                
            </span>
            
        </div>
        <div class='col design-image'>
        <a href='{{asset('images/' . $project->design_image)}}'><img class=' mw-100' src='{{asset('images/' . $project->design_image)}}'></a>
        </div>
    </div>
    <div class='row'>
        <div class='col final-image'>
            <a href='{{asset('images/' . $project->final_image)}}'>
                <img class='mw-100' src='{{asset('images/' . $project->final_image )}}'>
            </a>
        </div>
        <div class='col final-description'>
            <span>
                {{$project->final_text}}                
            </span>
        </div>
</div>
@stop
@section('title', '| Portfolio')

@section('scripts')
@endsection