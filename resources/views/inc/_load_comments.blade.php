<div class="row mt-2">
    <div class="col-md-12">
        <ul class="">
        <h4>Comments <small>{{$post->comments->count() }} total</small></h4>
        @foreach($post->comments as $comment) 
        <li class="comment container" data-comment="{{$comment->id}}">
            <div class="row mt-2">
                <div class="col-sm-1 portrait-wrapper">
                    <img class="portrait-icon" src="{{ 'https://www.gravatar.com/avatar/' .  md5( strtolower( trim($comment->user->email)))}}">
                </div>
                <div class="col-sm-7 username"><a href="/{{$comment->user->username}}/blog">{{$comment->user->username   /*$users[$key]->username didn't even need to send the users */}}</a></div>
                <div class="col-sm-4 date-time-display"><span>Posted on {{ date('m/d/Y g:i A', strtotime($comment->created_at)) . ($comment->created_at == $comment->updated_at ? ' ': ' Edited on: ' . date('m/d/Y, g:i A', strtotime($comment->updated_at)))}}</span></div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-{{ Auth::user() == $comment->user ? '10': '12'}} comment-text">
                        {{$comment->comment_text}}
                </div>
                @if(Auth::user() == $comment->user)
                <div class="col-sm-2">
                    {!! Form::open(['route'=> ['comments.destroy', $comment], 'method'=>'DELETE']) !!}
                    {{Form::submit('Delete', array('class'=>'btn btn-danger btn-block')) }}
                    {!! Form::close() !!}
                </div>
                
                @endif
            </div>
               
            <div class="row justify-content-between">
                <div class="col-2"><i class="fas fa-chevron-down"></i></div>
                @if(Auth::user())
                    
                
                <div class="col-2 social-container">
                    <span class="share-button">Share</span>
                    <span class="like-container">
                            @if(Auth::user() !== $comment->user)
                            {{-- may want to replace data-like true false with the id of the like if there doesn't exist a like yet then it should be null or 0--}}
                        <span class="like-button" data-like={{ $comment->likes->where('user_id', '=',  Auth::user()->id)->first()  ? 'true': 'false'}}>
                        {!! $comment->likes->where('user_id', '=',  Auth::user()->id)->first()  ? '<i class="fas fa-heart"></i>'
                            : "<i class='far fa-heart'></i>"!!} {{$comment->likes->count()}}</span>
                            @endif
                        </span>
                </div>
                @endif
            </div>
            
            
        </li>
        @endforeach
        </ul>
    </div>
</div>