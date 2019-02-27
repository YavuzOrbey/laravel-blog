@extends('main')
@section('stylesheets')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@stop
@section('content')
<div class="row">
  <div class="col-md-10">
    <h1>All Comments you've made</h1>
  </div>
</div>


<div class="row mt-2">
    <div class="col-md-12">
        <table>
        <thead>
            <tr>
            <th>Comment</th>
            <th>Post</th>
            <th>Edit</th>
            <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $key=>$comment)
            <tr>
                <td><span class='ref-name'>{{$comment->comment_text}}</span>
                    {!! Form::open(['route'=> ['comments.update', $comment], 'method'=>'PUT','class'=>'edit-form'])!!}
                    {{Form::textarea('comment', $comment->comment_text, [ 'placeholder'=>'Enter a comment', 'required'=>'', 'minlength'=>3, 'maxlength'=>190] ) }}
                    {{Form::submit('Save', ['class'=>'btn btn-primary btn-xs ']) }}
                    {!! Form::close() !!}</td>
                    
                <td><a href="/{{$comment->post->user->username}}/blog/{{$comment->post->slug}}">{{$comment->post->slug}}</a></td>
                <td><a href="{{route('comments.edit', $comment)}}"><button class="btn btn-success edit"><i class="fas fa-edit"></i></button></a></td>
                {!! Form::open(['route'=> ['comments.destroy', $comment], 'method'=>'DELETE'])!!}
                <td><button class="btn btn-danger "><i class="fas fa-trash-alt"></i></button></td>
                {!! Form::close() !!}
            </tr>
            @endforeach

        </tbody>
        </table>
    </div>
    </div>   
<hr>
    <div class="text-center">{!! $comments->links() !!}</div>
@stop
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
@section('title', '| Posts')