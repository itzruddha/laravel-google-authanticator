<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminCreateMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $admin;
    public $password;

    /**
     * Create a new event instance.
     */
    public function __construct($admin, $password)
    {
        //

        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
