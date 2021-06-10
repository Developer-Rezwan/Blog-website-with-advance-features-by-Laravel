<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TypingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $reciever;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($reciever_id,  $sender_id)
    {
        $this->reciever = $reciever_id;
        $this->sender = $sender_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('typer.finder.' . $this->sender . '.and.' . $this->reciever);
    }
}