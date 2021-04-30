<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class PrivateMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user_name;
    private $title;
    private $message;

    /**
     * Create a new event instance.
     * @param User $user
     * @return void
     */
    public function __construct($title, User $user, $message)
    {
        $this->user_name = $user->name;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(){
        return new PrivateChannel("code.".$this->title);
    }

    public function broadcastAs(){
        return "MessageEvent";
    }

    public function broadcastWith(){
        return [
            "message"=>$this->message,
            "user"=>$this->user_name,
            "datetime"=>\Carbon\Carbon::now()->setTimezone("America/Denver")->format("d-m-Y h:m:s a"),
            "time"=>\Carbon\Carbon::now()->setTimezone("America/Denver")->format("h:m a")
        ];
    }
}
