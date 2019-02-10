@extends('main')

@section('title', " | Edit $category->name")

@section('content')
{!! Form::open(['route'=>['categories.update', $category->id],  'method'=>'PUT', 'data-parsley-validate'=>''])!!}
{{Form::label('name', 'Category Name')}}
{{ Form::text('name', $category->name, ['class'=>'form-control'])}}
{{ Form::submit('Save', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@stop

