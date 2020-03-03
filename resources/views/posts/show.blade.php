@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@endsection
@section('content')
<div class="row mt-2">
    <div class="col-md-8">
        <h3>{{$post->title}}</h3>
        <p>{!!$post->body!!}</p>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body bg-light">
                <dl class="dl-horizontal">
                    <dt>URL Slug:</dt>
                    <dd><a href="{{route('blog.single', ['username' => Auth::user()->username, 'slug'=>$post->slug])}}">View in blog </a></dd>
                    <dt>Category</dt>
                    <dd>{{$post->category->name}}</dd>
                    <dt>Tags</dt>
                <dd>{{$post->tags->implode('name', ', ')}}</dd>
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
<div class="row">
    <div class="col-md-10">
      <h1>All Comments</h1>
    </div>
  </div>
  <div class="row mt-2">
      <div class="col-md-12">
        <table>
          <thead>
            <tr>
              <th>Comment</th>
              <th>User</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr id="tr"></tr>

          <noscript>
            @foreach ($post->comments as $comment)
                <tr>
                  <td><span class='ref-name'>{{$comment->comment_text}}</span></td>
                  <td><a href="/{{$comment->user->username}}/blog">{{$comment->user->username}}</a></td>
                  {!! Form::open(['route'=> ['comments.destroy', $comment], 'method'=>'DELETE'])!!}
                  <td><button class="btn btn-danger "><i class="fas fa-trash-alt"></i></button></td>
                  {!! Form::close() !!}
                </tr>
            @endforeach
          </noscript>
          </tbody>
        </table>
      </div>
  </div>   
@endsection
@section('title', '| Created Post')

@section('scripts')
{{Html::script('js/parsley.min.js') }}
<script src="{{ asset('js/app.js') }}"></script>
<script>
  var tr = document.getElementById('tr');
  var myTr = document.createElement("tr");
  myTr.setAttribute("v-for", "comment in comments");
  myTr.innerHTML = `<td><span class='ref-name'>@{{comment.comment_text}}</span></td>
                <td><a v-bind:href="'/'+comment.user.username + '/blog'">@{{comment.user.username}}</a></td>`;
  tr.parentNode.replaceChild(myTr, tr);
      const app = new Vue({
          el: '#app',
          data:  {
              comments: {},
              commentBox: '',
              post: {!! $post->toJson() !!},
              user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
          },
          mounted() {
              this.getComments();
          },
          methods: {
              getComments() {
                  axios.get('/api/posts/'+this.post.id+'/comments')
                       .then((response) => {
                           this.comments = response.data
                       })
                       .catch(function (error) {
                           console.log(error);
                       }
                  );
              },
              postComment() {
                  axios.post('/api/posts/'+this.post.id+'/comment', {
                      api_token: this.user.api_token,
                      body: this.commentBox
                  })
                  .then((response) => {
                      this.comments.unshift(response.data);
                      this.commentBox = '';
                  })
                  .catch((error) => {
                      console.log(error);
                  })
              }
          }
      })
</script>
@stop