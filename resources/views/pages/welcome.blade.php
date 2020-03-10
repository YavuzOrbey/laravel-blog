
@extends('main')

@section('content')
{{-- Need to do a few things here. For one need to loop through the posts and see which categories there are in the first place.  --}}
<div class='row'>
@foreach ($posts as $key=>$category)
    <div class="col-xl-6">
        <div class='{{strtolower($key)}} item '>
        <h3 class='blog-title' style="color: @if($loop->index%3==0) {{'white'}} @else {{'black'}} @endif"><span>{{$key}}</span></h3>
            <div class='recent-posts'>
                <h5>Recent Posts</h5>
                <ul>
                    @if(!count($posts[$key]))
                    <li>No posts to show!</li>
                    @endif
                    @foreach($posts[$key] as $post)
                <li><a href="{{route('blog.single', [$post->user->username, $post->slug])}}">{{$post->title}} - <time datetime="{{date('Y-m-d H:i', strtotime($post->created_at))}}">
                    {{date('m/d/y', strtotime($post->created_at)) . " " . date('g:i A', strtotime($post->created_at))}}
                </time></a></li>
                    @endforeach
                
                </ul>
            </div>
        </div>
    </div>
    
@endforeach
</div>
<div id="chat" class='messages'>
    <select id="user_select" v-model="sendTo" @click.prevent="run">
        <option value="volvo">Nobody</option>
        <option value="saab">Nobody</option>
        <option value="8">Yavuz</option>
        <option value="9">Deniz</option>
      </select>
    <ul>
        <li  v-for="message in messages">
            @{{message.from}}- @{{message.created_at}}: @{{message.text}}
        </li>
    </ul>
    <textarea name="body" v-model="messageBox" ></textarea>
    <button @click.prevent="sendMessage" >Submit</button>
</div>
@endsection

@section('scripts')

<script
src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/p5@0.10.2/lib/p5.js"></script>
{{-- <script src="{{asset('js/particles.js')}}"></script> --}}
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var chat = document.getElementById('chat');
const app = new Vue({
    el: '#app',
    data:  {
        messages: {},
        messageBox:'',
        user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
        sendTo: null,
    },
    mounted() {

    },
    methods: {
        run(){
            this.getMessages();
            this.listen();
        },
        getMessages() {
            axios.get(`/api/messages/${this.sendTo}`, {
                headers: {
                Authorization: 'Bearer ' + this.user.api_token //the token is a variable which holds the token
                }
            })
                 .then((response) => {
                     this.messages = response.data
                 })
                 .catch(function (error) {
                     console.log(error);
                 }
            );
        },
        sendMessage() {
            axios.post(`/api/messages/${this.sendTo}`, {
                api_token: this.user.api_token,
                body: this.messageBox
            })
            .then((response) => {

                this.messages.push(response.data);
                this.messageBox = '';
            })
            .catch((error) => {
                console.log(error);
            })
        },
        listen(){
                let channel = `private_message_${this.user.id+parseInt(this.sendTo)}`;
                Echo.channel(channel).listen('NewPrivateMessage', 
                (newMessage)=>  this.messages.push(newMessage) );
            
        }

    }})
    

</script>
@stop

@section('stylesheets')
<link href="https://fonts.googleapis.com/css?family=Mirza:400,700&display=swap" rel="stylesheet">
{{Html::style('css/chat.css')}}
@stop