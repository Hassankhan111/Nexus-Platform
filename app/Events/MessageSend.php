<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use Illuminate\Queue\SerializesModels;

class MessageSend implements ShouldBroadcastNow
{
    use SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }


   //my channel name
    public function broadcastOn()
    {
        return new PrivateChannel('broadcast-message.'. $this->message->receiver_id);
    }

       public function broadcastAs()
    {
        return  'getChatMessage';
    }
} 


