@extends('main')

@section('stylesheets')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    <h1>All Categories</h1>
  </div>
</div>
<div class="row mt-2">
    <div class="col-md-8">
      <table>
        <thead>
          <tr>
            <th>Category</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
      @foreach ($categories as $key=>$category)
            <tr>
              <td><span class='ref-name'><a href="{{route('categories.show', $category)}}">{{$category->name}}</a></span>
              {!! Form::open(['route'=> ['categories.update', $category->id], 'method'=>'PUT','class'=>'edit-form'])!!}
              {{Form::text('name', $category->name, [ 'placeholder'=>'Enter a Category Name', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}
              {{Form::submit('Save', ['class'=>'btn btn-primary btn-xs ']) }}
              {!! Form::close() !!}</td>
              <td><a href="{{route('categories.edit', $category->id)}}"><button class="btn btn-success edit"><i class="fas fa-edit"></i></button></a></td>

              {!! Form::open(['route'=> ['categories.destroy', $category->id], 'method'=>'DELETE'])!!}
              <td><button class="btn btn-danger "><i class="fas fa-trash-alt"></i></button></td>
              {!! Form::close() !!}
            </tr>
      @endforeach

        </tbody>
      </table>
    </div>
    <div class="col-md-4">
            {!! Form::open(['route' => 'categories.store', 'data-parsley-validate'=>'']) !!}
            {{Form::label('name', 'Name:') }}
            {{Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter a Category Name', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}

            {{Form::submit('Create', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=> 'margin-top: 20px']) }}
{!! Form::close() !!}
    </div>
</div>
    
    <div class="text-center"></div>
@stop

@section('title', '| Categories')

@section('scripts')
<script>
$( ".edit-form" ).hide();
var editButtons = document.querySelectorAll('.edit');

editButtons.forEach(elem=> elem.addEventListener("click", showEditField));

function showEditField(event){
  event.preventDefault();
  let row = $(this).closest('tr').children('td');
  let tagName = row.children('.ref-name');
  let editForm = row.children('.edit-form');
  $(tagName).hide();
  $(editForm).show();
}
</script>
@stop