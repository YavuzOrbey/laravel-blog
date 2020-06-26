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
use App\PrivateMessage;
class NewPrivateMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $privateMessage;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PrivateMessage $privateMessage)
    {
        $this->privateMessage = $privateMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if($this->privateMessage->user_from->id <  $this->privateMessage->user_to->id){
            $first = $this->privateMessage->user_from->id;
            $second= $this->privateMessage->user_to->id;
          }
          else{
            $first  = $this->privateMessage->user_to->id;
            $second = $this->privateMessage->user_from->id;
          }
        return [new Channel("private_message_" . $first . "_" . $second)];
    }
    public function broadcastAs()
  {
      return 'NewPrivateMessage';
  }
    public function broadcastWith(){
        return [
            'from' => $this->privateMessage->user_from->username,
            'to' =>  $this->privateMessage->user_to->username,
            'text' => $this->privateMessage->text,
            'created_at' => $this->privateMessage->created_at->format('H:i:s')
        ];
    }
}
