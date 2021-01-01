<?php

namespace App\Events;

use App\Models\Match;
use App\Models\Request;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestReponse implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $req;
    public $match;
    public function __construct(Request $request,Match $match=null)
    {
        $this->req=$request;
        $this->match = $match;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('response-req.'.$this->req->id);
    }

    public function broadcastWith(){
        return [
            'request'=>$this->req->toArray(),
            'match'=>$this->match->toArray()
        ];
    }
}
