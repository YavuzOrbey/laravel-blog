<div class="row mt-2">
    <div class="col-md-12">
        <ul class="">
        <h4>Comments <small>{{$post->comments->count() }} total</small></h4>
        @foreach($post->comments as $comment) 
        <li class="comment">
            <div class="row">
                <div class="col-sm-auto portrait-wrapper">
                <img class="portrait-icon" src="{{ 'https://www.gravatar.com/avatar/' .  md5( strtolower( trim($comment->user->email)))}}">
                </div>
                <div class="col-sm-10 comment-banner">
                    <div class="row">
                        <div class="col-sm-6 username">{{$comment->user->username   /*$users[$key]->username didn't even need to send the users */}}</div>
                        <div class="col-sm-6 date-time-display">{{ date('m/d/Y g:i A', strtotime($comment->created_at)) . ($comment->created_at == $comment->updated_at ? ' ': ' Edited on: ' . date('m/d/Y, g:i A', strtotime($comment->updated_at)))}}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
            <div class="col-sm-{{ Auth::user() == $comment->user ? '10': '12'}}">
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
            
        </li>
        @endforeach
        </ul>
    </div>
</div>