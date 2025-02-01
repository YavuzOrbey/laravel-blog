@extends('main')
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
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
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="row">
        <div class="col-sm-6">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-block">Edit</a>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-danger btn-block">Delete</button>
        </div>
    </div>
</form>

<a href="{{ route('posts.index') }}" class="btn btn-outline-dark btn-h1-spacing"><< See all posts</a>
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
                  <form action="{{ route('comments.destroy', $comment) }}" method="POST">
    @csrf
    @method('DELETE')
    <td><button class="btn btn-danger"><i class="fas fa-trash-alt"></i>Delete</button></td>
</form>

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
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
  var tr = document.getElementById('tr');
  var myTr = document.createElement("tr");
  myTr.setAttribute("v-for", "comment in comments");
  myTr.innerHTML = `<td><span class='ref-name'>@{{comment.comment_text}}</span></td>
                <td><a v-bind:href="'/'+comment.user.username + '/blog'">@{{comment.user.username}}</a></td>
                <td>
                    <form method="post" v-bind:action="'/comments/'+comment.id"> 
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">delete</button></form>
                    </td>`;
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
/*               postComment() {
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
              } */
          }
      })
</script>
@stop