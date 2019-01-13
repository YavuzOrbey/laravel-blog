@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
@endsection
@section('content')
<div class="row mt-2">
    <div class="col-md-6">
        <h3>{{$post->title}}</h3>
        <p>{{$post->body}}</p>
    </div>
    <div class="col-md-4 offset-md-2">
        <div class="card">
        <div class="card-body bg-light">
           <dl class="dl-horizontal">
            <dt>Created At</dt>
           <dd>{{date('M j, Y g:i A', strtotime($post->created_at))}}</dd>
           </dl>
           <dl class="dl-horizontal">
            <dt>Last Updated At</dt>
            <dd>{{ date('M j, Y g:i A', strtotime($post->updated_at)) }}</dd>
           </dl>
           <hr>
        </div>
    </div>
    </div>
</div>

@endsection
@section('title', "| $post->title")

@section('scripts')
{{Html::script('js/parsley.min.js') }}
@endsection