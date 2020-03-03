<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use App\Comment;
class NewComment implements ShouldBroadcastNow //change this later
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $comment;
    public $number = 0;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //need to create a dynamic channel for each post
        return [new Channel("post." . $this->comment->post->id), new Channel('comments')];
    }
    public function broadcastWith(){
        return [
            'comment_text' => $this->comment->comment_text,
            'user'=>[
                'username'=>$this->comment->user->username,
                'avatar' => ""
            ],
            'created_at' => $this->comment->created_at->toDateTimeString()];
    }
}
