<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateSiklus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $siklus;
    public $run;
    public $cooldown;
    public $time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($siklus, $run, $cooldown, $time)
    {
        $this->siklus = $siklus;
        $this->run = $run;
        $this->cooldown = $cooldown;
        $this->time = $time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('timerChannel');
    }

    public function broadcastAs()
    {
        return 'update';
    }
}
