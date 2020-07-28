@extends('main')
@section('stylesheets')
{{Html::style('css/parsley.css') }}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.1/styles/vs2015.min.css">
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
        <p>{!! html_entity_decode($post->body) !!}</p>
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
</div>
@include('inc/_load_comments')

@endsection
@section('title', '| ' . htmlspecialchars($post->title))

@section('scripts')


{{Html::script('js/parsley.min.js') }}
<script>
    Vue.component('comment-app', {
        data: function(){
             return {
                comments: {},
                commentBox: '',
                post: {!! $post->toJson() !!}
             }
         },
        mounted(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login ').then(res=>{

                }) 
            }).then(next=>{
                this.getComments();
                    this.listen();
            });
         },
        methods: {
            getComments() {
                axios.get('/api/posts/'+this.post.id+'/comments')
                    .then((response) => {
                        console.log(response.data);
                        this.comments = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    }
                );
            },
            postComment() {
                axios.post('/api/posts/'+this.post.id+'/comment', {
                        body: this.commentBox
                })
                .then((response) => {
                    this.comments.push(response.data);
                    this.commentBox = '';
                })
                .catch((error) => {
                    console.log(error);
                })
            },
            listen(){
                Echo.channel("post." + this.post.id).listen('NewComment', (comment)=> this.comments.unshift(comment))
            }},
            template: `<div><li v-for="comment in comments" class="comment container" :data-comment="comment.id">
                <div class="row mt-2">
        <div class="col-sm-1 portrait-wrapper">
            <img class="portrait-icon" v-bind:src="'https://www.gravatar.com/avatar/'+comment.user.avatar">
        </div>
        <div class="col-sm-7 username"><a v-bind:href="'/'+comment.user.username + '/blog'">@{{comment.user.username}}</a></div>
        <div class="col-sm-4 date-time-display">
            <span>Posted on  @{{comment.creation}} 
                <template v-if="comment.created_at !== comment.updated_at">
                    Edited on: @{{comment.updated_at}}</template>
            </span>
        </div>
    </div>
    <div class="row mt-4">
        <div v-bind:class="[comment.user.username===$root.user ? 'col-sm-10' : 'col-sm-12', 'comment-text']">
               @{{comment.comment_text}}
        </div>
    </div></li><div class="row mt-2">
        <div class="col-md-12" v-if="$root.user">
            <textarea class='form-control' name="body" v-model="commentBox" ></textarea>
            <button class='btn btn-outline-primary' @click.prevent="postComment" >Submit</button>
        </div>
        <div class="col-md-12" v-else>
            <span>Only logged in users can comment on or like posts. Login to comment on this post!</span>
        </div>
</div></div>`
     });   
/* const commentApp = new Vue({
    el: '#commentApp',
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
    }}) */


</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
@endsection