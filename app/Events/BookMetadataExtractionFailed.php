<?php

namespace App\Events;

use App\Enums\NotificationType;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookMetadataExtractionFailed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
        public string $msg,
        public ?string $action_url = null,
        public ?string $action_desc = null,
    )
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('users.' . $this->user->id),
        ];
    }

    public function broadcastWith(): array {
        return [
            'type' => NotificationType::Error,
            'title' => 'An error occurred while processing your book',
            'id' => uuid_create(),
            'msg' => $this->msg,
            'action_url' => $this->action_url,
            'action_desc' => $this->action_desc,
        ];
    }
}
