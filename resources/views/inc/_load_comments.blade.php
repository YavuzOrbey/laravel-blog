<div class="row mt-2">
    <div class="col-md-12">
        <ul class="">
        <h4>Comments <small>{{$post->comments->count() }} total</small></h4>
        @foreach($post->comments as $comment) 
        <li class="comment">
            <div class="row">
                <div class="col-xs-2">
                <div class="portrait-icon">{{"ICON"}}</div>
                </div>
                <div class="col-xs-10 comment-banner">
                    <div class="row">
                        <div class="col-sm-6 username">{{$comment->user->username   /*$users[$key]->username didn't even need to send the users */}}</div>
                        <div class="col-sm-6 date-time-display">{{ date('m/d/Y g:i A', strtotime($comment->created_at)) . ($comment->created_at == $comment->updated_at ? ' ': ' Edited on: ' . date('m/d/Y, g:i A', strtotime($comment->updated_at)))}}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-xs-12">
                    {{$comment->comment_text}}
                </div>
            </div>
            @if(Auth::user() == $comment->user)
            {!! Form::open(['route'=> ['comments.destroy', $comment], 'method'=>'DELETE']) !!}
            <div class="row">
                <div class="col-sm-4">{{Form::submit('Delete', array('class'=>'btn btn-danger btn-block')) }}</div>
            </div>
            {!! Form::close() !!}
            @endif
        </li>
        @endforeach
        </ul>
    </div>
</div>