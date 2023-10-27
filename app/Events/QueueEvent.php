<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QueueEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $schedule, $queue;

    public function __construct($schedule, $queue)
    {
        $this->schedule = $schedule;
        $this->queue = $queue;
    }

    public function broadcastOn()
    {
        return new Channel('public.queue.1');
    }

    public function broadcastAs()
    {
        return 'queue.1';
    }

    public function broadcastWith(): array
    {
        return [
            'schedule' => $this->schedule,
            'queue' => $this->queue,
        ];
    }
}
