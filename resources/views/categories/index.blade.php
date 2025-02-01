@extends('layouts.admin')

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
              <form action="{{ route('categories.update', $category->id) }}" method="POST" class="edit-form">
    @csrf
    @method('PUT')

    <div class="form-group">
        <input type="text" name="name" value="{{ old('name', $category->name) }}" 
               placeholder="Enter a Category Name" required minlength="3" maxlength="190" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary btn-xs">Save</button>
</form>
</td>
              <td><a href="{{route('categories.edit', $category->id)}}"><button class="btn btn-success edit"><i class="fas fa-edit"></i></button></a></td>

              <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <td><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
</form>

            </tr>
      @endforeach

        </tbody>
      </table>
    </div>
    <div class="col-md-4">
    <form action="{{ route('categories.store') }}" method="POST" data-parsley-validate>
    @csrf

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Enter a Category Name" required minlength="3" maxlength="190">
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 20px">Create</button>
</form>

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