@extends('main')

@section('title', " | Edit $tag->name")

@section('content')
{!! Form::open(['route'=>['tags.update', $tag],  'method'=>'PUT', 'data-parsley-validate'=>''])!!}
{{Form::label('name', 'Tag Name')}}
{{ Form::text('name', $tag->name, ['class'=>'form-control'])}}
{{ Form::submit('Save', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@stop

