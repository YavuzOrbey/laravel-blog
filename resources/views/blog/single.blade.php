@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet"
      href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/styles/default.min.css">

@endsection
@section('content')
<div class="row mt-2">
    <div class="col-md-12">
    <div class='title-card {{strtolower($category->name)}}-header'>
            <h1 class="">{{$post->title}}</h1>
            <div class='author-info'>
                <h4>Written by <span class='author-name'>{{$post->user->username}}</span> on <span class="created-at">{{date('m/d/y G:i', strtotime($post->created_at))}}</span></h4>
            </div>
        </div>
        <div class="blog-post">
           
           
                {!! html_entity_decode($post->body) !!}</p>
        @if ($post->image)
        <img src="{{asset('images/' . $post->image . ".jpeg")}}">
        @endif
        </div>
        <ul class="social-media-share" >
            <li><a href="https://www.facebook.com/sharer/sharer.php?u=example.org" target="_blank">
                <i class="fab fa-facebook "></i>
              </a></li>
            <li><a class="twitter-share-button"
                href="https://twitter.com/intent/tweet">
                <i class="fab fa-twitter "></i></a></li>
            <li><span class="instagram"><i class="fab fa-instagram"></i></span></li>
        </ul>
    </div>
    {{-- <div class="col-md-6">
        
        <div class="blog-post">
            <h3>{{$post->title}}</h3>
            <p >{!! $post->body!!}</p>
        @if ($post->image)
        <img src="{{asset('images/' . $post->image . ".jpeg")}}">
        @endif
        </div>

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
            <ul class="social-media-share" >
                <li><i class="fab fa-facebook text-primary"></i></li>
                <li><i class="fab fa-twitter text-primary"></i></li>
                <li><span class="instagram"><i class="fab fa-instagram"></i></span></li>
            </ul>
            <hr>
            </div>
        </div>
    </div> --}}
</div>
@include('inc/_load_comments')
<div class="row mt-2">
        <div class="col-md-12" v-if="user">
            <textarea class='form-control' name="body" v-model="commentBox" ></textarea>
            <button @click.prevent="postComment" >Submit</button>
            <noscript>
            <!-- may want to change this at some point to have post owner comment on his own posts -->
                @if (Auth::check() && Auth::id()!=$post->user_id )

                {!! Form::open(['route' => 'comments.store', 'data-parsley-validate'=>'']) !!}
    
                {{Form::label('comment', 'Comment:') }}
                {{Form::textarea('comment', null, array('class'=>'form-control', 'placeholder'=>'Add a comment...','required'=>'')) }}

                {{ Form::hidden('post_id', $post->id) }}
                {{ Form::hidden('user_id', $post->user_id) }}
                {{Form::submit('Create', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=> 'margin-top: 20px']) }}
    
                {!! Form::close() !!}
                @elseif (!Auth::check())
                <span>Only logged in users can comment on or like posts. Login to comment on this post!</span>
                
                @endif
            </noscript>
        </div>
        <div class="col-md-12" v-else>
            <span>Only logged in users can comment on or like posts. Login to comment on this post!</span>
        </div>
</div>



@endsection
@section('title', '| ' . htmlspecialchars($post->title))

@section('scripts')
<script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
{{Html::script('js/parsley.min.js') }}
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var li = document.getElementById('li');
    var myLi = document.createElement("li");
    myLi.setAttribute("v-for", "comment in comments");
    myLi.className = "comment container";
    myLi.setAttribute(":data-comment", "comment.id");
    myLi.innerHTML = `
    <div class="row mt-2">
        <div class="col-sm-1 portrait-wrapper">
            <img class="portrait-icon" v-bind:src="'https://www.gravatar.com/avatar/'+comment.user.avatar">
        </div>
        <div class="col-sm-7 username"><a v-bind:href="'/'+comment.user.username + '/blog'">@{{comment.user.username}}</a></div>
        <div class="col-sm-4 date-time-display">
            <span>Posted on  @{{comment.created_at}} 
                <template v-if="comment.created_at !== comment.updated_at">
                    Edited on: @{{comment.updated_at}}</template>
            </span>
        </div>
    </div>
    <div class="row mt-4">
        <div v-bind:class="[comment.user.username===user ? 'col-sm-10' : 'col-sm-12', 'comment-text']">
                @{{comment.comment_text}}
        </div>
    </div>
    
    `;
  
        li.parentNode.replaceChild(myLi, li);
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
        this.listen();
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
        },
        listen(){
            Echo.channel("post." + this.post.id).listen('NewComment', (comment)=> this.comments.unshift(comment))
        }
    }})
    
    
    </script>
@endsection