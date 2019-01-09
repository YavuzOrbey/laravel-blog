@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
@endsection
@section('content')
<div class="row mt-2">
    <div class="col-md-8">
        <h3>{{$post->title}}</h3>
        <p>{{$post->body}}</p>
    </div>
    <div class="col-md-4">
        <div class="card">
        <div class="card-body bg-light">
            <dl class="dl-horizontal">
                <dt>URL Slug:</dt>
                <dd>{{url($post->slug)}}</dd>
            </dl>
           <dl class="dl-horizontal">
            <dt>Created At</dt>
           <dd>{{date('M j, Y g:i A', strtotime($post->created_at))}}</dd>
           </dl>
           <dl class="dl-horizontal">
            <dt>Last Updated At</dt>
            <dd>{{ date('M j, Y g:i A', strtotime($post->updated_at)) }}</dd>
           </dl>
           <hr>
           {!! Form::open(['route'=> ['posts.destroy', $post->id], 'method'=>'DELETE'])!!}
           <div class="row">
               <div class="col-sm-6">{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary btn-block')) !!}</div>
               <div class="col-sm-6">{{Form::submit('Delete', array('class'=>'btn btn-danger btn-block')) }}</div>
               
               
            </div>
            {!! Form::close() !!}
            {!! Html::linkRoute('posts.index', '<< See all posts', null, array('class'=>'btn btn-outline-dark btn-h1-spacing')) !!}
        </div>
    </div>
    </div>
</div>

@endsection
@section('title', '| Created Post')

@section('scripts')
{{Html::script('js/parsley.min.js') }}
@endsection