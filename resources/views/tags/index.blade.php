@extends('main')
@section('stylesheets')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@stop
@section('content')
<div class="row">
  <div class="col-md-10">
    <h1>All Tags</h1>
  </div>
</div>
<div class="row mt-2">
  <div class="col-md-8">
    <table >
      <thead>
        <tr>
          <th>Category</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($tags as $key=>$tag)
      <tr>
        <td><span class='ref-name'><a href="{{route('tags.show', $tag)}}">{{$tag->name}}</a></span></td>
      <td><a href="{{route('tags.edit', $tag)}}"><button class="btn btn-success "><i class="fas fa-edit"></i></button></a></td>
      {!! Form::open(['route'=> ['tags.update', $tag], 'method'=>'PUT'])!!}
      {{Form::text('name', $tag->name, [ 'placeholder'=>'Enter a Tag Name', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}
      {{Form::submit('Save', ['class'=>'btn btn-primary btn-lg ', 'style'=> 'margin-top: 20px']) }}
      {!! Form::close() !!}
        {!! Form::open(['route'=> ['tags.destroy', $tag], 'method'=>'DELETE'])!!}
        <td><button class="btn btn-danger "><i class="fas fa-trash-alt"></i></button></td>
        {!! Form::close() !!}
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
    <div class="col-md-4">
            {!! Form::open(['route' => 'tags.store', 'data-parsley-validate'=>'']) !!}
            {{Form::label('name', 'Name:') }}
            {{Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter a Tag Name', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}

            {{Form::submit('Create', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=> 'margin-top: 20px']) }}
{!! Form::close() !!}
    </div>
</div>
    
    <div class="text-center"></div>
@stop

@section('title', '| Tags')