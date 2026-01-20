<?php
namespace App\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OnlineStatus implements ShouldBroadcast
{
    use SerializesModels;


    public function __construct()
    {
        
    }

    public function broadcastOn()
    {
        return new PresenceChannel('onlinechannel' );
    }

}


